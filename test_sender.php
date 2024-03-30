<?php
require_once 'config.php';
session_start();

if (isset($_POST['_id_contact'])) {  
    $externalID = $_POST['_id_contact'];
    $fullname = $_POST['_fullname'];
    $relationship = $_POST['_relationship'];
    $contactNum = $_POST['_contactNum'];
    
    // Prepare and execute the SQL INSERT statement
    $insert_sql = "INSERT INTO mediweb_contacts (patient_identifier, fullname, relationship, contact_num) 
                   VALUES ('$externalID', '$fullname', '$relationship', '$contactNum')";
    
    if (mysqli_query($conn, $insert_sql)) {
        header("Location: patient.php"); // Redirect after successful insertion
        exit(); // Terminate script execution after redirection
    } else {
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn); // Display error if insertion fails
    }
} else {
    echo "Form not submitted"; // This message will be displayed if the form is not submitted
}
?>