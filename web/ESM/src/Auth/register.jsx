import React, { useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";

export default function Register() {
  const [formData, setFormData] = useState({
    nom: "",
    prenom: "",
    email: "",
    password: "",
    role: "", // 'etudiant' ou 'prof'
    cne: "",
    cin: "",
    dateNaissance: "",
  });
  const [errors, setErrors] = useState([]);
  const [message, setMessage] = useState(null);

  const navigate = useNavigate();

  // Gestion des changements dans le formulaire
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  // Soumission du formulaire
  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(
        "http://localhost:8080/users/register",
			formData,
		  {
			headers: {
			  "Content-Type": "application/json",
			},
			withCredentials: true,
		  }
      );

      if (response.data.success) {
        setMessage("Registration successful");
        navigate("/success");
      } else {
        setErrors(response.data.errors || ["Registration failed"]);
      }
    } catch (error) {
      setErrors(["An error occurred during registration"]);
    }
  };
//onSubmit={handleSubmit}
  return (
    <div className="min-vh-100 d-flex align-items-center justify-content-center">
      <div
        className="bg-white p-4 rounded shadow-lg w-100"
        style={{ maxWidth: "400px" }}
      >
        <h2 className="text-center text-primary mb-4">Register</h2>
        <form action="http://localhost:8080/users/register" method="POST">
          <div className="row mb-3">
            <div className="col">
              <label htmlFor="nom" className="form-label">
                Last name
              </label>
              <input
                type="text"
                id="nom"
                name="nom"
                className="form-control"
                value={formData.nom}
                onChange={handleChange}
                placeholder="John"
                required
              />
            </div>
            <div className="col">
              <label htmlFor="prenom" className="form-label">
                First name
              </label>
              <input
                type="text"
                id="prenom"
                name="prenom"
                className="form-control"
                value={formData.prenom}
                onChange={handleChange}
                placeholder="Doe"
                required
              />
            </div>
          </div>

          <div className="mb-3">
            <label htmlFor="email" className="form-label">
              Email Address
            </label>
            <input
              type="email"
              id="email"
              name="email"
              className="form-control"
              value={formData.email}
              onChange={handleChange}
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
              value={formData.password}
              onChange={handleChange}
              placeholder="********"
              required
            />
          </div>
          <div className="mb-3">
            <p className="form-label mb-2">Role</p>
            <div className="d-flex align-items-center">
              <div
                className={`form-check role-option ${
                  formData.role === "0" ? "selected" : ""
                } me-3`}
              >
                <input
                  type="radio"
                  id="student"
                  name="role"
                  value="0"
                  checked={formData.role === "0"}
                  onChange={handleChange}
                  className="form-check-input"
                />
                <label htmlFor="student" className="form-check-label">
                  Étudiant
                </label>
              </div>
              <div
                className={`form-check role-option ${
                  formData.role === "1" ? "selected" : ""
                }`}
              >
                <input
                  type="radio"
                  id="professor"
                  name="role"
                  value="1"
                  checked={formData.role === "1"}
                  onChange={handleChange}
                  className="form-check-input"
                />
                <label htmlFor="professor" className="form-check-label">
                  Professeur
                </label>
              </div>
            </div>
          </div>

          {/* Champs conditionnels */}
          {formData.role === "0" && (
            <>
              <div className="mb-3">
                <label htmlFor="cne" className="form-label">
                  CNE
                </label>
                <input
                  type="text"
                  id="cne"
                  name="cne"
                  className="form-control"
                  value={formData.cne}
                  onChange={handleChange}
                  placeholder="CNE de l'étudiant"
                  required
                />
              </div>
              <div className="mb-3">
                <label htmlFor="dateNaissance" className="form-label">
                  Date de Naissance
                </label>
                <input
                  type="date"
                  id="dateNaissance"
                  name="dateNaissance"
                  className="form-control"
                  value={formData.dateNaissance}
                  onChange={handleChange}
                  required
                />
              </div>
            </>
          )}
          {formData.role === "1" && (
            <div className="mb-3">
              <label htmlFor="cin" className="form-label">
                CIN
              </label>
              <input
                type="text"
                id="cin"
                name="cin"
                className="form-control"
                value={formData.cin}
                onChange={handleChange}
                placeholder="CIN du professeur"
                required
              />
            </div>
          )}

          <div className="d-grid">
            <button type="submit" className="btn btn-primary">
              Register
            </button>
          </div>
        </form>

        {message && <p className="text-center text-success mt-3">{message}</p>}
        {errors.length > 0 && (
          <div>
            {errors.map((error, index) => (
              <p key={index} className="text-center text-danger mt-3">
                {error}
              </p>
            ))}
          </div>
        )}

        <p className="text-center mt-3 text-muted">
          Already have an account?{" "}
          <Link to="/" className="text-primary text-decoration-underline">
            Login
          </Link>
        </p>
      </div>
    </div>
  );
}
