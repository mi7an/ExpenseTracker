<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "expensetracker"; 

//  connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
