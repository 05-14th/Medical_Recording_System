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


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['docId'])){  
    $d_id = $_POST['docId'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $phone = $_POST['phoneNum'];
    $address= $_POST['address'];
   
    $insert_query = "INSERT INTO mediweb_doctor (doctor_id, name, designation, phone, address) VALUES ('$d_id','$name','$designation', '$phone', '$address')";
    if ($conn->query($insert_query) === TRUE) {
        header("Location: doctor.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }   
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctorName']) && isset($_POST['patient_id'])){  
    $d_name = $_POST['doctorName'];
    $p_id = $_POST['patient_id'];
    $meds = $_POST['medicines'];
    $medCon = $_POST['medicalCondition'];
    $allergy = $_POST['allergies'];
    $dateString = $_POST['date'];
    $date = date('Y-m-d',strtotime($dateString));
   
    $insert_query = "INSERT INTO mediweb_prescription (doctor_id, patient_id, Medicine, medicalCondition, allergies, date) VALUES ('$d_name','$p_id', '$meds','$medCon', '$allergy', '$date')";
    if ($conn->query($insert_query) === TRUE) {
        header("Location: prescription.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }   
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insId'])){  
    $insId = $_POST['insId'];
    $cname = $_POST['ca_name'];
    $plan = $_POST['ins_plan'];
    $conNum = $_POST['contactNum'];
    $polNum = $_POST['policyNum'];
    $groupNum = $_POST['g_num'];
   
    $insert_query = "INSERT INTO mediweb_insurance (insurance_id, carrier_name, insurance_plan, contact_number, policy_number, group_number) VALUES ('$insId','$cname','$plan', '$conNum', '$polNum', '$groupNum')";
    if ($conn->query($insert_query) === TRUE) {
        header("Location: insurance.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }   
}
?>

