import React from 'react';

export default function PhoneDisplay({ phone }) {
  return (
    <div className="text-center text-xl font-semibold py-4">
      Телефон отдела: <span className="text-blue-600">{phone}</span>
    </div>
  );
}
