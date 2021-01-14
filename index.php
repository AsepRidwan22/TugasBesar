<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <ul class="menu">
            <li class="logo"><a href="#"><img src="upload/logo.svg" alt="logo"></a></li>
            <li class="item"><a href="index.php">HOME</a></li>
            <li class="item"><a href="index.php?page=free-template">FREE TEMPLATE</a></li>
            <li class="item"><a href="index.php?page=premium-template">PREMIUM TEMPLATE</a></li>
            <li class="item"><a href="index.php?page=theme-sale">THEME SALE</a></li>
            <li class="item"><a href="index.php?page=about">ABOUT</a></li>
            <?php
                session_start();
                include("config/koneksi2.php");
                include("login/proses.php");

                if(!isset($_SESSION["username"])){
                    echo'<li class="item button"><a href="login/">LOGIN</a></li>';
                }else{
                    echo'<li class="item button"><a href="login/logout.php">LOGOUT</a></li>';
                }
            ?>
            <li class="toggle"><p>&#9776</p></li>
        </ul>
    </nav>
    <main>
        <div class="container"> 
            <?php
                $page = 'page/home.php';
                if(isset($_GET['page'])){
                    $page='page/'.$_GET['page'].'.php';
                }else{
                    $page = 'page/'.'home.php';
                }
                require($page);
            ?>
            <br>
        </div>
    </main>
    <foooter class="footer">
        <ul class="menu-footer">
            <li class="item-footer"><i class="fas fa-user-circle"></i><a href="#">About</a></li>
            <li class="item-footer"><i class="fas fa-paper-plane"></i><a href="#">Contact</a></li>
            <li class="item-footer"><i class="fas fa-check-square"></i><a href="#">Disclaimer</a></li>
            <li class="item-footer"><i class="fas fa-exclamation-triangle"></i><a href="#">Privacy Policy</a></li>
            <li class="item-footer"><i class="far fa-folder-open"></i><a href="#">Sitemap</a></li>
        </ul>
    </foooter>
    <div class="copyright">
        <div class="wrapper-copyright">
            <p>Copyright © 2015 - 2020 Arlina All Right Reserved</p>
            <p>Created with by <a href="#">Idntheme</a></p>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".toggle").on("click", function(){
                if($(".item").hasClass("active")){
                    $(".item").removeClass("active");
                }
                else{
                    $(".item").addClass("active");
                }
            });
        })
        
    </script>
</body>
</html>

