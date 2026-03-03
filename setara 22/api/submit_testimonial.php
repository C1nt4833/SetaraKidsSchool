<?php
header('Content-Type: application/json');
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $nama = isset($input['name']) ? $conn->real_escape_string($input['name']) : '';
    $rating = isset($input['rating']) ? intval($input['rating']) : 0;
    $caption = isset($input['message']) ? $conn->real_escape_string($input['message']) : '';

    if (empty($nama) || empty($caption) || $rating < 1 || $rating > 5) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Lengkapi data yang belum terisi!']);
        exit;
    }

    $sql = "INSERT INTO testimoni (nama, rating, caption, status) VALUES ('$nama', '$rating', '$caption', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Testimoni Anda berhasil dikirim dan akan muncul setelah disetujui admin.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $conn->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan']);
}

$conn->close();
?>
