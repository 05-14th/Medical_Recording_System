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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        if(isset($_POST['patient_showcon'])){
        $universal_id = $_POST['patient_showcon'];
        $doc_sql = "SELECT * FROM mediweb_patient a INNER JOIN mediweb_contacts b ON a.externalID = b.patient_identifier WHERE patient_id='$universal_id'";
        $uniResult = mysqli_query($conn, $doc_sql);     
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Relationship</th>
                    <th scope="col">Contact Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dataResult = mysqli_query($conn, $doc_sql);
                    if(mysqli_num_rows($dataResult) > 0) {
                        while ($medicalResult = mysqli_fetch_assoc($dataResult)){
                            echo "<tr>";
                            echo "<td>" . $medicalResult['fullname'] . "</td>";
                            echo "<td>" . $medicalResult['relationship'] . "</td>";
                            echo "<td>" . $medicalResult['contact_num'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No Emergency Contacts Found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
        
    <?php
        } else{
            echo "No Available Data.";
        }
    ?>
</body>
</html>
