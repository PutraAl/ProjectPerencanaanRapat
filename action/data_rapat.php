<?php 
$id_user = $_SESSION['id_user'];
$data = mysqli_query($mysqli, "SELECT * FROM tb_user where id_user = '$id_user'")->fetch_array();
$today = date('y-m-d');
$target = date('y-m-d', strtotime('+ 7 days'));
$rapatMendatang = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE tanggal >= '$today' AND status = 'dijadwalkan';");
$rapatToday = mysqli_query($mysqli, "SELECT * FROM tb_rapat where tanggal ='$today' and status = 'dijadwalkan' ");
$rapatMinggu = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE tanggal >= '$today' and tanggal <= '$target' and status ='dijadwalkan'");
$rapatBelumSelesai = mysqli_query($mysqli, "SELECT * FROM tb_rapat where status = 'dijadwalkan'");

// Ambil parameter filter dari GET
$filterTanggalDari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$filterTanggalSampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

// Build query dengan filter
$queryString = "SELECT * FROM tb_rapat WHERE 1=1 ";

if (!empty($filterTanggalDari)) {
  $queryString .= " AND tanggal >= '" . mysqli_real_escape_string($mysqli, $filterTanggalDari) . "'";
}

if (!empty($filterTanggalSampai)) {
  $queryString .= " AND tanggal <= '" . mysqli_real_escape_string($mysqli, $filterTanggalSampai) . "'";
}

if (!empty($filterStatus)) {
  $queryString .= " AND status = '" . mysqli_real_escape_string($mysqli, $filterStatus) . "'";
}

$queryString .= " ORDER BY id_rapat DESC";

// PAGINATION SETUP
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Hitung total data
$totalResult = mysqli_query($mysqli, $queryString);
$totalData = mysqli_num_rows($totalResult);
$totalPages = ceil($totalData / $itemsPerPage);

// Validasi halaman
if ($currentPage > $totalPages && $totalPages > 0) {
  $currentPage = $totalPages;
}

// Hitung offset
$offset = ($currentPage - 1) * $itemsPerPage;

// Query dengan LIMIT
$queryWithLimit = $queryString . " LIMIT $offset, $itemsPerPage";
$dataRapat = mysqli_query($mysqli, $queryWithLimit);

// Helper function untuk membuat URL dengan filter & pagination
function buildPaginationUrl($page, $filterTanggalDari = '', $filterTanggalSampai = '', $filterStatus = '') {
  $params = ['page' => $page];
  if (!empty($filterTanggalDari)) $params['tanggal_dari'] = $filterTanggalDari;
  if (!empty($filterTanggalSampai)) $params['tanggal_sampai'] = $filterTanggalSampai;
  if (!empty($filterStatus)) $params['status'] = $filterStatus;
  return '?' . http_build_query($params);
}

// Cek apakah ada mode edit
$editMode = false;
$rapatEdit = null;
$pesertaTerpilih = [];

// Cek apakah ada mode absensi
$absensiMode = false;
$rapatAbsensi = null;
$dataPesertaRapat = null;

if (isset($_GET['absensi'])) {
  $absensiMode = true;
  $id_absensi = mysqli_real_escape_string($mysqli, $_GET['absensi']);
  $queryAbsensi = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_absensi' AND status = 'selesai'");

  if (mysqli_num_rows($queryAbsensi) > 0) {
    $rapatAbsensi = mysqli_fetch_array($queryAbsensi);

    // Ambil data peserta rapat beserta status kehadiran
    $dataPesertaRapat = mysqli_query($mysqli, "
            SELECT u.*, tu.id_undangan, tu.status_kehadiran 
            FROM tb_undangan tu
            JOIN tb_user u ON tu.id_peserta = u.id_user
            WHERE tu.id_rapat = '$id_absensi'
            ORDER BY u.nama ASC
        ");
  } else {
    // Redirect jika rapat belum selesai
    echo "<script>
                alert('Absensi hanya bisa diakses untuk rapat yang sudah selesai!');
                window.location.href='rapat.php';
              </script>";
    exit;
  }
}

if (isset($_GET['edit'])) {
  $editMode = true;
  $id_edit = mysqli_real_escape_string($mysqli, $_GET['edit']);
  $queryEdit = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_edit'");
  $rapatEdit = mysqli_fetch_array($queryEdit);

  // Ambil peserta yang sudah terpilih
  $queryPesertaTerpilih = mysqli_query($mysqli, "SELECT id_peserta FROM tb_undangan WHERE id_rapat = '$id_edit'");
  while ($row = mysqli_fetch_array($queryPesertaTerpilih)) {
    $pesertaTerpilih[] = $row['id_peserta'];
  }
}
?>