<?php 
include '../koneksi.php';

session_start();

if(!$_SESSION["id"]){
  header("Location:../login.php");
}

$sql = "SELECT * FROM perpustakaan";
$result = mysqli_query($koneksi, $sql);

$sql1 = "SELECT * FROM user WHERE role='peminjam'";
$result1= mysqli_query($koneksi, $sql1);

$sql2 = "SELECT * FROM buku";
$result2 = mysqli_query($koneksi, $sql2);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perminjaman</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Hi Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        </div>
      </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php" class="nav-link">
                <li class="nav-item menu-open">
                <i class=" nav-icon fa-solid fa-house"></i>                  
                <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./pengguna.php" class="nav-link">
                <i class="nav-icon fa-solid fa-users"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./peminjam.php" class="nav-link">
                <i class="nav-icon fa-solid fa-people-carry-box"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./buku.php" class="nav-link">
                <i class="nav-icon fa-solid fa-book"></i>
                  <p>Buku</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./kategori.php" class="nav-link">
                <i class="nav-icon fa-sharp fa-solid fa-layer-group"></i>
                  <p>Kategori</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./ulasan.php" class="nav-link">
                <i class="nav-icon fa-solid fa-pen"></i>
                  <p>Ulasan</p>
                </a>
              </li>
            </ul>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <div class="content-wrapper" style="margin-top:-1px; background-color: #eeee; color:#161A30;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
   <section class="content mt-5">
    <div class="content-wraper shadow p-3 mb-5 bg-body-tertiary" style="width:50%;margin-left:25%;padding:10px;background:#fff;border-radius:7px;">
  <div class="container-fluid">
    <h2 style="color:#161A30; text-align:center;">Peminjaman</h2>
    <form action="../proses/proses_input_peminjaman.php" method="post">
      <?php
            if ($result) {
                echo "<label for='perpustakaan'>Perpustakaan :</label>";
                echo "<select class='form-control' name='perpustakaan' required>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $nama_perpustakaan = $row['nama_perpus'];
                    $id_perpus = $row['id'];
                    echo "<option value='$id_perpus'>$nama_perpustakaan</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
        <?php
            if ($result1) {
                echo "<label for='nama'>Nama :</label>";
                echo "<select class='form-control' name='nama' required>";
                echo "<option value=''></option>";

                while ($riw = mysqli_fetch_assoc($result1)) {
                    $nama_lengkap = $riw['nama_lengkap'];
                    $id_nama = $riw['id'];
                    echo "<option value='$id_nama'>$nama_lengkap</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
        <?php
            if ($result2) {
                echo "<label for='buku'>Buku :</label>";
                echo "<select class='form-control' name='buku' required>";
                echo "<option value=''></option>";

                while ($rew = mysqli_fetch_assoc($result2)) {
                    $nama_buku = $rew['judul'];
                    $id_buku = $rew['id'];
                    echo "<option value='$id_buku'>$nama_buku</option>";
                    }

                    echo "</select>";
                } else {
                    echo "Gagal mengambil data";
                }
        ?>
        <div class="form-grup">
            <label for="tanggal_peminjaman">Tanggal peminjaman :</label>
            <input type="date" name="tanggal_peminjaman" class="form-control">
        </div>
        <div class="form-grup">
            <label for="status">Status :</label>
            <select name="status" class="form-control">
                <option value="Dipinjam">Dipinjam</option>
                <option value="Dipinjam">Dikembalikan</option>
            </select>
        </div>
        <div class="form-grup" style="margin-left: 40%;">
        <button type="submit" name="registrasi" class="btn btn-info mt-4" style="width:100px">Pinjam</button>
        </div>
    </form>
  </div>
  </div>
   </section>
  </div>
</div>
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dashboard/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../dashboard/plugins/raphael/raphael.min.js"></script>
<script src="../dashboard/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../dashboard/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../dashboard/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dashboard/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dashboard/dist/js/pages/dashboard2.js"></script>
</body>
</html>