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
                $prescription_id = $_POST['prescription_id'];
                $sql = "SELECT * FROM mediweb_prescription WHERE prescription_id='$prescription_id'";
                $prescriptionResult = mysqli_query($conn, $sql);
                $prescriptionRow = mysqli_fetch_assoc($prescriptionResult);
                // Store patientRow data in the session
                $_SESSION['prescriptionRow'] = $prescriptionRow; 
        ?>
                         <input type=hidden name="id-prescription" value="<?php echo $prescriptionRow['prescription_id']; ?>">
                         <div class="form-group">
                            <input class="form-control" name="doctorName" placeholder="Doctor's Name" value="<?php echo $prescriptionRow['doctor_id']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="patient_id" placeholder="Patient ID" value="<?php echo $prescriptionRow['patient_id']; ?>">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicines" placeholder="Medecine"><?php echo $prescriptionRow['Medicine']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicalCondition" placeholder="Medical Condition" rows=3><?php echo $prescriptionRow['medicalCondition']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="allergies" placeholder="Allergies" rows=3><?php echo $prescriptionRow['allergies']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Enter Date:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo $prescriptionRow['date']; ?>">
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