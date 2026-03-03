<?php
// Konfigurasi SMTP
// Silakan isi detail akun email pengirim di sini

return [
    'smtp_host' => 'mail.setarakidsschool.sch.id',      // Host SMTP (contoh: smtp.gmail.com)
    'smtp_port' => 465,                   // Port SMTP (587 untuk TLS, 465 untuk SSL)
    'smtp_user' => 'no-reply@setarakidsschool.sch.id', // Email pengirim
    'smtp_pass' => 'setara0099_',    // Password aplikasi (App Password jika pakai 2FA Gmail)
    'from_email' => 'no-reply@setarakidsschool.sch.id', // Email yang muncul di 'From'
    'from_name' => 'Setara Kids School',    // Nama yang muncul di 'From'

    // Aktifkan debug sementara untuk melihat log SMTP di error_log (set false di produksi)
    'smtp_debug' => true
];
?>
