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
  <div class="bg-image"></div>
  <section class="login-container">
    <h2 class="text-center">Mediweb Patient Details</h2>
    <form method="POST" action="verify.php">
      <div class="form-group">
        <label for='extID'>Patient Id:</label>
        <input type="text" class="form-control" name="extID" id="extID" aria-describedby="externalHelp" placeholder="External ID" required/><br>
        <label for='_date'>Prescription Date:</label>
        <input type="date" class="form-control" name="_date" id="_date" required/>
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="showPatient">Show Details</button>
    </form>
    <div class="text-center signup-link">
      <p><a href="login.php">Login as Nurse</a></p>
    </div>
  </section>
</body>
</html>


