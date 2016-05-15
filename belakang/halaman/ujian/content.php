      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>
<?php 
$query_ujian="SELECT * from pelajaran ";
$aksi=mysql_query($query_ujian);
$jumlah=mysql_num_rows($aksi);

 ?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>no</th>
                        <th>Pelajaran</th>
                        <th>Jumlah Soal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
if ($jumlah>0) {
  while ($row=mysql_fetch_array($aksi)) {
    # code...

 ?>                      
                      <tr>
                        <td><?php echo $row['id_pelajaran']; ?></td>
                        <td><?php echo $row['nama_pelajaran']; ?></td>
                        <td>
                          <?php 
                          $jml_ujian = mysql_result(mysql_query("select count(*) from ujian where id_pelajaran='".$row['id_pelajaran']."'"),0);
                          echo $jml_ujian;
                          ?>
                        </td>
                        <td>
                          <a href="index.php?hal=ujian/daftar_ujian&id=<?php echo $row['id_pelajaran']; ?>" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Ujian</a>
                          <a href="index.php?hal=ujian/content&aksi=edit&id=<?php echo $row['id_pelajaran']; ?>" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i> Ubah</a>
                          <a href="index.php?hal=ujian/content&aksi=hapus&id=<?php echo $row['id_pelajaran']; ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>

                        </td>
                      </tr>
<?php 
  }
} ?>                    
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<!--               <div class="box box-success">
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

                  <table class="table"></table>
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

                </div>
                <div class="box-footer">
                </div>
              </div>



            </section>
          </div>

        </section>
      </div>-->
 
