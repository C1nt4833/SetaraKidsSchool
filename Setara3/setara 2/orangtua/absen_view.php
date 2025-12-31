<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Riwayat Absensi - Orang Tua Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f6f9;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            z-index: 1000;
            padding-top: 20px;
            border-right: 1px solid #eee;
        }
        .main-content {
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 0 24px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
        }
        .sidebar-brand h3 {
            color: var(--primary);
            font-size: 1.25rem;
            margin: 0;
            font-weight: 700;
        }
        .user-panel {
            text-align: center;
            padding: 0 20px;
            margin-bottom: 30px;
        }
        .user-img-circle {
            width: 80px;
            height: 80px;
            background-color: #ffe5d9;
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 32px;
        }
        .nav-link-custom {
            padding: 12px 24px;
            display: flex;
            align-items: center;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            border-left: 4px solid transparent;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background-color: #fef0ec;
            color: var(--primary);
            border-left-color: var(--primary);
        }
        .nav-link-custom i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        .topbar {
            background: var(--primary) !important;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            color: white;
        }
        .content-padding {
            padding: 30px;
        }
        .card-custom {
            background: #fff;
            border-radius: 15px;
            border: none;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
            margin-bottom: 30px;
        }
        .table-custom th {
            font-weight: 600;
            color: #555;
            background-color: #f8f9fa;
        }
        .table-custom td {
            vertical-align: middle;
            color: #555;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-hadir { background-color: #d1e7dd; color: #0f5132; }
        .status-izin { background-color: #fff3cd; color: #664d03; }
        .status-sakit { background-color: #cfe2ff; color: #084298; }
        .status-alpa { background-color: #f8d7da; color: #842029; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h3 class="text-primary"><i class="fa fa-book-reader me-2"></i>Setara Kids</h3>
        </div>
        
        <div class="user-panel">
             <div class="user-img-circle">
                <?php if (!empty($foto_profil) && $foto_profil != 'default.png' && file_exists("../img/profil/" . $foto_profil)): ?>
                    <img src="../img/profil/<?php echo htmlspecialchars($foto_profil); ?>" alt="User" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                <?php else: ?>
                    <i class="fa fa-user-friends"></i>
                <?php endif; ?>
             </div>
             <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($username); ?></h6>
             <small class="text-muted"><?php echo htmlspecialchars($role_display); ?></small>
        </div>

        <nav class="nav flex-column mt-2">
            <a href="dashboard.php" class="nav-link-custom">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="evaluasi.php" class="nav-link-custom">
                <i class="fa fa-file-alt"></i> Evaluasi
            </a>
            <a href="absen.php" class="nav-link-custom active">
                <i class="fa fa-user-check"></i> Absen
            </a>

            <a href="https://wa.me/628123456789" target="_blank" class="nav-link-custom">
                <i class="fab fa-whatsapp"></i> Pengaduan
            </a>
            <a href="../login.html" class="nav-link-custom mt-4 text-danger">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar"> 
            <div class="d-flex align-items-center">
                 <h5 class="mb-0 fw-bold text-white">Labirin Children Center</h5>
            </div>
            <div class="d-flex align-items-center">
                <div class="icon-btn ms-3 text-white">
                    <i class="fa fa-bell"></i>
                </div>
                <a href="profile.php" class="icon-btn ms-3 text-white text-decoration-none">
                     <i class="fa fa-user"></i>
                </a>
            </div>
        </div>

        <div class="content-padding">
            <h3 class="mb-4 text-dark fw-bold">Riwayat Absensi</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Absen</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-12">
                    <div class="card-custom">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Tanggal</th>
                                        <th style="width: 25%;">Nama Anak</th>
                                        <th style="width: 15%;">Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($riwayat_absen) > 0): ?>
                                        <?php foreach($riwayat_absen as $row): ?>
                                            <?php 
                                            // Status Badge Class
                                            $badge_class = 'status-hadir';
                                            if($row['status'] == 'izin') $badge_class = 'status-izin';
                                            if($row['status'] == 'sakit') $badge_class = 'status-sakit';
                                            if($row['status'] == 'alpa') $badge_class = 'status-alpa';
                                            ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                            <td class="fw-bold"><?php echo htmlspecialchars($row['nama_anak']); ?></td>
                                            <td><span class="status-badge <?php echo $badge_class; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                            <td><?php echo nl2br(htmlspecialchars($row['catatan'] ?? '-')); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4">Belum ada data kehadiran.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
