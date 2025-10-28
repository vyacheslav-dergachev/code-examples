import ReactElement from 'react';
import { useDepartmentStore } from '../store/departmentStore';

export default function Footer(): ReactElement | null {
  const { currentDepartment } = useDepartmentStore();

  if (!currentDepartment) {
    return null;
  }

  return (
    <footer className="mt-8 pt-4 border-t border-gray-200 text-center text-sm text-gray-600">
      <div className="space-y-1">
        <div>
          <span className="font-medium">Город:</span> {currentDepartment.city}
        </div>
        <div>
          <span className="font-medium">Телефон:</span> {currentDepartment.phone}
        </div>
      </div>
    </footer>
  );
}
