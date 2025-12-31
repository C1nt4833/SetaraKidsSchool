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

$username = $_SESSION['username'] ?? 'Terapis';
$role_display = "Terapis"; 

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Pisahkan logika dan tampilan
include 'dashboard_view.php';
?>
