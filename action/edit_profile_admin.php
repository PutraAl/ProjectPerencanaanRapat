<?php 
include "../connection/server.php";

$id_user = mysqli_real_escape_string($mysqli, $_POST['id_user']);
$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = $_POST['password'] != "" ? mysqli_real_escape_string($mysqli, md5($_POST['password'])) : "";
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$foto = $_FILES['foto']['name'];
$tmp_foto = $_FILES['foto']['tmp_name'];
$folder = '../assets/uploads/profile/';

// Validasi input
if(empty($nama) || empty($username) || empty($email)) {
    echo "<script>
        alert('Nama, username, dan email tidak boleh kosong!');
        window.location.href = '../admin/profile.php';
    </script>";
    exit;
}

// Cek user yang akan diupdate
$checkUser = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE id_user = $id_user");
if($checkUser->num_rows == 0) {
    echo "<script>
        alert('User tidak ditemukan!');
        window.location.href = '../admin/profile.php';
    </script>";
    exit;
}
$data = $checkUser->fetch_array();

// Cek username jika berubah
if($username != $data['username']) {
    $checkUsername = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND id_user != '$id_user'");
    if($checkUsername->num_rows > 0) {
        echo "<script>
            alert('Username telah digunakan!');
            window.location.href = '../admin/profile.php';
        </script>";
        exit;
    }
}

// Variable untuk update foto
$updateFoto = "";
$fotoName = $data['foto']; // foto lama sebagai default

// Jika ada upload foto baru
if(!empty($foto)) {
    // Validasi file foto
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $filename = $foto;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    if(!in_array($ext, $allowed)) {
        echo "<script>
            alert('Format foto harus JPG, JPEG, PNG, atau GIF!');
            window.location.href = '../admin/profile.php';
        </script>";
        exit;
    }
    
    // Cek ukuran file (max 2MB)
    if($_FILES['foto']['size'] > 2097152) {
        echo "<script>
            alert('Ukuran foto tidak boleh lebih dari 2MB!');
            window.location.href = '../admin/profile.php';
        </script>";
        exit;
    }
    
    // Generate nama file unik
    $fotoName = time() . '_' . $filename;
    
    // Hapus foto lama jika ada
    if($data['foto'] != "" && file_exists($folder . $data['foto'])) {
        unlink($folder . $data['foto']);
    }
    
    // Upload foto baru
    if(move_uploaded_file($tmp_foto, $folder . $fotoName)) {
        $updateFoto = ", foto = '$fotoName'";
    } else {
        echo "<script>
            alert('Gagal upload foto!');
            window.location.href = '../admin/profile.php';
        </script>";
        exit;
    }
}

// Update profile dengan atau tanpa password
if($password != "" && !empty($password)) {
    $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', email = '$email' $updateFoto WHERE id_user = $id_user");
} else {
    $query = mysqli_query($mysqli, "UPDATE tb_user SET nama = '$nama', username = '$username', email = '$email' $updateFoto WHERE id_user = $id_user");
}

// Cek hasil update
if($query) {
    echo "<script>
        alert('Berhasil edit profile!');
        window.location.href = '../admin/profile.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal update profile: " . mysqli_error($mysqli) . "');
        window.location.href = '../admin/profile.php';
    </script>";
}
?>