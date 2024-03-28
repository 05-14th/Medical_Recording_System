<?php
session_start();
include "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])){
    $admin = $_POST["email"];
    $password = $_POST["password"];

    //$confirm_sql = "SELECT * FROM mediweb_user WHERE email='$email' AND password='$password'";
    $confirm_sql = "SELECT * FROM mediweb_superuser WHERE email='$admin' AND password='$password'";
    $confirm_result = $conn->query($confirm_sql);
    if($confirm_result->num_rows > 0){
        $row = $confirm_result->fetch_assoc();
        //$_SESSION["userId"] = $row['user_id'];
        $_SESSION["userId"] = $row['su_id'];
        echo "<script>window.location.href = 'admin.php'</script>";
    } else{
        echo "<script>window.location.href = 'index.php'</script>";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin'])){
    $admin = $_POST["admin"];
    $password = $_POST["password"];

    //$confirm_sql = "SELECT * FROM mediweb_user WHERE email='$email' AND password='$password'";
    $confirm_sql = "SELECT * FROM mediweb_admin WHERE admin_id='$admin' AND password='$password'";
    $confirm_result = $conn->query($confirm_sql);
    if($confirm_result->num_rows > 0){
        echo "<script>window.location.href = 'register.php'</script>";
    } else{
        echo "<script>window.location.href = 'admin_auth.php'</script>";
    }
}
?>
