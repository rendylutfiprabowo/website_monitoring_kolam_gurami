<?php
include_once '../includes/koneksi.php'; // Pastikan path ini benar

header('Content-Type: application/json'); // Set header untuk output JSON

$sql = "SELECT suhu, amonia, tds, ph FROM riwayat_monitoring ORDER BY waktu DESC LIMIT 1";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['message' => 'No data found']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'Error preparing statement: ' . $conn->error]);
}

$conn->close();
?>
