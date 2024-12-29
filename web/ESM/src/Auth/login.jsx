import React, { useState } from 'react';
import { Link } from 'react-router-dom'; // Import Link for navigation
import "bootstrap/dist/css/bootstrap.min.css";

function LoginForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    console.log("Email:", email, "Password:", password);
  };

  return (
    <div className="min-vh-100 d-flex align-items-center justify-content-center">
      <div className="bg-white p-4 rounded shadow-lg w-100" style={{ maxWidth: "400px" }}>
        <h2 className="text-center text-primary mb-4">Login</h2>
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="email" className="form-label">
              Email Address
            </label>
            <input
              type="email"
              id="email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="form-control"
              placeholder="you@example.com"
              required
            />
          </div>
          <div className="mb-3">
            <label htmlFor="password" className="form-label">
              Password
            </label>
            <input
              type="password"
              id="password"
              name="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="form-control"
              placeholder="********"
              required
            />
          </div>
          <div className="d-grid">
            <button type="submit" className="btn btn-primary">
              Login
            </button>
          </div>
        </form>
        <p className="text-center mt-3 text-muted">
          Don't have an account?{' '}
          <Link to="/register" className="text-primary text-decoration-underline">
            Register
          </Link>
        </p>
      </div>
    </div>
  );
}

export default LoginForm;
