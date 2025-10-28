import { useEffect } from "react";
import { getCookie, setCookie } from "../utils/cookies";
import { useDepartmentStore } from "../store/departmentStore";
import { Department } from "../types/department";
import { DEFAULT_DEPARTMENT } from "../constants/department";

export function useDepartment() {
  const {
    currentDepartment,
    allDepartments,
    loading,
    showConfirmModal,
    setCurrentDepartment,
    setAllDepartments,
    setLoading,
    setShowConfirmModal,
    updateDepartment,
    confirmDepartment: storeConfirmDepartment,
  } = useDepartmentStore();

  const fetchAllDepartments = async (): Promise<Department[]> => {
    try {
      // @TODO: move to api component with ApiClient, use swagger-typescript-api
      const res = await fetch("http://api.code-examples.localhost/departments");
      const departments: Department[] = await res.json();
      setAllDepartments(departments);
      return departments;
    } catch (e) {
      return [];
    }
  };

  useEffect(() => {
    const initializeDepartment = async (): Promise<void> => {
      const departments = await fetchAllDepartments();
      const defaultDepartment: Department = departments.length > 0 ? departments[0] : DEFAULT_DEPARTMENT;

      const existing = getCookie("department");
      if (existing) {
        try {
          const parsedDepartment: Department = JSON.parse(existing);
          const isValidDepartment = departments.some(
            (dept: Department) => dept.city === parsedDepartment.city
          );

          if (isValidDepartment) {
            setCurrentDepartment(parsedDepartment);
            setLoading(false);
            return;
          } else {
            setCookie("department", "", -1);
          }
        } catch (e) {
          setCookie("department", "", -1);
        }
      }

      const timeout: NodeJS.Timeout = setTimeout(() => {
        setCurrentDepartment(defaultDepartment);
        setShowConfirmModal(true);
        setLoading(false);
      }, 3000);

      try {
        let detectedDepartment: Department = defaultDepartment;

        // @TODO: move to api component with ApiClient, use swagger-typescript-api
        const res = await fetch("http://api.code-examples.localhost/department-by-ip");
        const data: Department = await res.json();

        if (data && data.city) {
          const matchingDepartment: Department | undefined = departments.find(
            (dept: Department) => dept.city === data.city
          );
          if (matchingDepartment) {
            detectedDepartment = matchingDepartment;
          }
        }

        clearTimeout(timeout);
        setCurrentDepartment(detectedDepartment);
        setCookie("department", JSON.stringify(detectedDepartment));
        setShowConfirmModal(true);
      } catch (e) {
        clearTimeout(timeout);
        setCurrentDepartment(defaultDepartment);
        setShowConfirmModal(true);
      } finally {
        setLoading(false);
      }
    };

    initializeDepartment();
  }, []);

  const confirmDepartment = () => {
    setCookie("department", JSON.stringify(currentDepartment));
    storeConfirmDepartment();
  };

  const declineDepartment = async () => {
    if (allDepartments.length === 0) {
      await fetchAllDepartments();
    }
  };

  const changeDepartment = (dep: Department) => {
    updateDepartment(dep);
    setCookie("department", JSON.stringify(dep));
  };

  const closeModal = () => {
    const defaultDepartment: Department = allDepartments.length > 0 ? allDepartments[0] : DEFAULT_DEPARTMENT;
    updateDepartment(defaultDepartment);
    setCookie("department", JSON.stringify(defaultDepartment));
  };

  return {
    department: currentDepartment,
    loading,
    showConfirmModal,
    confirmDepartment,
    declineDepartment,
    departmentsList: allDepartments,
    allDepartments,
    changeDepartment,
    closeModal,
  };
}
