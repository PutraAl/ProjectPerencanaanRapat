<?php
include "../connection/server.php";

if(isset($_POST['absen_user'])) {
    $id_user = $_POST['id_user'];
    $id_undangan = $_POST['id_undangan'];
    $query = mysqli_query($mysqli, "UPDATE tb_undangan SET status_kehadiran = 'hadir', waktu_konfirmasi = NOW() WHERE id_peserta = '$id_user' AND id_undangan = '$id_undangan'");
    if($query) {
        echo "
        <script>
        alert('Berhasil konfirmasi kehadiran');
        window.location.href = '../page/undangan.php' ;
        </script>
        ";
    }
    else {
         echo "
        <script>
        alert('Gagal konfirmasi kehadiran');
        window.location.href = '../page/undangan.php' ;
        </script>
        ";
    }
}

if (isset($_POST['absen_admin'])) {

    $id_rapat = mysqli_real_escape_string($mysqli, $_POST['id_rapat']);
    $hadirList = isset($_POST['kehadiran']) ? $_POST['kehadiran'] : [];

    // 1. Update semua peserta menjadi TIDAK HADIR dulu
    $updateTidakHadir = mysqli_query($mysqli, "
        UPDATE tb_undangan 
        SET status_kehadiran = 'tidak_hadir', 
            waktu_konfirmasi = NOW()
        WHERE id_rapat = '$id_rapat'
    ");

    if (!$updateTidakHadir) {
        die("Error: " . mysqli_error($mysqli));
    }

    // 2. Jika ada yang hadir (checkbox dicentang)
    if (!empty($hadirList)) {
        foreach ($hadirList as $id_undangan) {
            $id = mysqli_real_escape_string($mysqli, $id_undangan);

            mysqli_query($mysqli, "
                UPDATE tb_undangan
                SET status_kehadiran = 'hadir',
                    waktu_konfirmasi = NOW()
                WHERE id_undangan = '$id'
            ");
        }
    }

    echo "<script>
            alert('Absensi berhasil disimpan!');
            window.location.href='../admin/rapat.php';
          </script>";
}
?>
