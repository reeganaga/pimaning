<?php 
if (isset($_POST['daftarpimaning'])) {
	include '../config/db.php';
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$nama_lengkap=$_POST['nama_lengkap'];

	$cekuser=mysql_query("SELECT * from users where email='$email'");
	$banyak=mysql_num_rows($cekuser);
	echo $banyak;
	if($banyak!==0){
		$msg='fail';
		header('Location:index.php?msg='.$msg);
	echo mysql_error();
	echo "gagal";
	}else{
		$daftar=mysql_query("INSERT into users (email,password,nama_lengkap) values('$email','$password','$nama_lengkap')");
		$msg='done';
		header('Location:index.php?msg='.$msg);
	}
}else{
echo "gagal";
 }
