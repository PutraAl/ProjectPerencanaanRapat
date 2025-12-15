<?php
include "../connection/server.php";

if (!isset($_GET['id'])) {
    die("Notulen tidak ditemukan.");
}

$id_rapat = $_GET['id'];

$query = mysqli_query($mysqli, "
    SELECT judul, tanggal, waktu, notulen
    FROM tb_rapat
    WHERE id_rapat = '$id_rapat'
");

$data = mysqli_fetch_assoc($query);

if (!$data || empty($data['notulen'])) {
    die("Notulen belum tersedia.");
}

/* Nama file */
$filename = "Notulen_" . preg_replace("/[^a-zA-Z0-9]/", "_", $data['judul']) . ".txt";

/* Header download */
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"$filename\"");

/* Isi file */
echo "NOTULEN RAPAT\n";
echo "=====================\n";
echo "Judul   : {$data['judul']}\n";
echo "Tanggal : {$data['tanggal']}\n";
echo "Waktu   : {$data['waktu']}\n\n";
echo "ISI NOTULEN:\n";
echo "---------------------\n";
echo $data['notulen'];

exit;
