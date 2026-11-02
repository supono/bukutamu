<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "Gunakan tombol Hapus pada daftar kontak."
    ];

    header("Location: index.php");
    exit;
}

periksaToken();

$id = filter_var(
    $_POST["id"] ?? null,
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if ($id === false || $id === null) {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "ID kontak tidak valid."
    ];
} else {
    try {
        $stmt = $koneksi->prepare(
            "DELETE FROM kontak WHERE id_kontak = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $_SESSION["pesan"] = [
            "tipe" => $stmt->affected_rows > 0 ? "success" : "danger",
            "teks" => $stmt->affected_rows > 0
                ? "Kontak berhasil dihapus."
                : "Kontak tidak ditemukan atau sudah dihapus."
        ];
    } catch (mysqli_sql_exception $kesalahan) {
        error_log($kesalahan->getMessage());

        $_SESSION["pesan"] = [
            "tipe" => "danger",
            "teks" => "Kontak gagal dihapus. Silakan coba kembali."
        ];
    }
}

header("Location: index.php");
exit;
