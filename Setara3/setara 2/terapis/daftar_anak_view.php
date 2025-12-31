<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Daftar Anak - Terapis Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
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
        /* Card Daftar Anak Styles */
        .child-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .child-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .child-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .parent-name {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
            display: block;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn-action-card {
            flex: 1;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 10px;
            border-radius: 8px;
            white-space: nowrap;
        }
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
                    <i class="fa fa-user"></i>
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
            <a href="absen.php" class="nav-link-custom">
                <i class="fa fa-user-check"></i> Absen
            </a>
            <a href="daftar_anak.php" class="nav-link-custom active">
                <i class="fa fa-child"></i> Daftar Anak
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
            <h3 class="mb-4 text-dark fw-bold">Daftar Anak Didik</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Daftar Anak</li>
                </ol>
            </nav>

            <div class="row g-4">
                <?php if(count($daftar_anak) > 0): ?>
                    <?php foreach($daftar_anak as $anak): ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="child-card">
                                <div>
                                    <h5 class="child-name"><?php echo htmlspecialchars($anak['nama_anak']); ?></h5>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark border">ID: <?php echo $anak['anak_id']; ?></span>
                                    </div>
                                    <span class="parent-name">
                                        Orangtua: 
                                        <?php echo htmlspecialchars($anak['nama_orangtua'] ? $anak['nama_orangtua'] : ($anak['username_orangtua'] ?? '-')); ?>
                                    </span>
                                </div>
                                <div class="action-buttons mt-3">
                                    <a href="evaluasi.php?child_id=<?php echo $anak['anak_id']; ?>" class="btn btn-primary btn-action-card text-center">
                                        Buat Laporan
                                    </a>
                                    <a href="absen.php?child_id=<?php echo $anak['anak_id']; ?>" class="btn btn-primary btn-action-card text-center">
                                        Input Absensi
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info py-4 text-center">
                            Belum ada data anak terdaftar.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
