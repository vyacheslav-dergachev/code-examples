import React from 'react';
import { useDepartment } from "./hooks/useDepartment.js";
import Spinner from "./components/Spinner.jsx";
import Header from "./components/Header.jsx";
import Footer from "./components/Footer.jsx";
import Content from "./components/Content.jsx";

export default function App() {
  const { loading } = useDepartment();

  if (loading) {
    return <Spinner />;
  }

  return (
    <div className="max-w-md mx-auto p-4 text-center">
      <Header />
      <Content />
      <Footer />
    </div>
  );
}
