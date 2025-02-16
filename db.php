<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // No password in XAMPP by default
$dbname = "vegetable_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>