<?php 
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $buku = $_POST['buku'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $status = $_POST['status'];

    $sql = "INSERT INTO peminjaman (user, buku, tanggal_peminjaman, status_peminjaman) VALUES ('$nama', '$buku', '$tanggal_peminjaman', '$status')";

    if (mysqli_query($koneksi, $sql)) {
        header("location:../admin/index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
?>