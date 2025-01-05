import React, { useState } from 'react';
import { Link } from 'react-router-dom'; // Import Link for navigation
import "bootstrap/dist/css/bootstrap.min.css";
import { FaEnvelope, FaLock } from 'react-icons/fa'; // Importing icons from react-icons

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
        <form action="http://localhost:8080/users/login" method="POST">
          <div className="mb-3">
            <label htmlFor="email" className="form-label">
              Email Address
            </label>
            <div className="position-relative">
              <input
                type="email"
                id="email"
                name="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="form-control ps-5"
                placeholder="you@example.com"
                required
              />
              <FaEnvelope
                className="position-absolute top-50 start-0 translate-middle-y ms-3"
                style={{ fontSize: "1.2rem" }}
              />
            </div>
          </div>
          <div className="mb-3">
            <label htmlFor="password" className="form-label">
              Password
            </label>
            <div className="position-relative">
              <input
                type="password"
                id="password"
                name="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="form-control ps-5"
                placeholder="********"
                required
              />
              <FaLock
                className="position-absolute top-50 start-0 translate-middle-y ms-3"
                style={{ fontSize: "1.2rem" }}
              />
            </div>
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
