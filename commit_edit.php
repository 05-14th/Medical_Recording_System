<?php
require_once 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id-container'])){  
    $id = $_POST['id-container'];
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
    
    $update_query = "UPDATE mediweb_patient SET fname = '$fname', lname = '$lname', title = '$title', preferredName = 
    '$preferred',gender='$gender', birthdate='$birthdate', bloodType='$bloodType', maritalStatus = '$maritalStat', sexualOrientation = 
    '$sexualOr', ward = '$wardType', externalID = '$external', licenseID = '$licensed' WHERE patient_id='$id'";
    if ($conn->query($update_query) === TRUE) {
        header("Location: patient.php");
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id-prescription'])){  
    $id = $_POST['id-prescription'];
    $doctor_id = $_POST['doctorName'];
    $patient_id = $_POST['patient_id'];
    $medicine = $_POST['medicines'];
    $medicalCon = $_POST['medicalCondition'];
    $allergies = $_POST['allergies'];
    $dateString = $_POST['date'];
    $date = date('Y-m-d',strtotime($dateString));
    
    $update_query = "UPDATE mediweb_prescription SET doctor_id = '$doctor_id',
    patient_id = '$patient_id',
    Medicine = '$medicine',
    medicalCondition = '$medicalCon',
    allergies = '$allergies',
    date = '$date' WHERE prescription_id='$id'";
    if ($conn->query($update_query) === TRUE) {
        header("Location: prescription.php");
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
}
?>