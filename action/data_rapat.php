<?php
// ===================================
// MENGAMBIL FILTER DARI GET REQUEST
// ===================================
$filterTanggalDari   = $_GET['tanggal_dari']   ?? '';
$filterTanggalSampai = $_GET['tanggal_sampai'] ?? '';
$filterStatus        = $_GET['status']          ?? '';
$filterSearch        = $_GET['search']          ?? '';

// ===================================
// BUILD QUERY DENGAN FILTER & SEARCH
// ===================================
$query = "SELECT * FROM tb_rapat WHERE 1=1";

// Filter tanggal dari
if (!empty($filterTanggalDari)) {
    $filterTanggalDari_escaped = mysqli_real_escape_string($mysqli, $filterTanggalDari);
    $query .= " AND tanggal >= '$filterTanggalDari_escaped'";
}

// Filter tanggal sampai
if (!empty($filterTanggalSampai)) {
    $filterTanggalSampai_escaped = mysqli_real_escape_string($mysqli, $filterTanggalSampai);
    $query .= " AND tanggal <= '$filterTanggalSampai_escaped'";
}

// Filter status
if (!empty($filterStatus)) {
    $filterStatus_escaped = mysqli_real_escape_string($mysqli, $filterStatus);
    $query .= " AND status = '$filterStatus_escaped'";
}

// FILTER SEARCH - Cari di judul, deskripsi, lokasi
if (!empty($filterSearch)) {
    $filterSearch_escaped = mysqli_real_escape_string($mysqli, $filterSearch);
    $query .= " AND (judul LIKE '%$filterSearch_escaped%' 
               OR deskripsi LIKE '%$filterSearch_escaped%' 
               OR lokasi LIKE '%$filterSearch_escaped%')";
}

$query .= " ORDER BY tanggal DESC";

// ===================================
// PAGINATION SETUP
// ===================================
$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Hitung total data
$totalResult = mysqli_query($mysqli, $query);
if (!$totalResult) {
    die("Query error: " . mysqli_error($mysqli));
}
$totalData = mysqli_num_rows($totalResult);
$totalPages = ceil($totalData / $itemsPerPage);

// Validasi halaman
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
}

// Hitung offset
$offset = ($currentPage - 1) * $itemsPerPage;

// Query dengan LIMIT
$queryWithLimit = $query . " LIMIT $offset, $itemsPerPage";
$dataRapat = mysqli_query($mysqli, $queryWithLimit);

if (!$dataRapat) {
    die("Query error: " . mysqli_error($mysqli));
}

// ===================================
// HELPER FUNCTION UNTUK PAGINATION
// ===================================
function buildPaginationUrl($page, $filterTanggalDari = '', $filterTanggalSampai = '', $filterStatus = '', $filterSearch = '') {
    $params = ['page' => $page];
    if (!empty($filterTanggalDari)) $params['tanggal_dari'] = $filterTanggalDari;
    if (!empty($filterTanggalSampai)) $params['tanggal_sampai'] = $filterTanggalSampai;
    if (!empty($filterStatus)) $params['status'] = $filterStatus;
    if (!empty($filterSearch)) $params['search'] = $filterSearch;
    return '?' . http_build_query($params);
}

// ===================================
// STATS QUERIES (TANPA SEARCH)
// ===================================
$today = date('Y-m-d');
$weekStart = date('Y-m-d', strtotime('monday this week'));
$weekEnd = date('Y-m-d', strtotime('sunday this week'));

$rapatToday = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE DATE(tanggal) = '$today'");
$rapatMinggu = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE DATE(tanggal) BETWEEN '$weekStart' AND '$weekEnd'");
$rapatMendatang = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE tanggal > CURDATE()");
$rapatBelumSelesai = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE status != 'selesai'");

// ===================================
// CEK ABSENSI MODE
// ===================================
$absensiMode = false;
$rapatAbsensi = null;
$dataPesertaRapat = null;

if (isset($_GET['absensi'])) {
    $id_rapat = (int)$_GET['absensi'];
    $absensiMode = true;
    
    // Ambil data rapat
    $queryRapat = "SELECT * FROM tb_rapat WHERE id_rapat = $id_rapat";
    $resultRapat = mysqli_query($mysqli, $queryRapat);
    $rapatAbsensi = mysqli_fetch_assoc($resultRapat);
    
    // Ambil data peserta rapat
    $queryPeserta = "
        SELECT u.id_user, u.nama, u.email, un.id_undangan, un.status_kehadiran
        FROM tb_undangan un
        JOIN tb_user u ON un.id_peserta = u.id_user
        WHERE un.id_rapat = $id_rapat
        ORDER BY u.nama ASC
    ";
    $dataPesertaRapat = mysqli_query($mysqli, $queryPeserta);
}
?>