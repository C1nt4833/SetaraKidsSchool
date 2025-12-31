<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Evaluasi Anak - Terapis Dashboard</title>
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
            <a href="evaluasi.php" class="nav-link-custom active">
                <i class="fa fa-file-alt"></i> Evaluasi
            </a>
            <a href="absen.php" class="nav-link-custom">
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
            <h3 class="mb-4 text-dark fw-bold">Evaluasi Anak</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Evaluasi</li>
                </ol>
            </nav>

            <div class="row">
                <!-- FORM INPUT (ATAS) -->
                <div class="col-12">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold text-primary" id="form-title">Input Evaluasi Baru</h5>
                        
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST" id="evalForm">
                            <input type="hidden" name="action_type" id="action_type" value="create">
                            <input type="hidden" name="record_id" id="record_id" value="">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="anak_id" class="form-label">ID Anak</label>
                                    <input type="text" class="form-control" id="anak_id" name="anak_id" placeholder="Masukkan ID Anak" required autocomplete="off">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan Evaluasi</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="5" placeholder="Tuliskan perkembangan anak..." required></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" id="btn-submit">Simpan Evaluasi</button>
                                <button type="button" class="btn btn-light px-4 py-2 border" id="btn-cancel" style="display: none;" onclick="resetForm()">Batal Edit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- RIWAYAT LIST (BAWAH) -->
                <div class="col-12">
                    <div class="card-custom">
                        <h5 class="mb-4 fw-bold text-dark">Riwayat Evaluasi</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Anak ID</th>
                                        <th style="width: 20%;">Nama Anak</th>
                                        <th style="width: 15%;">Tanggal</th>
                                        <th>Catatan</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($riwayat_evaluasi) > 0): ?>
                                        <?php foreach($riwayat_evaluasi as $row): ?>
                                        <tr>
                                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($row['anak_id']); ?></span></td>
                                            <td class="fw-bold"><?php echo htmlspecialchars($row['nama_anak']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                            <td><?php echo nl2br(htmlspecialchars($row['isi_catatan'])); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-warning btn-action" 
                                                    onclick='editItem(<?php echo json_encode($row); ?>)'>
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <a href="evaluasi.php?action=delete&id=<?php echo $row['id']; ?>" 
                                                   class="btn btn-sm btn-outline-danger btn-action" 
                                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4">Belum ada data evaluasi.</td>
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
        function editItem(data) {
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Populate form
            document.getElementById('form-title').innerText = 'Edit Evaluasi';
            document.getElementById('action_type').value = 'update';
            document.getElementById('record_id').value = data.id;
            
            // Fill ID
            document.getElementById('anak_id').value = data.anak_id;
            document.getElementById('tanggal').value = data.tanggal;
            document.getElementById('catatan').value = data.isi_catatan;
            
            document.getElementById('btn-submit').innerText = 'Update Evaluasi';
            document.getElementById('btn-cancel').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('evalForm').reset();
            document.getElementById('form-title').innerText = 'Input Evaluasi Baru';
            document.getElementById('action_type').value = 'create';
            document.getElementById('record_id').value = '';
            
            document.getElementById('btn-submit').innerText = 'Simpan Evaluasi';
            document.getElementById('btn-cancel').style.display = 'none';
        }
    </script>
</body>
</html>
