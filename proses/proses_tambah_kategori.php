<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include '../koneksi.php';

    $kategori = $_POST['nama_kategori'];

    $query = "INSERT INTO kategori_buku (nama_kategori) VALUES ('$kategori')";
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
    $koneksi->close();
} else {
    echo "ID tidak valid.";
}

header("location: ../admin/kategori.php");
exit();
?>