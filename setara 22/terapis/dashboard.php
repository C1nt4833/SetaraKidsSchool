<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'terapis' && $_SESSION['role'] !== 'guru')) {
    // Note: Role di database mungkin 'terapis', tapi user bilang 'guru'. 
    // Kita cek 'terapis' karena folder dan breadcrumb mengarah ke sana.
    // Jika tidak login, redirect ke login
    header("Location: ../login.html");
    exit;
}

// Database Connection for Stats
require_once '../api/db.php';

$username = $_SESSION['username'] ?? 'Terapis';
$role_display = "Terapis"; 

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Fetch Stats
$total_anak = $pdo->query("SELECT COUNT(*) FROM anak")->fetchColumn();
$absen_hari_ini = $pdo->query("SELECT COUNT(*) FROM absensi WHERE tanggal = CURDATE()")->fetchColumn();
$total_evaluasi = $pdo->query("SELECT COUNT(*) FROM catatan_terapi")->fetchColumn();

// Fetch Recent Activities (Last 5 combined)
$recent_activities = $pdo->query("(SELECT 'absen' as type, a.nama_anak, ab.tanggal 
                                    FROM absensi ab JOIN anak a ON ab.anak_id = a.anak_id)
                                   UNION 
                                   (SELECT 'evaluasi' as type, a.nama_anak, c.tanggal 
                                    FROM catatan_terapi c JOIN anak a ON c.anak_id = a.anak_id)
                                   ORDER BY tanggal DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

// Pisahkan logika dan tampilan
include 'dashboard_view.php';
?>
