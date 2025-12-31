<?php
// Konfigurasi SMTP
// Silakan isi detail akun email pengirim di sini

return [
    'smtp_host' => 'smtp.gmail.com',      // Host SMTP (contoh: smtp.gmail.com)
    'smtp_port' => 587,                   // Port SMTP (587 untuk TLS, 465 untuk SSL)
    'smtp_user' => 'your_email@gmail.com', // Email pengirim
    'smtp_pass' => 'your_app_password',    // Password aplikasi (App Password jika pakai 2FA Gmail)
    'from_email' => 'no-reply@setarakids.com', // Email yang muncul di 'From'
    'from_name' => 'Setara Kids System'    // Nama yang muncul di 'From'
];
?>
