<?php 
include "../connection/server.php";

// Ambil data dari form
$id_rapat = mysqli_real_escape_string($mysqli, $_POST['id_rapat']);
$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$peserta = $_POST['peserta'];
$waktu = $_POST['waktu'];
$notulen = mysqli_real_escape_string($mysqli, $_POST['notulen']); // Ambil notulen

// Validasi data
if(empty($id_rapat) || empty($judul) || empty($tanggal) || empty($waktu) || empty($lokasi) || empty($peserta)) {
    echo "<script>
            alert('Semua field harus diisi!');
            window.history.back();
          </script>";
    exit;
}

// Update data rapat
$queryUpdate = mysqli_query($mysqli, "UPDATE tb_rapat SET 
                                      judul = '$judul',
                                      deskripsi = '$deskripsi',
                                      tanggal = '$tanggal',
                                      waktu = '$waktu',
                                      lokasi = '$lokasi',
                                      status = '$status',
                                      notulen = '$notulen'
                                      WHERE id_rapat = '$id_rapat'");

if($queryUpdate) {
    
    // Hapus peserta lama dari tb_undangan
    mysqli_query($mysqli, "DELETE FROM tb_undangan WHERE id_rapat = '$id_rapat'");
    
    // Insert peserta baru
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
                alert('Data rapat berhasil diupdate!');
                window.location.href='../admin/rapat.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate peserta rapat!');
                window.location.href='../admin/rapat.php';
              </script>";
    }
    
} else {
    echo "<script>
            alert('Gagal mengupdate data rapat: " . mysqli_error($mysqli) . "');
            window.history.back();
          </script>";
}
?>