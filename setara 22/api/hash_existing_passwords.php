<?php
// Script to hash existing plain text passwords in the database
require_once __DIR__ . '/db.php';

try {
    // Get all users with plain text passwords (not starting with $)
    $stmt = $pdo->prepare('SELECT user_id, password FROM users WHERE password NOT LIKE "$%"');
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $hashed = password_hash($user['password'], PASSWORD_DEFAULT);
        $upd = $pdo->prepare('UPDATE users SET password = :pw WHERE user_id = :id');
        $upd->execute(['pw' => $hashed, 'id' => $user['user_id']]);
        echo "Hashed password for user_id {$user['user_id']}\n";
    }

    echo "All plain text passwords have been hashed.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
