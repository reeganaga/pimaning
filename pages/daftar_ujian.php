<?php 

if (isset($_SESSION['username'])) {
     # code...
                $id_pelajaran=$_GET['id_pelajaran'];

  ?>
<!--     <section id="blog" class="container">
        <div class="center">
            <h2>Dashboard</h2>
            <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
        </div>
    </section><!--/#blog--> 

    <section class="dashboard">
       <div class="container">
            <div class="row">
                <div class="center">
                    <h2>Daftar Ujian</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>    
                </div>        
            </div>
            <div class="row">   
                <div class="col-md-3">
                    <?php include 'menu_kiri.php'; ?>
                    
                </div>
                <div class="col-md-9">
                
                <div class="box">
                    <div class="box-header">
                        <?php $pelajaran=mysql_result(mysql_query("SELECT nama_pelajaran from pelajaran where id_pelajaran=$id_pelajaran"), 0) ?>
                      <h3 class="box-title">Daftar Ujian Pelajaran <?php echo $pelajaran; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Tgl Dibuat</th>
                            <th>waktu</th>
                            <th>Keterangan</th>
                            <th>banyak soal</th>
                            <th>nilai</th>
                            <th>aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                $getujian=mysql_query("SELECT * from ujian where id_pelajaran=$id_pelajaran");
                while ($row=mysql_fetch_array($getujian)) {
                 ?>
                         
                          <tr>
                            <td><?php echo $row['nama_ujian']; ?></td>
                            <td><?php echo $row['tgl_ujian']; ?></td>
                            <td><?php echo $row['waktu']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td>
                                <?php $banyaksoal=mysql_result(mysql_query("SELECT count(id_soal) from soal where id_ujian=".$row['id_ujian']), 0); 
                                echo $banyaksoal;
                                ?>
                            </td>
                            <td>
                                 <?php 
                                 $cekdata=mysql_query("SELECT nilai from nilai where id_ujian=".$row['id_ujian']." and id_user=".$_SESSION['id_user']);
                                $ada=mysql_num_rows($cekdata);
                                if ($ada>0) {
                                   $nilai=mysql_result(mysql_query("SELECT nilai from nilai where id_ujian=".$row['id_ujian']." and id_user=".$_SESSION['id_user']), 0);
                                    echo '<span class="bg-red" style="padding:5px;">'.$nilai.'</span>';
                                }else{
                                    $nilai="kosong";
                                    echo $nilai;
                                 
                                
                                }?>
                            </td>
                            <td>
                                <?php if ($nilai=='kosong'): ?>
                                    <a class="btn btn-warning" href="index.php?page=kerjakan_ujian&id_ujian=<?php echo $row['id_ujian']; ?>">kerjakan</a>                                
                                <?php else: ?>
                                    <a class="btn btn-success" href="index.php?page=lihat_jawaban&id_ujian=<?php echo $row['id_ujian']; ?>">Jawaban</a>                                
                                <?php endif ?>
                            </td>
                          </tr>
                <?php 
                } ?>
                        </tbody>
                      </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->    
                
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->    

<?php 
}else{
 include 'home.php';
 // print_r($_SESSION);
 }

 ?>
