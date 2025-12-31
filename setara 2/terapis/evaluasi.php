<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'terapis' && $_SESSION['role'] !== 'guru')) {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Terapis';
$role_display = "Terapis";

// Database Connection
$DB_HOST = '127.0.0.1';
$DB_NAME = 'setara';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

$message = '';
$message_type = '';

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_hapus = $_GET['id'];
    try {
        $stmtDel = $pdo->prepare("DELETE FROM catatan_terapi WHERE id = ?");
        $stmtDel->execute([$id_hapus]);
        $message = "Catatan berhasil dihapus.";
        $message_type = "success";
    } catch (Exception $e) {
        $message = "Gagal menghapus: " . $e->getMessage();
        $message_type = "danger";
    }
}

// Handle Form Submission (Create & Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action_type = $_POST['action_type'] ?? 'create'; // 'create' or 'update'
    $record_id = $_POST['record_id'] ?? '';
    
    // INPUT ID ANAK LANGSUNG
    $anak_id_input = trim($_POST['anak_id'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';
    $catatan = $_POST['catatan'] ?? '';

    if ($anak_id_input && $tanggal && $catatan) {
        // Validasi apakah ID Anak ada di database
        $stmtCheck = $pdo->prepare("SELECT anak_id FROM anak WHERE anak_id = ? LIMIT 1");
        $stmtCheck->execute([$anak_id_input]);
        
        if ($stmtCheck->rowCount() > 0) {
            $anak_id = $anak_id_input;

            try {
                if ($action_type === 'update' && $record_id) {
                    // Update
                    $stmt = $pdo->prepare("UPDATE catatan_terapi SET anak_id = :anak_id, tanggal = :tanggal, isi_catatan = :catatan WHERE id = :id");
                    $stmt->execute([
                        'anak_id' => $anak_id,
                        'tanggal' => $tanggal,
                        'catatan' => $catatan,
                        'id' => $record_id
                    ]);
                    $message = "Evaluasi berhasil diperbarui!";
                } else {
                    // Create
                    // Hitung pertemuan ke berapa
                    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM catatan_terapi WHERE anak_id = ?");
                    $stmtCount->execute([$anak_id]);
                    $count = $stmtCount->fetchColumn();
                    $pertemuan_ke = $count + 1;
    
                    $stmt = $pdo->prepare("INSERT INTO catatan_terapi (anak_id, tanggal, isi_catatan, pertemuan_ke) VALUES (:anak_id, :tanggal, :catatan, :pertemuan_ke)");
                    $stmt->execute([
                        'anak_id' => $anak_id,
                        'tanggal' => $tanggal,
                        'catatan' => $catatan,
                        'pertemuan_ke' => $pertemuan_ke
                    ]);
                    $message = "Evaluasi berhasil disimpan!";
                }
                $message_type = "success";
            } catch (Exception $e) {
                $message = "Gagal menyimpan data: " . $e->getMessage();
                $message_type = "danger";
            }
        } else {
            $message = "ID Anak tidak ditemukan di database.";
            $message_type = "danger";
        }
    } else {
        $message = "Semua field harus diisi.";
        $message_type = "warning";
    }
}

// Ambil Riwayat Evaluasi
$stmtRiwayat = $pdo->query("SELECT c.*, a.nama_anak 
                            FROM catatan_terapi c 
                            JOIN anak a ON c.anak_id = a.anak_id 
                            ORDER BY c.created_at DESC LIMIT 50");
$riwayat_evaluasi = $stmtRiwayat->fetchAll(PDO::FETCH_ASSOC);

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Load View
include 'evaluasi_view.php';
?>
