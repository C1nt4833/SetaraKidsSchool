<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/SimpleSMTP.php';

$to = trim($_REQUEST['to'] ?? '');
$config = file_exists(__DIR__ . '/smtp_config.php') ? include(__DIR__ . '/smtp_config.php') : null;
if (!$config) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'smtp_config.php tidak ditemukan']);
    exit;
}

if (!$to) $to = $config['smtp_user'] ?? ($config['from_email'] ?? '');
if (!$to) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Tujuan email tidak disediakan dan tidak ada default di konfigurasi']);
    exit;
}

$subject = 'Test SMTP - Setara (' . date('Y-m-d H:i:s') . ')';
$body = '<p>Ini adalah email tes SMTP dari aplikasi Setara. Jika Anda menerima ini, pengaturan SMTP bekerja.</p>';

try {
    $res = send_email_smtp($to, $subject, $body);
    if (is_array($res)) {
        if ($res['success']) {
            echo json_encode(['success' => true, 'message' => 'Test email terkirim ke ' . $to, 'debug' => (!empty($config['smtp_debug']) ? $res['logs'] : null)]);
        } else {
            http_response_code(500);
            $resp = ['success' => false, 'message' => 'Gagal mengirim email: ' . ($res['error'] ?? 'unknown')];
            if (!empty($config['smtp_debug'])) $resp['debug'] = $res['logs'];
            echo json_encode($resp);
        }
    } else {
        echo json_encode(['success' => (bool)$res, 'message' => (bool)$res ? 'Test email terkirim' : 'Gagal mengirim email']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
}
