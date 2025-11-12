<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Calon Santri</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #004d40, #0d6efd);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-grow: 1;
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      overflow: hidden;
      background: #fff;
      padding: 30px;
      animation: fadeIn 0.8s ease-in-out;
    }
    .login-header {
      text-align: center;
      margin-bottom: 25px;
    }
    .login-header h3 {
      font-weight: 700;
      color: #004d40;
    }
    .form-label {
      font-weight: 600;
      color: #333;
    }
    .btn-login {
      background: linear-gradient(90deg, #0d6efd, #20c997);
      border: none;
      color: white;
      font-weight: 600;
      padding: 12px;
      transition: all 0.3s;
    }
    .btn-login:hover {
      background: linear-gradient(90deg, #20c997, #0d6efd);
    }
    footer {
      text-align: center;
      color: white;
      padding: 15px 0;
      font-size: 14px;
      background: rgba(0,0,0,0.4);
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-15px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>

  <!-- Login Form -->
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <i class="bi bi-person-circle fs-1 text-success"></i>
        <h3>Login User</h3>
        <p class="text-muted">Silakan masukkan No HP dan Password Anda</p>
      </div>

      <form action="proseslogin.php" method="POST">
        <div class="mb-3">
          <label for="nis" class="form-label">No HP</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP" required>
        </div>
        <div class="mb-4">
          <label for="nik" class="form-label">Password</label>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password" required>
        </div>
        <div class="d-grid">
          <button type="submit" name="login" class="btn btn-login">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 IT. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
