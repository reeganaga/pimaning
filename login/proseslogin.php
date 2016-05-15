<?php 
session_start();
include '../config/db.php';
if (isset($_POST['login'])) {
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	
	$query="SELECT * from users where email='$email' and password='$password'";
	$aksi=mysql_query($query);
	$ada=mysql_num_rows($aksi);

	if ($ada>0) {
		while ($row=mysql_fetch_array($aksi)) {
			$_SESSION['username']=$row['username'];
			$_SESSION['id_user']=$row['id_user'];
			$_SESSION['email']=$row['email'];
			$_SESSION['nama_lengkap']=$row['nama_lengkap'];
			$_SESSION['alamat']=$row['alamat'];
			$_SESSION['foto']=$row['foto'];

			header('Location:../index.php?page=dashboard&log=true');
		}
		
	}else{
			header('Location:index.php?log=false');
	}

}else{
			header('Location:index.php?log=false');
}
