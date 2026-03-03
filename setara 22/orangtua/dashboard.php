<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'orangtua') {
    header('Location: ../login.html');
    exit;
}

$foto_profil = $_SESSION['foto_profil'] ?? 'default.png';
$username = $_SESSION['username'] ?? 'Orang Tua';
$role_display = "Orang Tua";

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

include 'dashboard_view.php';
?>
