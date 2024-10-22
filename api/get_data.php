<?php
include '../includes/koneksi_db.php'; // Sesuaikan dengan path ke koneksi database Anda

$sql = "SELECT suhu, amonia, tds, ph FROM riwayat_monitoring ORDER BY waktu DESC LIMIT 1"; // Mengambil data terakhir
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc(); // Mengambil data sebagai array
}

echo json_encode($data); // Mengirim data sebagai JSON
$conn->close();
