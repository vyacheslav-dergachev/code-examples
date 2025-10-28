import { create } from 'zustand';

export const useDepartmentStore = create((set, get) => ({
  currentDepartment: null,
  allDepartments: [],
  loading: true,
  showConfirmModal: false,

  setCurrentDepartment: (department) => set({ currentDepartment: department }),
  setAllDepartments: (departments) => set({ allDepartments: departments }),
  setLoading: (loading) => set({ loading }),
  setShowConfirmModal: (show) => set({ showConfirmModal: show }),

  // Actions
  updateDepartment: (department) => {
    set({ currentDepartment: department, showConfirmModal: false });
  },

  confirmDepartment: () => {
    set({ showConfirmModal: false });
  },

  declineDepartment: () => {
    // Modal logic will be handled in components
  },
}));
