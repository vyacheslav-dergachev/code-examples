import ReactElement from 'react';

interface PhoneDisplayProps {
  phone?: string;
}

export default function PhoneDisplay({ phone }: PhoneDisplayProps): ReactElement {
  return (
    <div className="text-center text-xl font-semibold py-4">
      Телефон отдела: <span className="text-blue-600">{phone}</span>
    </div>
  );
}
