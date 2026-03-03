<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Evaluasi - Orang Tua Dashboard</title>
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
        }
        .icon-btn {
            color: white;
            margin-left: 15px;
            cursor: pointer;
            background: rgba(173, 216, 230, 0.8); /* Light blue circle seperti foto kedua */
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            text-decoration: none;
        }
        .icon-btn:hover {
            background: rgba(173, 216, 230, 1); /* Lebih solid saat hover */
            color: white;
        }
        .icon-btn i {
            color: white;
        }
        .content-padding {
            padding: 20px;
        }
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
        .card-custom {
            background: #fff;
            border-radius: 15px;
            border: none;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }
        .table-custom th {
            font-weight: 600;
            color: #555;
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
        }
        .table-custom td {
            vertical-align: middle;
            color: #555;
        }
        .badge-pertemuan {
            background-color: var(--primary);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
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

        /* Responsive Sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
            backdrop-filter: blur(2px);
        }

        .toggle-sidebar {
            display: none;
            background: transparent;
            color: white;
            border: none;
            padding: 0;
            margin-right: 15px;
            font-size: 24px;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px;
                width: 280px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1100;
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
            .toggle-sidebar {
                display: block;
            }
            .sidebar-brand {
                justify-content: flex-end;
                padding-left: 50px;
                padding-right: 0;
            }
            .sidebar-close {
                display: flex;
                left: 15px;
                top: 18px;
            }
            .content-padding {
                padding: 15px;
            }
            .card-custom {
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
            }
            
            /* Enhanced Scrollable Table */
            .table-responsive {
                border: none;
                margin: 0 -15px; /* Bleed to card edges */
                padding: 0 15px;
                width: calc(100% + 30px);
                -webkit-overflow-scrolling: touch;
            }
            .table-custom {
                min-width: 650px;
                margin-bottom: 0;
            }
            .table-custom th {
                background-color: #f1f5f9 !important;
                color: #475569 !important;
                white-space: nowrap;
                padding: 12px 10px !important;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }
            .table-custom td {
                padding: 12px 10px !important;
                font-size: 13px;
                border-bottom: 1px solid #f1f5f9;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar">
        <button class="sidebar-close" id="sidebarClose">
            <i class="fa fa-times"></i>
        </button>
        <div class="sidebar-brand">
            <h3 class="text-primary">Setara Kids <i class="fa fa-heart ms-2"></i></h3>
        </div>
        
        <div class="user-panel">
             <div class="user-img-circle">
                <?php 
                $avatar_url = !empty($foto_profil) && $foto_profil != 'default.png' && file_exists("../img/profil/" . $foto_profil)
                    ? "../img/profil/" . htmlspecialchars($foto_profil)
                    : "https://ui-avatars.com/api/?name=" . urlencode($username) . "&background=ffe5d9&color=00A3FF&size=128&bold=true";
                ?>
                <img src="<?php echo $avatar_url; ?>" alt="User" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
             </div>
             <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($username); ?></h6>
             <small class="text-muted"><?php echo htmlspecialchars($role_display); ?></small>
        </div>

        <nav class="nav flex-column mt-2">
            <a href="dashboard.php" class="nav-link-custom">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="evaluasi.php" class="nav-link-custom active">
                <i class="fa fa-file-alt"></i> Evaluasi
            </a>
            <a href="absen.php" class="nav-link-custom">
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
                 <button class="toggle-sidebar" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                 </button>
            </div>

            <!-- Mobile Search Form -->
            <div class="mobile-search-form" id="mobileSearchForm">
                <form class="w-100" onsubmit="event.preventDefault();">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 mobile-search-input" placeholder="Type for search..." autocomplete="off" style="border-radius: 20px 0 0 20px;">
                        <button type="button" class="btn btn-light" id="closeSearch" style="border-radius: 0 20px 20px 0; border-left: 1px solid #eee;"><i class="fa fa-times text-muted"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <form class="search-form d-none d-md-block me-3">
                    <input type="text" class="form-control" placeholder="Type for search..." id="evalSearchInput" autocomplete="off">
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
            <h3 class="mb-4 text-dark fw-bold">Evaluasi Anak</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Evaluasi</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-12">
                    <?php if (empty($anak_list)): ?>
                        <div class="alert alert-warning">
                            Anda belum memiliki data anak terdaftar. Harap hubungi admin.
                        </div>
                    <?php else: ?>
                        
                        <!-- List Anak -->
                        <div class="mb-4">
                             <h6 class="text-muted">Anak Terdaftar: 
                                <?php foreach($anak_list as $a): ?>
                                    <span class="badge bg-info text-white me-1"><?php echo htmlspecialchars($a['nama_anak']); ?></span>
                                <?php endforeach; ?>
                             </h6>
                        </div>

                        <!-- Tabel Evaluasi -->
                        <div class="card-custom">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Anak</th>
                                            <th>Pertemuan Ke</th>
                                            <th>Catatan Evaluasi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="evalTableBody">
                                        <?php if(count($evaluasi_data) > 0): ?>
                                            <?php foreach($evaluasi_data as $row): ?>
                                            <tr>
                                                <td style="width: 15%; white-space: nowrap;">
                                                    <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                                                </td>
                                                <td style="width: 20%; font-weight: bold;">
                                                    <?php echo htmlspecialchars($row['nama_anak']); ?>
                                                </td>
                                                <td style="width: 15%;">
                                                    <span class="badge-pertemuan">Ke-<?php echo $row['pertemuan_ke']; ?></span>
                                                </td>
                                                <td>
                                                    <?php echo nl2br(htmlspecialchars($row['isi_catatan'])); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4">Belum ada data evaluasi.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
                $('.mobile-search-input').val('').trigger('input');
            });

            // Live Search Script for Evaluation History - Responsive (input event)
            $('#evalSearchInput, .mobile-search-input').on('input', function() {
                var value = $(this).val().toLowerCase();
                $('#evalTableBody tr').each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>
</html>
