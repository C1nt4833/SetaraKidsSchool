<?php
require_once 'api/db.php';

try {
    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'jenis_kelamin'");
    if ($result && $result->rowCount() > 0) {
        echo "Column jenis_kelamin exists.\n";
    } else {
        echo "Column jenis_kelamin MISSING.\n";
    }

    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'foto_profil'");
    if ($result && $result->rowCount() > 0) {
        echo "Column foto_profil exists.\n";
    } else {
        echo "Column foto_profil MISSING.\n";
    }

    $result = $pdo->query("SHOW COLUMNS FROM anak LIKE 'tahun_masuk'");
    if ($result && $result->rowCount() > 0) {
        echo "Column tahun_masuk exists.\n";
    } else {
        echo "Column tahun_masuk MISSING.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
