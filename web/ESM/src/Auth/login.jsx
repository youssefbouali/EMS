import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

export default function Login() {




  return (
    <>
      <div className="min-vh-100 d-flex align-items-center justify-content-center">
        <div className="bg-white p-4 rounded shadow-lg w-100" style={{ maxWidth: '400px' }}>
          <h2 className="text-center text-primary mb-4">Register</h2>
          <form action="http://localhost:8080/users/login" method="POST">
            <div className="mb-3">
              <label htmlFor="email" className="form-label">
                Email 
              </label>
              <input
                type="email"
                id="email"
                name="email"
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
                className="form-control"
                placeholder="********"
                required
              />
            </div>
            <div className="d-grid">
              <button type="submit" className="btn btn-primary">
                Register
              </button>
            </div>
          </form>
          <p className="text-center mt-3 text-muted">
            Already have an account?{' '}
            <a href="#" className="text-primary text-decoration-underline">
              Sign In
            </a>
          </p>
        </div>
      </div>
    </>
  );
}
