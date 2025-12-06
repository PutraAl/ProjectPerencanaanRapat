<?php 
include "../connection/server.php";

if(isset($_GET['id'])) {
    
    $id_rapat = mysqli_real_escape_string($mysqli, $_GET['id']);
    
    // Hapus peserta rapat terlebih dahulu (foreign key)
    $queryHapusUndangan = mysqli_query($mysqli, "DELETE FROM tb_undangan WHERE id_rapat = '$id_rapat'");
    
    // Hapus data rapat
    $queryHapusRapat = mysqli_query($mysqli, "DELETE FROM tb_rapat WHERE id_rapat = '$id_rapat'");
    
    if($queryHapusRapat) {
        echo "<script>
                alert('Data rapat berhasil dihapus!');
                window.location.href='../admin/rapat.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data rapat: " . mysqli_error($mysqli) . "');
                window.location.href='../admin/rapat.php';
              </script>";
    }
    
} else {
    header("Location: ../admin/rapat.php");
    exit;
}
?>