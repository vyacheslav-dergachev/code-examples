export interface Department {
  name: string;
  city: string;
  phone: string;
}

export interface DepartmentStore {
  currentDepartment: Department | null;
  allDepartments: Department[];
  loading: boolean;
  showConfirmModal: boolean;
  setCurrentDepartment: (department: Department | null) => void;
  setAllDepartments: (departments: Department[]) => void;
  setLoading: (loading: boolean) => void;
  setShowConfirmModal: (show: boolean) => void;
  updateDepartment: (department: Department) => void;
  confirmDepartment: () => void;
  declineDepartment: () => void;
}
