<?php
// Set timeout untuk script ini (60 detik)
set_time_limit(60);
ini_set('max_execution_time', 60);

// Matikan output buffering untuk response cepat
if (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json; charset=utf-8');
// Pastikan tidak ada output sebelum ini
if (ob_get_level()) {
    ob_clean();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/SimpleSMTP.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;
$identifier = isset($input['identifier']) ? trim($input['identifier']) : '';
error_log('ForgotPassword request received. identifier=' . $identifier);

if (empty($identifier)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Username atau email wajib diisi']);
    exit;
}

try {
    // Cari user berdasarkan username atau email
    $stmt = $pdo->prepare('SELECT * FROM users WHERE (email = :id OR username = :id) AND email IS NOT NULL AND email != "" LIMIT 1');
    $stmt->execute(['id' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    error_log('ForgotPassword: user lookup done. found=' . ( $user ? 'yes' : 'no'));
} catch (Exception $e) {
    error_log('ForgotPassword DB lookup error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit;
}

// Jika user tidak ditemukan
if (!$user) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Username atau email tidak terdaftar. Pastikan Anda memasukkan username/email yang benar.']);
    exit;
}

// Pastikan email tidak kosong
$email = trim($user['email'] ?? '');
if (empty($email)) {
    error_log('ForgotPassword: User found but email is empty. username=' . ($user['username'] ?? 'N/A'));
    echo json_encode(['success' => false, 'message' => 'Akun ini tidak memiliki email terdaftar. Silakan hubungi administrator.']);
    exit;
}
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
    // Log dan kembalikan error
    error_log('ForgotPassword DB error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Gagal membuat token reset. Silakan coba lagi.']);
    exit;
}

// Buat tautan reset - gunakan path relatif dari root project
$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Dapatkan base path dari script location
// $_SERVER['SCRIPT_NAME'] contoh: '/setara 22/api/forgot_password.php'
$scriptPath = dirname($_SERVER['SCRIPT_NAME']); // '/setara 22/api' atau '/api'
$basePath = str_replace('/api', '', $scriptPath); // hapus '/api'
$basePath = trim($basePath, '/'); // hapus leading/trailing slash

// Jika basePath kosong, berarti di root
if (empty($basePath)) {
    $link = $proto . '://' . $host . '/reset_password.php?token=' . urlencode($token);
} else {
    // URL encode untuk handle spasi dalam path (seperti "setara 22")
    $basePathEncoded = implode('/', array_map('rawurlencode', explode('/', $basePath)));
    $link = $proto . '://' . $host . '/' . $basePathEncoded . '/reset_password.php?token=' . urlencode($token);
}

$subject = 'Reset Password - Setara Kids';
$body = "<p>Halo,</p><p>Kami menerima permintaan reset password untuk akun Anda. Klik tautan di bawah untuk membuat password baru (tautan berlaku 10 menit):</p>";
$body .= "<p><a href=\"$link\">Reset Password</a></p>";
$body .= "<p>Jika Anda tidak meminta reset password, silakan abaikan email ini.</p>";

$sent = false;
$sendDetails = [];
$smtpError = null;

try {
    // Gunakan helper sederhana dengan timeout handling
    $res = send_email_smtp($email, $subject, $body);
    if (is_array($res)) {
        $sent = (bool)$res['success'];
        $sendDetails = $res;
        $smtpError = $res['error'] ?? null;
    } else {
        $sent = (bool)$res;
        $sendDetails = ['success' => $sent];
    }

    if ($sent) {
        error_log('ForgotPassword: reset email sent to ' . $email);
    } else {
        error_log('ForgotPassword: Failed to send reset email to ' . $email . '. Error: ' . ($smtpError ?? 'unknown'));
        if (!empty($sendDetails['logs'])) {
            foreach ($sendDetails['logs'] as $l) error_log('SMTP LOG: ' . $l);
        }
    }
} catch (Exception $e) {
    error_log('SMTP exception: ' . $e->getMessage());
    $sendDetails['error'] = $e->getMessage();
    $smtpError = $e->getMessage();
    $sent = false;
}

// Kembalikan pesan dan status yang jelas untuk UI
$debugLink = '';
if (file_exists(__DIR__ . '/smtp_config.php')) {
    $cfg = include(__DIR__ . '/smtp_config.php');
    if (!empty($cfg['smtp_debug'])) {
        $debugLink = "\n\n[DEBUG MODE] Link Reset: " . $link;
    }
}

// Siapkan response
$response = null;

if ($sent) {
    $response = ['success' => true, 'message' => 'Email reset password telah dikirim ke ' . $email . '. Periksa inbox atau folder spam Anda. Tautan berlaku selama 10 menit.' . $debugLink];
} else {
    // Buat pesan error yang lebih informatif
    $errorMsg = 'Gagal mengirim email reset password. ';
    
    if ($smtpError) {
        // Cek jenis error SMTP
        if (stripos($smtpError, 'timeout') !== false) {
            $errorMsg .= 'Server email tidak merespons (timeout). Pastikan koneksi internet stabil atau coba lagi nanti.';
        } else if (stripos($smtpError, 'authentication') !== false || stripos($smtpError, 'auth') !== false) {
            $errorMsg .= 'Masalah autentikasi SMTP. Silakan hubungi administrator.';
        } else if (stripos($smtpError, 'connection') !== false || stripos($smtpError, 'connect') !== false || stripos($smtpError, 'Could not connect') !== false) {
            $errorMsg .= 'Tidak dapat terhubung ke server email. Pastikan server SMTP dapat diakses atau coba lagi nanti.';
        } else {
            $errorMsg .= 'Error: ' . $smtpError;
        }
    } else {
        $errorMsg .= 'Silakan coba lagi nanti atau hubungi administrator.';
    }

    $response = ['success' => false, 'message' => $errorMsg];
    
    // Jika debug mode aktif, tambahkan detail
    if (!empty($debugLink)) {
        $response['details'] = "Link token dibuat: " . $link . "\n\nError: " . ($smtpError ?? 'Unknown');
    }
    
    http_response_code(500);
}

// Pastikan tidak ada output sebelum ini
while (ob_get_level()) {
    ob_end_clean();
}

// Kirim response dan flush segera
$jsonResponse = json_encode($response);
header('Content-Length: ' . strlen($jsonResponse));
echo $jsonResponse;

// Flush output segera
if (function_exists('fastcgi_finish_request')) {
    // FastCGI - kirim response ke client, lanjutkan eksekusi di background
    fastcgi_finish_request();
} else {
    // Standard PHP - flush semua output
    if (ob_get_level()) {
        ob_end_flush();
    }
    flush();
    // Jika menggunakan Apache, coba flush lagi
    if (function_exists('apache_setenv')) {
        @apache_setenv('no-gzip', 1);
    }
}

exit;
