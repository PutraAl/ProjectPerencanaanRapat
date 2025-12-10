<?php 
include "../connection/server.php";
require_once "../services/SendGridService.php";

// API Key SendGrid 
$SENDGRID_API_KEY = '';

// Ambil data dari form
$id_rapat = mysqli_real_escape_string($mysqli, $_POST['id_rapat']);
$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$peserta = $_POST['peserta'];
$waktu = $_POST['waktu'];
$notulen = mysqli_real_escape_string($mysqli, $_POST['notulen']);

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
    
    // Ambil peserta lama dari database
    $queryPesertaLama = mysqli_query($mysqli, "SELECT id_peserta FROM tb_undangan WHERE id_rapat = '$id_rapat'");
    $pesertaLama = array();
    
    while($row = mysqli_fetch_assoc($queryPesertaLama)) {
        $pesertaLama[] = $row['id_peserta'];
    }
    
    // Cari peserta yang akan dihapus dan yang akan ditambah
    $pesertaHapus = array_diff($pesertaLama, $peserta);
    $pesertaBaru = array_diff($peserta, $pesertaLama);
    
    $successUpdate = true;
    
    // Inisialisasi SendGrid Service
    $sendGrid = new SendGridService($SENDGRID_API_KEY);
    
    // Ambil data rapat untuk email
    $queryRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_rapat'");
    $rapatData = mysqli_fetch_assoc($queryRapat);
    
    // Hapus hanya peserta yang tidak dipilih lagi
    if(!empty($pesertaHapus)) {
        foreach($pesertaHapus as $id_user) {
            $queryDelete = mysqli_query($mysqli, "DELETE FROM tb_undangan WHERE id_rapat = '$id_rapat' AND id_peserta = '$id_user'");
            
            if(!$queryDelete) {
                $successUpdate = false;
                break;
            }
        }
    }
    
    // Insert hanya peserta baru dan kirim email
    if($successUpdate && !empty($pesertaBaru)) {
        foreach($pesertaBaru as $id_user) {
            // Insert ke database
            $queryUndangan = mysqli_query($mysqli, "INSERT INTO tb_undangan VALUES (NULL, '$id_rapat', '$id_user', 'belum_dikonfirmasi', NULL)");
            
            if(!$queryUndangan) {
                $successUpdate = false;
                break;
            }
            
            // Ambil data user untuk email
            $queryUser = mysqli_query($mysqli, "SELECT nama, email FROM tb_user WHERE id_user = '$id_user'");
            $userData = mysqli_fetch_assoc($queryUser);
            
            // Kirim email ke peserta baru
            if($userData && !empty($userData['email'])) {
                $sendGrid->kirimNotifikasiDitambahkan(
                    $userData['email'],
                    $userData['nama'],
                    $rapatData
                );
            }
        }
    }
    
    if($successUpdate) {
        echo "<script>
                alert('Data rapat berhasil diupdate! Email telah dikirim ke peserta baru.');
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