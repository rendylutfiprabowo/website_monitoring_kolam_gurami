<?php

// Konfigurasi database
$host = 'localhost';
$dbname = 'monitoring';
$username = 'root';
$password = '';

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query SQL untuk migrasi (membuat tabel)
    $query = "CREATE TABLE IF NOT EXISTS riwayat_monitoring (
        kode INT(11) AUTO_INCREMENT PRIMARY KEY,
        suhu DECIMAL(10,2) NOT NULL,
        amonia DECIMAL(10,2) NOT NULL,
        tds DECIMAL(10,2) NOT NULL,
        ph DECIMAL(10,2) NOT NULL,
        waktu DATETIME DEFAULT CURRENT_TIMESTAMP
    )";

    // Eksekusi query
    $pdo->exec($query);
    echo "Tabel riwayat_monitoring berhasil dibuat.\n";

} catch (PDOException $e) {
    echo "Gagal membuat tabel: " . $e->getMessage();
}

?>