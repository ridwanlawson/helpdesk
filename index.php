<?php 
  include 'dist/config/index.php';
  $sql = $conn->query("SELECT * FROM perusahaan WHERE id_perusahaan = 1");
  $judul = $sql->fetch_object();  
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $judul->nm_perusahaan; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="icon" href="dist/assets/img/logo.png" style="border-radius: 50px">

  <link rel="stylesheet" href="dist/assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Nunito', sans-serif;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger" style="text-transform:uppercase;">
    <link rel="icon" href="" style="border-radius: 50px">
    <img src="dist/assets/img/logo.png" alt="logo" width="40px" class="mr-2">
    <a class="navbar-brand" href="#"><?php echo $judul->nm_perusahaan; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a style="color: white" class="nav-link" href="index.php"><b>Home</b></a>
        </li>
        <li class="nav-item">
          <a style="color: white" class="nav-link" href="#statistik">Statistik</a>
        </li>
        <li class="nav-item">
          <a style="color: white" class="nav-link" href="#faq">FAQ</a>
        </li>
        <li class="nav-item">
          <a style="color: white" class="nav-link" href="#kontak">Kontak</a>
        </li>
        <li class="nav-item">
          <a style="color: white" class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
    </div>
   </nav>
  <?php 
    $query = "SELECT * FROM pengumuman WHERE status_pengumuman = 'aktif'";
    $result = $conn->query($query);
    $data = $result->fetch_object();
    if ($data) {
     
  ?>
  <marquee scrollamount="8" onmouseover="this.stop();" onmouseout="this.start();">
  <p style="margin-top: 10px;">
  <?php 
    $query = "SELECT * FROM pengumuman WHERE status_pengumuman = 'aktif'";
    $result = $conn->query($query);
    while ($data = $result->fetch_object()) {
  ?>
    <b style="margin-right: 200px"><?php echo $data->nm_pengumuman ?></b>
  <?php 
    }
   ?>
   </p>
  </marquee>
  <?php } ?>
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="dist/assets/sawahlunto/1.jpg" class="d-block w-100" alt="dist/assets/sawahlunto/1.jpg">
        <div class="carousel-caption d-none d-md-block">
          <h2>Selamat Datang di Aplikasi Helpdesk SPBE Pemerintah Kota Sawahlunto </h2>
          <p>Kami Hadir Untuk Melayani.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="dist/assets/sawahlunto/2.jpg" class="d-block w-100" alt="dist/assets/sawahlunto/2.jpg">
        <div class="carousel-caption d-none d-md-block">
          <h2>Selamat Datang di Aplikasi Helpdesk SPBE Pemerintah Kota Sawahlunto </h2>
          <p>Terdepan dalam memberikan informasi terkait layanan kami.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="dist/assets/sawahlunto/5.jpg" class="d-block w-100" alt="dist/assets/sawahlunto/5.jpg">
        <div class="carousel-caption d-none d-md-block">
          <h2>Selamat Datang di Aplikasi Helpdesk SPBE Pemerintah Kota Sawahlunto </h2>
          <p>Sistem Pemerintahan Berbasis Elektronik.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
    <h1 align="center" style="color:#dc3545;background-color: #dc3545;"> - </h1>
  <div class="container">
    <form method="POST" >
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="caridata" value="<?php echo @$_POST['caridata']; ?>" placeholder="Ketikkan Masalah Anda!" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <input type="submit" name="cari" value="Cari" class="btn btn-danger" >
        </div>
      </div>
    </form>
    <div id="accordion">
 <?php
    if (isset($_POST['cari'])) {
      $caridata = $_POST['caridata'];
      $querys = $conn->query("SELECT * FROM faq WHERE nm_faq like '%".$caridata."%'");
    }else{
      $querys = $conn->query("SELECT * FROM faq LIMIT 5");
    } 
    while ($data_faq = $querys->fetch_object()) { 
  ?>
    <!-- <option value='<?php //echo $data_faq->id_faq ?>'></option> -->
      <div class="card" id="faq">
        <a href="#" style="text-decoration: none;" data-toggle="collapse" data-target="#collapse<?php echo $data_faq->id_faq ?>" aria-expanded="true" aria-controls="collapseOne">
          <div class="card-header" id="heading<?php echo $data_faq->id_faq ?>" style="background-color: white; color:black">
            <h5 class="mb-0">
              <i class="fas fa-plus"></i> <?php echo $data_faq->nm_faq ?>
            </h5>
          </div>
        </a>
        <div id="collapse<?php echo $data_faq->id_faq ?>" class="collapse" aria-labelledby="heading<?php echo $data_faq->id_faq ?>" data-parent="#accordion">
            <div class="list-group">
               <?php   
                $queryss = $conn->query("SELECT * FROM solusi WHERE id_faq = $data_faq->id_faq"); 
                while ($data_solu = $queryss->fetch_object()){
              ?>
                <a target="_blank" href="detail.php?id=<?php echo $data_solu->id_solusi ?>" class="list-group-item list-group-item-action"><?php echo $data_solu->nm_solusi ?></a>
              <?php 
               }
              ?>
            </div>
        </div>
      </div>
<?php } ?>

    </div>
  </div>
 <div class="footer-copyright text-center py-3">©<?php echo date('Y') ?> Copyright. <?php echo $judul->nm_perusahaan; ?>
  </div>


  <script src="dist/assets/modules/modal/popper.min.js"></script>
  <script src="dist/assets/modules/modal/bootstrap.min.js"></script>
  <script src="dist/assets/modules/jquery.min.js"></script>

  <script src="dist/assets/modules/jquery.min.js"></script>
  <script src="dist/assets/modules/popper.js"></script>
  <script src="dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</body>
</html>