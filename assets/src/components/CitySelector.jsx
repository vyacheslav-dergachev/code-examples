import React from 'react';

export default function CitySelector({ currentDepartment, allDepartments, onChange }) {
  if (!allDepartments || allDepartments.length === 0) {
    return null; // Don't render if no departments available
  }

  return (
    <div className="flex justify-center py-2">
      <label className="mr-2 font-medium">Ваш город:</label>
      <select
        value={currentDepartment?.city || ''}
        onChange={(e) => {
          const selectedDepartment = allDepartments.find(dept => dept.city === e.target.value);
          if (selectedDepartment) {
            onChange(selectedDepartment);
          }
        }}
        className="border rounded p-1"
      >
        {allDepartments.map((department) => (
          <option key={department.city} value={department.city}>
            {department.city}
          </option>
        ))}
      </select>
    </div>
  );
}
