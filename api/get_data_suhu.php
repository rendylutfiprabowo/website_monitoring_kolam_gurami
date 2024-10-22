<?php
include '../includes/koneksi_db.php'; // Sesuaikan dengan path ke koneksi database Anda 

$sql = "SELECT suhu, waktu FROM riwayat_monitoring 
        WHERE waktu >= DATE_SUB(NOW(), INTERVAL 12   HOUR) 
        ORDER BY waktu";
$result = $conn->query($sql);

// Membuat array untuk menyimpan data suhu per jam
$suhuPerJam = array();

while ($row = $result->fetch_assoc()) {
    // Ekstrak jam dari kolom waktu
    $jam = date('H', strtotime($row['waktu'])); // Mengambil hanya jam

    // Menambahkan suhu ke dalam array sesuai jam
    if (!isset($suhuPerJam[$jam])) {
        $suhuPerJam[$jam] = array();
    }
    $suhuPerJam[$jam][] = $row['suhu'];
}

// Menghitung rata-rata suhu per jam
$rataRataSuhuPerJam = array();
foreach ($suhuPerJam as $jam => $suhus) {
    $rataRataSuhuPerJam[] = array(
        'jam' => $jam,
        'rata_rata_suhu' => array_sum($suhus) / count($suhus)
    );
}

// Menghasilkan respons JSON
if (empty($rataRataSuhuPerJam)) {
    echo json_encode(array("error" => "No data found"));
} else {
    echo json_encode(array("rata_rata_per_jam" => $rataRataSuhuPerJam));
}

$conn->close();
