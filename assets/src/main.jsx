import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './App.jsx';
import '../styles/app.css';

console.log('React main.jsx loaded');

// Find the container element
const container = document.getElementById('react-app');

console.log('Container found:', container);

if (container) {
  console.log('Mounting React app...');
  // Create root and render the app
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
  console.log('React app mounted successfully');
} else {
  console.error('React app container not found. Make sure you have an element with id="react-app" in your template.');
}
