<!DOCTYPE html>
<html>
<head>
    <title>Galeri Foto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .full-screen-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease;
        }

        .full-screen-modal.show {
            visibility: visible;
            opacity: 1;
        }

        .full-screen-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform .3s;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform .3s;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            opacity: 0;
            transition: opacity .3s;
            border-radius: 10px;
        }

        .gallery-item:hover .gallery-caption {
            opacity: 1;
        }

        .gallery-caption .card-text {
            color: white;
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-menu {
            border: none;
          box-shadow: 0 0 10px rgba(156, 167, 119, 0.3);
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        #dropdownMenuButton {
            border-radius: 10px;
        }
        .container-custom {
    width: 88%;
    margin: 0 auto; /* agar kontainer tetap berada di tengah */
}

    </style>
</head>
<body>




<div class="container-custom my-3 p-0 bg-hero rounded">
<div class="py-5 text-white text-center">
        <p class="display-5 fw-bold animate__animated animate__fadeIn">Galeri Foto</p>
        <p class="display-7 fw-bold ">Selamat Datang Di Website Galeri foto Saya!</p>
    </div>
</div>


<div class="container-custom p-0 ">
  <div class="row bg-f3d8c7 bg-opacity-50 photo-gallery">
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM gallery_foto INNER JOIN gallery_user ON gallery_foto.UserID = gallery_user.UserID");
        foreach ($tampil as $tampils) :
            ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <a class="gallery-item" href="#" onclick="redirectToDetail(<?= $tampils['FotoID'] ?>)" data-toggle="modal" data-target="#full-screen-modal" data-src="uploads/<?= $tampils['NamaFile'] ?>">
                    <img src="uploads/<?= $tampils['NamaFile'] ?>" class="img-fluid" alt="...">

                    <div class="dropdown">
                        <div id="dropdownMenuButton<?= $tampils['FotoID'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="gallery-caption">
                                <h5 class="card-title"><?= $tampils['JudulFoto'] ?></h5>
                                <p class="card-text">by: <?= $tampils['Username'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton<?= $tampils['FotoID'] ?>">
                        <a class="dropdown-item" href="?url=detail&&id=<?= $tampils['FotoID'] ?>">Detail</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade full-screen-modal" id="full-screen-modal" tabindex="-1" role="dialog" aria-labelledby="full-screen-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img class="img-fluid" src="">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#full-screen-modal').on('show.bs.modal', function(e) {
                var img = $(e.relatedTarget);
                $(this).find('img').attr('src', img.data('src'));
            });
            $('.dropdown-toggle').dropdown();
            $('.gallery-item').hover(function() {
                $(this).find('.dropdown-menu').show();
            }, function() {
                $(this).find('.dropdown-menu').hide();
            });
        });
        
        function redirectToDetail(id) {
            window.location.href = "?url=detail&id=" + id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybB5IXNxFwWQfE7u8Lj+XJHAxKlXiG/8rsrtpb6PEdzD828Ii" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</body>
</html>
