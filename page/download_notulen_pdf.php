<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../connection/server.php";
require_once "../lib/fpdf.php";

// keamanan ringan (tanpa middleware)
if (!isset($_SESSION['id_user'])) {
    die("Akses ditolak");
}

$id_rapat = $_GET['id'] ?? null;
if (!$id_rapat) {
    die("ID rapat tidak ditemukan");
}

// Query data
$query = mysqli_query($mysqli, "
    SELECT judul, tanggal, waktu, notulen
    FROM tb_rapat
    WHERE id_rapat = '$id_rapat'
");

$row = mysqli_fetch_assoc($query);
if (!$row) {
    die("Data notulen tidak ditemukan");
}

// =======================
// GENERATE PDF
// =======================
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'NOTULEN RAPAT',0,1,'C');
$pdf->Ln(4);

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,'Judul   : '.$row['judul'],0,1);
$pdf->Cell(0,8,'Tanggal : '.$row['tanggal'],0,1);
$pdf->Cell(0,8,'Waktu   : '.$row['waktu'],0,1);
$pdf->Ln(5);

$pdf->MultiCell(0,7,$row['notulen']);

$filename = "Notulen_".$row['judul'].".pdf";
$pdf->Output('D', $filename);
exit;
