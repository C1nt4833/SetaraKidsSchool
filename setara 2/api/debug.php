<?php
// Debug endpoint (DEV ONLY) — gunakan untuk cek koneksi & isi user
error_reporting(E_ALL);
ini_set('display_errors', 1);

$DB_HOST = '127.0.0.1';
$DB_NAME = 'setara';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'err' => 'DB connection failed: '.$e->getMessage()]);
    exit;
}

$username = $_GET['username'] ?? null;
if (!$username) {
    echo json_encode(['ok' => true, 'msg' => 'connected']);
    exit;
}

$stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM users WHERE username = :u LIMIT 1');
$stmt->execute(['u' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode(['ok' => true, 'user' => $user]);