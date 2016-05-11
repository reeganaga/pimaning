<div class="daftar_pelajaran">
<fieldset>
<legend>Pilih Mata Pelajaran</legend>
<form id="f_mp" >
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