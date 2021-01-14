<?php

if(isset($_POST["login"])){
  	 if($_POST["username"] == "" | $_POST["password"] == ""){
  	 	echo'<script>
  	 	      alert("Jangan ada yang kosong !");
  	 	      window.location="index.php";
  	 	     </script>';
  	 	return false;
  	 }
     
     $name = htmlspecialchars($_POST['username']); 
     $password = md5($_POST['password']);

     $login = mysqli_query($conn,"SELECT * FROM login WHERE username='$name'");
     if(mysqli_num_rows($login) ===1){
     	$data = mysqli_fetch_assoc($login);

     	if($password == $data["password"] && $data["level"] == "admin"){
     		$_SESSION["username"] = $data["username"]; 
     		$_SESSION["level"] = $data["level"];
     		header('Location: ../admin/');

     	}else if($password == $data["password"] && $data["level"] == "user"){
     		$_SESSION["username"] = $data["username"];
     		$_SESSION["level"] = $data["level"];
     		header('Location: ../index.php');

     	}else if($password != $data["password"] && $data["level"] == "admin" | $data["level"] == "user"){
     		echo'<script>
     		        alert("Nama Atau Password Salah !");
     		        window.location="index.php";
     		     </script>';
     		return false;
     	}
      
     }else{
     	echo'<script>
     		        alert("Akun Tidak Ada Dalam Database !");
     		        window.location="index.php";
     		     </script>';
        return false;
     }

  }

if(isset($_POST["register"])){
   if($_POST["email"] =="" | $_POST["username"] == "" | $_POST["password"] == ""){
      echo'<script>
             alert("Jangan ada yang kosong !");
             windows.location="register.php";
            </script>';
      return false;
   }
   $email = $_POST["email"];
   $username = $_POST["username"];
   $password = md5($_POST["password"]);
  
   $cek = mysqli_query($conn,"SELECT * FROM login WHERE email='$email'");
   if(mysqli_num_rows($cek) === 1){
      echo'<script>
                alert("Email ini sudah terdaftar, silahkan coba dengan email lain !");
                window.location="register.php";
             </script>';
        return false;
   }

   $save = mysqli_query($conn,"INSERT INTO login(username,email,password) VALUES('$username', '$email', '$password')");
   if ($save === true) {
        echo'<script>
                alert("Registrasi Berhasil...");
                window.location="/index.php"; 
             </script>';
   }else{
         echo'<script>
                alert("Registrasi Gagal !");
                window.location="register.php";
             </script>';
        return false;
   }
}

  if(isset($_POST["tambah_pengguna"])){
   if($_POST["email"] =="" | $_POST["username"] == "" | $_POST["password"] == "" | $_POST["level"] == ""){
      echo'<script>
             alert("Jangan ada yang kosong !");
             windows.location="admin/tambah-pengguna.php";
            </script>';
      return false;
   }
   $email = $_POST["email"];
   $level = $_POST["level"];
   $username = $_POST["username"];
   $password = md5($_POST["password"]);
   //cek
   $cek = mysqli_query($conn,"SELECT * FROM login WHERE email='$email'");
   if(mysqli_num_rows($cek) === 1){
      echo'<script>
                alert("Email ini sudah terdaftar, silahkan coba dengan email lain !");
                window.location="tambah-pengguna.php";
             </script>';
        return false;
   }

  //save
   $save = mysqli_query($conn,"INSERT INTO login(username,email,password,level) VALUES('$username', '$email', '$password', '$level')");
   if ($save === true) {
        echo'<script>
                alert("Pengguna Baru Berhasil Ditambahkan...");
                window.location="login/admin/data-pengguna.php";
             </script>';
   }else{
         echo'<script>
                alert("Pengguna Baru Gagal Ditambahkan !");
                window.location="login/admin/tambah-pengguna.php";
             </script>';
        return false;
   }
}

  if(isset($_SESSION["username"])){
	  $username = $_SESSION["username"]; //$username isi dng session username.
	  //cocokan data pengguna berdasarkan $username.
	  $data = mysqli_query($conn,"SELECT * FROM login WHERE username='$username'");
	  //ambil data hasil pencocokan.
	  $pengguna = mysqli_fetch_assoc($data);
      
      //data ini hanya untuk level admin
      if($_SESSION["level"] == "admin"){
	      //hitung semua pengguna
	      $count = mysqli_query($conn,"SELECT * FROM login ORDER BY id DESC");
	      $totalPengguna = mysqli_num_rows($count); //total pengguna
	      //hitung semua admin
	      $count = mysqli_query($conn,"SELECT * FROM login WHERE level='admin'");
	      $totalAdmin = mysqli_num_rows($count); //total admin
	      //hitung semua user
	      $count = mysqli_query($conn,"SELECT * FROM login WHERE level='user'");
	      $totalUser = mysqli_num_rows($count); //total user
	   }
  }
///////////////////////////////////////
///////////   END DATA VIEW  /////////
//////////////////////////////////////