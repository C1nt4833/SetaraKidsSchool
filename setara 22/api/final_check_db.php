<?php
$db = 'setara';
$host = '127.0.0.1';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $db);
$res = $conn->query("SHOW TABLES LIKE 'testimoni'");
if ($res->num_rows > 0) {
    echo "Table 'testimoni' EXISTS in $db";
} else {
    echo "Table 'testimoni' DOES NOT EXIST in $db";
}
?>
