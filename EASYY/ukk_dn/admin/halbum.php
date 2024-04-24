<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM gallery_album WHERE AlbumID=$id";
    mysqli_query($conn, $query);
    header('location: admin.php');
}
?>