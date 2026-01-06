<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/SimpleSMTP.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;
$identifier = trim($input['identifier'] ?? '');
error_log('ForgotPassword request received. identifier=' . $identifier);
if ($identifier === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Identifier (username/email) wajib diisi']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :id OR username = :id LIMIT 1');
    $stmt->execute(['id' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    error_log('ForgotPassword: user lookup done. found=' . ( $user ? 'yes' : 'no'));
} catch (Exception $e) {
    error_log('ForgotPassword DB lookup error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

// Selalu kembalikan pesan sukses agar tidak membeberkan apakah akun ada atau tidak
if (!$user) {
    echo json_encode(['success' => true, 'message' => 'Jika akun terdaftar, Anda akan menerima email berisi tautan reset.']);
    exit;
}

$email = $user['email'];
$token = bin2hex(random_bytes(32));
$expires = date('Y-m-d H:i:s', time() + 600); // 10 menit

try {
    // Simpan di tabel password_resets
    $ins = $pdo->prepare('INSERT INTO password_resets (email, token, expired_at) VALUES (:email, :token, :expired_at)');
    $ins->execute(['email' => $email, 'token' => $token, 'expired_at' => $expires]);
    error_log('ForgotPassword: password_resets inserted for ' . $email);

    // Juga update kolom di tabel users (opsional)
    $upd = $pdo->prepare('UPDATE users SET reset_token = :token, reset_token_expires = :expires WHERE email = :email');
    $upd->execute(['token' => $token, 'expires' => $expires, 'email' => $email]);
    error_log('ForgotPassword: users.reset_token updated for ' . $email);
} catch (Exception $e) {
    // Log dan lanjutkan — jangan bocorkan detail ke user
    error_log('ForgotPassword DB error: ' . $e->getMessage());
    echo json_encode(['success' => true, 'message' => 'Jika akun terdaftar, Anda akan menerima email berisi tautan reset.']);
    exit;
}

// Buat tautan reset
$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$link = $proto . '://' . $host . '/reset_password.php?token=' . urlencode($token);

$subject = 'Reset Password - Setara Kids';
$body = "<p>Halo,</p><p>Kami menerima permintaan reset password untuk akun Anda. Klik tautan di bawah untuk membuat password baru (tautan berlaku 10 menit):</p>";
$body .= "<p><a href=\"$link\">Reset Password</a></p>";
$body .= "<p>Jika Anda tidak meminta reset password, silakan abaikan email ini.</p>";

$sent = false;
try {
    // Gunakan helper sederhana
    $sent = send_email_smtp($email, $subject, $body);
    if ($sent) {
        error_log('ForgotPassword: reset email sent to ' . $email);
    } else {
        error_log('ForgotPassword: Failed to send reset email to ' . $email);
    }
} catch (Exception $e) {
    error_log('SMTP error: ' . $e->getMessage());
}

// Jika email berhasil dikirim, beri tahu user untuk cek email; jika gagal, tampilkan pesan generik (agar tidak mengungkapkan keberadaan akun)
if ($sent) {
    echo json_encode(['success' => true, 'message' => 'Email terkirim ke ' . $email . '. Periksa inbox atau folder spam — tautan berlaku 10 menit.']);
} else {
    echo json_encode(['success' => true, 'message' => 'Jika akun terdaftar, Anda akan menerima email berisi tautan reset.']);
}
