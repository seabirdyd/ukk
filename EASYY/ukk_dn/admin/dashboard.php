<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ?url=login");
    exit();
}

$query_album = "SELECT COUNT(*) as jumlah_album FROM gallery_album";
$result_album = mysqli_query($conn, $query_album);
$row_album = mysqli_fetch_assoc($result_album);
$jumlah_album = $row_album['jumlah_album'];

$query_foto = "SELECT COUNT(*) as jumlah_foto FROM gallery_foto";
$result_foto = mysqli_query($conn, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);
$jumlah_foto = $row_foto['jumlah_foto'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .bg-custom {
            background-color: #008000;
        }

        .text-custom {
            color: #008000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="my-4">Menu</h2>
                <div class="list-group">
                <a href="admin.php" class="list-group-item bg-custom text-white">Admin</a>
                    <a href="dashboard.php" class="list-group-item bg-custom text-white">Dashboard</a>
                    <a href="logout.php" class="list-group-item bg-custom text-white">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="my-4">Dashboard</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                           <div class="card-header">Jumlah Album</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $jumlah_album; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Jumlah Foto</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $jumlah_foto; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-light position-fixed bottom-0 w-100 text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright:
        <a class="text-custom" href="#">dadan</a>
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>