<?php
$dbs = ['setara', 'setara_db', 'setarasc_db'];
$host = '127.0.0.1';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);

foreach ($dbs as $db) {
    if ($conn->select_db($db)) {
        $res = $conn->query("SELECT nama FROM testimoni WHERE nama = 'Have Tomven' LIMIT 1");
        if ($res && $res->num_rows > 0) {
            echo "Found matching data in database: $db\n";
        }
    }
}
?>
