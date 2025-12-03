<?php 
include "../connection/server.php";



$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$id_user = mysqli_real_escape_string($mysqli, $_POST['peserta']);

?>