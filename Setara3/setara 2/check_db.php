<?php
require_once 'api/db.php';

$result = $conn->query("SHOW COLUMNS FROM users LIKE 'jenis_kelamin'");
if ($result && $result->num_rows > 0) {
    echo "Column jenis_kelamin exists.\n";
} else {
    echo "Column jenis_kelamin MISSING.\n";
}

$result = $conn->query("SHOW COLUMNS FROM users LIKE 'foto_profil'");
if ($result && $result->num_rows > 0) {
    echo "Column foto_profil exists.\n";
} else {
    echo "Column foto_profil MISSING.\n";
}

$result = $conn->query("SHOW COLUMNS FROM anak LIKE 'tahun_masuk'");
if ($result && $result->num_rows > 0) {
    echo "Column tahun_masuk exists.\n";
} else {
    echo "Column tahun_masuk MISSING.\n";
}
?>
