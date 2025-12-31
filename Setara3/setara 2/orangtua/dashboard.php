<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'orangtua') {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Orang Tua';
$role_display = "Orang Tua";

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

include 'dashboard_view.php';
?>
