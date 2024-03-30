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
    $universal_id = $_POST['doctorName'];
    $patient_id = $_POST['patient_id'];
    $medicine = $_POST['medicines'];
    $medicalCon = $_POST['medicalCondition'];
    $allergies = $_POST['allergies'];
    $dateString = $_POST['date'];
    $date = date('Y-m-d',strtotime($dateString));
    
    $update_query = "UPDATE mediweb_prescription SET doctor_id = '$universal_id',
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

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id-doctor'])){  
    $id = $_POST['id-doctor'];
    $doc_id = $_POST['docId'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $phone = $_POST['phoneNum'];
    $address = $_POST['address'];
   
    
    $update_query = "UPDATE mediweb_doctor SET doctor_id='$doc_id', name='$name', designation='$designation', 
    phone='$phone', address='$address' WHERE doctorNum='$id'";


    if ($conn->query($update_query) === TRUE) {
        header("Location: doctor.php");
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id-insurance'])){  
    $id = $_POST['id-insurance'];
    $ins_id = $_POST['insId'];
    $car_name = $_POST['ca_name'];
    $ins_plan = $_POST['ins_plan'];
    $con_num = $_POST['contactNum'];
    $pol_num = $_POST['policyNum'];
    $group_num = $_POST['g_num'];
   
    
    $update_query = "UPDATE mediweb_insurance SET insurance_id='$ins_id', carrier_name='$car_name', contact_number='$con_num', 
    insurance_plan='$ins_plan', policy_number='$pol_num', group_number = '$group_num' WHERE insurance_no='$id'";


    if ($conn->query($update_query) === TRUE) {
        header("Location: insurance.php");
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
}

?>