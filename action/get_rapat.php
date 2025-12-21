<?php
// File: ../action/get_rapat_ajax.php
// PENTING: Jangan include atau require file lain yang bisa output HTML

// Mulai output buffering dan bersihkan semua
@ob_end_clean();
ob_start();

// Set header JSON DULUAN
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');

// Koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_rapat'; // Sesuaikan nama DB Anda

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    ob_end_clean();
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$mysqli->set_charset("utf8mb4");

// Validasi request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    echo json_encode(['error' => 'Invalid method']);
    exit;
}

if (!isset($_POST['action']) || $_POST['action'] !== 'get_rapat') {
    ob_end_clean();
    echo json_encode(['error' => 'Invalid action']);
    exit;
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    ob_end_clean();
    echo json_encode(['error' => 'ID rapat tidak ditemukan']);
    exit;
}

$id = intval($_POST['id']); // Convert ke integer untuk keamanan

$query = "
    SELECT r.*, GROUP_CONCAT(u.id_user) as peserta_ids
    FROM tb_rapat r
    LEFT JOIN tb_undangan u ON r.id_rapat = u.id_rapat
    WHERE r.id_rapat = $id
    GROUP BY r.id_rapat
";

$result = $mysqli->query($query);

if (!$result) {
    ob_end_clean();
    echo json_encode(['error' => 'Query failed: ' . $mysqli->error]);
    exit;
}

$data = $result->fetch_assoc();

if (!$data) {
    ob_end_clean();
    echo json_encode(['error' => 'Data not found', 'id' => $id]);
    exit;
}

// Clear buffer dan output JSON
ob_end_clean();
echo json_encode($data);
exit;
?>