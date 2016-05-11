<script>
var info_loading = "<div style='font-size:110%;font-style:italic;font-weight:bolder;width:150px;margin:0 auto;' class='tombol loading'>Sedang proses .............</div>";	
function bersihkan(elm){
	$("#content").data($(elm).attr("name"),$(elm).val());
	$(elm).val("");
	}
function kembali_semula(elm){
	if($(elm).val() == ""){
		$(elm).val($("#content").data($(elm).attr("name")));
		}
	}	
function load_menu(elm){
		$(".menu_terpilih").eq(0).removeClass("menu_terpilih").addClass("menu_awal");
		$(elm).parent().removeClass("menu_awal").addClass("menu_terpilih");
		var url = $(elm).attr("href");
		$("#content").html(info_loading).load(url);
		return false;
	}
$(function(){
	$(".menu_awal>a").eq(0).click();
	})		
</script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Chat</h3>
                  <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                    <div class="btn-group" data-toggle="btn-toggle" >
                      <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                    </div>
                  </div>
                </div>
                <div class="box-body">

                <!-- start isi -->
<div id="content"></div>
<div id="isi_awal">
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
</div>

                <!-- end isi -->  
                </div><!-- /.chat -->
                <div class="box-footer">
                </div>
              </div><!-- /.box (chat box) -->



            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
// include_once "include/cek_session.php";
// include_once "include/koneksi.php";
?>


<!-- conent -->
<script>	
function lihat_ujian(id_pelajaran){
	// load content dengan data dari daftar_ujian.php
	$("#content").html(info_loading).load("halaman/ujian/daftar_ujian.php?id_pelajaran="+id_pelajaran);
	}	
function edit_mp(elm,id_pelajaran){
	var nama_pelajaran = $(elm).parent().find("li").text();
	$(".sedang_diedit").removeClass("sedang_diedit");
	$(".telah_diedit").removeClass("telah_diedit");
	$(elm).parent().addClass("sedang_diedit");
	$("#f_mp input[name=nama_pelajaran]").val(nama_pelajaran);
	// sembunyikan tombol simpan
	$("#simpan_mp").fadeOut();
	$("#update_mp").fadeIn();
	$("#update_mp").data("id_pelajaran",id_pelajaran);
	}
function batal_update(){
	$(".sedang_diedit").removeClass("sedang_diedit");
	$("#update_mp").fadeOut();
	$("#simpan_mp").fadeIn();
	$(".inputan").each(function(){
		$(this).val($("#content").data($(this).attr("name")));
		})
	}	
function update_mp(elm){
	var errornya = 0;
	$(".inputan").each(function(){
		if($(this).val() == ""){
			errornya++;
			$(this).focus();
			return false;
			}
		})	
	if(errornya == 0){
		//simpan ke database
		var data = $(elm).parent().parent().serializeArray();
		var url = "halaman/ujian/update_data.php";
		var tabel = "pelajaran";
		data.unshift({"name":"id_pelajaran","value":$("#update_mp").data("id_pelajaran")});
		$.post(url,{data:data,table:tabel},function(hasil){
			if(hasil == 1){
				// update data pada baris yang diedit
				var div_mapel = $(".sedang_diedit");
				$(div_mapel).find("li").text($("input[name=nama_pelajaran]").val());
				// hapus class sedang diedit dan tambahkan kelas telah diedit
				$(div_mapel).removeClass("sedang_diedit").addClass("telah_diedit");
				}
			else{
				alert("gagal disimpan, mungkin data sudah ada \n atau koneksi bermasalah"+hasil);
				
				}	
			})			
		}
	else {
		alert("harus diisi semua....");
	}	
}			
function simpan_mp(elm){
	var nama_pelajaran = $(elm).prev().val();
	if(nama_pelajaran != "" && nama_pelajaran != "nama mata pelajaran"){
		//simpan ke database
		var data = $(elm).parent().serializeArray();
		var url = "halaman/ujian/simpan_form.php";
		var tabel = "pelajaran";
		$.post(url,{data:data,tbl:tabel},function(hasil){
			if(hasil == 1){
				// reload content dengan halaman ini
				$("#content").html(info_loading).load("halaman/ujian/daftar_mp.php");
				}
			else{
				$("#content").html(info_loading).load("halaman/ujian/daftar_mp.php");
				$( "#isi_awal" ).empty();
				// alert("gagal disimpan, mungkin data sudah ada \n atau koneksi bermasalah");
				}	
			})
		}
	else {
		alert("harus diisi semua....");
		}	
}
function hapus_mp(elm,id_pelajaran){
	$(".sedang_diedit").removeClass("sedang_diedit");
	$(elm).parent().addClass("sedang_diedit");
	var hapus = confirm("Dengan menghapus mata pelajaran ini berarti akan menghapus \n seluruh data yang berkaitan dengan mata pelajaran ini \n termasuk ujian dan nilai yang telah ada... ");
	if(hapus){
	var url = "halaman/ujian/hapus_data.php";		
	$.post(url,{id_nilai:id_pelajaran,id_nama:"id_pelajaran",table:"pelajaran"},function(hasil){
		if(hasil == 1){
			// hapus dibaris yang dihapus saja kawan
			$(elm).parent().remove();
			}
		else {
			alert("gagal dihapus cek query anda .....");
			}	
		})
	}
}	
</script>
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
