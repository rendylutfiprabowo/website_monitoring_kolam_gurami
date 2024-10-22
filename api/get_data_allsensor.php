<?php
include '../includes/koneksi_db.php';

$sql = "SELECT tds, ph, amonia, suhu, waktu FROM riwayat_monitoring 
        WHERE waktu >= DATE_SUB(NOW(), INTERVAL 12 HOUR) 
        ORDER BY waktu";
$result = $conn->query($sql);

$dataPerJam = array();

while ($row = $result->fetch_assoc()) {
    $jam = date('H', strtotime($row['waktu']));
    if (!isset($dataPerJam[$jam])) {
        $dataPerJam[$jam] = ['tds' => [], 'ph' => [], 'amonia' => [], 'suhu' => []];
    }
    $dataPerJam[$jam]['tds'][] = $row['tds'];
    $dataPerJam[$jam]['ph'][] = $row['ph'];
    $dataPerJam[$jam]['amonia'][] = $row['amonia'];
    $dataPerJam[$jam]['suhu'][] = $row['suhu'];
}

$rataRataPerJam = array();
foreach ($dataPerJam as $jam => $values) {
    $rataRataPerJam[] = array(
        'jam' => $jam,
        'rata_rata_tds' => array_sum($values['tds']) / count($values['tds']),
        'rata_rata_ph' => array_sum($values['ph']) / count($values['ph']),
        'rata_rata_amonia' => array_sum($values['amonia']) / count($values['amonia']),
        'rata_rata_suhu' => array_sum($values['suhu']) / count($values['suhu'])
    );
}

echo json_encode(array("rata_rata_per_jam" => $rataRataPerJam));

$conn->close();
?>
