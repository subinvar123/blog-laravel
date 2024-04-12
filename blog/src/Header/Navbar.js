import { Link } from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import '../App.css';
import React from 'react';
import { useNavigate } from 'react-router-dom';

const Navbar = () => {
  const navigate = useNavigate();
  const isLoggedIn = localStorage.getItem('token');

  const handleSignout = () => {
    // Clear the authentication token from localStorage
    localStorage.removeItem('token');
    localStorage.removeItem('subscription');
    // Navigate to the login page
    navigate('/');
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark header navbar-fixed-topmain-nav navbar-right">
      <Link className="navbar-brand" to="/">Blogs</Link>
      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon"></span>
      </button>
      <div className="collapse navbar-collapse" id="navbarNavDropdown">
        <ul className="navbar-nav mr-auto">
          <li className="nav-item">
            <Link className="nav-link" to="/">Home</Link>
            </li>
            {!isLoggedIn && (
            <li className="nav-item">
              <Link className="nav-link" to="/login">Login</Link>
            </li>
          )}
          {isLoggedIn && (
            <>
              <li className="nav-item">
                <Link className="nav-link" to="/user">Posts</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/Create">Create</Link>
              </li>
              <li className="nav-item signout-item">
                <button className="btn btn-link nav-link" onClick={handleSignout}>Sign out</button>
              </li>
            </>
          )}
        </ul>
      </div>
    </nav>
  );
};

export default Navbar;