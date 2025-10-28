import ReactElement from 'react';
import PhoneDisplay from './PhoneDisplay';
import CitySelector from './CitySelector';
import ConfirmCityModal from './ConfirmCityModal';
import { useDepartment } from '../hooks/useDepartment';
import { Department } from '../types/department';

export default function Header(): ReactElement {
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
        onChange={(selectedDepartment: Department) => {
          changeDepartment(selectedDepartment);
        }}
      />

      {showConfirmModal && (
        <ConfirmCityModal
          department={department}
          departmentsList={departmentsList}
          onConfirm={confirmDepartment}
          onDecline={declineDepartment}
          onSelectDepartment={(dep: Department | null) => {
            if (dep) changeDepartment(dep);
          }}
          onClose={closeModal}
        />
      )}
    </>
  );
}
