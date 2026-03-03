<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Absensi Anak - Terapis Dashboard</title>
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
        .icon-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }
        .icon-btn i {
            color: white;
        }
        .content-padding {
            padding: 30px;
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
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
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
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 2px;
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
                padding: 15px;
            }
            .card-custom {
                padding: 15px;
                border-radius: 10px;
            }
            
            /* Enhanced Scrollable Table */
            .table-responsive {
                border: none;
                margin: 0 -15px;
                padding: 0 15px;
                width: calc(100% + 30px);
                -webkit-overflow-scrolling: touch;
            }
            .table-custom {
                min-width: 650px;
            }
            .table-custom th {
                background-color: #f1f5f9 !important;
                padding: 12px 10px !important;
                font-size: 12px;
            }
            .table-custom td {
                padding: 12px 10px !important;
                font-size: 13px;
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
                <img src="<?php echo $avatar_url; ?>" alt="User" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
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
            <a href="daftar_anak.php" class="nav-link-custom">
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
                 <button class="btn text-white d-lg-none me-2 p-0" id="sidebarToggle" style="font-size: 24px;">
                     <i class="fa fa-bars"></i>
                 </button>
            </div>

            <!-- Mobile Search Form -->
            <div class="mobile-search-form" id="mobileSearchForm">
                <form class="w-100" onsubmit="event.preventDefault();">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 mobile-search-input" placeholder="Cari di riwayat..." autocomplete="off" style="border-radius: 20px 0 0 20px;">
                        <button type="button" class="btn btn-light" id="closeSearch" style="border-radius: 0 20px 20px 0; border-left: 1px solid #eee;"><i class="fa fa-times text-muted"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <form class="search-form d-none d-md-block me-3" onsubmit="event.preventDefault();">
                    <input type="text" class="form-control" placeholder="Type for search..." id="absenSearchInput" autocomplete="off">
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
            <h3 class="mb-4 text-dark fw-bold">Absensi Anak</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Absen</li>
                </ol>
            </nav>

            <div class="row">
                <!-- FORM INPUT -->
                <div class="col-12">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold text-primary" id="form-title">Input Kehadiran Baru</h5>
                        
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST" id="absenForm">
                            <input type="hidden" name="action_type" id="action_type" value="create">
                            <input type="hidden" name="record_id" id="record_id" value="">

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="anak_id" class="form-label">ID Anak</label>
                                    <input type="text" class="form-control" id="anak_id" name="anak_id" placeholder="Masukkan ID Anak" value="<?php echo htmlspecialchars($prefill_anak_id ?? ''); ?>" required autocomplete="off">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status Kehadiran</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpa">Alpa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="2" placeholder="Keterangan tambahan..."></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" id="btn-submit">Simpan Absensi</button>
                                <button type="button" class="btn btn-light px-4 py-2 border" id="btn-cancel" style="display: none;" onclick="resetForm()">Batal Edit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- TABLE RIWAYAT -->
                <div class="col-12">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold text-dark">Riwayat Kehadiran</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Tanggal</th>
                                        <th style="width: 25%;">Nama Anak (ID)</th>
                                        <th style="width: 15%;">Status</th>
                                        <th>Catatan</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="absenTableBody">
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
                                            <td class="fw-bold">
                                                <?php echo htmlspecialchars($row['nama_anak']); ?>
                                                <small class="text-muted ms-1">(<?php echo htmlspecialchars($row['anak_id']); ?>)</small>
                                            </td>
                                            <td><span class="status-badge <?php echo $badge_class; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                            <td><?php echo nl2br(htmlspecialchars($row['catatan'] ?? '-')); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-warning btn-action" 
                                                    onclick='editItem(<?php echo json_encode($row); ?>)'>
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <a href="absen.php?action=delete&id=<?php echo $row['absensi_id']; ?>" 
                                                   class="btn btn-sm btn-outline-danger btn-action" 
                                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4">Belum ada data kehadiran.</td>
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
                // Clear mobile search and trigger search to reset table
                $('.mobile-search-input').val('').trigger('input');
            });

            // Live Search Script for Attendance History - Responsive (input event)
            $('#absenSearchInput, .mobile-search-input').on('input', function() {
                var value = $(this).val().toLowerCase();
                $('#absenTableBody tr').each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        function editItem(data) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            document.getElementById('form-title').innerText = 'Edit Kehadiran';
            document.getElementById('action_type').value = 'update';
            document.getElementById('record_id').value = data.absensi_id;
            
            document.getElementById('anak_id').value = data.anak_id;
            document.getElementById('tanggal').value = data.tanggal;
            document.getElementById('status').value = data.status;
            document.getElementById('catatan').value = data.catatan || '';
            
            document.getElementById('btn-submit').innerText = 'Update Absensi';
            document.getElementById('btn-cancel').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('absenForm').reset();
            // set default date to today
            document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
            
            document.getElementById('form-title').innerText = 'Input Kehadiran Baru';
            document.getElementById('action_type').value = 'create';
            document.getElementById('record_id').value = '';
            
            document.getElementById('btn-submit').innerText = 'Simpan Absensi';
            document.getElementById('btn-cancel').style.display = 'none';
        }
    </script>
</body>
</html>
