<?php
require_once "config.php";
session_start();

function generateData($sql){
    global $conn;
    $dataResult = mysqli_query($conn, $sql);
    while ($medicalResult = mysqli_fetch_assoc($dataResult)){
        echo "<tr>";
        echo "<td>".  $medicalResult['fullname'] ."</td>";
        echo "<td>" . $medicalResult['relationship'] . "</td>";
        echo "<td>" . $medicalResult['contact_num'] . "</td>";
        echo "</tr>";
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
    </head>
    <body>
        <?php
            if(isset($_SESSION['patient_id'])){
                $universal_id = $_SESSION['patient_id'];
                $sql = "SELECT * FROM mediweb_patient a INNER JOIN mediweb_prescription b ON a.externalID = b.patient_id INNER JOIN 
                mediweb_doctor c ON b.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON b.insurance_id = d.insurance_id 
                WHERE externalID ='$universal_id'";
                $uniResult = $conn->query($sql);
                $uniRow = mysqli_fetch_assoc($uniResult);
                // Store patientRow data in the session
            }
        ?>
        <h1>Mediweb Patient Information</h1>
        <section>
            <h2>Personal Details</h2>
            <section>
                <div>
                    <label for="fullname">Name: </label>
                    <input id="fullname" value="<?php echo $uniRow['fname']; ?> <?php echo $uniRow['lname']; ?>" readonly/>
                </div>
                <div>
                    <label for="prefname">Preferred Name: </label>
                    <input id="prefname" value="<?php echo $uniRow['preferredName']; ?>" readonly/>
                </div>
                <div>
                    <label for="ext-id">External ID: </label>
                    <input id="ext-id" value="<?php echo $uniRow['externalID']; ?>" readonly/>
                </div>
            </section>
            <section>
                <div>
                    <label for="gender">Gender: </label>
                    <input id="gender" value="<?php echo $uniRow['gender']; ?>" readonly/>
                </div>
                <div>
                    <label for="bdate">Birthdate: </label>
                    <input id="bdate" value="<?php echo $uniRow['birthdate']; ?>" readonly/>
                </div>
                <div>
                    <label for="bltype">Blood Type: </label>
                    <input id="bltype" value="<?php echo $uniRow['bloodType']; ?>" readonly/>
                </div>
            </section>
            <section>
                <div>
                    <label for="seor">Sexual Orientation: </label>
                    <input id="seor" value="<?php echo $uniRow['sexualOrientation']; ?>" readonly/>
                </div>
                <div>
                    <label for="marStat">Marital Status: </label>
                    <input id="marStat" value="<?php echo $uniRow['maritalStatus']; ?>" readonly/>
                </div>
                <div>
                    <label for="update">Updated Date: </label>
                    <input id="update" value="<?php echo $uniRow['updatedDate']; ?>" readonly/>
                </div>
            </section>
            <section>
                <div>
                    <label for="ward">Ward: </label>
                    <input id="ward" value="<?php echo $uniRow['ward']; ?>" readonly/>
                </div>
                <div>
                    <label for="title">Title: </label>
                    <input id="title" value="<?php echo $uniRow['title']; ?>" readonly/>
                </div>
            </section>
        </section>
        <section>
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
        <section>
            <h2>Insurance Details</h2>
            <div>
                <label for="insId">Insurance ID: </label>
                <input  id="insId" value="<?php echo $uniRow['insurance_id']; ?>" readonly/>
            </div>
            <div>
                <label for="carrier">Insurance Carrier: </label>
                <input  id="carrier" value="<?php echo $uniRow['carrier_name']; ?>" readonly/>
            </div>
            <div>
                <label for="insPlan">Insurance Plan: </label>
                <input  id="insPlan" value="<?php echo $uniRow['insurance_plan']; ?>" readonly/>
            </div>
            <div>
                <label for="polNum">Policy Number: </label>
                <input  id="polNum" value="<?php echo $uniRow['policy_number']; ?>" readonly/>
            </div>
            <div>
                <label for="grpNum">Group Number: </label>
                <input  id="grpNum" value="<?php echo $uniRow['group_number']; ?>" readonly/>
            </div>
            <div>
                <label for="conNum">Contact Number: </label>
                <input  id="conNum" value="<?php echo $uniRow['contact_number']; ?>" readonly/>
            </div>
        </section>
        <section>
            <h2>Prescription Details</h2>
            <div>
                <label for="presDate">Date: </label>
                <input type="Date" id="presDate" value="<?php echo $uniRow['date']; ?>"/>
            </div>
            <div>
                <label for="medCon">Medical Condition: </label>
                <textarea id="medcon" rows=3 readonly><?php echo $uniRow['medicalCondition']; ?></textarea>
            </div>
            <div>
                <label for="allergies">Allergies: </label>
                <textarea id="allergies" rows=3 readonly><?php echo $uniRow['allergies']; ?></textarea>
            </div>
            <div>
                <label for="meds">Medicine: </label>
                <textarea id="meds" rows=3 readonly><?php echo $uniRow['Medicine']; ?></textarea>
            </div>
            <div>
                <label for="doc">Prescribed by: </label>
                <input id="doc" value="<?php echo $uniRow['name']; ?>"/>
            </div>
        </section>
    </body>
</html>