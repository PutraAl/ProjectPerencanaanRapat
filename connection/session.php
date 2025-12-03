<?php 
function middleware(){
//     if(!isset($_SESSION['login'] )) {
//     echo "
//     <script>
//     alert('Jangan coba login jika tidak login bro!');
//     window.location.href = '../index.php';
//     </script>
//     ";
// }
}

function logout() {
    session_destroy();
    header("location:../login.php");
    // echo "
    // <script>
    // alert('Berhasil Logout');
    // window.location.href = '../login.php';
    // </script>
    // ";
}
?>