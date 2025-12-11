<?php
include "../connection/server.php";
require_once "../services/SendGridService.php";

// API Key SendGrid 
// $SENDGRID_API_KEY = '';

// Ambil data dari form
$judul = mysqli_real_escape_string($mysqli, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($mysqli, $_POST['deskripsi']);
$tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);
$waktu = mysqli_real_escape_string($mysqli, $_POST['waktu']);
$lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$peserta = $_POST['peserta'];

// Validasi data
if (empty($judul) || empty($tanggal) || empty($waktu) || empty($lokasi) || empty($peserta)) {
    echo "<script>
            alert('Semua field harus diisi!');
            window.history.back();
          </script>";
    exit;
}

// Insert data rapat
$queryInsert = mysqli_query($mysqli, "INSERT INTO tb_rapat (judul, deskripsi, tanggal, waktu, lokasi, status) 
                                      VALUES ('$judul', '$deskripsi', '$tanggal', '$waktu', '$lokasi', '$status')");

if ($queryInsert) {

    // Ambil ID rapat yang baru saja dibuat
    $id_rapat = mysqli_insert_id($mysqli);

    // Inisialisasi SendGrid Service
    $sendGrid = new SendGridService($SENDGRID_API_KEY);

    // Ambil data rapat untuk email
    $queryRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_rapat'");
    $rapatData = mysqli_fetch_assoc($queryRapat);

    // Insert peserta dan kirim email
    $successPeserta = true;
    $emailCount = 0;

    foreach ($peserta as $id_user) {
        // Insert ke database
        $queryUndangan = mysqli_query($mysqli, "INSERT INTO tb_undangan VALUES (NULL, '$id_rapat', '$id_user', 'belum_dikonfirmasi', NULL)");

        if (!$queryUndangan) {
            $successPeserta = false;
            break;
        }

        // Ambil data user untuk email
        $queryUser = mysqli_query($mysqli, "SELECT nama, email FROM tb_user WHERE id_user = '$id_user'");
        $userData = mysqli_fetch_assoc($queryUser);

        // Kirim email undangan ke peserta
        if ($userData && !empty($userData['email'])) {
            $emailSent = $sendGrid->kirimUndangan(
                $userData['email'],
                $userData['nama'],
                $rapatData
            );

            if ($emailSent) {
                $emailCount++;
            }
        }
    }

    if ($successPeserta) {
        echo "<script>
                alert('Rapat berhasil ditambahkan! Email undangan telah dikirim ke peserta.');
                window.location.href='../admin/rapat.php';
              </script>";
    } else {
        echo "<script>
                alert('Rapat ditambahkan tapi gagal mengirim email ke beberapa peserta!');
                window.location.href='../admin/rapat.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal menambah data rapat: " . mysqli_error($mysqli) . "');
            window.history.back();
          </script>";
}
