<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);
$result = $conn->query("SHOW DATABASES");
while($row = $result->fetch_assoc()) {
    echo $row['Database'] . "\n";
}
?>
