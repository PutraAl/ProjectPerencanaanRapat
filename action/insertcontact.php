<?php 
include "../connection/server.php";

$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
$keluhan = mysqli_real_escape_string($mysqli, $_POST['keluhan']);

$query = mysqli_query($mysqli, "INSERT INTO tb_contact VALUES (NULL, '$email', '$nama', '$keluhan')");

if($query) {
    echo "
    <script>
    alert('Berhasil Melapor, silahkan tunggu respon :)');
    window.location.href = '../index.php';
    </script>
    ";
}
else {
        echo "
    <script>
    alert('Laporan gagal dikirim, pastikan isi form dengan benar');
    window.location.href = '../index.php';
    </script>
    ";
}

?>