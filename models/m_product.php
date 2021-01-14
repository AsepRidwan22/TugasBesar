<?php
class Barang{
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM product";
        if($id != null){
            $sql .= " WHERE id_product = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tampil2($page){
        $db = $this->mysqli->conn;
        if($page = "free-template"){
            $sql = "SELECT * FROM product WHERE price = 0 ";
        }else if($page = "premium-template"){
            $sql = "SELECT * FROM product WHERE price >= 200 ";
        }else if($page = "theme-sale"){
            $sql = "SELECT * FROM product WHERE price <= 100 ";
        }else if($page = null){
            $sql = "SELECT * FROM product";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah($name, $price, $category, $image){
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO product VALUES ('', '$name', '$price', '$category', '$image')") or die($db->error);
    }

    public function edit($sql){
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }
    public function hapus($id){
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM product WHERE id_product ='$id'") or die ($db->error);
    }

    function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
    }
}
?>