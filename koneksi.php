<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "latihan";

// Kegagalan koneksi ditangani oleh halaman yang menggunakan file ini.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$koneksi = new mysqli($host, $user, $pass, $database);
$koneksi->set_charset('utf8mb4');
