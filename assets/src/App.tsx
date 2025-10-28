import ReactElement from 'react';
import { useDepartment } from "./hooks/useDepartment";
import Spinner from "./components/Spinner";
import Header from "./components/Header";
import Footer from "./components/Footer";
import Content from "./components/Content";

export default function App(): ReactElement {
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
