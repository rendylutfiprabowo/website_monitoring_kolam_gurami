<?php
include '../includes/koneksi_db.php'; // Sesuaikan dengan path ke koneksi database Anda

$sql = "SELECT amonia, waktu FROM riwayat_monitoring 
        WHERE waktu >= DATE_SUB(NOW(), INTERVAL 12 HOUR) 
        ORDER BY waktu";
$result = $conn->query($sql);

// Membuat array untuk menyimpan data amonia per jam
$amoniaPerJam = array();

while ($row = $result->fetch_assoc()) {
    // Ekstrak jam dari kolom waktu
    $jam = date('H', strtotime($row['waktu'])); // Mengambil hanya jam

    // Menambahkan amonia ke dalam array sesuai jam
    if (!isset($amoniaPerJam[$jam])) {
        $amoniaPerJam[$jam] = array();
    }
    $amoniaPerJam[$jam][] = $row['amonia'];
}

// Menghitung rata-rata amonia per jam
$rataRataAmoniaPerJam = array();
foreach ($amoniaPerJam as $jam => $amonias) {
    $rataRataAmoniaPerJam[] = array(
        'jam' => $jam,
        'rata_rata_amonia' => array_sum($amonias) / count($amonias)
    );
}

// Menghasilkan respons JSON
if (empty($rataRataAmoniaPerJam)) {
    echo json_encode(array("error" => "No data found"));
} else {
    echo json_encode(array("rata_rata_per_jam" => $rataRataAmoniaPerJam));
}

$conn->close();

