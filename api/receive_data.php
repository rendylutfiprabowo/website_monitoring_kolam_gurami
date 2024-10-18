<?php
include_once '../includes/koneksi.php'; // Pastikan path ini benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $suhu = $_POST['suhu'] ?? null;
    $amonia = $_POST['amonia'] ?? null;
    $tds = $_POST['tds'] ?? null;
    $ph = $_POST['ph'] ?? null;

    if (isset($suhu, $amonia, $tds, $ph)) {
        $sql = "INSERT INTO riwayat_monitoring (suhu, amonia, tds, ph, waktu) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("dddd", $suhu, $amonia, $tds, $ph);
            if ($stmt->execute()) {
                echo "Data saved successfully";
            } else {
                echo "Error saving data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Data incomplete.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
