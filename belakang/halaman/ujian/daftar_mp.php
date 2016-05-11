
<?php
// include_once "include/cek_session.php";
 include_once "include/koneksi.php";
?>
<div class="daftar_pelajaran">
<fieldset>
<legend>Pilih Mata Pelajaran</legend>
<form id="f_mp">
<input type="text" name="nama_pelajaran" value="nama mata pelajaran" class="inputan" onfocus="bersihkan(this)" onblur="kembali_semula(this)"/>
<span id="simpan_mp" class="tombol tambah" onclick="simpan_mp(this)">Mata Pelajaran</span>
<span id="update_mp" style="display:none">
<span class="tombol simpan" onclick="update_mp(this)">Mata Pelajaran</span>
<span class="tombol batal" onclick="batal_update()">Batal</span>
</span>
</form>
<?php
// ambil data mata pelajaran dari database
$mp_exe = mysql_query("select * from pelajaran");
$jml_mp = mysql_num_rows($mp_exe);
if($jml_mp > 0){
?>
	<ul>
		<?php
		while($data = mysql_fetch_assoc($mp_exe)){
			$jml_ujian = mysql_result(mysql_query("select count(*) from ujian where id_pelajaran='".$data['id_pelajaran']."'"),0);
			echo "<div><span class='jml_ujian'>".$jml_ujian."</span>";
			echo "<li>".$data['nama_pelajaran']."</li>";
			echo "<div onclick=\"lihat_ujian('".$data['id_pelajaran']."')\" style='margin:10px'><span class='tombol tambah'>Ujian </span></div>";
			echo "<div onclick=\"edit_mp(this,'".$data['id_pelajaran']."')\" style='margin:10px'><span class='tombol edit'>Pelajaran</span></div>";
			echo "<div onclick=\"hapus_mp(this,'".$data['id_pelajaran']."')\" style='margin:10px'><span class='tombol hapus'>Pelajaran</span></div>";
			echo "</div>";
			}
			
		?>
	</ul>
<?php	
	}
else {
	echo "Mata Pelajaran Belum Dibuat";
	}	
?>

</fieldset>
</div>

<style>
.daftar_pelajaran{
	width:80%;
	margin: 0 auto;
	}
.daftar_pelajaran>fieldset>ul>div{
	float:left;
	width:150px;
	min-height:120px;
	padding:6px;
	border-radius:5px;
	margin:10px;
	border:2px solid #000000;
	color:#000000;
	overflow:auto;
	}
.daftar_pelajaran div:hover{
	cursor:pointer;
	}
.jml_ujian{
	padding:3px;
	border-radius:4px;
	border:1px solid #105610;
	background:#479F47;
	color:#FFFFFF;
	font-weight:bolder;
	font-size:0.8 em;
	position:relative;
	float:right;
	margin-right:-6px;
	margin-top:-7px;
	z-index:20;
	}		
.daftar_pelajaran ul,.daftar_pelajaran li{
	list-style:none;
//	text-align:center;
	}
.daftar_pelajaran li{
	position:relative;
	font-weight:bolder;
	border-bottom:2px solid #000000;
	}
</style>
