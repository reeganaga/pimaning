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