<?php
require_once 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])){
    $patientId = $_POST["id-container"];

    $delete_query = "DELETE FROM mediweb_patient WHERE patient_id='$patientId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: patient.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmPres'])){
    $insId = $_POST["id-prescription"];

    $delete_query = "DELETE FROM mediweb_prescription WHERE prescription_id='$insId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: prescription.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDoc'])){
    $insId = $_POST["id-doctor"];

    $delete_query = "DELETE FROM mediweb_doctor WHERE doctor_id='$insId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: doctor.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmIns'])){
    $insId = $_POST["id-insurance"];

    $delete_query = "DELETE FROM mediweb_insurance WHERE insurance_id='$insId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: insurance.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

?>