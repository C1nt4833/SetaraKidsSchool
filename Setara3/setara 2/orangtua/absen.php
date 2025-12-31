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

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

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

// Ambil data anak yang terhubung
$stmtAnak = $pdo->prepare("SELECT anak_id FROM anak WHERE orangtua_id = ?");
$stmtAnak->execute([$user_id]);
$anak_list = $stmtAnak->fetchAll(PDO::FETCH_ASSOC);

$riwayat_absen = [];

if (count($anak_list) > 0) {
    $anak_ids = array_column($anak_list, 'anak_id');
    $placeholders = implode(',', array_fill(0, count($anak_ids), '?'));
    
    // Ambil data absensi
    $sql = "SELECT ab.*, a.nama_anak 
            FROM absensi ab 
            JOIN anak a ON ab.anak_id = a.anak_id 
            WHERE ab.anak_id IN ($placeholders) 
            ORDER BY ab.tanggal DESC, ab.absensi_id DESC";
            
    $stmtAbsen = $pdo->prepare($sql);
    $stmtAbsen->execute($anak_ids);
    $riwayat_absen = $stmtAbsen->fetchAll(PDO::FETCH_ASSOC);
}

// Load View
include 'absen_view.php';
?>
