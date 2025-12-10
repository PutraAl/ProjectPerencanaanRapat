<?php 
include "../connection/server.php";

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = $_POST['password'] != "" ? mysqli_real_escape_string($mysqli, md5($_POST['password'])) : "";
$email = mysqli_real_escape_string($mysqli, $_POST['email']);

$checkUser = mysqli_query($mysqli, "SELECT * FROM tb_user where id_user = $id_user");
$data = $checkUser->fetch_array();

if($username != $data['username']) {
    $checkUsername = mysqli_query($mysqli, "SELECT * FROM tb_user where username = '$username' and id_user != '$id_user'");
    if($checkUsername->num_rows>0){
        echo "
        <script>
        alert('Username telah digunakan!');
        window.location.href = '../page/profil.php'; 
        </script>
        ";
        exit;
    }


}

if($password != "" OR !empty($password)) {
                $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', email = '$email' WHERE id_user = $id_user ");
                if($query) {
                     echo "
                        <script>
                        alert('Berhasil edit profile')
                        window.location.href ='../page/profil.php';
                        </script>
                        ";
                }
            } 
            else {
               $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', email = '$email' WHERE id_user = $id_user "); 
                if($query) {
                     echo "
                        <script>
                        alert('Berhasil edit profile')
                        window.location.href ='../page/profil.php';
                        </script>
                        ";
                }
            }

?>