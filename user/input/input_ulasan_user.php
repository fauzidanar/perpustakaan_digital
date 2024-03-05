<?php
include '../../koneksi.php';
$sql = "SELECT * FROM user";
$result = mysqli_query($koneksi, $sql);

$sql1 = "SELECT * FROM buku";
$result1 = mysqli_query($koneksi, $sql1);
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 60%;
            margin: auto;
            margin-top: 50px;
            

        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<form action="../proses/proses_ulasan_user.php" method="post">
<?php 
            if ($result) {
                echo "<label for='nama'>Nama Lengkap :</label>";
                echo "<select class='form-control' name='nama' required>";
                echo "<option value=''></option>";

                while ($rew = mysqli_fetch_assoc($result)) {
                    $nama_lengkap = $rew['nama_lengkap'];
                    $id_user = $rew['id'];
                    echo "<option value='$id_user'>$nama_lengkap</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";

                }
        ?>
   <?php
            if ($result1) {
                echo "<label for='buku'>judul :</label>";
                echo "<select class='form-control' name='buku' required>";
                echo "<option value=''></option>";

                while ($rew = mysqli_fetch_assoc($result1)) {
                    $nama_buku = $rew['judul'];
                    $id_buku = $rew['id'];
                    echo "<option value='$id_buku'>$nama_buku</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
    <label for="rating">Rating:</label><br>
    <input type="number" id="rating" name="rating" min="1" max="10" required><br>
    <input type="text" name="ulasan">
    <input type="submit" value="Submit">
</form>
