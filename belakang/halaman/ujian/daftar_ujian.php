        <?php 
        if ($_GET['id']) {
          $id=$_GET['id'];
        }

        if (isset($_POST['insert_ujian'])) {
          $nama_ujian=$_POST['nama_ujian'];
          $tgl_ujian=$_POST['tgl_ujian'];
          $waktu=$_POST['waktu'];
          $keterangan=$_POST['keterangan'];
          $id_pelajaran=$_POST['id'];

          $query=mysql_query("INSERT into ujian(nama_ujian,tgl_ujian,waktu,keterangan,id_pelajaran)
                  values('$nama_ujian','$tgl_ujian','$waktu','$keterangan',$id_pelajaran) ");
          // echo "INSERT into ujian(nama_ujian,tgl_ujian,waktu,keterangan,id_pelajaran)
          //         values('$nama_ujian','$tgl_ujian','$waktu','$keterangan',$id_pelajaran)";
          if ($query) {
            $msg="Data Berhasil ditambahkan";
          }else{
            // echo mysql_error();
            $msg="Data Gagal ditambahkan";
          }
        }

        if (isset($_POST['update_ujian'])) {
          
        }
         ?>
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

        <!-- Main content -->

        <section class="content">
        <?php if (isset($msg)): ?>
        <div class="alert alert-warning alert-dismissible fade in" style="border-radius: 0px !important;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $msg; print_r($query);?>
        </div>          
        <?php endif ?>
                <a class="btn btn-flat btn-warning " href="index.php?hal=ujian/content">kembali</a>
                <p></p>
          <div class="row">
            <div class="col-md-3">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Input Data Ujian</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form class="form" method="post" action="">
                  <div class="form-group">
                    <label class="control-label">Nama Ujian</label>
                    <input name="nama_ujian" type="text" class="form-control"></input>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tanggal</label>
                    <input name="tgl_ujian" type="date" class="form-control"></input>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Waktu</label>
                    <input name="waktu" min="1" type="number" placeholder="dalam menit" class="form-control"></input>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control"></input>
                  </div>
                  <div class="form-group">
                    <input name="id" type="hidden" value="<?php echo $id; ?>"></input>
                    <input name="insert_ujian" type="submit" class="form-control btn btn-success btn-flat" value="Simpan"></input>
                  </div>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-9">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php 
                  $getdata=mysql_query("SELECT * from ujian where id_pelajaran=$id");
                  $banyak=mysql_num_rows($getdata);
                   ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Soal</th>
                        <th>keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($banyak>0) {
                        while ($row=mysql_fetch_array($getdata)) {
                          
                       ?>
                      <tr>
                        <td><?php echo $row['nama_ujian']; ?></td>
                        <td><?php echo $row['tgl_ujian']; ?></td>
                        <td><?php echo $row['waktu']; ?> Menit</td>
                        <td>
                          <?php 
                          $soal=mysql_query("SELECT * from soal where id_ujian =".$row['id_ujian']);
                          $banyaksoal=mysql_num_rows($soal);
                          echo $banyaksoal;
                           ?>
                        </td>
                        <td><?php echo $row['keterangan']; ?></td>
                        <td>
                          <a class="btn btn-sm btn-flat btn-primary" href=""><i class="fa fa-edit"></i>Ujian</a>
                          <a class="btn btn-sm btn-flat btn-primary" href=""><i class="fa fa-trash"></i>Ujian</a>
                          <a class="btn btn-sm btn-flat btn-primary" href="index.php?hal=ujian/buat_soal&id_ujian=<?php echo $row['id_ujian']; ?>"><i class="fa fa-plus"></i>Soal</a>
                          <a class="btn btn-sm btn-flat btn-primary" href=""><i class="fa fa-edit"></i>Soal</a>
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