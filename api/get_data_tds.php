<?php
include '../includes/koneksi_db.php'; // Sesuaikan dengan path ke koneksi database Anda

$sql = "SELECT tds, waktu FROM riwayat_monitoring 
        WHERE waktu >= DATE_SUB(NOW(), INTERVAL 12 HOUR) 
        ORDER BY waktu";
$result = $conn->query($sql);

// Membuat array untuk menyimpan data TDS per jam
$tdsPerJam = array();

while ($row = $result->fetch_assoc()) {
    // Ekstrak jam dari kolom waktu
    $jam = date('H', strtotime($row['waktu'])); // Mengambil hanya jam

    // Menambahkan TDS ke dalam array sesuai jam
    if (!isset($tdsPerJam[$jam])) {
        $tdsPerJam[$jam] = array();
    }
    $tdsPerJam[$jam][] = $row['tds'];
}

// Menghitung rata-rata TDS per jam
$rataRataTdsPerJam = array();
foreach ($tdsPerJam as $jam => $tdsValues) {
    $rataRataTdsPerJam[] = array(
        'jam' => $jam,
        'rata_rata_tds' => array_sum($tdsValues) / count($tdsValues)
    );
}

// Menghasilkan respons JSON
if (empty($rataRataTdsPerJam)) {
    echo json_encode(array("error" => "No data found"));
} else {
    echo json_encode(array("rata_rata_per_jam" => $rataRataTdsPerJam));
}

$conn->close();
