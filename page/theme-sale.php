<?php
    require_once('config/koneksi.php');
    require_once('models/database.php');
    include "models/m_product.php";
    $connection = new Database($host, $user, $pass, $database);
    $product = new Barang($connection);
    $page = "theme-sale";
    $tampil = $product->tampil2($page);
    while($data = $tampil->fetch_object()){
?>
<div class="list-wrapper">
    <div class="list-items">
        <div class="content">
            <aside class="aside">
                <a href=""><img src="upload/img_product/<?php echo $data->image ?>"></a>
                <p><?php echo $data->name; ?></p>
                <ul class="harga">
                    <a href="#">$<?php echo $data->price; ?></a>
                </ul>
            </aside> 
        </div>
    </div>
</div>
<?php
    }
?>    