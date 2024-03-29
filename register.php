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
  <link href="style.css" rel="stylesheet">
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
    <form method="POST" action="verify.php" onsubmit="return validateForm()">
      <div class="form-group">
        <input type="text" class="form-control" name="full-name" placeholder="Full Name">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="_email" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="confirm_password" name="confirm-password" placeholder="Confirm Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="register">Signup</button>
    </form>
    <div class="text-center login-link">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </section>
  <script>
    function validateForm() {
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var confirm_password = document.getElementById('confirm_password').value;

      var valid = true;

      // Validate email
      if (!validateEmail(email)) {
          document.getElementById('email').style.borderColor = "red";
          valid = false;
      } else {
          document.getElementById('email').style.borderColor = "";
      }

      // Validate password match
      if (password !== confirm_password || password.length < 8) {
          document.getElementById('password').style.borderColor = "red";
          document.getElementById('confirm_password').style.borderColor = "red";
          valid = false;
      } else {
          document.getElementById('password').style.borderColor = "";
          document.getElementById('confirm_password').style.borderColor = "";
      }

      return valid;
  }

  function validateEmail(email) {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
  }
  </script>
</body>
</html>
