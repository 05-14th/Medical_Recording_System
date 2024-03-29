<?php
require_once 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
    }
    .login-container {
      border: 2px solid #007bff;
      border-radius: 15px;
      padding: 3%;
      width: 30%;
      background-color: #f8f9fa;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
      color: #007bff;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 20px;
    }
    .btn-primary {
      border-radius: 20px;
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .signup-link {
      margin-top: 20px;
    }
    .signup-link a {
      color: #007bff;
      text-decoration: none;
    }
    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <section class="login-container">
    <h2 class="text-center">Mediweb Login</h2>
    <form method="POST" action="verify.php">
      <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <div class="text-center signup-link">
      <p>Don't have an account? <a href="admin_auth.php">Register</a></p>
    </div>
  </section>
</body>
</html>


