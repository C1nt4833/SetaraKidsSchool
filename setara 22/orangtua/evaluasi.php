<?php
session_start();

// Cek session dan role - terima 'orangtua' atau 'ortu'
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'orangtua' && $_SESSION['role'] !== 'ortu')) {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Orang Tua';
$role_display = "Orang Tua";
$user_id = $_SESSION['user_id'];

// Database Connection
require_once '../api/db.php';

// Ambil data anak yang terhubung dengan orang tua ini
$stmtAnak = $pdo->prepare("SELECT anak_id, nama_anak FROM anak WHERE orangtua_id = ?");
$stmtAnak->execute([$user_id]);
$anak_list = $stmtAnak->fetchAll(PDO::FETCH_ASSOC);

$evaluasi_data = [];

// Jika punya anak, ambil evaluasinya
if (count($anak_list) > 0) {
    $anak_ids = array_column($anak_list, 'anak_id');
    $placeholders = implode(',', array_fill(0, count($anak_ids), '?'));
    
    // Query untuk mengambil catatan terapi JOIN dengan nama anak agar jelas punya siapa
    $sql = "SELECT c.*, a.nama_anak 
            FROM catatan_terapi c 
            JOIN anak a ON c.anak_id = a.anak_id 
            WHERE c.anak_id IN ($placeholders) 
            ORDER BY c.tanggal DESC, c.created_at DESC";
            
    $stmtEval = $pdo->prepare($sql);
    $stmtEval->execute($anak_ids);
    $evaluasi_data = $stmtEval->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Load View
include 'evaluasi_view.php';
?>
