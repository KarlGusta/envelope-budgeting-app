<?php
$host = 'localhost';
$db = 'envelope_budget';
$user = 'root';
$pass = ''; // change if needed

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
