<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f8f9fa;
    }
    .login-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-card h2 {
      text-align: center;
      color: #0d6efd;
      margin-bottom: 20px;
    }
    .text-decoration-underline:hover {
      text-decoration: underline !important;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>Login</h2>
    <!-- bdl action ela 7assab fin ghaytsifto les donnees-->
    <form action="http://localhost" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input
          type="email"
          id="email"
          name="email"
          class="form-control"
          placeholder="you@example.com"
          required
        >
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          class="form-control"
          placeholder="********"
          required
        >
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <p class="text-center mt-3 text-muted">
      Vous n'avez pas un compte?
      <a href="/register.php" class="text-primary text-decoration-underline">
        Register
      </a>
    </p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
