<?php 
include "../connection/server.php";


// Delete user
if(isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $query = mysqli_query($mysqli, "DELETE FROM tb_user where id_user = $id_user");
    if($query) {
        echo "
        <script>
        alert('Berhasil menghapus data');
        window.location.href = '../admin/user.php';
        </script>
        ";
    }
}

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = $_POST['password'] != "" ? mysqli_real_escape_string($mysqli, md5($_POST['password'])) : "";
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$role = $_POST['role'];
$checkUser = mysqli_query($mysqli, "SELECT * FROM tb_user where id_user = $id_user");
$data = $checkUser->fetch_array();

if($username != $data['username']) {
    $checkUsername = mysqli_query($mysqli, "SELECT * FROM tb_user where username = '$username' and id_user != '$id_user'");
    if($checkUsername->num_rows>0){
        echo "
        <script>
        alert('Username telah digunakan!');
        window.location.href = '../admin/user.php'; 
        </script>
        ";
        exit;
    }


}

if($password != "" OR !empty($password)) {
                $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', email = '$email', role = '$role' WHERE id_user = $id_user ");
                if($query) {
                     echo "
                        <script>
                        alert('Berhasil edit profile')
                        window.location.href ='../admin/user.php';
                        </script>
                        ";
                }
            } 
            else {
               $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', email = '$email', role = '$role' WHERE id_user = $id_user "); 
                if($query) {
                     echo "
                        <script>
                        alert('Berhasil edit profile')
                        window.location.href ='../admin/user.php';
                        </script>
                        ";
                }
            }

?>