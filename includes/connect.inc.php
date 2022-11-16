<?php

// Declare Database Connection Variables
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "shareyourvision";

// Create connection variable
$conn = new mysqli($servername, $username, $password, $dbname);

// Call connection with DB
// if ($conn->connect_error) {
//   die('<div class="alert alert-warning mt-3" role="alert"><h4>Connection Failed<h4>' . $conn->connect_error . '</div>');
// } else {
//   echo('<div class="alert alert-success mt-3" role="alert">Connection Successful</div>');
// }

?>
