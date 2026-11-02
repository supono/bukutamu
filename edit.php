<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$id = filter_var(
    $_GET["id"] ?? null,
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if ($id === false || $id === null) {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "ID kontak tidak valid."
    ];

    header("Location: index.php");
    exit;
}

try {
    $stmt = $koneksi->prepare(
        "SELECT nama, alamat, jenis_kelamin
         FROM kontak
         WHERE id_kontak = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $data = $stmt->get_result()->fetch_assoc();
} catch (mysqli_sql_exception $kesalahan) {
    error_log($kesalahan->getMessage());

    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "Data kontak belum dapat dimuat."
    ];

    header("Location: index.php");
    exit;
}

if (!$data) {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "Kontak yang dipilih tidak ditemukan."
    ];

    header("Location: index.php");
    exit;
}

$judul = "Edit Kontak";
$aksi = "edit.php?id=" . $id;

$nama = $data["nama"];
$alamat = $data["alamat"] ?? "";
$jenisKelamin = $data["jenis_kelamin"] ?? "";
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
                "UPDATE kontak
                 SET nama = ?, alamat = ?, jenis_kelamin = ?
                 WHERE id_kontak = ?"
            );

            $stmt->bind_param(
                "sssi",
                $nama,
                $alamat,
                $jenisKelamin,
                $id
            );

            $stmt->execute();

            $_SESSION["pesan"] = [
                "tipe" => "success",
                "teks" => "Data kontak berhasil disimpan."
            ];

            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $kesalahan) {
            error_log($kesalahan->getMessage());
            $error = "Perubahan gagal disimpan. Silakan coba kembali.";
        }
    }
}

require "form_kontak.php";
