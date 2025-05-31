import React from 'react';
import ReactDOM from 'react-dom/client';
import '../css/app.css';

import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from 'react-router-dom';

import Landing from './Pages/LandingPage';
import Login from './Pages/Login';
import Register from './Pages/Register';

ReactDOM.createRoot(document.getElementById('app')).render(
  <React.StrictMode>
    <Router>
      <Routes>
        <Route path="/" element={<Landing />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="*" element={<Navigate to="/" />} />
      </Routes>
    </Router>
  </React.StrictMode>
);
