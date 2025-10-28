import React from 'react';

import PhoneDisplay from './PhoneDisplay.jsx';
import CitySelector from './CitySelector.jsx';
import ConfirmCityModal from './ConfirmCityModal.jsx';
import { useDepartment } from '../hooks/useDepartment.js';

export default function Header() {
  const {
    department,
    allDepartments,
    changeDepartment,
    showConfirmModal,
    confirmDepartment,
    declineDepartment,
    departmentsList,
    closeModal
  } = useDepartment();

  return (
    <>
      <PhoneDisplay phone={department?.phone} />
      <CitySelector
        currentDepartment={department}
        allDepartments={allDepartments}
        onChange={(selectedDepartment) => {
          changeDepartment(selectedDepartment);
        }}
      />

      {showConfirmModal && (
        <ConfirmCityModal
          department={department}
          departmentsList={departmentsList}
          onConfirm={confirmDepartment}
          onDecline={declineDepartment}
          onSelectDepartment={(dep) => {
            if (dep) changeDepartment(dep);
          }}
          onClose={closeModal}
        />
      )}
    </>
  );
}
