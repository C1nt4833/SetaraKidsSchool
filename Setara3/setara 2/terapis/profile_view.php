<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Profil Saya - Terapis Dashboard</title>
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
        .topbar { background: var(--primary) !important; height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; color: white; }
        .content-padding { padding: 30px; }
        .card-custom { background: #fff; border-radius: 15px; border: none; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.03); margin-bottom: 30px; }
        .profile-pic-preview { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .form-control:disabled, .form-control[readonly] { background-color: #e9ecef; opacity: 1; }
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
                <?php if (!empty($user['foto_profil']) && $user['foto_profil'] != 'default.png'): ?>
                    <img src="../img/profil/<?php echo htmlspecialchars($user['foto_profil']); ?>" alt="User">
                <?php else: ?>
                    <i class="fa fa-user"></i>
                <?php endif; ?>
             </div>
             <h6 class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($username); ?></h6>
             <small class="text-muted"><?php echo htmlspecialchars($role_display); ?></small>
             <div class="mt-2">
                 <a href="profile.php" class="badge bg-light text-primary border border-primary text-decoration-none">Lihat Profil</a>
             </div>
        </div>

        <nav class="nav flex-column mt-2">
            <a href="dashboard.php" class="nav-link-custom"> <i class="fa fa-tachometer-alt"></i> Dashboard </a>
            <a href="evaluasi.php" class="nav-link-custom"> <i class="fa fa-file-alt"></i> Evaluasi </a>
            <a href="absen.php" class="nav-link-custom"> <i class="fa fa-user-check"></i> Absen </a>
            <a href="daftar_anak.php" class="nav-link-custom"> <i class="fa fa-child"></i> Daftar Anak </a>
            <a href="../login.html" class="nav-link-custom mt-4 text-danger"> <i class="fa fa-sign-out-alt"></i> Logout </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar"> 
            <div class="d-flex align-items-center"> <h5 class="mb-0 fw-bold text-white">Labirin Children Center</h5> </div>
        </div>

        <div class="content-padding">
            <h3 class="mb-4 text-dark fw-bold">Profil Guru/Terapis</h3>
            
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card-custom">
                        <?php 
                        $foto = !empty($user['foto_profil']) && $user['foto_profil'] != 'default.png' 
                            ? "../img/profil/" . $user['foto_profil'] 
                            : "https://via.placeholder.com/150?text=No+Image";
                        ?>
                        <img src="<?php echo $foto; ?>" alt="Profil" class="profile-pic-preview">
                        <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($user['nama_lengkap']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                        
                        <!-- Form Upload Foto -->
                        <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                            <div class="mb-2">
                                <label class="form-label small text-muted">Ganti Foto Profil</label>
                                <input type="file" class="form-control form-control-sm" name="foto_profil" accept="image/png, image/jpeg" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Upload Foto Baru</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold">Informasi Profil</h5>
                        
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Read Only Fields -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" readonly>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="<?php echo ($user['jenis_kelamin'] == 'L') ? 'Laki-laki' : ($user['jenis_kelamin'] == 'P' ? 'Perempuan' : '-'); ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" value="<?php echo $user['tanggal_lahir'] ? date('d M Y', strtotime($user['tanggal_lahir'])) : '-'; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="alert alert-light border mt-3">
                            <i class="fa fa-info-circle me-2 text-primary"></i> 
                            Data profil (Nama, Tanggal Lahir, dll) hanya dapat diubah oleh Administrator. 
                            Hubungi admin jika terdapat kesalahan data.
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
