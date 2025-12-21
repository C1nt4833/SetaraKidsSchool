<?php
session_start();
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'orangtua') {
//     header("Location: ../login.html");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Orangtua - Setara Kids</title>
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
                Menu Orangtua
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="dashboard.php">
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
                        <span>Halo, Orangtua</span>
                        <img src="../img/appointment.jpg" alt="Profile" onerror="this.src='https://via.placeholder.com/40'">
                    </a>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                <h1 class="page-title">Notifikasi</h1>
                
                <div class="row">
                    <div class="col-md-10">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-primary">Laporan Harian Tersedia</h5>
                                            <small>Hari ini</small>
                                        </div>
                                        <p class="mb-1">Terapis Budi telah mengunggah laporan perkembangan harian untuk Ananda Bima.</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-danger">Tagihan SPP</h5>
                                            <small>5 hari yang lalu</small>
                                        </div>
                                        <p class="mb-1">Pengingat pembayaran SPP bulan ini. Harap segera melakukan pembayaran.</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-success">Undangan Kegiatan</h5>
                                            <small>1 minggu yang lalu</small>
                                        </div>
                                        <p class="mb-1">Kami mengundang Ayah/Bunda untuk hadir dalam acara Parenting Seminar pada hari Sabtu.</p>
                                    </a>
                                </div>
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
