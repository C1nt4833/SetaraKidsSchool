<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'setara'; // Correct database name as seen in phpMyAdmin screenshot

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
