<?php
include 'db_connect.php';
$result = $conn->query("SHOW COLUMNS FROM testimoni");
if ($result) {
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "Table testimoni does not exist. Error: " . $conn->error;
}
?>
