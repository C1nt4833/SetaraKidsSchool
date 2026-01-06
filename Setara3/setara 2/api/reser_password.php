<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;
$token = trim($input['token'] ?? '');
$password = $input['password'] ?? '';

if ($token === '' || strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Token tidak valid atau password terlalu pendek']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT * FROM password_resets WHERE token = :token AND expired_at > NOW() LIMIT 1');
    $stmt->execute(['token' => $token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

if (!$row) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Token tidak valid atau sudah kadaluarsa']);
    exit;
}

$email = $row['email'];
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $upd = $pdo->prepare('UPDATE users SET password = :pw, reset_token = NULL, reset_token_expires = NULL WHERE email = :email');
    $upd->execute(['pw' => $hash, 'email' => $email]);

    $del = $pdo->prepare('DELETE FROM password_resets WHERE token = :token');
    $del->execute(['token' => $token]);
} catch (Exception $e) {
    error_log('ResetPassword DB error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan password baru']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Password berhasil diubah']);
