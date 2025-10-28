import ReactElement from 'react';
import { Department } from '../types/department';
import { DEFAULT_DEPARTMENT } from '../constants/department';

interface CitySelectorProps {
  currentDepartment: Department | null;
  allDepartments: Department[];
  onChange: (department: Department) => void;
}

export default function CitySelector({ currentDepartment, allDepartments, onChange }: CitySelectorProps): ReactElement {
  const departments = allDepartments.length > 0 ? allDepartments : [DEFAULT_DEPARTMENT];
  const current = currentDepartment || DEFAULT_DEPARTMENT;

  return (
    <div className="flex justify-center py-2">
      <label className="mr-2 font-medium">Ваш город:</label>
      <select
        value={current.city}
        onChange={(e) => {
          const selectedDepartment = departments.find(dept => dept.city === e.target.value);
          if (selectedDepartment) {
            onChange(selectedDepartment);
          }
        }}
        className="border rounded p-1"
      >
        {departments.map((department) => (
          <option key={department.city} value={department.city}>
            {department.city}
          </option>
        ))}
      </select>
    </div>
  );
}
