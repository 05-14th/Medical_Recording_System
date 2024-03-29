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
            if(isset($_POST['prescription_id'])){
                $universal_id = $_POST['prescription_id'];
                $sql = "SELECT * FROM mediweb_prescription WHERE prescription_id='$universal_id'";
                $uniResult = mysqli_query($conn, $sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                // Store patientRow data in the session
                $_SESSION['prescriptionRow'] = $uniRow; 

                // Fetch doctor options from the database
                $doctorSql = "SELECT doctor_id, name FROM mediweb_doctor"; // Assuming your doctors table has 'id' and 'name' columns
                $doctorResult = mysqli_query($conn, $doctorSql);
                $doctorOptions = array();
                while ($row = mysqli_fetch_assoc($doctorResult)) {
                    $doctorOptions[] = $row;
                }

                // Fetch patient options from the database
                $patientSql = "SELECT externalID, fname, lname FROM mediweb_patient"; // Assuming your patients table has 'id' and 'name' columns
                $patientResult = mysqli_query($conn, $patientSql);
                $patientOptions = array();
                while ($row = mysqli_fetch_assoc($patientResult)) {
                    $patientOptions[] = $row;
                }

                $insSql = "SELECT insurance_id, carrier_name FROM mediweb_insurance"; 
                $insResult = mysqli_query($conn, $insSql);
                $insOptions = array();
                while ($row = mysqli_fetch_assoc($insResult)) {
                    $insOptions[] = $row;
                }
        ?>
                         <input type=hidden name="id-prescription" value="<?php echo $uniRow['prescription_id']; ?>">
                         <div class="form-group">
                            <select class="form-control" name="doctorName" disabled>
                                <?php
                                foreach ($doctorOptions as $doctorOption) {
                                    $selected = ($doctorOption['doctor_id'] == $uniRow['doctor_id']) ? 'selected' : '';
                                    echo '<option value="' . $doctorOption['doctor_id'] . '" ' . $selected . '>' . $doctorOption['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="patient_id" disabled>
                                <?php
                                foreach ($patientOptions as $patientOption) {
                                    $selected = ($patientOption['externalID'] == $uniRow['patient_id']) ? 'selected' : '';
                                    echo '<option value="' . $patientOption['externalID'] . '" ' . $selected . '>' . $patientOption['fname'] . " " . $patientOption['lname'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="patient_id" disabled>
                                <?php
                                foreach ($insOptions as $insOption) {
                                    $selected = ($insOption['insurance_id'] == $uniRow['insurance_id']) ? 'selected' : '';
                                    echo '<option value="' . $insOption['insurance_id'] . '" ' . $selected . '>' . $insOption['insurance_id'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicines" placeholder="Medecine"><?php echo $uniRow['Medicine']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicalCondition" placeholder="Medical Condition" rows=3><?php echo $uniRow['medicalCondition']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="allergies" placeholder="Allergies" rows=3><?php echo $uniRow['allergies']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Enter Date:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo $uniRow['date']; ?>">
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