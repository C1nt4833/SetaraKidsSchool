<?php
include 'db_connect.php';

// Create testimonials table
$sql = "CREATE TABLE IF NOT EXISTS testimonials (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    rating INT(1) NOT NULL,
    message TEXT NOT NULL,
    photo_url VARCHAR(255) DEFAULT NULL,
    is_approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table testimonials created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
