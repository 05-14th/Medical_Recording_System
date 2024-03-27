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
                $universal_id = $_POST['patient_id'];
                $doc_sql = "SELECT * FROM mediweb_patient WHERE patient_id='$universal_id'";
                $uniResult = mysqli_query($conn, $doc_sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                // Store patientRow data in the session
                $_SESSION['patientRow'] = $uniRow; 
        ?>
                         <input type=hidden name="id-container" value="<?php echo $uniRow['patient_id']; ?>">
                        <div class="form-group">
                            <input class="form-control" name="fname" placeholder="First Name" value="<?php echo $uniRow['fname']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="lname" placeholder="Last Name" value="<?php echo $uniRow['lname']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="title" placeholder="Title" value="<?php echo $uniRow['title']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="preferredName" placeholder="Preferred Name" value="<?php echo $uniRow['preferredName']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="gender" placeholder="Gender" value="<?php echo $uniRow['gender']; ?>">
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" name="sexualOrientation" placeholder="Sexual Orientation" value="<?php echo $uniRow['sexualOrientation']; ?>">
                        </div>
                        <div style="display: flex;">
                        <div class="form-group">
                            <label for="selected_date">Birthdate:</label>
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $uniRow['birthdate']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="bloodType">Blood Type: </label>
                            <select name="bloodType">
                                <option value="O+" <?php if($uniRow['bloodType'] == 'O+') echo 'selected'; ?>>O+</option>
                                <option value="O-" <?php if($uniRow['bloodType'] == 'O-') echo 'selected'; ?>>O-</option>
                                <option value="A+" <?php if($uniRow['bloodType'] == 'A+') echo 'selected'; ?>>A+</option>
                                <option value="A-" <?php if($uniRow['bloodType'] == 'A-') echo 'selected'; ?>>A-</option>
                                <option value="B+" <?php if($uniRow['bloodType'] == 'B+') echo 'selected'; ?>>B+</option>
                                <option value="B-" <?php if($uniRow['bloodType'] == 'B-') echo 'selected'; ?>>B-</option>
                                <option value="AB+" <?php if($uniRow['bloodType'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                <option value="AB-" <?php if($uniRow['bloodType'] == 'AB-') echo 'selected'; ?>>AB-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maritalStat">Marital Status: </label>
                            <select name="maritalStat">
                                <option value="Default" disabled>Select Marital Status</option>
                                <option value="Single" <?php if($uniRow['maritalStatus'] == 'Single') echo 'selected'; ?>>Single</option>
                                <option value="Married" <?php if($uniRow['maritalStatus'] == 'Marrried') echo 'selected'; ?>>Married</option>
                                <option value="Widowed" <?php if($uniRow['maritalStatus'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                                <option value="Partners" <?php if($uniRow['maritalStatus'] == 'Partners') echo 'selected'; ?>>Partners</option>
                                <option value="Divorced" <?php if($uniRow['maritalStatus'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                            </select>
                        </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="wardType">Ward: </label>
                            <select name="wardType" >
                                <option value="Medical" <?php if($uniRow['ward'] == 'Medical') echo 'selected'; ?>>Medical Ward</option>
                                <option value="OB" <?php if($uniRow['ward'] == 'OB') echo 'selected'; ?>>OB Ward</option>
                                <option value="Surgical <?php if($uniRow['ward'] == 'Surgical') echo 'selected'; ?>">Surgical Ward</option>
                                <option value="Philhealth" <?php if($uniRow['ward'] == 'Philhealth') echo 'selected'; ?>>Philhealth Ward</option>
                                <option value="Pediatric" <?php if($uniRow['ward'] == 'Pediatric') echo 'selected'; ?>>Pediatric Ward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="externalId" placeholder="External ID" value="<?php echo $uniRow['externalID']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="licensedId" placeholder="Licensed ID" value="<?php echo $uniRow['licenseID']; ?>">
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