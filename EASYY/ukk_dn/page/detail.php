<?php 
$details=mysqli_query($conn, "SELECT * FROM gallery_foto INNER JOIN gallery_user ON gallery_foto.UserID=gallery_user.UserID WHERE gallery_foto.FotoID='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gallery_likefoto WHERE FotoID='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gallery_likefoto WHERE FotoID='$_GET[id]' AND UserID='".@$_SESSION['user_id']."'"));
?>
<div class="container-fluid p-5">
  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <img src="uploads/<?= $data['NamaFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="card-img-top">
        <div class="card-body" style="margin-top: 10px;">
          <h3 class="card-title mb-3"><?= $data['JudulFoto'] ?> 
          <div style="float: right; margin-right: 10px;">
      <a href="?url=home" class="back-button">Kembali</a>
    </div>
          <a href="<?php if(isset($_SESSION['user_id'])) {echo '?url=like&&id='.$data['FotoID'].'';}else{echo 'login.php';}?>" class="btn btn-sm like-button <?php if($cek==0){echo "text-secondary";}else{echo "text-danger";}?>" id="like-button-<?= $data['FotoID']?>"><i class="fa-solid fa-fw fa-heart"></i> <?= $likes?></a></h3>
               <small class="text-muted mb-3">by:<?= $data['Username'] ?>, <?= $data['Tanggal'] ?></small>
               <p><?= $data['DeskripsiFoto'] ?></p>
               <?php 
               //ambil data komentar
               $komen_id=@$_GET["komentar_id"];
               $submit=@$_POST['submit'];
               $komentar=@$_POST['komentar'];
               $foto_id=@$_POST['foto_id'];
               $user_id=@$_SESSION['user_id'];
               $tanggal=date('Y-m-d');
               $dataKomentar=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM gallery_komentarfoto WHERE KomentarID='$komen_id' AND UserID='$user_id' AND FotoID='$foto_id'"));
               if ($submit=='Kirim') {
                  $komen=mysqli_query($conn, "INSERT INTO gallery_komentarfoto VALUES('','$foto_id','$user_id','$komentar','$tanggal')");
                  header("Location: ?url=detail&&id=$foto_id");
               }elseif($submit=='Edit'){
                  
               }

               ?>
        <form action="?url=detail" method="post">
  <div class="form-group d-flex flex-row">
   
    <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
    <?php if(isset($_SESSION['user_id'])): ?>
      <input type="text" class="form-control flex-grow-1 mr-2" name="komentar" required placeholder="Masukan Komentar">
    <input type="submit" value="Kirim" name="submit" class="btn btn-secondary btn-orange">
    <?php else: ?>
      <p class="text-muted mb-2">Silakan login untuk memberikan komentar.</p>
    <?php endif; ?>
  </div>
</form>
            </div>
         </div>
      </div>
  <div class="col-lg-6">
      <?= @$alert ?>
      <?php $UserID=@$_SESSION["user_id"]; $komen=mysqli_query($conn, "SELECT * FROM gallery_komentarfoto INNER JOIN gallery_user ON gallery_komentarfoto.UserID=gallery_user.UserID INNER JOIN gallery_foto ON gallery_komentarfoto.FotoID=gallery_foto.FotoId WHERE gallery_komentarfoto.FotoID='$_GET[id]'");
      foreach($komen as $komens): ?>
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <p class="mb-0 fw-bold"><?= $komens['Username'] ?></p>
          <p class="mb-1"><?= $komens['IsiKomentar'] ?></p>
          <p class="text-muted small mb-0"><?= $komens['TanggalKomentar'] ?></p>
          <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $komens['UserID']): ?>
            <?php
echo "<td><a href='?url=hkomentar&id={$komens['KomentarID']}' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus komentar ini?')  && (window.location.href = '?url=detail')\">Hapus</a></td>";
?>
          <?php endif; ?>
         <?php endforeach; ?>
      </div>
   </div>
</div>
<style>
   .btn-orange {
  background-color: orange;
  border-color: orange;
}

.btn-orange:hover {
  background-color: darkorange;
  border-color: darkorange;
  transform: scale(1.1);
  transition: all 0.3s ease-in-out;
}
.back-button {
  background-color: orange;
  border: none;
  padding: 2px 5px; /* Reduced padding */
  border-radius: 5px;
  color: white;
  text-decoration: none;
  position: relative;
  overflow: hidden;
  font-size: 14px; /* Reduced font size */
}

/* The rest of the styles can remain the same */
.back-button:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(45deg);
  width: 100%;
  height: 100%;
  background-color: #FEE8B0;
  border-radius: 5px;
  opacity: 0;
  transition: all 0.5s ease;
}

.back-button:hover:before {
  transform: translate(-50%, -50%) rotate(45deg) scale(2);
  opacity: 1;
}
.like-button {
  transition: transform 0.3s;
}

.like-button.clicked {
  transform: scale(1.25);
}
</style>
<script>
   document.querySelectorAll('.like-button').forEach(button => {
  button.addEventListener('click', () => {
    button.classList.add('clicked');
  });
});
   </script>