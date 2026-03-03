<?php
header('Content-Type: application/json');
include 'db_connect.php';

// Fetch approved testimonials from the correct table
$sql = "SELECT nama as name, rating, caption as message FROM testimoni WHERE status = 'approved' ORDER BY created_at DESC";
$result = $conn->query($sql);

$testimonials = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $testimonials[] = $row;
    }
}

echo json_encode($testimonials);

$conn->close();
?>
