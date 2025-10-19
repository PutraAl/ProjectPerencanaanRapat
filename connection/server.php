<?php 
session_start();
$mysqli = mysqli_connect("localhost", "root", "", "db_rapat");
if($connection = mysqli_connect_error()) {
    echo "ERROR CONNECTION";
}
?>