import React, { useState } from 'react';
import axios from 'axios';
import {Link, useNavigate } from 'react-router-dom';
import './Css/Login.css'; // Import CSS for styling


const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleLogin = async () => {
    try {
      const response = await axios.post('https://projectlatest.ddev.site/api/login', {
        email: email,
        password: password
      });
      const { token } = response.data;
      const { subscription } = response.data;
      const { user_id } = response.data;
      localStorage.setItem('token', token); // Store the token in localStorage
      localStorage.setItem('subscription', subscription);
      localStorage.setItem('user_id', user_id);
      navigate('/'); // Redirect to the user page
    } catch (error) {
      setError('Invalid email or password'); // Set error message
    }
  };

  return (
    <div className="login-page">
      <div className="login-container">
        <h2>Login</h2>
        <input
          type="email"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          className="login-input"
        />
        <input
          type="password"
          placeholder="Password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          className="login-input"
        />
        <button onClick={handleLogin} className="login-button">Login</button>
        <Link className="Register button" to="/Register">Register</Link>
        {error && <p className="error-message">{error}</p>}
      </div>
    </div>
  );
};

export default Login;
