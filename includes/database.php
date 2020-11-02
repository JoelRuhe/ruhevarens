<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ruhevarens";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo'<br><br><br><br><br>';
  die("Connection failed: " . $conn->connect_error);
}
?>