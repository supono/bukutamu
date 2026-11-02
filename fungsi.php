<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function periksaLogin() {
    if (!isset($_SESSION['id_user'])) {
        $_SESSION['login_error'] = 'Silakan login terlebih dahulu atuh lah..';
        header('Location: index.php');
        exit;
    }
}

function aman($teks) {
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES | ENT_SUBSTITUTE,
        "UTF-8"
    );
}

// Membuat token pelindung formulir
if (!isset($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(32));
}

function periksaToken() {
    $token = $_POST["csrf"] ?? "";

    if (
        !is_string($token) ||
        !hash_equals($_SESSION["csrf"], $token)
    ) {
        $_SESSION["pesan"] = [
            "tipe" => "danger",
            "teks" => "Formulir sudah tidak valid. Silakan buka kembali dan coba lagi."
        ];

        header("Location: index.php");
        exit;
    }
}

// Membaca input teks dari formulir
function inputTeks($namaKolom) {
    $nilai = $_POST[$namaKolom] ?? "";

    if (!is_string($nilai)) {
        exit("Format input tidak valid.");
    }

    return trim($nilai);
}

function validasiKontak($nama, $jenisKelamin) {
    if ($nama === "") {
        return "Nama wajib diisi.";
    }

    if (mb_strlen($nama, "UTF-8") > 150) {
        return "Nama maksimal 150 karakter.";
    }

    if (!in_array($jenisKelamin, ["L", "P"], true)) {
        return "Jenis kelamin tidak valid.";
    }

    return "";
}
