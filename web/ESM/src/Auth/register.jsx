import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

export default function Register() {




  return (
    <>
      <div className="min-vh-100 d-flex align-items-center justify-content-center">
        <div className="bg-white p-4 rounded shadow-lg w-100" style={{ maxWidth: '400px' }}>
          <h2 className="text-center text-primary mb-4">Register</h2>
          <form action="http://localhost:8080/users/login" method="POST">
            <div className="mb-3">
              <label htmlFor="nom" className="form-label">
                First Name
              </label>
              <input
                type="text"
                id="nom"
                name="nom"
                className="form-control"
                placeholder="John"
                required
              />
            </div>
            <div className="mb-3">
              <label htmlFor="prenom" className="form-label">
                Last Name
              </label>
              <input
                type="text"
                id="prenom"
                name="prenom"
                className="form-control"
                placeholder="Doe"
                required
              />
            </div>
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
            <div className="mb-3">
              <p className="form-label mb-2">Role</p>
              <div className="form-check">
                <input
                  type="checkbox"
                  id="student"
                  name="role"
                  value="0"
                  className="form-check-input"
                />
                <label htmlFor="student" className="form-check-label">
                  Étudiant
                </label>
              </div>
              <div className="form-check">
                <input
                  type="checkbox"
                  id="professor"
                  name="role"
                  value="1"
                  className="form-check-input"
                />
                <label htmlFor="professor" className="form-check-label">
                  Professeur
                </label>
              </div>
            </div>
            <div className="d-grid">
              <button type="submit" className="btn btn-primary">
                Register
              </button>
            </div>
          </form>
          <p className="text-center mt-3 text-muted">
            Already have an account?{' '}
            <a href="/login" className="text-primary text-decoration-underline">
              Sign In
            </a>
          </p>
        </div>
      </div>
    </>
  );
}
