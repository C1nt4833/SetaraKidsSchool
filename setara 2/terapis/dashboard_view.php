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
            color: var(--primary); /* Mengambil warna dari style.css (biasanya oranye) */
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
            background-color: #ffe5d9; /* Light orange matches theme */
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
            background-color: #fef0ec; /* Very light orange */
            color: var(--primary);
            border-left-color: var(--primary);
        }
        .nav-link-custom i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        .topbar {
            background: var(--primary) !important; /* Warna kuning/oranye sesuai index.html */
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            color: white;
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
            background: rgba(255,255,255,0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .icon-btn:hover {
            background: rgba(255,255,255,0.4);
        }
        .content-padding {
            padding: 30px;
        }
        .card-welcome {
            background: #fff;
            border-radius: 15px;
            border: none;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
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
        <!-- Topbar -->
        <div class="topbar"> 
            <div class="d-flex align-items-center">
                 <h5 class="mb-0 fw-bold text-white">Labirin Children Center</h5>
            </div>
            <div class="d-flex align-items-center">
                <form class="search-form d-none d-md-block me-3">
                    <input type="text" class="form-control" placeholder="Type for search...">
                </form>
                <div class="icon-btn">
                    <i class="fa fa-bell"></i>
                </div>
                <a href="profile.php" class="icon-btn text-decoration-none">
                     <i class="fa fa-user"></i>
                </a>
            </div>
        </div>

        <div class="content-padding">
            <h3 class="mb-4 text-dark fw-bold">Dashboard</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="#" class="text-primary"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-muted"><?php echo $role_display; ?></a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-12">
                    <div class="card-welcome">
                        <h2 class="mb-3 text-dark">Selamat Datang</h2>
                        <p class="text-secondary mb-0">Pantau perkembangan belajar dan kehadiran anak secara real-time.</p>
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
