<?php 
require_once "../connection/middleware.php";
middlewareUser();
$id_user = $_SESSION['id_user'];
$hari = date('y-m-d');
$target = date('y-m-d', strtotime('+ 7 days'));
$totalUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan a join tb_rapat b on a.id_rapat = b.id_rapat WHERE id_peserta = '$id_user' AND status = 'dijadwalkan' ");
$rapatSelesai = mysqli_query($mysqli, "SELECT * FROM tb_rapat a join tb_undangan b ON a.id_rapat = b.id_rapat WHERE id_peserta = $id_user AND status = 'selesai';");
$rapatMendatang = mysqli_query($mysqli, "SELECT * FROM tb_rapat a join tb_undangan b on a.id_rapat = b.id_rapat WHERE tanggal >= '$hari' AND id_peserta = $id_user AND status = 'dijadwalkan';");
$rapatToday = mysqli_query($mysqli, "SELECT * FROM tb_undangan a join tb_rapat b ON a.id_rapat = b.id_rapat WHERE id_peserta = $id_user AND tanggal = '$hari' AND status = 'dijadwalkan'");
$rapatMinggu = mysqli_query($mysqli, "SELECT * FROM tb_undangan a join tb_rapat b ON a.id_rapat = b.id_rapat WHERE tanggal >= '$hari' and tanggal <= '$target' and id_peserta = $id_user and status ='dijadwalkan'");
?>