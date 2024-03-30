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
    <form method="POST" action="test_sender.php" enctype="multipart/form-data">
        <input name="_id_contact" value="1"/>
        <div class="form-group">
            <input class="form-control" name="_fullname" placeholder="Full Name" value="1" required/>
        </div>
        <div class="form-group">
            <input class="form-control" name="_relationship" placeholder="Relationship" value="1" required/>
        </div>
        <div class="form-group">
            <input class="form-control" name="_contactNum" placeholder="Contact Number" value="1" required/>
        </div>

        <input type="submit" class="btn btn-success" name="add_contact" value="Confirm"/>
        <button type="button" class="btn btn-danger" name="cancel_add" onclick="closeModal()">Cancel</button>
    </form>
</body>
</html>
