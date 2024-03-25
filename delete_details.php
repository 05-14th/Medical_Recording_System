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
    $docId = $_POST["id-prescription"];

    $delete_query = "DELETE FROM mediweb_prescription WHERE prescription_id='$docId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: prescription.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDoc'])){
    $docId = $_POST["id-doctor"];

    $delete_query = "DELETE FROM mediweb_doctor WHERE doctor_id='$docId'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: doctor.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}

?>