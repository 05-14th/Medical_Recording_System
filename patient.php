<?php
require_once 'config.php';
session_start();

function generateData($sql){
    global $conn;
    $dataResult = mysqli_query($conn, $sql);
    while ($medicalResult = mysqli_fetch_assoc($dataResult)){
        echo "<tr>";
        echo "<td>" . $medicalResult['fname'] . "</td>";
        echo "<td>" . $medicalResult['lname'] . "</td>";
        echo "<td>" . $medicalResult['title'] . "</td>";
        echo "<td>" . $medicalResult['preferredName'] . "</td>";
        echo "<td>".  $medicalResult['gender'] ."</td>";
        echo "<td>" . $medicalResult['birthdate'] . "</td>";
        echo "<td>" . $medicalResult['bloodType'] . "</td>";
        echo "<td>" . $medicalResult['maritalStatus'] . "</td>";
        echo "<td>" . $medicalResult['sexualOrientation'] . "</td>";
        echo "<td>" . $medicalResult['ward'] . "</td>";
        echo "<td>" . $medicalResult['externalID'] . "</td>";
        echo "<td>" . $medicalResult['licenseID'] . "</td>";
        echo "<td>" . $medicalResult['updatedDate'] . "</td>";
        echo "<td>";
        echo "<button type='button' data-id='" . $medicalResult['patient_id'] ."' class='btn btn-success tweak-button' onclick='addContact(this)'>Add Contact</button><br>";
        echo "<button type='button' data-id='" . $medicalResult['patient_id'] ."' class='btn btn-warning tweak-button' onclick='editModal(this)'>Edit</button><br>";
        echo "<button type='button' data-id='" . $medicalResult['patient_id'] ."' class='btn btn-danger tweak-button' onclick='deleteModal(this)'>Delete</button><br>";
        echo "<button type='button' data-id='" . $medicalResult['patient_id'] ."' class='btn btn-primary tweak-button' onclick='showModal(this)'>Show Contacts</button><br>";
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
            <div class="form-group" style="display: flex;">
                <input style="width: 30vw; height: 6vh;" placeholder="Search for Patient" name="search-input"><br>
                <input style="width: 6vw; height: 6vh;" type="submit" class="btn btn-primary" name="search-button" value="Search">    
            </div>
        </form>
    </div>
    <button type="button" data-id="" class="btn btn-success" onclick="addModal()">Add Patient</button>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Title</th>
                    <th>Preferred Name</th>
                    <th>Gender</th>
                    <th>Bithdate</th>
                    <th>Blood Type</th>
                    <th>Marital Status</th>
                    <th>Sexual Orientation</th>
                    <th>Ward</th>
                    <th>External ID</th>
                    <th>Licensed ID</th>
                    <th>Date Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search-button"])) {
                    if(strlen(trim($_POST['search-input'])) === 0) {
                        // Retrieve and sanitize the SQL query from the form
                        $sql_query = "SELECT * FROM mediweb_patient";  
                        generateData($sql_query);
                    }elseif(isset($_POST['search-input'])){
                        $search_result = $_POST['search-input'];
                        $sql_query = "SELECT * FROM mediweb_patient WHERE fname LIKE '%$search_result%' OR  lname LIKE '%$search_result%'";  
                        generateData($sql_query);
                    }else {
                        $sql_query = "SELECT * FROM mediweb_patient";  
                        generateData($sql_query);    
                    }
                }else {
                    $sql_query = "SELECT * FROM mediweb_patient";  
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
                    <h5 class="modal-title" id="addModalLabel">Add Patient Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="add_details.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="form-control" name="fname" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="lname" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="title" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="preferredName" placeholder="Preferred Name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="gender" placeholder="Gender" required>
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" name="sexualOrientation" placeholder="Sexual Orientation" required>
                        </div>
                        <div class="form-group">
                            <label for="selected_date">Birthdate:</label>
                            <input class="form-control" type="date" id="selected_date" name="selected_date">
                        </div>
                        <div class="form-group">
                            <label for="bloodType">Blood Type: </label>
                            <select class="form-control" name="bloodType" required>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maritalStat">Marital Status: </label>
                            <select class="form-control" name="maritalStat" required>
                                <option value="Default" disabled>Select Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Partners">Partners</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wardType">Ward: </label>
                            <select class="form-control" name="wardType" required>
                                <option value="Not Applicable">Not Applicable</option>
                                <option value="Medical">Medical Ward</option>
                                <option value="OB">OB Ward</option>
                                <option value="Surgical">Surgical Ward</option>
                                <option value="Philhealth">Philhealth Ward</option>
                                <option value="Pediatric">Pediatric Ward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="externalId" placeholder="External ID" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="licensedId" placeholder="Licensed ID" required>
                        </div>
                        <div class="form-group">
                            <label for="date_confirmed">Date: </label>
                            <input id= "date_confiremd" class="form-control" value="<?php echo date("F j, Y"); ?>" name="date" readonly>
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

    <!-- Modal for adding contacts -->
    <div class="modal" id="addConModal" tabindex="-1" role="dialog" aria-labelledby="addConModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Add Emergency Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="contactDetailsContent" action="add_details.php">
                       
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
                        <input type="hidden" name="id-container" id="id-container">
                        <h5>This action will cause this data to be permanently deleted. Are you sure you want to proceed?</h5>
                        <input type="submit" value="Confirm" class="btn btn-danger" name="confirm">
                        <button type="button" class="btn btn-success" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for showing contacts -->
    <div class="modal" id="showModal" tabindex="-1" role="dialog" aria-labelledby="addConModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Add Emergency Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contDetailsContent">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var add_modal = document.getElementById("addModal");
        var edit_modal = document.getElementById("editModal");
        var delete_modal = document.getElementById("deleteModal");
        var addCon_modal =document.getElementById("addConModal");
        var show_modal = document.getElementById("showModal");

        function addModal(){
            add_modal.style.display = "block";
        }

        function addContact(button){
            sendContactRequest(button)
            addCon_modal.style.display = "block";
        }

        function editModal(button){
            sendEditRequest(button);
            edit_modal.style.display = "block";
        }

        function deleteModal(button){
            var placeId = button.getAttribute('data-id');
            document.getElementById('id-container').value = placeId;
            delete_modal.style.display = "block";
        }

        function showModal(button){
            showContactRequest(button);
            show_modal.style.display = "block";
        }

        function closeModal(){
            add_modal.style.display = "none";
            edit_modal.style.display = "none";
            delete_modal.style.display = "none";
            addCon_modal.style.display = "none";
            show_modal.style.display = "none";
        }

        function sendEditRequest(button) {
                var placeId = button.getAttribute('data-id'); // Get the place ID from data-id attribute

                // AJAX request to send data to PHP
                $.ajax({
                    type: 'POST',
                    url: 'edit_details.php', // Replace with your PHP file to retrieve place details
                    data: { patient_id: placeId }, // Replace 'your_place_id' with the actual place ID
                    success: function(response) {
                        // Inject the retrieved form content into the modal body
                        $('#destinationDetailsContent').html(response);
                    },
                    error: function() {
                        alert('Error occurred while fetching place details.');
                    }
                });
            }
        
        function sendContactRequest(button) {
            var patientId = button.getAttribute('data-id'); // Get the place ID from data-id attribute

            // AJAX request to send data to PHP
            $.ajax({
                type: 'POST',
                url: 'add_contact.php', // Replace with your PHP file to retrieve place details
                data: { patient_idc: patientId }, // Replace 'your_place_id' with the actual place ID
                success: function(response) {
                    // Inject the retrieved form content into the modal body
                    $('#contactDetailsContent').html(response);
                },
                error: function() {
                    alert('Error occurred while fetching place details.');
                }
            });
        }

        function showContactRequest(button) {
            var patId = button.getAttribute('data-id'); // Get the place ID from data-id attribute

            // AJAX request to send data to PHP
            $.ajax({
                type: 'POST',
                url: 'show_contact.php', // Replace with your PHP file to retrieve place details
                data: { patient_showcon: patId }, // Replace 'your_place_id' with the actual place ID
                success: function(response) {
                    // Inject the retrieved form content into the modal body
                    $('#contDetailsContent').html(response);
                },
                error: function() {
                    alert('Error occurred while fetching place details.');
                }
            });
        }

    </script>
</body>
</html>