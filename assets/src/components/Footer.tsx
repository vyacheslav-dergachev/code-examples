import ReactElement from 'react';
import { useDepartmentStore } from '../store/departmentStore';
import { DEFAULT_DEPARTMENT } from '../constants/department';

export default function Footer(): ReactElement {
  const { currentDepartment } = useDepartmentStore();

  const department = currentDepartment || DEFAULT_DEPARTMENT;

  return (
    <footer className="mt-8 pt-4 border-t border-gray-200 text-center text-sm text-gray-600">
      <div className="space-y-1">
        <div>
          <span className="font-medium">Город:</span> {department.city}
        </div>
        <div>
          <span className="font-medium">Телефон:</span> {department.phone}
        </div>
      </div>
    </footer>
  );
}
