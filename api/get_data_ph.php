<?php
include '../includes/koneksi_db.php'; // Sesuaikan dengan path ke koneksi database Anda

$sql = "SELECT ph, waktu FROM riwayat_monitoring 
        WHERE waktu >= DATE_SUB(NOW(), INTERVAL 12 HOUR) 
        ORDER BY waktu";
$result = $conn->query($sql);

// Membuat array untuk menyimpan data pH per jam
$phPerJam = array();

while ($row = $result->fetch_assoc()) {
    // Ekstrak jam dari kolom waktu
    $jam = date('H', strtotime($row['waktu'])); // Mengambil hanya jam

    // Menambahkan pH ke dalam array sesuai jam
    if (!isset($phPerJam[$jam])) {
        $phPerJam[$jam] = array();
    }
    $phPerJam[$jam][] = $row['ph'];
}

// Menghitung rata-rata pH per jam
$rataRataPhPerJam = array();
foreach ($phPerJam as $jam => $phValues) {
    $rataRataPhPerJam[] = array(
        'jam' => $jam,
        'rata_rata_ph' => array_sum($phValues) / count($phValues)
    );
}

// Menghasilkan respons JSON
if (empty($rataRataPhPerJam)) {
    echo json_encode(array("error" => "No data found"));
} else {
    echo json_encode(array("rata_rata_per_jam" => $rataRataPhPerJam));
}

$conn->close();
