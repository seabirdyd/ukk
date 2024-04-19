<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e9T9hXmJ58bldgTk+" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center mb-5">Halaman Upload</h4>
                        <?php

                        //ambil data dari <form>
                        $submit = @$_POST['submit'];
                        $fotoid = @$_GET['fotoid'];
                        if ($submit == 'Simpan') {
                            $judul_foto = @$_POST['judul_foto'];
                            $deskripsi_foto = @$_POST['deskripsi_foto'];
                            $nama_file = @$_FILES['namafile']['name'];
                            $tmp_foto = @$_FILES['namafile']['tmp_name'];
                            $tanggal = date('Y-m-d');
                            $album_id = @$_POST['album_id'];
                            $user_id = @$_SESSION['user_id'];
                            if (move_uploaded_file($tmp_foto, 'uploads/' . $nama_file)) {
                                $insert = mysqli_query($conn, "INSERT INTO gallery_foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal','$nama_file','$album_id','$user_id')");
                                if ($insert) {
                                    echo '<div class="alert alert-success mt-3 animate__animated animate__fadeIn">
                                            Berhasil menambahkan foto!
                                          </div>';
                                    echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                                } else {
                                    echo '<div class="alert alert-danger mt-3 animate__animated animate__fadeIn">
                                            Gagal menambahkan foto!
                                          </div>';
                                    echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                                }
                            } else {
                                echo '<div class="alert alert-danger mt-3 animate__animated animate__fadeIn">
                                            Gagal memindahkan file!
                                          </div>';
                                echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                            }
                        } elseif (isset($_GET['edit'])) {
                            if ($submit == "Ubah") {
                                $judul_foto = @$_POST['judul_foto'];
                                $deskripsi_foto = @$_POST['deskripsi_foto'];
                                $nama_file = @$_FILES['namafile']['name'];
                                $tmp_foto = @$_FILES['namafile']['tmp_name'];
                                $tanggal = date('Y-m-d');
                                $album_id = @$_POST['album_id'];
                                $user_id = @$_SESSION['user_id'];

                                if (strlen($nama_file) == 0) {
                                    $query = "UPDATE gallery_foto SET JudulFoto='$judul_foto', DeskripsiFoto='$deskripsi_foto', TanggalUnggah='$tanggal', AlbumID='$album_id' WHERE FotoID='$fotoid'";
                                } else {
                                    if (move_uploaded_file($tmp_foto, "uploads/" . $nama_file)) {
                                        $query = "UPDATE gallery_foto SET JudulFoto='$judul_foto', DeskripsiFoto='$deskripsi_foto', NamaFile='$nama_file', TanggalUnggah='$tanggal', AlbumID='$album_id' WHERE FotoID='$fotoid'";
                                    }
                                }

                                $update = mysqli_query($conn, $query);

                                if ($update) {
                                    echo '<div class="alert alert-success mt-3 animate__animated animate__fadeIn">
                                            Berhasil mengubah foto!
                                          </div>';
                                    echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                                } else {
                                    echo '<div class="alert alert-danger mt-3 animate__animated animate__fadeIn">
                                            Gagal mengubah foto!
                                          </div>';
                                    echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                                }
                            }
                        }elseif (isset($_GET['hapus'])) {
                            $fotoid = $_GET['fotoid'];

                            // Hapus semua like terkait foto
                            $deleteLikes = mysqli_query($conn, "DELETE FROM gallery_likefoto WHERE FotoID='$fotoid'");

                            // Hapus semua komentar terkait foto
                            $deleteComments = mysqli_query($conn, "DELETE FROM gallery_komentarfoto WHERE FotoID='$fotoid'");

                            // Baru setelah itu, hapus fotonya
                            $deleteFoto = mysqli_query($conn, "DELETE FROM gallery_foto WHERE FotoID='$fotoid'");
                            if ($deleteFoto) {
                                echo '<div class="alert alert-success mt-3 animate__animated animate__fadeIn">
                                            Berhasil menghapus foto dan semua like & komentar!
                                          </div>';
                                echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                            } else {
                                echo '<div class="alert alert-danger mt-3 animate__animated animate__fadeIn">
                                            Gagal menghapus foto!
                                          </div>';
                                echo '<meta http-equiv="refresh" content="0.5; url=?url=upload">';
                            }
                        }

                        //mencari data album
                        $album = mysqli_query($conn, "SELECT * FROM gallery_album WHERE UserID='$_SESSION[user_id]'");
                        $val = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM gallery_foto WHERE FotoID='$fotoid'"));
                        ?>

                        <?php if (!isset($_GET['edit'])) : ?>
                            <form action="?url=upload" method="post" enctype="multipart/form-data" class="mb-5">
                                <div class="form-group my-3">
                                    <label for="judul_foto" class="form-label">Judul Foto</label>
                                    <input type="text" class="form-control" id="judul_foto" required name="judul_foto">
                                </div>
                                <div class="form-group my-3">
<label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                                    <textarea name="deskripsi_foto" class="form-control" required cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <label for="namafile" class="form-label">Pilih Gambar</label>
                                    <input type="file" name="namafile" class="form-control" id="namafile" required>
                                    <small class="text-danger">File Harus Berupa: *.jpg, *.png *.gif</small>
                                </div>
                                <div class="form-group my-3">
                                    <label for="album_id" class="form-label">Pilih Album</label>
                                    <select name="album_id" class="form-select">
                                        <?php foreach ($album as $albums) :?>
                                            <option value="<?= $albums['AlbumID']?>"><?= $albums['NamaAlbum']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success my-3">Simpan</button>
                            </form>
                            <style>
                                .form-label {
                                    font-weight: bold;
                                }

                                .form-control {
                                    border-radius: 5px;
                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                }

                                .form-select {
                                    border-radius: 5px;
                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                }

                                .my-3 {
                                    margin-top: 1rem;
                                    margin-bottom: 1rem;
                                }

                                .btn-success {
                                    background-color: #006400;
                                    border: none;
                                    color: white;
                                    padding: 10px 24px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin: 4px 2px;
                                    cursor: pointer;
                                    border-radius: 5px;
                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                }
                            </style>
                        <?php elseif (isset($_GET['edit'])) : ?>
                            <form action="?url=upload&&edit&&fotoid=<?= $val['FotoID'] ?>" method="post" enctype="multipart/form-data" class="mb-5">
                                <div class="form-group">
                                    <label for="judul_foto" class="form-label">Judul Foto</label>
                                    <input type="text" class="form-control" value="<?= $val['JudulFoto'] ?>" required name="judul_foto">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                                    <textarea name="deskripsi_foto" class="form-control" required cols="30" rows="5"><?= $val['DeskripsiFoto'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="namafile" class="form-label">Pilih Gambar</label>
                                    <input type="file" name="namafile" class="form-control" id="namafile">
                                    <small class="text-danger">File Harus Berupa: *.jpg, *.png *.gif</small>
                                </div>
                                <div class="form-group">
                                    <label for="album_id" class="form-label">Pilih Album</label>
                                    <select name="album_id" class="form-select">
                                        <?php foreach ($album as $albums) : ?>
                                            <?php if ($albums['AlbumID'] == $val['AlbumID']) : ?>
                                                <option value="<?= $albums['AlbumID'] ?>" selected><?= $albums['NamaAlbum'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $albums['AlbumID'] ?>"><?= $albums['NamaAlbum'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="submit" value="Ubah" class="btn btn-success my-3">Ubah</button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="col-7">
    <div class="row">
        <?php
        $fotos = mysqli_query($conn, "SELECT * FROM gallery_foto WHERE UserID='" . @$_SESSION['user_id'] . "'");
        while ($foto = mysqli_fetch_assoc($fotos)) :
        ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 border-0 shadow rounded-3">
                    <img src="uploads/<?= htmlspecialchars($foto['NamaFile']) ?>" class="card-img-top" alt="<?= htmlspecialchars($foto['JudulFoto']) ?>">
                    <div class="card-body">
                        <h6 class="card-title mb-1"><?= htmlspecialchars($foto['JudulFoto']) ?></h6>
                        <p class="card-text small text-muted mb-0">
                            <a href="?url=upload&&edit&&fotoid=<?= htmlspecialchars($foto['FotoID']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="?url=upload&&hapus&&fotoid=<?= htmlspecialchars($foto['FotoID']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="btn btn-sm btn-outline-danger">Hapus</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        // Add animation to alert boxes
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('animate__animated', 'animate__fadeOut');
            }, 3000);

            alert.addEventListener('animationend', () => {
                alert.style.display = 'none';
                alert.classList.remove('animate__animated', 'animate__fadeOut');
            });
        });
    </script>
</body>
</html>