<?php
require_once('../config/koneksi.php');
require_once('database.php');
include "m_product.php";
$connection = new Database($host, $user, $pass, $database);
$product = new Barang($connection);

$id_product = $_POST['id_product'];
$name = $connection->conn->real_escape_string($_POST['name']);
$price = $connection->conn->real_escape_string($_POST['price']);
$category = $connection->conn->real_escape_string($_POST['category']);

$pict = $_FILES['image']['name'];
$extensi = explode(".", $_FILES['image']['name']);
$image = "img-" .round(microtime(true)). "." .end($extensi);
$sumber = $_FILES['image']['tmp_name'];

if($pict == '') {
    $product->edit("UPDATE product SET name ='$name', price ='$price', category ='$category' WHERE id_product = '$id_product'");
    echo "<script>window.location='?page=template_premium'; </script>";
}else {
    $img_awal = $product->tampil($id_product)->fetch_object()->image;
    unlink("../upload/img_product/". $img_awal);

    $upload = move_uploaded_file($sumber, "../upload/img_product/".$image);
    if($upload){
        $product->edit("UPDATE product SET name ='$name', price ='$price', category ='$category', image ='$image' WHERE id_product = '$id_product'");
        echo "<script>window.location='?page=template_premium'; </script>";
    }else{
        echo "<script>alert('upload image filed')</script>";
    }
}
?>