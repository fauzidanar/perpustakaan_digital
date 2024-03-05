<?php 
include '../koneksi.php';
session_start();

if(!$_SESSION["id"]){
  header("Location:../login.php");
}

$sql = "SELECT * FROM buku";
$result = mysqli_query($koneksi, $sql);

$sql1 = "SELECT * FROM kategori_buku";
$result1 = mysqli_query($koneksi, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
        /* CSS untuk mengatur teks di tengah */
 
       .isi:hover{
        background-color: #525CEB;
       color:#FFf;
       }

        .brand-link {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-text {
            margin-left: 5px; /* Margin agar ada jarak antara ikon dan teks */
        }
        .navbar-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .nav-link {
            margin-right: 1000px; /* Adjust the right margin as needed */
        }
    </style>
  <title>Buku</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../dashboard/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="overflow-x:hidden;">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        <a class="nav-link" href="../logout.php" role="button"><i class="fa-solid fa-right-from-bracket"></i></a>
      </li>
    </ul>
  </nav>
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
                <a href="./buku_petugas.php" class="nav-link">
                <i class="nav-icon fa-solid fa-book"></i>
                  <p>buku</p>
                </a>
              </li>
            </ul>
          </li>
          
            </ul>
          </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper " style="height:91.6vh; background-color: #fff; color:#161A30;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid ">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="color:#161A30;">Buku</h1>
            <a href="input_buku.php">
              <button type="button" class="btn btn-primary" style="margin-left:170%;margin-top:-30px;position:absolute;width:140px;">+ Tambah Buku</button>
            </a>
          </div>            
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content d-flex flex-col">
    <div class="content-wraper shadow p-3 mb-5 bg-body-tertiary" style="width:100%;margin-left:0%;padding:20px;background:#fff;border-radius:20px;;">
      <div class="container-fluid">
    <table class="table" style="margin-top:30px;width:90%; position:relative;left:50px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; while ($row = mysqli_fetch_assoc($result)) :  $i++; ?>
            <tr>
                    <td><?= $i ?></td>
                    <td class='d-flex'>
                      <img src="../asset/<?= $row['foto']?>" alt="" style="width: 50px; height: 55px; border-radius: 3px; margin-right:10px;">
                      <div>
                        <b><?= $row['judul'] ?></b><br> 
                        <?= $row['penulis'] ?>
                      </div>
                  </td>
                    <td><?= $row['penerbit'] ?></td>
                    <td><?= $row['tahun_terbit'] ?></td>
                    <td>
                        <a href="edit_buku_petugas.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                        <a href="proses_hapus_buku.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                        <a href="detail_buku.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm" style="background-color: #007bff;">detail</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
  </div>
    </section>
  </div>
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../dashboard/plugins/moment/moment.min.js"></script>
<script src="../dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dashboard/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dashboard/dist/js/pages/dashboard.js"></script>
</body>
</html>
