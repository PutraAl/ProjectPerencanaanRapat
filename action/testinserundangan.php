<?php
include "../connection/server.php";

$idRapat = 1;
$idProdi = '';
$idJurusan = 1;
$idUser = mysqli_query($mysqli, "SELECT * FROM tb_user");


if($idJurusan != '' || $idJurusan != NULL ) {
    while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,id_jurusan, status_kehadiran) VALUES ('$idRapat', '$userID',  '$idJurusan', 'belum_dikonfirmasi')");
    }
}
elseif($idProdi != '' || $idProdi != NULL ) {
    $queryJurusan = mysqli_query($mysqli, "SELECT tb_jurusan.id_jurusan FROM tb_prodi join tb_jurusan on tb_jurusan.id_jurusan = tb_prodi.id_jurusan WHERE tb_jurusan.id_jurusan = '$idJurusan';");
    $rowJurusan = $queryJurusan->fetch_array();
    $JurusanID = $rowJurusan['id_jurusan'];
     while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,  id_prodi,id_jurusan, status_kehadiran) VALUES ('$idRapat', '$userID', '$idProdi', '$jurusanID', 'belum_dikonfirmasi')");
    }
}
else {
     while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,   status_kehadiran) VALUES ('$idRapat', '$userID', 'belum_dikonfirmasi')");
    }
}

?>