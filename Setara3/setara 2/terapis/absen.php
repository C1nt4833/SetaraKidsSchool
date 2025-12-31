<?php
session_start();

// Cek session dan role
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'terapis' && $_SESSION['role'] !== 'guru')) {
    header("Location: ../login.html");
    exit;
}

$username = $_SESSION['username'] ?? 'Terapis';
$role_display = "Terapis";
$terapis_id = $_SESSION['user_id']; // ID Terapis yang login

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
        $stmtDel = $pdo->prepare("DELETE FROM absensi WHERE absensi_id = ?");
        $stmtDel->execute([$id_hapus]);
        $message = "Data absensi berhasil dihapus.";
        $message_type = "success";
    } catch (Exception $e) {
        $message = "Gagal menghapus: " . $e->getMessage();
        $message_type = "danger";
    }
}

// Handle Form Submission (Create & Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action_type = $_POST['action_type'] ?? 'create';
    $record_id = $_POST['record_id'] ?? '';
    
    $anak_id_input = trim($_POST['anak_id'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';
    $status = $_POST['status'] ?? '';
    $catatan = $_POST['catatan'] ?? '';

    if ($anak_id_input && $tanggal && $status) {
        // Cek Validitas ID Anak
        $stmtCheck = $pdo->prepare("SELECT anak_id FROM anak WHERE anak_id = ? LIMIT 1");
        $stmtCheck->execute([$anak_id_input]);

        if ($stmtCheck->rowCount() > 0) {
            $anak_id = $anak_id_input;

            try {
                if ($action_type === 'update' && $record_id) {
                    // Update
                    $stmt = $pdo->prepare("UPDATE absensi SET anak_id = :anak_id, tanggal = :tanggal, status = :status, catatan = :catatan WHERE absensi_id = :id");
                    $stmt->execute([
                        'anak_id' => $anak_id,
                        'tanggal' => $tanggal,
                        'status' => $status,
                        'catatan' => $catatan,
                        'id' => $record_id
                    ]);
                    $message = "Absensi berhasil diperbarui!";
                } else {
                    // Create
                    $stmt = $pdo->prepare("INSERT INTO absensi (anak_id, terapis_id, tanggal, status, catatan) VALUES (:anak_id, :terapis_id, :tanggal, :status, :catatan)");
                    $stmt->execute([
                        'anak_id' => $anak_id,
                        'terapis_id' => $terapis_id,
                        'tanggal' => $tanggal,
                        'status' => $status,
                        'catatan' => $catatan
                    ]);
                    $message = "Absensi berhasil disimpan!";
                }
                $message_type = "success";
            } catch (Exception $e) {
                $message = "Gagal menyimpan data: " . $e->getMessage();
                $message_type = "danger";
            }
        } else {
            $message = "ID Anak tidak ditemukan.";
            $message_type = "danger";
        }
    } else {
        $message = "ID Anak, Tanggal, dan Status wajib diisi.";
        $message_type = "warning";
    }
}

// Ambil Riwayat Absensi (JOIN dengan tabel anak untuk dapat nama)
// Menampilkan semua history atau dibatasi per terapis? Biasanya guru ingin melihat yang dia input.
// Tapi bisa jadi guru ingin lihat riwayat umum. Kita filter yang diinput terapis ini atau global?
// Untuk keamanan data antar terapis, mungkin filter by terapis_id, atau global jika sistemnya terbuka.
// Kita buat global saja dulu agar terlihat semua history anak, atau filter by anak jika fitur search ada.
// Default: Tampilkan 50 input terakhir.
$stmtRiwayat = $pdo->query("SELECT ab.*, a.nama_anak 
                            FROM absensi ab 
                            JOIN anak a ON ab.anak_id = a.anak_id 
                            ORDER BY ab.tanggal DESC, ab.absensi_id DESC LIMIT 50");
$riwayat_absen = $stmtRiwayat->fetchAll(PDO::FETCH_ASSOC);

// Fetch fresh user data (photo, full name)
require_once '../api/get_current_user.php';
if (isset($currentUser)) {
    $username = $display_name;
}

// Load View
include 'absen_view.php';
?>
