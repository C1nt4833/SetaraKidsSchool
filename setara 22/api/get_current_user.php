<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/db.php'; // Uses existing PDO config

$currentUser = null;
$foto_profil = 'default.png';
$display_name = $_SESSION['username'] ?? 'User';

if (isset($_SESSION['user_id'])) {
    try {
        $stmtUser = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmtUser->execute([$_SESSION['user_id']]);
        $currentUser = $stmtUser->fetch(PDO::FETCH_ASSOC);
        
        if ($currentUser) {
            $foto_profil = $currentUser['foto_profil'] ?? 'default.png';
            $display_name = $currentUser['nama_lengkap'] ?: $currentUser['username'];
        }
    } catch (Exception $e) {
        // Silent fail, stick to defaults
    }
}
?>
