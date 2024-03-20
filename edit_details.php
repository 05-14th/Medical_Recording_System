<?php 
require_once 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function toggleFileInput() {
            var checkbox = document.getElementById('enableCheckbox');
            var fileInput = document.getElementById('_picture');
            
            // Check if the checkbox is checked
            if (checkbox.checked) {
                fileInput.disabled = false; // Enable file input
            } else {
                fileInput.disabled = true; // Disable file input
            }
        }
  </script>
</head>
<body>
<form method="post" action="commit_edit.php" enctype="multipart/form-data">
 <?php
            if(isset($_POST['patient_id'])){
                $patient_id = $_POST['patient_id'];
                $sql = "SELECT * FROM mediweb_patient WHERE patient_id='$patient_id'";
                $patientResult = mysqli_query($conn, $sql);
                $patientRow = mysqli_fetch_assoc($patientResult);
                // Store patientRow data in the session
                $_SESSION['patientRow'] = $patientRow; 
        ?>
                         <input type=hidden name="id-container" value="<?php echo $patientRow['patient_id']; ?>">
                        <div class="form-group">
                            <input class="form-control" name="fname" placeholder="First Name" value="<?php echo $patientRow['fname']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="lname" placeholder="Last Name" value="<?php echo $patientRow['lname']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="title" placeholder="Title" value="<?php echo $patientRow['title']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="preferredName" placeholder="Preferred Name" value="<?php echo $patientRow['preferredName']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="gender" placeholder="Gender" value="<?php echo $patientRow['gender']; ?>">
                        </div>
                        <div style="display: flex;">
                        <div class="form-group">
                            <label for="selected_date">Birthdate:</label>
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $patientRow['birthdate']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="bloodType">Blood Type: </label>
                            <select name="bloodType">
                                <option value="O+" <?php if($patientRow['bloodType'] == 'O+') echo 'selected'; ?>>O+</option>
                                <option value="O-" <?php if($patientRow['bloodType'] == 'O-') echo 'selected'; ?>>O-</option>
                                <option value="A+" <?php if($patientRow['bloodType'] == 'A+') echo 'selected'; ?>>A+</option>
                                <option value="A-" <?php if($patientRow['bloodType'] == 'A-') echo 'selected'; ?>>A-</option>
                                <option value="B+" <?php if($patientRow['bloodType'] == 'B+') echo 'selected'; ?>>B+</option>
                                <option value="B-" <?php if($patientRow['bloodType'] == 'B-') echo 'selected'; ?>>B-</option>
                                <option value="AB+" <?php if($patientRow['bloodType'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                <option value="AB-" <?php if($patientRow['bloodType'] == 'AB-') echo 'selected'; ?>>AB-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maritalStat">Marital Status: </label>
                            <select name="maritalStat">
                                <option value="Default" disabled>Select Marital Status</option>
                                <option value="Single" <?php if($patientRow['maritalStatus'] == 'Single') echo 'selected'; ?>>Single</option>
                                <option value="Married" <?php if($patientRow['maritalStatus'] == 'Marrried') echo 'selected'; ?>>Married</option>
                                <option value="Widowed" <?php if($patientRow['maritalStatus'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                                <option value="Partners" <?php if($patientRow['maritalStatus'] == 'Partners') echo 'selected'; ?>>Partners</option>
                                <option value="Divorced" <?php if($patientRow['maritalStatus'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="sexualOrientation">Sexual Orientation: </label>
                            <select name="sexualOrientation" >
                                <option value="Default" disabled>Select Sexual Orientation</option>
                                <option value="Male" <?php if($patientRow['sexualOrientation'] == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if($patientRow['sexualOrientation'] == 'Female') echo 'selected'; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wardType">Ward: </label>
                            <select name="wardType" >
                                <option value="Medical" <?php if($patientRow['ward'] == 'Medical') echo 'selected'; ?>>Medical Ward</option>
                                <option value="OB" <?php if($patientRow['ward'] == 'OB') echo 'selected'; ?>>OB Ward</option>
                                <option value="Surgical <?php if($patientRow['ward'] == 'Surgical') echo 'selected'; ?>">Surgical Ward</option>
                                <option value="Philhealth" <?php if($patientRow['ward'] == 'Philhealth') echo 'selected'; ?>>Philhealth Ward</option>
                                <option value="Pediatric" <?php if($patientRow['ward'] == 'Pediatric') echo 'selected'; ?>>Pediatric Ward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="externalId" placeholder="External ID" value="<?php echo $patientRow['externalID']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="licensedId" placeholder="Licensed ID" value="<?php echo $patientRow['licenseID']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="date_confirmed">Date: </label>
                            <input id= "date_confiremd" class="form-control" value="<?php echo date("F j, Y"); ?>" name="date" readonly>
                        </div>
                        <input type="submit" class="btn btn-success" name="add_site" value="Confirm">
                        <button type="button" class="btn btn-danger" name="cancel_add" onclick="closeModal()">Cancel</button>
                    </form>
<?php
        } else{
            echo "No Available Data.";
        }
    ?>

</body>
</html>