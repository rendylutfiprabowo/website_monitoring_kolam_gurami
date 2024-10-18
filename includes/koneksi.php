<?php
$servername = 'localhost';
$dbname = 'monitoring';
$username = 'root';
$password = '';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connection successful!";
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// Selalu baik untuk menutup koneksi setelahnya
// $conn->close();

?>
