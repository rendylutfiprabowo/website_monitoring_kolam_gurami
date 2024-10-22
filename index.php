<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Default ke home jika tidak ada parameter
$activePage = $page; // Menentukan halaman aktif
$content = 'pages/'.$page . '.php'; // Menyusun path untuk file konten

// Memeriksa apakah file konten ada
if (!file_exists($content)) {
    $content = '404.php'; // Halaman 404 jika file tidak ditemukan
    $title = '404 - Not Found';
} else {
    $title = ucfirst($page); // Mengambil judul halaman
}

include 'template.php'; // Memuat template utama
