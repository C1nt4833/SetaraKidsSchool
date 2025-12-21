<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');

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
    echo json_encode(['success' => false, 'message' => 'Database connection failed: '.$e->getMessage()]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;

$username = trim($input['username'] ?? '');
$password = $input['password'] ?? '';

if ($username === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Username dan password harus diisi']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT user_id, username, password, role FROM users WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: '.$e->getMessage()]);
    exit;
}

if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'User tidak ditemukan']);
    exit;
}

$stored = $user['password'] ?? '';
$ok = false;
// jika nilai tersimpan tampak seperti hash bcrypt/argon2, pakai password_verify
if (preg_match('/^\$(2y|2a|2b)\$|^\$argon2/i', $stored)) {
    if (password_verify($password, $stored)) $ok = true;
} else {
    // fallback: perbandingan plaintext (ada di DB contoh untuk terapis)
    if (hash_equals($stored, $password)) $ok = true;
}

if (!$ok) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
    exit;
}

session_start();
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

echo json_encode(['success' => true, 'role' => $user['role']]);