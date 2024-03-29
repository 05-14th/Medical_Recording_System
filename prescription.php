<?php
require_once 'config.php';
session_start();

function generateData($sql){
    global $conn;
    $dataResult = mysqli_query($conn, $sql);
    while ($medicalResult = mysqli_fetch_assoc($dataResult)){
        echo "<tr>";
        echo "<td>" . $medicalResult['name'] . "</td>";
        echo "<td>" . $medicalResult['lname']. " ".$medicalResult['fname']. "</td>";
        echo "<td>" . $medicalResult['insurance_id'] . "</td>";
        echo "<td>" . $medicalResult['carrier_name'] . "</td>";
        echo "<td>" . $medicalResult['Medicine'] . "</td>";
        echo "<td>" . $medicalResult['medicalCondition'] . "</td>";
        echo "<td>".  $medicalResult['allergies'] ."</td>";
        echo "<td>".  $medicalResult['date'] ."</td>";
        echo "<td>";
        //echo "<button type='button' data-id='" . $medicalResult['patient_id'] ."' class='btn btn-success tweak-button' onclick=''>Print</button><br>";
        echo "<button type='button' data-id='" . $medicalResult['prescription_id'] ."' class='btn btn-warning tweak-button' onclick='editModal(this)'>Edit</button><br>";
        echo "<button type='button' data-id='" . $medicalResult['prescription_id'] ."' class='btn btn-danger tweak-button' onclick='deleteModal(this)'>Delete</button><br>";
        echo "</td>";
        echo "</tr>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediWeb</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body{
            margin: 5px;
        }

        .scroll{
            overflow: scroll;
        }

        .standard_size{
            width: 150px;
            height: 150px; 
        }

        .search-form{
            display: flex;
            justify-content: center;
        }

        .tweak-button{
            width: 10vw;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="search-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group" style="display:flex;">
                <input style="width: 30vw; height: 6vh;" placeholder="Search for Prescription" name="search-input"><br>
                <input style="width: 6vw; height: 6vh;" type="submit" class="btn btn-primary" name="search-button" value="Search">    
            </div>
        </form>
    </div>
    <button type="button" data-id="" class="btn btn-success" onclick="addModal()">Add Prescription</button>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Insurance ID</th>
                    <th>Insurance Carrier</th>
                    <th>Medicines</th>
                    <th>Medical Conditon</th>
                    <th>Allergies</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search-button"])) {
                    if(strlen(trim($_POST['search-input'])) === 0) {
                        // Retrieve and sanitize the SQL query from the form
                        $sql_query = "SELECT * FROM mediweb_prescription a INNER JOIN mediweb_patient b ON a.patient_id = b.externalID INNER JOIN mediweb_doctor c ON a.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON a.insurance_id = d.insurance_id";  
                        generateData($sql_query);
                    }elseif(isset($_POST['search-input'])){
                        $search_result = $_POST['search-input'];
                        $sql_query = "SELECT * FROM mediweb_prescription a INNER JOIN mediweb_patient b ON a.patient_id = b.externalID INNER JOIN mediweb_doctor c ON a.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON a.insurance_id = d.insurance_id WHERE medicalCondition LIKE '%$search_result%' OR b.fname LIKE '%$search_result%' OR b.lname LIKE '%$search_result%'";  
                        generateData($sql_query);
                    }else {
                        $sql_query = "SELECT * FROM mediweb_prescription a INNER JOIN mediweb_patient b ON a.patient_id = b.externalID INNER JOIN mediweb_doctor c ON a.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON a.insurance_id = d.insurance_id";  
                        generateData($sql_query);    
                    }
                }else {
                    $sql_query = "SELECT * FROM mediweb_prescription a INNER JOIN mediweb_patient b ON a.patient_id = b.externalID INNER JOIN mediweb_doctor c ON a.doctor_id = c.doctor_id INNER JOIN mediweb_insurance d ON a.insurance_id = d.insurance_id";  
                    generateData($sql_query);    
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and jQuery if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Modal for adding -->
    <div class="modal scroll" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Prescription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="add_details.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <?php 
                                $doc_sql = "SELECT doctor_id, name FROM mediweb_doctor";
                                $doc_result = $conn->query($doc_sql);
                                $doc_options = "";
                                if ($doc_result->num_rows > 0) {
                                    while ($row = $doc_result->fetch_assoc()) {
                                        $doc_options .= "<option value='" . $row['doctor_id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                                echo "Doctor Name: <select name='doctorName' class='form-control'>" . $doc_options . "</select>";
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                $doc_sql = "SELECT externalID, lname, fname FROM mediweb_patient";
                                $doc_result = $conn->query($doc_sql);
                                $doc_options = "";
                                if ($doc_result->num_rows > 0) {
                                    while ($row = $doc_result->fetch_assoc()) {
                                        $doc_options .= "<option value='".$row['externalID']."'>".$row['lname']." ".$row['fname']."</option>";
                                    }
                                }
                                echo "Patient Name: <select name='patient_id' class='form-control'>" . $doc_options . "</select>";
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                $doc_sql = "SELECT insurance_id FROM mediweb_insurance";
                                $doc_result = $conn->query($doc_sql);
                                $doc_options = "";
                                if ($doc_result->num_rows > 0) {
                                    while ($row = $doc_result->fetch_assoc()) {
                                        $doc_options .= "<option value='".$row['insurance_id']."'>".$row['insurance_id']."</option>";
                                    }
                                }
                                echo "Insurance ID: <select name='ins_id' class='form-control'>" . $doc_options . "</select>";
                            ?>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicines" placeholder="Medicine" required></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="medicalCondition" placeholder="Medical Condition" rows=3 required></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="allergies" placeholder="Allergies" rows=3 required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Enter Date:</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <input type="submit" class="btn btn-success" name="add_site" value="Confirm">
                        <button type="button" class="btn btn-danger" name="cancel_add" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="destinationDetailsContent">
                       
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for deleting -->
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post"action="delete_details.php">
                        <input type="hidden" name="id-prescription" id="id-container">
                        <h5>This action will cause this data to be permanently deleted. Are you sure you want to proceed?</h5>
                        <input type="submit" value="Confirm" class="btn btn-danger" name="confirmPres">
                        <button type="button" class="btn btn-success" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var add_modal = document.getElementById("addModal");
        var edit_modal = document.getElementById("editModal");
        var delete_modal = document.getElementById("deleteModal");

        function addModal(){
            add_modal.style.display = "block";
        }

        function editModal(button){
            sendEditRequest(button)
            edit_modal.style.display = "block";
        }

        function deleteModal(button){
            var placeId = button.getAttribute('data-id');
            document.getElementById('id-container').value = placeId;
            delete_modal.style.display = "block";
        }

        function closeModal(){
            add_modal.style.display = "none";
            edit_modal.style.display = "none";
            delete_modal.style.display = "none";
        }

        function sendEditRequest(button) {
                var placeId = button.getAttribute('data-id'); // Get the place ID from data-id attribute

                // AJAX request to send data to PHP
                $.ajax({
                    type: 'POST',
                    url: 'edit_prescription.php', // Replace with your PHP file to retrieve place details
                    data: { prescription_id: placeId }, // Replace 'your_place_id' with the actual place ID
                    success: function(response) {
                        // Inject the retrieved form content into the modal body
                        $('#destinationDetailsContent').html(response);
                    },
                    error: function() {
                        alert('Error occurred while fetching place details.');
                    }
                });
            }

    </script>
</body>
</html>