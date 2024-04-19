<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM gallery_komentarfoto WHERE KomentarID=$id";
    mysqli_query($conn, $query);
}else if($url=='detail'){
    include '?url=detail';
}
?>