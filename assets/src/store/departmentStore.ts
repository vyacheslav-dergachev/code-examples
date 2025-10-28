import { create } from 'zustand';
import { Department } from '../types/department';

interface DepartmentStore {
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

export const useDepartmentStore = create<DepartmentStore>((set) => ({
  currentDepartment: null,
  allDepartments: [],
  loading: true,
  showConfirmModal: false,

  setCurrentDepartment: (department: Department | null) => set({ currentDepartment: department }),
  setAllDepartments: (departments: Department[]) => set({ allDepartments: departments }),
  setLoading: (loading: boolean) => set({ loading }),
  setShowConfirmModal: (show: boolean) => set({ showConfirmModal: show }),

  updateDepartment: (department: Department) => {
    set({ currentDepartment: department, showConfirmModal: false });
  },

  confirmDepartment: () => {
    set({ showConfirmModal: false });
  },

  declineDepartment: () => {
    // Modal logic will be handled in components
  },
}));
