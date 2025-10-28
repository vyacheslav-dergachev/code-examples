import React, { useState } from "react";

export default function ConfirmCityModal({
  department,
  departmentsList,
  onConfirm,
  onDecline,
  onSelectDepartment,
  onClose,
}) {
  const [showSelect, setShowSelect] = useState(false);

  const handleNo = async () => {
    await onDecline();
    setShowSelect(true);
  };

  return (
    <div 
      className="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
      onClick={onClose}
    >
      <div 
        className="bg-white rounded-2xl shadow-lg p-6 max-w-sm w-full text-center relative"
        onClick={(e) => e.stopPropagation()}
      >
        <button
          className="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold"
          onClick={onClose}
        >
          ×
        </button>
        {!showSelect ? (
          <>
            <p className="text-lg mb-4">
              Ваш город — <b>{department?.city || "Неизвестно"}</b>?
            </p>
            <div className="flex justify-center gap-4">
              <button
                className="px-4 py-2 bg-blue-600 text-white rounded"
                onClick={onConfirm}
              >
                Да
              </button>
              <button
                className="px-4 py-2 bg-gray-300 rounded"
                onClick={handleNo}
              >
                Нет
              </button>
            </div>
          </>
        ) : (
          <>
            <p className="text-lg mb-3">Выберите ваш город:</p>
            <select
              className="border p-2 rounded w-full mb-4"
              onChange={(e) =>
                onSelectDepartment(
                  departmentsList.find(
                    (d) => d.city === e.target.value || d.name === e.target.value
                  )
                )
              }
            >
              <option value="">— выбрать —</option>
              {departmentsList.map((d) => (
                <option key={d.city} value={d.city}>
                  {d.city} ({d.phone})
                </option>
              ))}
            </select>
            <button
              className="px-4 py-2 bg-blue-600 text-white rounded"
              onClick={() => onSelectDepartment(null)}
            >
              Готово
            </button>
          </>
        )}
      </div>
    </div>
  );
}
