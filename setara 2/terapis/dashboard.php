<?php
session_start();
// Cek jika user login sebagai terapis (placeholder)
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'terapis') {
//     header("Location: ../login.html");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Terapis - Setara Kids</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Dashboard Style -->
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <a href="#" class="sidebar-brand">
                <i class="fa fa-book-reader"></i> Setara Kids
            </a>
            <div class="sidebar-heading">
                Menu Terapis
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="laporan.php">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="absen.php">
                        <i class="fas fa-user-check"></i> Absen
                    </a>
                </li>
                <li>
                    <a href="daftar_anak.php">
                        <i class="fas fa-child"></i> Daftar Anak
                    </a>
                </li>
                <li>
                    <a href="jadwal.php">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                    </a>
                </li>
                <li style="margin-top: 20px;">
                    <a href="../api/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Topbar -->
            <nav class="topbar">
                <button class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="ml-auto d-flex align-items-center">
                    <!-- Notifikasi Icon -->
                    <a href="notifikasi.php" class="topbar-icon">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger rounded-circle">3+</span>
                    </a>
                    
                    <!-- Profil Link -->
                    <a href="profil.php" class="user-profile text-decoration-none">
                        <span>Halo, Terapis</span>
                        <img src="../img/user.jpg" alt="Profile" onerror="this.src='https://via.placeholder.com/40'">
                    </a>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                <h1 class="page-title">Dashboard</h1>
                
                <!-- Content Kosong -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-body" style="height: 400px; display: flex; align-items: center; justify-content: center; color: #aaa;">
                                <h3>Selamat Datang di Dashboard Terapis</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
