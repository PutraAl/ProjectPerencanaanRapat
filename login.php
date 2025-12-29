<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/login.css">
 
</head>
<body>

  <div class="login-container">
    <div class="login-wrapper">
      <div class="image-section">
        <img src="assets/img/Polibatam.png" alt="Polibatam">
      </div>
      <div class="form-section">
        <h2>Welcome Back</h2>
        <p class="form-subtitle">Sign in to your account</p>
        
        <form action="action/login.php" method="post">
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <span class="input-icon">✓</span>
          </div>
          
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="input-icon">✓</span>
          </div>
          <button type="submit" class="btn-login w-100" name="login">Login</button>
        </form>
      </div>
    </div>
  </div>

  <script src="assets/js/login.js">
  </script>

</body>
</html>