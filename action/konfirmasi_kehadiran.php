<?php
include "../connection/server.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
