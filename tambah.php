<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$judul = "Tambah Kontak";
$aksi = "tambah.php";

$nama = "";
$alamat = "";
$jenisKelamin = "L";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    periksaToken();

    $nama = inputTeks("nama");
    $alamat = inputTeks("alamat");
    $jenisKelamin = inputTeks("jenis_kelamin");

    $error = validasiKontak($nama, $jenisKelamin);

    if ($error === "") {
        try {
            $stmt = $koneksi->prepare(
                "INSERT INTO kontak
                    (nama, alamat, jenis_kelamin, create_on)
                 VALUES (?, ?, ?, NOW())"
            );

            $stmt->bind_param("sss", $nama, $alamat, $jenisKelamin);
            $stmt->execute();

            $_SESSION["pesan"] = [
                "tipe" => "success",
                "teks" => "Kontak berhasil ditambahkan."
            ];

            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $kesalahan) {
            error_log($kesalahan->getMessage());
            $error = "Penyimpanan gagal. Silakan coba kembali.";
        }
    }
}

require "form_kontak.php";
