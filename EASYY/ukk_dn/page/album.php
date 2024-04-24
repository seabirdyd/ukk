<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMmcke49" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 p-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="mb-4">Halaman Album</h4>
                        <?php 
                        //ambil data yang di kirim oleh <form>
                        $submit=@$_POST['submit'];
                        $albumID=@$_GET['albumid'];
                        if ($submit=='Simpan') {
                            $nama_album=@$_POST['nama_album'];
                            $deskripsi_album=@$_POST['deskripsi_album'];
                            $tanggal=date('Y-m-d');
                            $user_id=@$_SESSION['user_id'];
                            $insert=mysqli_query($conn, "INSERT INTO gallery_album VALUES('','$nama_album','$deskripsi_album','$tanggal','$user_id')");
                            if ($insert) {
                                echo 'Berhasil Membuat Album';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                            }else{
                                echo 'Gagal Membuat Album';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                            }
                        }elseif(isset($_GET['edit'])){
                            if($submit=='Ubah'){
                            $nama_album=@$_POST['nama_album'];
                            $deskripsi_album=@$_POST['deskripsi_album'];
                            $tanggal=date('Y-m-d');
                            $user_id=@$_SESSION['user_id'];
                            $update=mysqli_query($conn, "UPDATE gallery_album SET NamaAlbum='$nama_album', Deskripsi='$deskripsi_album' WHERE AlbumID='$albumID'");
                               if($update){
                                  echo 'Berhasil Mengubah Album';
                                  echo'<meta http-equiv="refresh" content="0.8; url=?url=album">';
                               }else{
                                  echo 'Gagal Mengubah Album';
                                  echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                               }
                            }
                        }elseif(isset($_GET['hapus'])){
                            $hapus=mysqli_query($conn, "DELETE FROM gallery_album WHERE AlbumID='$albumID'");
                            if($hapus){
                                echo 'Berhasil Hapus Album';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';}else{
                                echo 'Gagal Hapus Album';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=album">';
                            }
                        }
                        $val=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM gallery_album WHERE AlbumID='$albumID' "));
                        ?>
                        <?php if(!isset($_GET['edit'])): ?>
                        <form action="?url=album" method="post">
                            <div class="form-group mb-3">
                                <label>Nama Album</label>
                                <input type="text" class="form-control" required name="nama_album">
                            </div>
                            <div class="form-group mb-3">
                                <label>Deskripsi Album</label>
                                <textarea name="deskripsi_album" class="form-control" required cols="30" rows="5"></textarea>
                            </div>
                            <input type="submit" value="Simpan" name="submit" class="btn btn-success">
                        </form>
                        <?php elseif(isset($_GET['edit'])): ?>
                        <form action="?url=album&&edit&&albumid=<?= $val['AlbumID'] ?>" method="post">
                            <div class="form-group mb-3">
                                <label>Nama Album</label>
                                <input type="text" class="form-control" value="<?= $val['NamaAlbum'] ?>" required name="nama_album">
                            </div>
                            <div class="form-group mb-3">
                                <label>Deskripsi Album</label>
                                <textarea name="deskripsi_album" class="form-control" required cols="30" rows="5"><?= $val['Deskripsi'] ?></textarea>
                            </div>
                            <input type="submit" value="Ubah" name="submit" class="btn btn-success">
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 p-4">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php 
                    $i=1;
                    $userid=@$_SESSION['user_id'];
                    $albums = mysqli_query($conn, "SELECT * FROM gallery_album WHERE UserID='$userid'");
                    foreach ($albums as $album) :
                    ?>
                    <div class="col">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $album['NamaAlbum'] ?></h5>
                                <p class="card-text text-muted"><?= $album['Deskripsi'] ?><br><?= $album['TanggalDibuat'] ?></p>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                <a href="?url=kategori&&albumid=<?= $album['AlbumID'] ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-images"></i> Lihat Foto
                                </a>
                                <div>
                                    <a href="?url=album&&edit&&albumid=<?= $album['AlbumID'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
<a href="?url=album&&hapus&&albumid=<?= $album['AlbumID'] ?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSGFpoO/ufreqqF6MVu4JdG7PhIxZlW8sSJv43gkdSHlua9DmM/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" integrity="sha384-MrFsm+sodUMSWw+KcQgfbdymkU/+IrjNzI5L06febp/Zdnobx93bgs/pMD14Ehdb" crossorigin="anonymous"></script>
</body>
</html>