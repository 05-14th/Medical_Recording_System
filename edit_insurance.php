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
            if(isset($_POST['insurance_id'])){
                $universal_id = $_POST['insurance_id'];
                $doc_sql = "SELECT * FROM mediweb_insurance WHERE insurance_id='$universal_id'";
                $uniResult = mysqli_query($conn, $doc_sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                $_SESSION['insuranceRow'] = $uniRow; 
        ?>
                        <input type=hidden name="id-insurance" value="<?php echo $uniRow['insurance_no']; ?>">
                        <div class="form-group">
                            <input class="form-control" name="insId" placeholder="Insurance ID" value="<?php echo $uniRow['insurance_id']?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="ca_name" placeholder="Carrier Name" value="<?php echo $uniRow['carrier_name']?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="ins_plan" placeholder="Insurance Plan" value="<?php echo $uniRow['insurance_plan']?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="contactNum" placeholder="Contact Number" value="<?php echo $uniRow['contact_number']?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="policyNum" placeholder="Policy Number" value="<?php echo $uniRow['policy_number']?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="g_num" placeholder="Group Number" value="<?php echo $uniRow['group_number']?>">
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