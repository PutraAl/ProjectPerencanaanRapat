<?php 
include "../connection/server.php";



$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$peserta =  $_POST['peserta'];
$waktu = $_POST['waktu'];
$jadwal = mysqli_real_escape_string($mysqli, $_POST['status']);

$queryRapat = mysqli_query($mysqli, "INSERT INTO tb_rapat VALUES (NULL, '$judul', '$deskripsi', '$tanggal', '$waktu', '$lokasi', 1, NULL, '$status')");

if($queryRapat) {

    $id_rapat = mysqli_insert_id($mysqli);

    $successPeserta = true;
   foreach($peserta as $id_user) {
    $queryUndangan = mysqli_query($mysqli, "INSERT INTO tb_undangan VALUES (NULL, '$id_rapat', '$id_user', 'belum_dikonfirmasi', NULL)");

    if(!$queryUndangan) {
        $successPeserta = false;
        break;
    }
   }

   if($successPeserta) {
            echo "<script>
                    alert('Data rapat berhasil ditambahkan!');
                    window.location.href='../admin/rapat.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan peserta rapat!');
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