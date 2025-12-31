-- Menambahkan kolom ke tabel users
ALTER TABLE `users`
ADD COLUMN `jenis_kelamin` ENUM('L', 'P') DEFAULT NULL AFTER `nama_lengkap`,
ADD COLUMN `tanggal_lahir` DATE DEFAULT NULL AFTER `jenis_kelamin`,
ADD COLUMN `foto_profil` VARCHAR(255) DEFAULT 'default.png' AFTER `email`;

-- Menambahkan kolom ke tabel anak
ALTER TABLE `anak`
ADD COLUMN `tahun_masuk` YEAR DEFAULT NULL AFTER `paket_id`;
