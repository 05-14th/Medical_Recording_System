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
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <?php
            if(isset($_POST['patient_idc'])){
            $universal_id = $_POST['patient_idc'];
            $doc_sql = "SELECT * FROM mediweb_patient WHERE patient_id='$universal_id'";
            $uniResult = mysqli_query($conn, $doc_sql);
            $uniRow = mysqli_fetch_assoc($uniResult);
            $_SESSION['patientRow'] = $uniRow;         
        ?>
        <input type=hidden name="_id_contact" value="<?php echo $uniRow['externalID']; ?>"/>
        <div class="form-group">
            <input class="form-control" name="_fullname" placeholder="Full Name"  required/>
        </div>
        <div class="form-group">
            <input class="form-control" name="_relationship" placeholder="Relationship" required/>
        </div>
        <div class="form-group">
            <input class="form-control" name="_contactNum" placeholder="Contact Number" required/>
        </div>

        <input type="submit" class="btn btn-success" name="add_contact" value="Confirm"/>
        <button type="button" class="btn btn-danger" name="cancel_add" onclick="closeModal()">Cancel</button>
    </form>
    <?php
        } else{
            echo "No Available Data.";
        }
    ?>
</body>
</html>
