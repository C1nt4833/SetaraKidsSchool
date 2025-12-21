<?php
session_start();
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
    <title>Profil Terapis - Setara Kids</title>
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
                <h1 class="page-title">Profil Saya</h1>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" value="T001" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fullname" value="Budi Terapis">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" value="terapis@example.com">
                                    </div>
                                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
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
