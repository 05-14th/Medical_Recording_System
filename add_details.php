<?php
require_once 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fname'])){  
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $title = $_POST['title'];
    $preferred = $_POST['preferredName'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['selected_date'];
    $bloodType = $_POST['bloodType'];
    $maritalStat = $_POST['maritalStat'];
    $sexualOr = $_POST['sexualOrientation'];
    $wardType = $_POST['wardType'];
    $external = $_POST['externalId'];
    $licensed = $_POST['licensedId'];

    $dateString = $_POST['date'];
    $date = date('Y-m-d',strtotime($dateString));

    $dateString1 = $_POST['selected_date'];
    $date1 = date('Y-m-d',strtotime($dateString1));
    
    $insert_query = "INSERT INTO mediweb_patient (fname, lname, title, preferredName, gender, birthdate, bloodType, updatedDate, maritalStatus, sexualOrientation, ward, externalID, licenseID) VALUES ('$fname','$lname','$title', '$preferred', '$gender', '$date1', '$bloodType', '$date', '$maritalStat', '$sexualOr', '$wardType', '$external', '$licensed')";
    if ($conn->query($insert_query) === TRUE) {
        header("Location: patient.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }   
}
?>