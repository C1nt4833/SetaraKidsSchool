<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Terapis - Setara Kids School</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Libraries Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
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
            z-index: 1001;
            padding-top: 20px;
            border-right: 1px solid #eee;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-close {
            display: none;
            position: absolute;
            top: 22px;
            left: 20px;
            font-size: 20px;
            color: #6c757d;
            cursor: pointer;
            border: none;
            background: #f8f9fa;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .sidebar-close:hover { background: #e9ecef; color: var(--primary); }
        
        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            display: none;
            backdrop-filter: blur(2px);
        }
        .main-content {
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: 0.3s;
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
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .nav-link-custom {
            padding: 12px 24px;
            display: flex;
            align-items: center;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            border-left: 4px solid transparent;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background-color: #f1f5f9;
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
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .search-form .form-control {
            border-radius: 20px;
            border: none;
            padding-left: 20px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .icon-btn {
            color: white;
            margin-left: 15px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            text-decoration: none;
        }
        .icon-btn:hover { background: rgba(255, 255, 255, 0.3); color: white; }
        
        .content-padding { padding: 30px; }
        
        .mobile-search-form {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary);
            z-index: 10;
            padding: 0 20px;
            align-items: center;
        }
        .mobile-search-form.active {
            display: flex;
        }
        
        /* New Premium Elements */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, #00d2ff 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 163, 255, 0.2);
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .welcome-banner h2 { font-weight: 800; font-size: 2.5rem; margin-bottom: 10px; }
        .welcome-banner p { opacity: 0.9; font-size: 1.1rem; max-width: 600px; }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            height: 100%;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .stat-icon {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-right: 20px;
        }
        .icon-anak { background: #E0F2FE; color: #0EA5E9; }
        .icon-absen { background: #DCFCE7; color: #22C55E; }
        .icon-eval { background: #FEF3C7; color: #F59E0B; }
        
        .stat-details h3 { font-size: 2rem; font-weight: 800; margin: 0; color: #1e293b; }
        .stat-details p { margin: 0; color: #64748b; font-size: 0.95rem; font-weight: 600; }

        .card-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            height: 100%;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .section-header h5 { font-weight: 800; color: #1e293b; margin: 0; }
        
        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .activity-item:last-child { border: 0; }
        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 16px;
        }
        
        .quick-action-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s;
            border: 1px solid #f1f5f9;
            background: #fff;
            text-align: center;
        }
        .action-btn:hover { 
            background: #f8fafc; 
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .action-btn i { font-size: 28px; margin-bottom: 12px; color: var(--primary); }
        .action-btn span { font-weight: 700; color: #334155; font-size: 0.95rem; }

        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px;
                width: 280px;
            }
            .sidebar.active {
                left: 0;
            }
            .sidebar-overlay.active {
                display: block;
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar-brand {
                justify-content: flex-end;
                padding-left: 65px;
            }
            .sidebar-close {
                display: flex;
            }
            .topbar {
                padding: 0 20px;
            }
            .search-form {
                display: none !important;
            }
            .content-padding {
                padding: 20px;
            }
            .welcome-banner {
                padding: 30px 20px;
            }
            .welcome-banner h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <button class="sidebar-close" id="sidebarClose">
            <i class="fa fa-times"></i>
        </button>
        <div class="sidebar-brand">
            <h3 class="text-primary">Setara Kids <i class="fa fa-book-reader ms-2"></i></h3>
        </div>
        
        <div class="user-panel">
             <div class="user-img-circle">
                <?php 
                $avatar_url = !empty($foto_profil) && $foto_profil != 'default.png' && file_exists("../img/profil/" . $foto_profil)
                    ? "../img/profil/" . htmlspecialchars($foto_profil)
                    : "https://ui-avatars.com/api/?name=" . urlencode($username) . "&background=ffe5d9&color=00A3FF&size=128&bold=true";
                ?>
                <img src="<?= $avatar_url ?>" alt="User" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
             </div>
             <h6 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($username) ?></h6>
             <small class="text-muted"><?= htmlspecialchars($role_display) ?></small>
        </div>

        <nav class="nav flex-column mt-2">
            <a href="dashboard.php" class="nav-link-custom active">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="evaluasi.php" class="nav-link-custom">
                <i class="fa fa-file-alt"></i> Evaluasi
            </a>
            <a href="absen.php" class="nav-link-custom">
                <i class="fa fa-user-check"></i> Absen
            </a>
            <a href="daftar_anak.php" class="nav-link-custom">
                <i class="fa fa-child"></i> Daftar Anak
            </a>

            <div class="mt-4 pt-3 border-top mx-3">
                <a href="../login.html" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link-custom text-danger px-2">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <form id="logout-form" action="../api/logout.php" method="POST" style="display: none;"></form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar"> 
            <div class="d-flex align-items-center">
                 <button class="btn text-white d-lg-none me-2 p-0" id="sidebarToggle" style="font-size: 24px;">
                     <i class="fa fa-bars"></i>
                 </button>
            </div>

            <!-- Mobile Search Form -->
            <div class="mobile-search-form" id="mobileSearchForm">
                <form class="w-100" onsubmit="event.preventDefault(); window.location.href='daftar_anak.php?search=' + this.querySelector('input').value;">
                    <div class="input-group">
                        <input type="text" class="form-control border-0" placeholder="Type for search..." autocomplete="off" style="border-radius: 20px 0 0 20px;">
                        <button type="button" class="btn btn-light" id="closeSearch" style="border-radius: 0 20px 20px 0; border-left: 1px solid #eee;"><i class="fa fa-times text-muted"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <form class="search-form d-none d-md-block me-3" onsubmit="event.preventDefault(); window.location.href='daftar_anak.php?search=' + this.querySelector('input').value;">
                    <input type="text" class="form-control" placeholder="Type for search..." autocomplete="off">
                </form>
                <div class="icon-btn d-md-none" id="mobileSearchToggle">
                    <i class="fa fa-search"></i>
                </div>
                <div class="icon-btn">
                    <i class="fa fa-bell"></i>
                </div>
                <a href="profile.php" class="icon-btn text-decoration-none">
                     <i class="fa fa-user"></i>
                </a>
            </div>
        </div>

        <div class="content-padding">
            <!-- Welcome Banner -->
            <div class="welcome-banner animate__animated animate__fadeIn">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <h2 class="animate__animated animate__fadeInLeft animate__delay-1s">Halo, <?= explode(' ', trim($username))[0] ?>! 👋</h2>
                        <p class="animate__animated animate__fadeInLeft animate__delay-1s">Sudah siap untuk kegiatan hari ini? Berikut ringkasan perkembangan anak-anak di Setara Kids School.</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <div class="stat-icon icon-anak">
                            <i class="fa fa-children"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?= $total_anak ?></h3>
                            <p>Total Anak Didik</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="stat-icon icon-absen">
                            <i class="fa fa-calendar-check"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?= $absen_hari_ini ?></h3>
                            <p>Absensi Hari Ini</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                        <div class="stat-icon icon-eval">
                            <i class="fa fa-clipboard-list"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?= $total_evaluasi ?></h3>
                            <p>Total Evaluasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Recent Activity -->
                <div class="col-lg-8">
                    <div class="card-section animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <div class="section-header">
                            <h5>Aktivitas Terbaru Hari Ini</h5>
                        </div>
                        <?php if (count($recent_activities) > 0): ?>
                            <?php foreach($recent_activities as $act): ?>
                                <div class="activity-item">
                                    <div class="activity-icon <?= ($act['type'] == 'absen') ? 'icon-absen' : 'icon-eval' ?>">
                                        <i class="fa <?= ($act['type'] == 'absen') ? 'fa-user-check' : 'fa-file-alt' ?>"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-dark"><?= htmlspecialchars($act['nama_anak']) ?></span>
                                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i><?= date('d M Y', strtotime($act['tanggal'])) ?></small>
                                        </div>
                                        <small class="text-secondary">Telah diinputkan <?= ($act['type'] == 'absen') ? 'kehadiran' : 'evaluasi harian' ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-tasks fa-3x text-light"></i>
                                </div>
                                <p class="text-muted font-italic">Belum ada aktivitas tercatat untuk hari ini.</p>
                                <a href="absen.php" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">Mulai Input Sekarang</a>
                            </div>
                        <?php endif; ?>
                        <div class="mt-4 pt-3 border-top text-center">
                            <a href="daftar_anak.php" class="text-primary text-decoration-none fw-bold small">LIHAT SEMUA DATA ANAK <i class="fa fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4">
                    <div class="card-section animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                        <div class="section-header">
                            <h5>Menu Pintas</h5>
                        </div>
                        <div class="quick-action-grid">
                            <a href="absen.php" class="action-btn">
                                <i class="fa fa-user-plus"></i>
                                <span>Input Absen</span>
                            </a>
                            <a href="evaluasi.php" class="action-btn">
                                <i class="fa fa-pen-nib"></i>
                                <span>Input Eval</span>
                            </a>
                            <a href="daftar_anak.php" class="action-btn">
                                <i class="fa fa-child"></i>
                                <span>Data Anak</span>
                            </a>
                            <a href="profile.php" class="action-btn">
                                <i class="fa fa-user-circle"></i>
                                <span>Profil Saya</span>
                            </a>
                        </div>
                        
                        <div class="mt-4 p-4 rounded-3" style="background: #f1f5f9;">
                            <h6 class="fw-bold mb-2 small"><i class="fa fa-lightbulb text-warning me-2"></i>Tips Produktif</h6>
                            <p class="mb-0 text-muted small" style="line-height: 1.5;">Gunakan fitur pencarian di atas untuk menemukan data anak secara instant dari halaman manapun.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarToggle, #sidebarOverlay, #sidebarClose').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.sidebar-overlay').toggleClass('active');
            });

            $('#mobileSearchToggle').on('click', function() {
                $('#mobileSearchForm').addClass('active');
                $('#mobileSearchForm input').focus();
            });

            $('#closeSearch').on('click', function() {
                $('#mobileSearchForm').removeClass('active');
            });
        });
    </script>
</body>
</html>
