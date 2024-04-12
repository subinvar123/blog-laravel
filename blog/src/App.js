import React from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom'; // Import corrected components
import PrivateRoute from './PrivateRoute';
import Login from './Login';
import UserPage from './UserPage';
import Subscribe from './Subscribe';
import Home from './Home';
import Edit from './Components/Edit/Edit';
import Register from './Components/Register/Register';
import Create from './Components/Create/Create';
import About from './Components/About';
import Detail from './Components/Detail/Detail';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/user" element={<UserPage />} />
        <Route path="/register" element={<Register />} />
        <Route path="/Create" element={<Create />} />
        <Route path="/Edit/:id" element={<Edit />} />
        <Route path="/About" element={<About />} />
        <Route path="Detail/:id" element={<Detail />} />
        <Route path="/subscribe" element={<Subscribe />} />
      </Routes>
    </Router>
  );
};

export default App;
