<?php
include "../connection/server.php";

$idRapat = 1;
$idProdi = 2;
$idJurusan = 2;


if($idJurusan != '' || $idJurusan != NULL ) {
    $idUser = mysqli_query($mysqli, "SELECT * FROM tb_user a join tb_prodi b ON a.id_prodi = b.id_prodi where b.id_jurusan = '$idJurusan'; ");
    while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,id_jurusan, status_kehadiran) VALUES ('$idRapat', '$userID',  '$idJurusan', 'belum_dikonfirmasi')");
    }
}
elseif($idProdi != '' || $idProdi != NULL ) {
    // $queryJurusan = mysqli_query($mysqli, "SELECT tb_jurusan.id_jurusan FROM tb_prodi join tb_jurusan on tb_jurusan.id_jurusan = tb_prodi.id_jurusan WHERE tb_jurusan.id_jurusan = '$idJurusan';");
    $idUser = mysqli_query($mysqli, "SELECT * FROM tb_user where id_prodi = '$idProdi' ");
    $queryJurusan = mysqli_query($mysqli, "SELECT * from tb_prodi a join tb_jurusan b on a.id_jurusan = b.id_jurusan where id_prodi = '$idProdi';");
    $rowJurusan = $queryJurusan->fetch_array();
    $JurusanID = $rowJurusan['id_jurusan'];
     while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        // $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,  id_prodi,id_jurusan, status_kehadiran) VALUES ('$idRapat', '$userID', '$idProdi', '$JurusanID', 'belum_dikonfirmasi')");
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,  id_prodi,id_jurusan, status_kehadiran) VALUES ('$idRapat', '$userID', '$idProdi', '$JurusanID', 'belum_dikonfirmasi')");
    }
}
else {
     while($row = $idUser->fetch_array()) {
        $userID = $row['id_user'];
        $query = mysqli_query($mysqli, "INSERT INTO tb_undangan (id_rapat, id_peserta,   status_kehadiran) VALUES ('$idRapat', '$userID', 'belum_dikonfirmasi')");
    }
}

?>