import { useEffect } from "react";
import { getCookie, setCookie } from "../utils/cookies.js";
import { useDepartmentStore } from "../store/departmentStore.js";

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

  const fetchAllDepartments = async () => {
    try {
      // @TODO: move to api component with ApiClient, use swagger-typescript-api
      const res = await fetch("http://api.code-examples.localhost/departments");
      const departments = await res.json();
      setAllDepartments(departments);
      return departments;
    } catch (e) {
      return [];
    }
  };

  useEffect(() => {
    const initializeDepartment = async () => {
      const departments = await fetchAllDepartments();
      const defaultDepartment = departments.length > 0 ? departments[0] : null;

      if (!defaultDepartment) {
        setLoading(false);
        return;
      }

      const existing = getCookie("department");
      if (existing) {
        try {
          const parsedDepartment = JSON.parse(existing);
          const isValidDepartment = departments.some(
            dept => dept.city === parsedDepartment.city
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

      const timeout = setTimeout(() => {
        setCurrentDepartment(defaultDepartment);
        setShowConfirmModal(true);
        setLoading(false);
      }, 3000);

      try {
        let detectedDepartment = defaultDepartment;

        // @TODO: move to api component with ApiClient, use swagger-typescript-api
        const res = await fetch("http://api.code-examples.localhost/department-by-ip");
        const data = await res.json();

        if (data && data.city) {
          const matchingDepartment = departments.find(
            dept => dept.city === data.city
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

  const changeDepartment = (dep) => {
    updateDepartment(dep);
    setCookie("department", JSON.stringify(dep));
  };

  const closeModal = () => {
    const defaultDepartment = allDepartments.length > 0 ? allDepartments[0] : null;
    if (defaultDepartment) {
      updateDepartment(defaultDepartment);
      setCookie("department", JSON.stringify(defaultDepartment));
    } else {
      setShowConfirmModal(false);
    }
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
