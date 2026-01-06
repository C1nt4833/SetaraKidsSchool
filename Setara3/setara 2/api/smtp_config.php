<?php
// Konfigurasi SMTP
// Silakan isi detail akun email pengirim di sini

return [
    'smtp_host' => 'mail.setarakidsschool.sch.id',      // Host SMTP (contoh: smtp.gmail.com)
    'smtp_port' => 465,                   // Port SMTP (587 untuk TLS, 465 untuk SSL)
    'smtp_user' => 'no-reply@setarakidsschool.com', // Email pengirim
    'smtp_pass' => 'setara0099_',    // Password aplikasi (App Password jika pakai 2FA Gmail)
    'from_email' => 'no-reply@setarakidsschool.com', // Email yang muncul di 'From'
    'from_name' => 'Setara Kids School'    // Nama yang muncul di 'From'
];
?>
