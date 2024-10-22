<?php
    $servername = "localhost";
    $username = "root"; // username default XAMPP
    $password = ""; // password default XAMPP
    $dbname = "monitoring"; // ganti dengan nama database Anda

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>