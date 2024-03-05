<?php 
include '../koneksi.php';

session_start();

$username = $_SESSION['username'];  


$query = "SELECT id FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    $row = mysqli_fetch_assoc($result);
    $userId = $row['id'];

// Query untuk mendapatkan buku yang sedang dipinjam oleh pengguna
$queryPeminjaman = "SELECT buku.id as buku_id, buku.foto, buku.stok, buku.judul, buku.tahun_terbit, buku.penulis, buku.penerbit
FROM buku
JOIN peminjaman ON buku.id = peminjaman.buku
JOIN user ON peminjaman.user = user.id
WHERE user.username = '$username' AND peminjaman.status_peminjaman = 'Dipinjam'";
$result= mysqli_query($koneksi, $queryPeminjaman);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peminjaman</title>

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
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="../logout.php" role="button"><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Hi user</span>
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
                <i class=" nav-icon fa-solid fa-house"></i>                  
                <p>Home</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="peminjaman.php" class="nav-link">
                <i class="nav-icon fa-solid fa-book-bookmark"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="favorite.php" class="nav-link">
                <i class="nav-icon fa-solid fa-star"></i>
                  <p>Favorite</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Buku yang Sedang Dipinjam</h1>

        <!-- Card Container -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php while ($rew = mysqli_fetch_assoc($result)) : ?>
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top" src="../asset/<?= $rew['foto']; ?>" alt="Buku Image" style="object-fit: contain; height: 200px; width: 100%;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $rew['judul']; ?></h5>
                    <p class="card-text">Penulis: <?= $rew['penulis']; ?></p>
                    <p class="card-text">Stok Buku: <?= $rew['stok']; ?></p>
                    <?php
                    $bukuid = $rew['buku_id'];
                    $sql1 = "SELECT * FROM peminjaman WHERE status_peminjaman = 'Dipinjam' AND user = '$userId' AND buku='$bukuid' ";
                    $result1 = mysqli_query($koneksi, $sql1);
                    if (mysqli_num_rows($result1) > 0) :
                    ?>
                        <a href="proses/proses_pengembalian_peminjaman.php?id=<?= $rew['buku_id'] ?>" class="btn btn-sm btn-danger mt-auto">
                            Kembalikan
                        </a>
                    <?php else : ?>
                        <a href="proses/proses_peminjaman.php?id=<?= $rew['buku_id'] ?>" class="btn btn-sm btn-primary mt-auto">
                            Pinjam
                        </a>
                    <?php endif; ?>
                    <!-- Tautan untuk membaca PDF -->
                    <a href="baca_buku.php?id=<?= $rew['buku_id'] ?>" class="btn btn-sm btn-primary mt-2">
                        Baca
                    </a>
                    <a href="ulasan.php?id=<?= $rew['buku_id'] ?>" class="btn btn-sm mt-2" style="background-color:green; color:#fff; height:32px;">Ulas</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
