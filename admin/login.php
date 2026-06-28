<?php
require_once __DIR__ . '/../includes/config.php';
if (isAuthenticated()) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - HCV</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f8f9fa 0%, #e8f4fd 100%);
      padding: 20px;
    }
    .login-container {
      width: 100%;
      max-width: 420px;
    }
    .login-card {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    }
    .login-logo {
      text-align: center;
      margin-bottom: 30px;
    }
    .login-logo svg {
      width: 60px;
      height: 60px;
    }
    .login-logo h1 {
      font-size: 1.5rem;
      font-weight: 800;
      margin-top: 15px;
      color: #000;
    }
    .login-logo p {
      color: #6c757d;
      font-size: 0.9rem;
      margin-top: 5px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-size: 0.9rem;
      font-weight: 600;
      color: #495057;
      margin-bottom: 8px;
    }
    .form-control {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid #dee2e6;
      border-radius: 10px;
      font-size: 1rem;
      font-family: inherit;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus {
      outline: none;
      border-color: #14A5E5;
      box-shadow: 0 0 0 4px rgba(20,165,229,0.1);
    }
    .login-btn {
      width: 100%;
      padding: 14px;
      background: #14A5E5;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }
    .login-btn:hover { background: #0d8bc4; }
    .login-btn:disabled { opacity: 0.7; cursor: not-allowed; }
    .error-msg {
      background: #fde8ea;
      color: #F2172D;
      padding: 12px 16px;
      border-radius: 10px;
      font-size: 0.85rem;
      margin-bottom: 20px;
      display: none;
    }
    .error-msg.show { display: block; }
    .login-footer {
      text-align: center;
      margin-top: 20px;
      color: #6c757d;
      font-size: 0.85rem;
    }
    .login-footer a {
      color: #14A5E5;
      text-decoration: none;
      font-weight: 600;
    }
    .login-footer a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-logo">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <circle cx="50" cy="50" r="45" fill="#14A5E5"/>
          <text x="50" y="58" font-size="32" font-weight="bold" fill="white" text-anchor="middle" font-family="Arial">HCV</text>
        </svg>
        <h1>Admin Login</h1>
        <p>Health Communication and Visibility</p>
      </div>
      <div class="error-msg" id="errorMsg"></div>
      <form id="loginForm">
        <div class="form-group">
          <label for="username">Username or Email</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required autocomplete="username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required autocomplete="current-password">
        </div>
        <button type="submit" class="login-btn" id="loginBtn">Sign In</button>
      </form>
      <div class="login-footer">
        <a href="<?= SITE_URL ?>">Back to Website</a>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const btn = document.getElementById('loginBtn');
      const errorMsg = document.getElementById('errorMsg');
      btn.textContent = 'Signing in...';
      btn.disabled = true;
      errorMsg.classList.remove('show');

      const formData = new FormData(this);
      try {
        const res = await fetch('../api/login.php', { method: 'POST', body: formData });
        const data = await res.json();
        if (data.success) {
          window.location.href = 'dashboard.php';
        } else {
          errorMsg.textContent = data.error || 'Login failed';
          errorMsg.classList.add('show');
        }
      } catch (err) {
        errorMsg.textContent = 'Network error. Please try again.';
        errorMsg.classList.add('show');
      } finally {
        btn.textContent = 'Sign In';
        btn.disabled = false;
      }
    });
  </script>
</body>
</html>
