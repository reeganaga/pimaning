<?php 
$user='root';   // user dari database saya
$server='localhost'; // name server
$pass='root'; // password database
$database='online_test_kaji'; // nama database
mysql_connect($server,$user, $pass) or die('koneksi gagal');
mysql_select_db($database) or die('database tidak ditemukan');
?>
