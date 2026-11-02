<?php
// Aktifkan session untuk menyimpan pesan kesalahan dan data pengguna yang login.
session_start();


// Ambil input hanya jika berupa string untuk menolak kiriman berbentuk array.
$username = $_POST['username'];
$password = $_POST['password'];

include "koneksi.php";

// LIMIT 1 membatasi hasil pencarian menjadi satu akun.
$sql = "SELECT id_user, username, password, nama FROM `user` WHERE username = '".$username."' AND password = '".$password."'";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$koneksi->close();



if ($user){

session_regenerate_id(true);
// Simpan identitas pengguna untuk pemeriksaan akses dan tampilan dashboard.
$_SESSION['id_user'] = $user['id_user'];
$_SESSION['username'] = $user['username'];
$_SESSION['nama'] = $user['nama'];
header('Location: dashboard.php');
exit;

} else {
    $_SESSION['login_error'] = "Login salah";
    header('Location: index.php');
exit;
}

