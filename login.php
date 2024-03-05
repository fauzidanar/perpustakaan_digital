<?php 
include 'koneksi.php';

session_start();    

if(isset($_POST['login'])){

var_dump ($_POST);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$admin = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

if($data = mysqli_fetch_assoc($admin)){
if(password_verify($password, $data['password'])){
$_SESSION['username'] = $data['username'];

if($data['role'] == 'admin'){
$_SESSION['id'] = $data['id'];
$_SESSION['role'] = $data['role'];
header('location: admin/index.php');
}
elseif($data['role'] == 'petugas'){
$_SESSION['id'] = $data['id'];
$_SESSION['role'] = $data['role'];
header('location: petugas/index.php');

//echo"Masuk ke petugas";
}
elseif($data['role'] == 'peminjam'){
$_SESSION['role'] = $data['role'];
header('location: user/index.php');
//echo"Masuk ke peminjam"; 
}
//header('location: admin/index.php');
} else {
echo "username dan password salah";
}
} else {
echo "akun tidak ada";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dashboard/dist/css/adminlte.min.css">
   <!-- Custom style -->
   <style>
    body {
      background-image: url('perpus.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      position: relative;
    }
    /* Tambahkan lapisan transparan berwarna hitam */
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Ubah nilai alpha (0.5) sesuai keinginan */
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h2 href="admin/index.php"><b>Login</b></h2>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <p class="mb-0">
        <a href="register.php" class="text-center"> Daftar</a>
        </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dashboard/dist/js/adminlte.min.js"></script>
</body>
</html>
