<?php 
include "../connection/server.php";
$id_contact = $_GET['id'];

$query = mysqli_query($mysqli, "DELETE FROM tb_contact where id_contact = $id_contact");
if($query) {
    echo "
    <script>
    alert('Berhasil menghapus data');
    window.location.href = '../admin/contact.php';
    </script>
    ";
}
else {
     echo "
    <script>
    alert('Gagal menghapus data');
    window.location.href = '../admin/contact.php';
    </script>
    ";
}
?>