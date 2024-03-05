<?php 
include '../koneksi.php';

session_start();


$sql = "SELECT * FROM perpustakaan";
$result1 = mysqli_query($koneksi, $sql);

$sql = "SELECT * FROM buku";
$result = mysqli_query($koneksi, $sql);

$query1 = isset($bukuid) ? "SELECT buku.id as buku_id, buku.foto, buku.stok, buku.judul, buku.tahun_terbit, buku.penulis, buku.penerbit, ulasan_buku.buku, ulasan_buku.rating,
          AVG(ulasan_buku.rating) as rating_buku
        FROM buku
        LEFT JOIN ulasan_buku ON buku.id = ulasan_buku.buku
        WHERE buku.kategori_id = '$bukuid'
        GROUP BY buku.id" : 

        "SELECT buku.id as buku_id, buku.judul, buku.tahun_terbit, buku.penulis, buku.penerbit, ulasan_buku.buku, ulasan_buku.rating,
          AVG(ulasan_buku.rating) as rating_buku
        FROM buku
        LEFT JOIN ulasan_buku ON buku.id = ulasan_buku.buku
        GROUP BY buku.id";
$result2 = mysqli_query($koneksi, $query1);
$query_buku = isset($bukuid) ? "SELECT * FROM buku WHERE kategori_id = $bukuid" : "SELECT * FROM buku";
$resultbuku = mysqli_query($koneksi,$query_buku);

$username = $_SESSION['username'];  

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $bookId = $_GET['id'];
        $action = $_GET['action'];
        // Validasi action
        if ($action !== 'add' && $action !== 'delete') {
            echo "Action tidak valid.";
            exit();
        }

        // Validasi apakah buku dengan ID tertentu ada di database
        $checkBookQuery = "SELECT * FROM buku WHERE id = $bookId";
        $checkBookResult = mysqli_query($koneksi, $checkBookQuery);

        if (mysqli_num_rows($checkBookResult) > 0) {
            // Buku ditemukan, lanjutkan proses bookmark
            if ($action == 'add') {
                // Jika action=add, tambahkan buku ke koleksi pribadi
                $insertQuery = "INSERT INTO koleksi_pribadi (user, buku) VALUES ((SELECT id FROM user WHERE username = '$username'), $bookId)";
                mysqli_query($koneksi, $insertQuery);
            } elseif ($action == 'delete') {
                // Jika action=delete, hapus buku dari koleksi pribadi
                $deleteQuery = "DELETE FROM koleksi_pribadi WHERE user_id = (SELECT id FROM user WHERE username = '$username') AND buku = $bookId";
                mysqli_query($koneksi, $deleteQuery);
            }

            // Redirect kembali ke halaman utama setelah bookmark berhasil ditambahkan atau dihapus
            header("Location: index.php");
            exit();
        } else {
            // Jika buku dengan ID tertentu tidak ditemukan, bisa ditangani sesuai kebutuhan (contoh: berikan pesan)
            echo "Buku dengan ID $bukuid tidak ditemukan.";
            exit();
        }
    } else {
        // Jika parameter id atau action tidak valid, bisa ditangani sesuai kebutuhan (contoh: berikan pesan)
    }
} else {
    // Jika bukan metode GET, bisa ditangani sesuai kebutuhan (contoh: berikan pesan)
    echo "Metode yang diterima hanya GET.";

}

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

<!-- jQuery -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Add an input event listener to the search input
        $("#searchInput").on("input", function() {
            let searchTerm = $(this).val().toLowerCase(); // Get the value of the input and convert to lowercase

            // Loop through each card
            $(".card").each(function() {
                let cardTitle = $(this).find(".card-title").text().toLowerCase(); // Get the text content of the card title and convert to lowercase

                // Check if the card title contains the search term
                if (cardTitle.includes(searchTerm)) {
                    $(this).show(); // If yes, show the card
                } else {
                    $(this).hide(); // If no, hide the card
                }
            });
        });
    });
</script>


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

  <!-- /.navbar -->

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

    <div class="content-wrapper" style="margin-top:-1px; background-color: #eeee; color:#161A30;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>List Buku</h1>
        <!-- Search Input -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari berdasarkan judul buku..." id="searchInput">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Cari</button>
            </div>
        </div>
    </section>
     
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)):?>
              <div class="col-md-4 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="../asset/<?= $row['foto']; ?>" alt="Cover Buku" style="max-height: 200px; max-width: 100%;">
            </div>
            <h5 class="card-title text-truncate"><?php echo $row['judul']; ?></h5>
            <p class="card-text">Penulis: <?php echo $row['penulis']; ?></p>
            <p class="card-text">Penerbit: <?php echo $row['penerbit']; ?></p>
            <p class="card-text">Tahun Terbit: <?php echo $row['tahun_terbit']; ?></p>
            <p class="card-text">Stok Buku: <?= $row['stok']; ?></p>
            
            
            <!--botom-->
            <a href="proses/proses_pinjam.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Pinjam</a>
            <a href="detail_/detail_buku_user.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Detail</a>
            <?php
                            // Cek apakah buku sudah ada di koleksi pribadi user
                        $checkQuery = "SELECT * FROM koleksi_pribadi WHERE id = (SELECT id FROM user WHERE username = '$username') AND id = {$row['id']}";
                        $checkResult = mysqli_query($koneksi, $checkQuery);

                        if (mysqli_num_rows($checkResult) > 0) :?>
                            <a  style="height:35px;" href="index.php?id=<?=$row['id'];?>&action=delete" class="btn btn-danger" onclick="return confirmDelete()">
                            <i class="fas fa-star"></i></a>
                        <?php else :?>
                            <a  style="height:35px;" href="index.php?id=<?=$row['id'];?>&action=add" class="btn btn-secondary">
                            <i class="fas fa-star"></i></a>
                      <?php endif; ?>
            <!-- Tambahkan tombol untuk aksi lainnya di sini -->
            
        </div>
    </div>
</div>

            <?php endwhile;?>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
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
<script>
  $(document).ready(function(){
        // Add an input event listener to the search input
        $("#searchInput").on("input", function() {
            let searchTerm = $(this).val().toLowerCase(); // Get the value of the input and convert to lowercase

            // Keep track if any results are found
            let resultsFound = false;

            // Loop through each searchable card
            $(".searchable").each(function() {
                let cardText = $(this).text().toLowerCase(); // Get the text content of the card and convert to lowercase

                // Check if the card text contains the search term
                if (cardText.includes(searchTerm)) {
                    $(this).show(); // If yes, show the card
                    resultsFound = true; // Mark that results are found
                } else {
                    $(this).hide(); // If no, hide the card
                }
            });

            // Show/hide the no results message based on resultsFound
            if (resultsFound) {
                $("#noResultsMessage").hide();
            } else {
                $("#noResultsMessage").show();
            }
      });
   });
</script>
</body>
</html> 