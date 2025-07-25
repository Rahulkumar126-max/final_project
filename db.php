<?php
// db.php - Database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql101.infinityfree.com";
$username = "if0_39557140";    // Change if needed
$password = "79quvCULFS8WOl";        // Change if needed
$dbname = "if0_39557140_hostelcomplaint";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>