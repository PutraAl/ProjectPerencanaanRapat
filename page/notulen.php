<?php
include "../connection/server.php";

if (!isset($_GET['id'])) {
    echo "<p>Notulen tidak ditemukan.</p>";
    exit;
}

$id_rapat = $_GET['id'];

$data = mysqli_query($mysqli, "
    SELECT judul, tanggal, waktu, notulen
    FROM tb_rapat
    WHERE id_rapat = '$id_rapat'
");

$rapat = mysqli_fetch_assoc($data);

if (!$rapat) {
    echo "<p>Data rapat tidak ditemukan.</p>";
    exit;
}
?>
