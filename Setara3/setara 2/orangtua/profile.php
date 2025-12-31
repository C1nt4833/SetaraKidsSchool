<?php
session_start();
require_once '../api/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'orangtua') {
    header("Location: ../login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';
$message_type = '';

// Handle Form Submission (Only Photo Upload)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Only process photo upload
    $foto_filename = null;
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === 0) {
        $target_dir = __DIR__ . "/../img/profil/";
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                $message = "Gagal membuat folder upload.";
                $message_type = "danger";
            }
        }
        
        if (empty($message)) {
            $file_ext = strtolower(pathinfo($_FILES['foto_profil']['name'], PATHINFO_EXTENSION));
        $valid_ext = ['jpg', 'jpeg', 'png'];
        
        if (in_array($file_ext, $valid_ext)) {
            $new_filename = "ortu_" . $user_id . "_" . time() . "." . $file_ext;
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_dir . $new_filename)) {
                $foto_filename = $new_filename;
            } else {
                $message = "Gagal memindahkan file foto. Cek permission folder.";
                $message_type = "danger";
            }
        } else {
            $message = "Format foto harus JPG atau PNG.";
            $message_type = "danger";
        }
    } // End if empty message
    } elseif (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] !== UPLOAD_ERR_OK) {
        // Handle specific upload errors
        switch ($_FILES['foto_profil']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "Ukuran file terlalu besar (melebihi upload_max_filesize).";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "Ukuran file terlalu besar (melebihi MAX_FILE_SIZE).";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "File hanya terupload sebagian.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "Tidak ada file yang dipilih.";
                break;
            default:
                $message = "Terjadi kesalahan upload: Code " . $_FILES['foto_profil']['error'];
                break;
        }
        $message_type = "danger";
    } else {
        $message = "Silakan pilih foto.";
        $message_type = "warning";
    }

    if ($foto_filename && empty($message)) {
        try {
            $sql = "UPDATE users SET foto_profil = ? WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$foto_filename, $user_id])) {
                $message = "Foto profil berhasil diperbarui.";
                $message_type = "success";
            } else {
                $message = "Gagal memperbarui foto profil.";
                $message_type = "danger";
            }
        } catch (PDOException $e) {
            $message = "Database Error: " . $e->getMessage();
            $message_type = "danger";
        }
    }
}

// Fetch User Data from DB
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $user['nama_lengkap'] ?: $user['username'];
$role_display = ucfirst($user['role']);

// Fetch Children Data
try {
    $sql_anak = "SELECT a.*, p.nama_paket, YEAR(CURRENT_DATE()) - YEAR(a.tanggal_lahir) AS umur_tahun 
                 FROM anak a 
                 LEFT JOIN paket_belajar p ON a.paket_id = p.paket_id 
                 WHERE a.orangtua_id = ?";
    $stmt_anak = $pdo->prepare($sql_anak);
    $stmt_anak->execute([$user_id]);
    $anak_list = $stmt_anak->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $anak_list = [];
}

// View
include 'profile_view.php';
?>
