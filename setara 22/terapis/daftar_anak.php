<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'terapis' && $_SESSION['role'] !== 'guru')) {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Terapis';
$role_display = "Terapis";

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

// Ambil semua data anak + nama orang tua
// JOIN ke tabel users untuk ambil nama lengkap orang tua
$sql = "SELECT a.*, u.nama_lengkap as nama_orangtua, u.username as username_orangtua 
        FROM anak a 
        LEFT JOIN users u ON a.orangtua_id = u.user_id 
        ORDER BY a.nama_anak ASC";

try {
    $stmt = $pdo->query($sql);
    $daftar_anak = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Gagal mengambil data anak: " . $e->getMessage());
}

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Load View
include 'daftar_anak_view.php';
?>
