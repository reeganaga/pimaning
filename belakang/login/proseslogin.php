<?php 
session_start();
include '../../config/db.php';
if (isset($_POST['login'])) {
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	
	$query="SELECT * from admin where username='$username' and password='$password'";
	$aksi=mysql_query($query);
	$ada=mysql_num_rows($aksi);

	if ($ada>0) {
		while ($row=mysql_fetch_array($aksi)) {
			$_SESSION['username_admin']=$row['username'];
			$_SESSION['email_admin']=$row['email'];
			$_SESSION['nama_lengkap_admin']=$row['nama_lengkap'];
			$_SESSION['alamat_admin']=$row['alamat'];
			$_SESSION['foto_admin']=$row['foto'];

			header('Location:../index.php?log=true');
			echo "sukses";
		}
		
	}else{
			header('Location:index.php?log=false');
	}

}else{
			header('Location:index.php?log=false');
}
