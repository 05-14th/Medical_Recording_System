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
            if(isset($_POST['doctor_id'])){
                $universal_id = $_POST['doctor_id'];
                $doc_sql = "SELECT * FROM mediweb_doctor WHERE doctor_id='$universal_id'";
                $uniResult = mysqli_query($conn, $doc_sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                $_SESSION['doctorRow'] = $uniRow; 
        ?>
                        <input type=hidden name="id-doctor" value="<?php echo $uniRow['doctorNum']; ?>">
                         <div class="form-group">
                            <input class="form-control" name="docId" placeholder="Doctor ID" value="<?php echo $uniRow['doctor_id'];?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="name" placeholder="Full Name" value="<?php echo $uniRow['name'];?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="designation" placeholder="Designation" value="<?php echo $uniRow['designation'];?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="phoneNum" placeholder="Phone Number" value="<?php echo $uniRow['phone'];?>">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="address" placeholder="Address" rows="3"><?php echo $uniRow['address'];?></textarea>
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