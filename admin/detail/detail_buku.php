<?php 
include '../../koneksi.php';
session_start();

if(!$_SESSION["id"]){
  header("Location:../login.php");

}

// Ambil ID buku dari parameter URL
if(isset($_GET['id'])) {
    $id_buku = $_GET['id'];
    
    // Query untuk mengambil detail buku berdasarkan ID
    $sql = "SELECT * FROM buku WHERE id = $id_buku";
    $result = mysqli_query($koneksi, $sql);
    
    // Periksa apakah buku ditemukan
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Ambil informasi buku
        $judul = $row['judul'];
        $penulis = $row['penulis'];
        $penerbit = $row['penerbit'];
        $tahun_terbit = $row['tahun_terbit'];
        $sinopsis = $row['sinopsis'];
        $foto = $row['foto'];
    } else {
        // Redirect jika buku tidak ditemukan
        header("Location: index.php");
    }
} else {
    // Redirect jika tidak ada parameter ID buku
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dashboard/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="hold-transitionx  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-light" style="background-color:#fff">
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')" href="../../logout.php">
          <i class="fa-solid fa-arrow-right-from-bracket" style="color:#7077A1;"></i>
        </a>
      </li>
    </ul>
  </nav>


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
                <a href="../index.php" class="nav-link">
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
                <a href="../pengguna.php" class="nav-link">
                <i class="nav-icon fa-solid fa-users"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../peminjam.php" class="nav-link">
                <i class="fa-solid fa-people-carry-box"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../buku.php" class="nav-link">
                <i class="nav-icon fa-solid fa-book"></i>
                  <p>Buku</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../ulasan.php" class="nav-link">
                <i class="nav-icon fa-sharp fa-solid fa-layer-group"></i>
                  <p>Kategori</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../ulasan.php" class="nav-link">
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
  <div class="content-wrapper" style="height: 100vh; background-color: #f8f9fa; color: #212529;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Buku: <?= $judul ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">Informasi Buku</h5>
                            <div class="text-center mb-4">
                                <img src="../../asset/<?php echo $foto ?>" alt="Cover Buku" style="max-width: 100%; height: auto;">
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Judul:</strong> <?= $judul ?></p>
                                <p class="card-text"><strong>Penulis:</strong> <?= $penulis ?></p>
                                <p class="card-text"><strong>Penerbit:</strong> <?= $penerbit ?></p>
                                <p class="card-text"><strong>Tahun Terbit:</strong> <?= $tahun_terbit ?></p>
                            </div>
                            <div>
                                <p class="card-text"><strong>Sinopsis:</strong> <?= $sinopsis ?></p>
                                <a href="../buku.php?= $row['id'] ?>" class="btn btn-success btn-sm">Close</a>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


  </div>
</div>
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/dist/js/adminlte.min.js"></script>
</body>
</html>
