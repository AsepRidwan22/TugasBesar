<?php
ob_start();
include "../models/m_product.php";
$product = new Barang($connection);
if(@$_GET['act'] == ''){
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Product <small>Template</small></h1>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="icon-dashboard"></i> Template Premium</a></li>
      </ol>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>NO</th>
            <th>Name Template</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $tampil = $product->tampil();
            while($data = $tampil->fetch_object()){
          ?>
          <tr>
            <td><?php echo $no++; "."?></td>
            <td><?php echo $data->name; ?></td>
            <td><?php echo $data->price; ?></td>
            <td><?php echo $data->category ?></td>
            <td align="center">
              <img src="../upload/img_product/<?php echo $data->image ?>" alt="img-tamplate" width="100">
            </td>
            <td align="center">
              <a id="edit_product" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_product; ?>" data-name="<?php echo $data->name; ?>" data-price="<?php echo $data->price; ?>" data-category="<?php echo $data->category; ?>" data-image="<?php echo $data->image; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit">Edit</i></button></a>
              <a href="?page=template_premium&act=del&id=<?php echo $data->id_product; ?>" onclick="return confirm('yakin akan menghapus data')">
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o">Delete</i></button>
              </a>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
        </table>
      </div>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="name" class="control-label">Nama template</label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group">
                <label for="price" class="control-label">price</label>
                <input type="number" name="price" class="form-control" id="price" required>
              </div>
              <div class="form-group">
                <label for="category" class="control-label">category</label>
                <input type="text" name="category" class="form-control" id="category" required>
              </div>
              <div class="form-group">
                <label for="image" class="control-label">image</label>
                <input type="file" name="image" class="form-control" id="image" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
            </div>
            </form>
            <?php
            if(@$_POST['tambah']){
              $name = $connection->conn->real_escape_string($_POST['name']);
              $price = $connection->conn->real_escape_string($_POST['price']);
              $category = $connection->conn->real_escape_string($_POST['category']);

              $extensi = explode(".", $_FILES['image']['name']);
              $image = "img-" .round(microtime(true)). "." .end($extensi);
              $sumber = $_FILES['image']['tmp_name'];
              $upload = move_uploaded_file($sumber, "../upload/img_product/".$image);
              if($upload){
                $product->tambah($name, $price, $category, $image);
                header("location: ?page=template_premium");
              }else{
                echo "<script>alert('upload image filed')</script>";
              }
            }
            ?>
          </div>
        </div>
      </div>

      <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">edit Data Barang</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
            <div class="modal-body" id="modal-edit">
              <div class="form-group">
                <label for="name" class="control-label">Nama template</label>
                <input type="hidden" id="id" name="id_product">
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group">
                <label for="price" class="control-label">price</label>
                <input type="number" name="price" class="form-control" id="price" required>
              </div>
              <div class="form-group">
                <label for="category" class="control-label">category</label>
                <input type="text" name="category" class="form-control" id="category" required>
              </div>
              <div class="form-group">
                <label for="image" class="control-label">image</label>
                <div style="padding-bottom:5px">
                  <img src="" width="80" id="pict">
                </div>
                <input type="file" name="image" class="form-control" id="image">
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="edit" value="edit">
            </div>
            </form>
          </div>
        </div>
      </div>

      
    </div>
  </div>
<?php
}else if(@$_GET['act'] == 'del'){
  $img_awal = $product->tampil($_GET['id'])->fetch_object()->image;
  unlink("../upload/img_product/".$img_awal);

  $product->hapus($_GET['id']);
  header("location: ?page=template_premium");
}