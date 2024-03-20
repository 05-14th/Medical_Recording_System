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

?>