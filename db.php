<?php
$servername = "localhost";
$username = "root"; // Root is my local setup
$password = "";
$dbname = "membership_directory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
