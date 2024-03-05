<?php 
include '../koneksi.php';

session_start();

if(!$_SESSION["id"]){
  header("Location:../login.php");
}

$sql = "SELECT * FROM perpustakaan";
$result = mysqli_query($koneksi, $sql);

$sql1 = "SELECT * FROM user WHERE role='peminjam'";
$result1 = mysqli_query($koneksi, $sql1);

$sql2 = "SELECT * FROM buku";
$result2 = mysqli_query($koneksi, $sql2);

// Ambil nilai rentang tanggal dari formulir jika tersedia
$filter_start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$filter_end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Buat kondisi filter berdasarkan rentang tanggal jika tanggal telah dipilih
$date_condition = '';
if (!empty($filter_start_date) && !empty($filter_end_date)) {
    $date_condition = "AND tanggal_peminjaman BETWEEN '$filter_start_date' AND '$filter_end_date'";
}

$sql3 = "SELECT peminjaman.*, user.nama_lengkap, buku.judul, perpustakaan.nama_perpus 
         FROM peminjaman
         INNER JOIN user ON peminjaman.user = user.id
         INNER JOIN buku ON peminjaman.buku = buku.id
         INNER JOIN perpustakaan ON peminjaman.perpus_id = perpustakaan.id
         WHERE 1 $date_condition"; // Tambahkan kondisi filter tanggal
$result3 = mysqli_query($koneksi, $sql3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
        /* CSS untuk mengatur teks di tengah */
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
  <title>Dashboard</title>
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
    <form method="POST" action="" style="background-color: transparent; margin-left: 50px;">
    <div style="display: flex; align-items: center;">
        <div style="margin-right: 10px;">
            <label for="start_date" style="margin-right: 5px;">Tanggal Pinjam:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $filter_start_date; ?>" style="padding: 5px;">
        </div>
        <div>
            <label for="end_date" style="margin-right: 5px;">Tanggal Pengembalian:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $filter_end_date; ?>" style="padding: 5px;">
        </div>
        <button type="submit" style="padding: 5px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Filter</button>
    </div>
</form>

  </div>
  </div>
  <table class="table" style="margin-top:30px;width:90%; position:relative;left:50px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Perpustakaan</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Tanggal_peminjaman</th>
                <th>Tanggal_pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; while ($row = mysqli_fetch_assoc($result3)) :  $i++; ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row['nama_perpus'] ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['tanggal_peminjaman'] ?></td>
                    <td><?= $row['tanggal_pengembalian'] ?></td>
                    <td><?= $row['status_peminjaman']?></td>
                    <td>
                        <a href="edit/edit_peminjaman.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delet/hapus_peminjaman.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                        <a href="../proses/proses_download.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm" style="background-color: green;">Download</a>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

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
