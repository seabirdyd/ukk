<?php include 'koneksi.php'; session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> dang!</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
  <a class="navbar-brand" style="font-size: 2rem;" href="#">Dang!</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="?url=home">Home</a>
        </li>
        <?php if(isset($_SESSION['user_id'])):?>
        <li class="nav-item">
          <a class="nav-link" href="?url=upload">Upload</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?url=album">Album</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= ucwords($_SESSION['username'])?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="?url=profile">Profile</a></li>
            <li><a class="dropdown-item" href="?url=logout">Logout</a></li>
          </ul>
        </li>
        <?php else:?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daftar.php">Daftar</a>
        </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>
    <?php 
        $url=@$_GET["url"];
        if($url=='home'){
            include 'page/home.php';
        }elseif($url=='profile'){
            include 'page/profil.php';
        }else if($url=='upload'){
            include 'page/upload.php';
        }else if($url=='album'){
            include 'page/album.php';
        }else if($url=='like'){
            include 'page/like.php';
        }else if($url=='komentar'){
            include 'page/komentar.php';
        }else if($url=='detail'){
            include 'page/detail.php';
          }else if($url=='hkomentar'){
            include 'page/hkomentar.php';
        }else if($url=='kategori'){
            include 'page/kategori.php';
        }else if($url=='logout'){
            session_destroy();
            header("Location: ?url=home");
        }else{
            include 'page/home.php';
        }
    ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>