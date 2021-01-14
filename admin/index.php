<?php
    session_start();
    include("../config/koneksi2.php");
    include("../login/proses.php");

    if(!isset($_SESSION["username"])){
        echo'<script>
                alert("Mohon login dahulu !");
                window.location="../login/index.php";
            </script>';
        return false;
    }

    if($_SESSION["level"] != "admin"){
        echo'<script>
                alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                window.location="../index.php";
            </script>';
        return false;
    }
    require_once('../config/koneksi.php');
    require_once('../models/database.php');
    $connection = new Database($host, $user, $pass, $database);

    require_once('template/header.php');
    $page = 'page/dashboard.php';
    if(isset($_GET['page'])){
        $page='page/'.$_GET['page'].'.php';
    }else{
        $page = 'page/'.'dashboard.php';
    }
    require($page);
    require_once('template/footer.php');
?>
      