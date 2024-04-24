<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      body {
  padding: 1rem;
  background-color: #FEE8B0;
}
        .gallery-item {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .gallery-item img {
            transition: transform .3s ease-in-out;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 py-3">
                <a href="?url=album" class="btn btn-dark">Kembali ke album</a>
            </div>
            <?php 
            $kategori=mysqli_query($conn, "SELECT * FROM gallery_foto INNER JOIN gallery_album ON gallery_foto.AlbumID=gallery_album.AlbumID WHERE gallery_foto.AlbumID='{$_GET['albumid']}'");
            foreach($kategori as $kat):
                ?>
                <div class="col-6 col-md-3 mb-4">
                    <div class="position-relative gallery-item">
                        <img src="uploads/<?= $kat['NamaFile'] ?>" class="img-fluid rounded">
                        <div class="position-absolute bottom-0 start-0 m-2 text-white">
                            <h5 class="card-title"><?= $kat['JudulFoto'] ?></h5>
                            <p class="card-text">Album: <?= $kat['NamaAlbum'] ?></p>
                            <a href="?url=detail&&id=<?= $kat['FotoID'] ?>" class="btn btn-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</body>
</html>