<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');

$mysqli = mysqli_connect("localhost", "root", "", "db_rapat");
if (mysqli_connect_error()) {
    echo "ERROR CONNECTION: " . mysqli_connect_error();
    exit(); // Menghentikan eksekusi skrip jika koneksi gagal
}

?>