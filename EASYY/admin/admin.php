<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_album = $_POST['nama_album'];
    $query = "INSERT INTO gallery_album (AlbumID, NamaAlbum) VALUES (NULL, '$nama_album')";
    mysqli_query($conn, $query);
    header('location: admin.php');
}
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
                <h2 class="my-4">Daftar Album</h2>
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Nama Album</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM gallery_album";
                    $result = mysqli_query($conn, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['NamaAlbum'] . "</td>";
                        echo "<td><a href='halbum.php?id=" . $row['AlbumID'] . "' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus album ini?')\">Hapus</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

                <h2 class="my-4">Daftar Foto</h2>
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Album</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM gallery_foto JOIN gallery_album ON gallery_foto.AlbumID = gallery_album.AlbumID";
                    $result = mysqli_query($conn, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['JudulFoto'] . "</td>";
                        echo "<td>" . $row['DeskripsiFoto'] . "</td>";
                        echo "<td>" . $row['NamaAlbum'] . "</td>";
                        echo "<td><img src='../uploads/" . $row['NamaFile'] . "' width='100'></td>";
                        echo "<td><a href='hfoto.php?id=" . $row['FotoID'] . "' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus foto ini?')\">Hapus</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
<footer class="bg-light position-fixed bottom-0 w-100 text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Copyright:
        <a class="text-custom" href="#">dadan</a>
    </div>
</footer>
</html>