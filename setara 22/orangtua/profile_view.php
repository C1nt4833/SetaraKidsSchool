<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Profil Keluarga - Orangtua Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        body { background-color: #f3f6f9; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background: #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.05); z-index: 1000; padding-top: 20px; border-right: 1px solid #eee; }
        .main-content { margin-left: 260px; padding: 0; min-height: 100vh; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 0 24px; margin-bottom: 40px; display: flex; align-items: center; }
        .user-panel { text-align: center; padding: 0 20px; margin-bottom: 30px; }
        .user-img-circle { width: 80px; height: 80px; background-color: #ffe5d9; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 32px; overflow: hidden; }
        .user-img-circle img { width: 100%; height: 100%; object-fit: cover; }
        .nav-link-custom { padding: 12px 24px; display: flex; align-items: center; color: #6c757d; text-decoration: none; transition: all 0.3s; font-weight: 500; border-left: 4px solid transparent; }
        .nav-link-custom:hover, .nav-link-custom.active { background-color: #fef0ec; color: var(--primary); border-left-color: var(--primary); }
        .nav-link-custom i { margin-right: 15px; width: 20px; text-align: center; }
        .topbar { background: var(--primary) !important; height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; color: white; position: sticky; top: 0; z-index: 999; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .search-form .form-control { border-radius: 20px; border: none; padding-left: 20px; width: 300px; }
        .icon-btn {
            color: white;
            margin-left: 15px;
            cursor: pointer;
            background: rgba(173, 216, 230, 0.8);
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
            background: rgba(173, 216, 230, 1);
            color: white;
        }
        .content-padding { padding: 30px; }
        .card-custom { background: #fff; border-radius: 15px; border: none; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.03); margin-bottom: 30px; }
        .profile-pic-preview { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .child-card { border-left: 4px solid var(--primary); background: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 15px; }
        .child-card:last-child { margin-bottom: 0; }
        .info-label { font-size: 13px; color: #888; margin-bottom: 2px; }
        .info-value { font-weight: 600; color: #333; }

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
                $avatar_url = !empty($user['foto_profil']) && $user['foto_profil'] != 'default.png' && file_exists("../img/profil/" . $user['foto_profil'])
                    ? "../img/profil/" . htmlspecialchars($user['foto_profil'])
                    : "https://ui-avatars.com/api/?name=" . urlencode($username) . "&background=ffe5d9&color=00A3FF&size=128&bold=true";
                ?>
                <img src="<?php echo $avatar_url; ?>" alt="User" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
             </div>
             <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($username); ?></h6>
             <small class="text-muted"><?php echo htmlspecialchars($role_display); ?></small>
             <div class="mt-2">
                 <a href="profile.php" class="badge bg-light text-primary border border-primary text-decoration-none">Lihat Profil</a>
             </div>
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
            <a href="https://wa.me/628123456789" target="_blank" class="nav-link-custom">
                <i class="fab fa-whatsapp"></i> Pengaduan
            </a>
            <!-- Logout -->
            <a href="../login.html" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link-custom mt-4 text-danger">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="../api/logout.php" method="POST" style="display: none;">
                <!-- Hidden logout form -->
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
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
                        <input type="text" class="form-control border-0" placeholder="Type for search..." autocomplete="off" style="border-radius: 20px 0 0 20px;">
                        <button type="button" class="btn btn-light" id="closeSearch" style="border-radius: 0 20px 20px 0; border-left: 1px solid #eee;"><i class="fa fa-times text-muted"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <form class="search-form d-none d-md-block me-3" onsubmit="event.preventDefault();">
                    <input type="text" class="form-control" placeholder="Type for search..." id="profileSearchInput" autocomplete="off">
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
            <h3 class="mb-4 text-dark fw-bold">Profil Keluarga</h3>
            
            <div class="row">
                <!-- Parent Info -->
                <div class="col-lg-5">
                    <div class="card-custom">
                        <div class="text-center mb-4">
                             <?php 
                            $foto_card = !empty($user['foto_profil']) && $user['foto_profil'] != 'default.png' && file_exists("../img/profil/" . $user['foto_profil'])
                                ? "../img/profil/" . $user['foto_profil'] 
                                : "https://ui-avatars.com/api/?name=" . urlencode($username) . "&background=ffe5d9&color=00A3FF&size=150&bold=true";
                            ?>
                            <div style="position: relative; display: inline-block;">
                                <img src="<?php echo $foto_card; ?>" alt="Profil" class="profile-pic-preview" id="profilePicPreview" style="cursor: pointer;" title="Klik untuk mengganti foto">
                            </div>
                        </div>
                        
                        <h5 class="mb-4 fw-bold border-bottom pb-2">Data Orang Tua</h5>
                        
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Hidden form for Photo Upload -->
                        <form id="photoUploadForm" action="" method="POST" enctype="multipart/form-data" style="display: none;">
                            <input type="file" name="foto_profil" id="fotoInput" accept="image/png, image/jpeg" onchange="document.getElementById('photoUploadForm').submit();">
                        </form>

                        <!-- Readonly Info -->
                        <div class="mb-3">
                            <label class="form-label">Nama Orang Tua</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" value="<?php 
                                $jk = $user['jenis_kelamin'] ?? null;
                                echo ($jk == 'L') ? 'Laki-laki' : (($jk == 'P') ? 'Perempuan' : '-'); 
                            ?>" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="3" readonly><?php echo htmlspecialchars($user['alamat'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="alert alert-light border">
                            <small class="text-muted">Hubungi admin sekolah untuk memperbarui data informasi identitas lainnya.</small>
                        </div>

                    </div>
                </div>

                <!-- Children Info -->
                <div class="col-lg-7">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold border-bottom pb-2">Informasi Anak</h5>
                        <div id="childrenList">
                        
                        <?php if (count($anak_list) > 0): ?>
                            <?php foreach($anak_list as $anak): ?>
                                <div class="child-card">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Nama Anak</div>
                                            <div class="info-value"><?php echo htmlspecialchars($anak['nama_anak']); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Jenis Kelamin</div>
                                            <div class="info-value">
                                                <?php echo ($anak['jenis_kelamin'] == 'L') ? 'Laki-laki' : ($anak['jenis_kelamin'] == 'P' ? 'Perempuan' : '-'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Paket Belajar</div>
                                            <div class="info-value text-primary"><?php echo htmlspecialchars($anak['nama_paket'] ?? 'Belum ada paket'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Tahun Masuk</div>
                                            <div class="info-value"><?php echo htmlspecialchars($anak['tahun_masuk'] ?? '-'); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Tanggal Lahir</div>
                                            <div class="info-value"><?php echo date('d M Y', strtotime($anak['tanggal_lahir'])); ?></div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="info-label">Umur</div>
                                            <div class="info-value"><?php echo htmlspecialchars($anak['umur_tahun']); ?> Tahun</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
<?php else: ?>
                            <div class="alert alert-info">Belum ada data anak yang terdaftar. Hubungi admin untuk menambahkan.</div>
                        <?php endif; ?>
                    </div>
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
            });
        
            // Trigger click on file input when clicking the profile picture
            $('#profilePicPreview').click(function() {
                $('#fotoInput').click();
            });

            // Live Search for Children Cards
            $('#profileSearchInput').on('input', function() {
                var value = $(this).val().toLowerCase();
                $('#childrenList .child-card').each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>
</html>
