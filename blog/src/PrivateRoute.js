// PrivateRoute.js
import React from 'react';
import { Route, Navigate } from 'react-router-dom';

const PrivateRoute = ({ element, ...rest }) => {
  // Check if the user is authenticated (you need to implement your own authentication logic here)
  const isAuthenticated = true; // Placeholder for authentication status

  return (
    <Route
      {...rest}
      element={isAuthenticated ? element : <Navigate to="/login" replace />} // Redirect to login if not authenticated
    />
  );
};

export default PrivateRoute;
