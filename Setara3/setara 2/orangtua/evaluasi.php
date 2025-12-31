<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'orangtua') {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Orang Tua';
$role_display = "Orang Tua";
$user_id = $_SESSION['user_id'];

// Database Connection
$DB_HOST = '127.0.0.1';
$DB_NAME = 'setara';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

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
