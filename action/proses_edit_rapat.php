<?php 
include "../connection/server.php";



$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$peserta =  $_POST['peserta'];
$waktu = mysqli_real_escape_string($mysqli,$_POST['waktu']);
$id_rapat = $_POST['id_rapat'];

$queryRapat = mysqli_query($mysqli, "UPDATE tb_rapat  SET judul = '$judul', deskripsi = '$deskripsi', tanggal = '$tanggal', lokasi = '$lokasi', status = '$status', waktu = '$waktu' WHERE id_rapat = '$id_rapat' ");

if($queryRapat) {


    $successPeserta = true;
   foreach($peserta as $id_user) {
    $queryUndangan = mysqli_query($mysqli, "UPDATE tb_undangan SET id_rapat ='$id_rapat' WHERE id_peserta = '$id_user'");
    // $deleteUndangan = mysqli_query($mysqli, "DELETE FROM tb_undangan where id_rapat = '$id_rapat' AND id_peserta != '$id_user';");

    if(!$queryUndangan) {
        $successPeserta = false;
        break;
    }
   }

   if($successPeserta) {
            echo "<script>
                    alert('Data rapat berhasil diedit!');
                    window.location.href='../admin/rapat.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal edit peserta rapat!');
                    window.location.href='../admin/rapat.php';
                  </script>";
        }
 
        

}
else {
        echo "<script>
                alert('Gagal menambahkan data rapat: " . mysqli_error($mysqli) . "');
                window.history.back();
              </script>";
    }
?>