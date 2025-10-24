<?php
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "racos_finals"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
