<?php
require_once "config.php";
session_start();

function generateData($sql){
    global $conn;
    $dataResult = mysqli_query($conn, $sql);
    if(mysqli_num_rows($dataResult) > 0) {
        while ($medicalResult = mysqli_fetch_assoc($dataResult)){
            echo "<tr>";
            echo "<td>".  $medicalResult['fullname'] ."</td>";
            echo "<td>" . $medicalResult['relationship'] . "</td>";
            echo "<td>" . $medicalResult['contact_num'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No Emergency Contacts Found</td></tr>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="p-3"> 
        <?php
            if(isset($_SESSION['patient_id']) && isset($_SESSION['pres_date'])){
                $pres_date = $_SESSION['pres_date'];
                $universal_id = $_SESSION['patient_id'];
                $formatted_date = date("Y-m-d", strtotime($pres_date));
                $sql = "SELECT * FROM mediweb_patient a INNER JOIN mediweb_prescription b ON a.externalID = b.patient_id INNER JOIN 
                mediweb_doctor c ON b.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON b.insurance_id = d.insurance_id 
                WHERE externalID ='$universal_id' AND date='$formatted_date'";
                $uniResult = $conn->query($sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                if(mysqli_num_rows($uniResult) > 0) {
                // Store patientRow data in the session
            
        ?>
        <h1 class="text-center p-3">Mediweb Patient Information</h1>
        <section class="px-2 bg-white rounded-top border border-warning ">
            <h2>Personal Details</h2>
            <section class="d-inline-flex p-2">
                <div class="form-group px-1">
                    <label for="fullname">Name: </label>
                    <input class="form-control" id="fullname" value="<?php echo $uniRow['fname']; ?> <?php echo $uniRow['lname']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="prefname">Preferred Name: </label>
                    <input class="form-control" id="prefname" value="<?php echo $uniRow['preferredName']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="ext-id">External ID: </label>
                    <input class="form-control" id="ext-id" value="<?php echo $uniRow['externalID']; ?>" readonly/>
                </div>
            </section>
            <section class="d-flex p-2">
                <div class="form-group px-1">
                    <label for="gender">Gender: </label>
                    <input class="form-control" id="gender" value="<?php echo $uniRow['gender']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="bdate">Birthdate: </label>
                    <input class="form-control" id="bdate" value="<?php echo $uniRow['birthdate']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="bltype">Blood Type: </label>
                    <input class="form-control" id="bltype" value="<?php echo $uniRow['bloodType']; ?>" readonly/>
                </div>
            </section>
            <section class="d-inline-flex p-2">
                <div class="form-group px-1">
                    <label for="seor">Sexual Orientation: </label>
                    <input class="form-control" id="seor" value="<?php echo $uniRow['sexualOrientation']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="marStat">Marital Status: </label>
                    <input class="form-control" id="marStat" value="<?php echo $uniRow['maritalStatus']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="update">Updated Date: </label>
                    <input class="form-control" id="update" value="<?php echo $uniRow['updatedDate']; ?>" readonly/>
                </div>
            </section>
            <section class="d-flex p-2">
                <div class="form-group px-1">
                    <label for="ward">Ward: </label>
                    <input class="form-control" id="ward" value="<?php echo $uniRow['ward']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="title">Title: </label>
                    <input class="form-control" id="title" value="<?php echo $uniRow['title']; ?>" readonly/>
                </div>
            </section>
        </section>
        <section class="px-2 bg-white border border-warning">
            <h2>Emergency Contact</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Relationship</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $contact_sql = "SELECT * FROM mediweb_patient a INNER JOIN mediweb_contacts e ON a.externalID = e.patient_identifier WHERE externalID ='$universal_id'";
                            generateData($contact_sql);    
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="px-2 bg-white border border-warning">
            <h2>Insurance Details</h2>
            <section class="d-inline-flex p-2">
                <div class="form-group px-1">
                    <label for="insId">Insurance ID: </label>
                    <input class="form-control" id="insId" value="<?php echo $uniRow['insurance_id']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="carrier">Insurance Carrier: </label>
                    <input class="form-control" id="carrier" value="<?php echo $uniRow['carrier_name']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="insPlan">Insurance Plan: </label>
                    <input class="form-control" id="insPlan" value="<?php echo $uniRow['insurance_plan']; ?>" readonly/>
                </div>
            </section>
            <section class="d-inline-flex p-2">
                <div class="form-group px-1">
                    <label for="polNum">Policy Number: </label>
                    <input class="form-control" id="polNum" value="<?php echo $uniRow['policy_number']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="grpNum">Group Number: </label>
                    <input class="form-control" id="grpNum" value="<?php echo $uniRow['group_number']; ?>" readonly/>
                </div>
                <div class="form-group px-1">
                    <label for="conNum">Contact Number: </label>
                    <input class="form-control" id="conNum" value="<?php echo $uniRow['contact_number']; ?>" readonly/>
                </div>
            </section>
        </section>
        <section class="shadow mb-5 px-2 bg-white rounded-bottom border border-warning">
            <h2>Prescription Details</h2>
            <section class="d-inline-flex p-2">
                <div class="form-group py-2">
                    <label for="presDate">Date: </label>
                    <input class="form-control" type="Date" id="presDate" value="<?php echo $pres_date; ?>" readonly/>
                </div>
                <div class="form-group p-2">
                    <label for="doc">Prescribed by: </label>
                    <input class="form-control" id="doc" value="<?php echo $uniRow['name']; ?>" readonly/>
                </div>
            </section>
            <div class="form-group p-2">
                <label for="medCon">Medical Condition: </label>
                <textarea class="form-control" id="medcon" rows=5 readonly><?php echo $uniRow['medicalCondition']; ?></textarea>
            </div>
            <div class="form-group p-2">
                <label for="allergies">Allergies: </label>
                <textarea class="form-control" id="allergies" rows=5 readonly><?php echo $uniRow['allergies']; ?></textarea>
            </div>
            <div class="form-group p-2">
                <label for="meds">Medicine: </label>
                <textarea class="form-control" id="meds" rows=5 readonly><?php echo $uniRow['Medicine']; ?></textarea>
            </div>
        </section>
    </body>
    <?php 
            } else {
                echo "No Record Found. <a href='index.php'>Back to previous page.</a>";
            }
        } else{
            echo "No Record Found. <a href='index.php'>Back to previous page.</a>";
        }
    ?>


</html>