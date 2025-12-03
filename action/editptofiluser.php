<?php
require_once "config.php";
require_once "session.php";

middleware(); // pastikan user login

$userId = $_SESSION['id_user']; // ambil user dari session

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if($method === 'GET'){
    // Ambil data profil user
    $sql = "SELECT name, email, department, position, phone FROM users WHERE id=$userId";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        echo json_encode($row);
    } else {
        echo json_encode(['message'=>'User tidak ditemukan']);
    }

} elseif($method === 'POST'){
    // Update profil user
    $data = json_decode(file_get_contents('php://input'), true);

    $name = mysqli_real_escape_string($conn, $data['name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $department = mysqli_real_escape_string($conn, $data['department']);
    $position = mysqli_real_escape_string($conn, $data['position']);
    $phone = mysqli_real_escape_string($conn, $data['phone']);

    $sql = "UPDATE users SET 
            name='$name', 
            email='$email', 
            department='$department', 
            position='$position', 
            phone='$phone' 
            WHERE id=$userId";

    if(mysqli_query($conn, $sql)){
        echo json_encode(['message'=>'Profil berhasil diupdate']);
    } else {
        echo json_encode(['message'=>'Update gagal', 'error'=>mysqli_error($conn)]);
    }
}
?>
