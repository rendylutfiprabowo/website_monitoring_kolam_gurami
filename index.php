<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Default ke home jika tidak ada parameter
$content = 'pages/'.$page . '.php'; // Misalnya: 'home.php'
$title = ucfirst($page); // Untuk menampilkan judul

// Memeriksa apakah file konten ada
if (!file_exists($content)) {
    $content = '404.php'; // Halaman 404 jika file tidak ditemukan
    $title = '404 - Not Found';
}

include 'template.php'; // Memuat template utama
