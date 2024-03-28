<?php
require_once 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
    }
    .signup-container {
      border: 2px solid #007bff;
      border-radius: 15px;
      padding: 3%;
      width: 30%;
      background-color: #f8f9fa;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .signup-container h2 {
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
    .login-link {
      margin-top: 20px;
    }
    .login-link a {
      color: #007bff;
      text-decoration: none;
    }
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <section class="signup-container">
    <h2 class="text-center">Signup for Mediweb</h2>
    <form>
      <div class="form-group">
        <input type="text" class="form-control" id="full-name" placeholder="Full Name">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="username" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Signup</button>
    </form>
    <div class="text-center login-link">
      <p>Already have an account? <a href="index.php">Login</a></p>
    </div>
  </section>
</body>
</html>
