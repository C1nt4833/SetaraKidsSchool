<?php
$dbs = ['setara', 'setara_db', 'setarasc_db', 'sett2585_setara'];
$host = '127.0.0.1';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password);

foreach ($dbs as $db) {
    if ($conn->select_db($db)) {
        $res = $conn->query("SHOW TABLES LIKE 'testimoni'");
        if ($res->num_rows > 0) {
            echo "Found 'testimoni' in database: $db\n";
            $cols = $conn->query("SHOW COLUMNS FROM testimoni");
            while($c = $cols->fetch_assoc()) {
                echo "  - " . $c['Field'] . " (" . $c['Type'] . ")\n";
            }
        }
    }
}
?>
