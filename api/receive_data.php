<?php
include '../includes/koneksi_db.php'; // Pastikan path ke file benar

$suhu = isset($_GET['suhu']) ? $_GET['suhu'] : null;
$amonia = isset($_GET['amonia']) ? $_GET['amonia'] : null;
$tds = isset($_GET['tds']) ? $_GET['tds'] : null;
$ph = isset($_GET['ph']) ? $_GET['ph'] : null;


//mengembalikan kode ke 1 jika database dikoosongkan
mysqli_query($conn, "ALTER TABLE riwayat_monitoring AUTO_INCREMENT=1"); 

//menyimpan data ke database
$sql = "INSERT INTO riwayat_monitoring (suhu, amonia, tds, ph) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("dddd", $suhu, $amonia, $tds, $ph);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Data berhasil disimpan";
    } else {
        echo "Tidak ada data yang disimpan";
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
$conn->close();
