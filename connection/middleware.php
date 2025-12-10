<?php 
error_reporting(0);
function middlewareAdmin(){
    if(!$_SESSION['login']) {
        echo "
        <script>
        alert('Harap login dahulu!')
        window.location.href = '../login.php'
        </script>
        ";
        exit;
    }
    else if($_SESSION['role'] != 'admin') {
        echo "
        <script>
        alert('Jangan coba-coba mau masuk ya adik!')
        window.history.back()
        </script>
        ";
        exit;
    }
   
}

function middlewareUser() {
     if(!$_SESSION['login']) {
        echo "
        <script>
        alert('Harap login dahulu!')
        window.location.href = '../login.php'
        </script>
        ";
        exit;
    }
    else if($_SESSION['role'] != 'user') {
        echo "
        <script>
        alert('Jangan coba-coba mau masuk ya adik!')
        window.history.back()
        </script>
        ";
        exit;
    }
}


?>