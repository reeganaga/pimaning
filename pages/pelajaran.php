<?php 

if (isset($_SESSION['username'])) {
     # code...
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
                    <h2>Daftar Pelajaran</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>    
                </div>        
            </div>
            <div class="row">   
                <div class="col-md-3">
                    <?php include 'menu_kiri.php'; ?>
                </div>
                <div class="col-md-9">
                <?php $getpelajaran=mysql_query("SELECT * from pelajaran");
                while ($row=mysql_fetch_array($getpelajaran)) {
                    # code...
                
                 ?>
                <div class="col-md-3">
                    <div class="box box-success">
                      <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $row['nama_pelajaran']; ?></h3>
                        <?php $banyakujian=mysql_result(mysql_query("SELECT count(id_ujian) as jumlah from ujian where id_pelajaran=".$row['id_pelajaran']),0);  ?>
                        <div class="label pull-right btn-danger"><?php echo $banyakujian; ?></div>
                      </div>
                      <div class="box-body">
                        <a class="btn btn-flat bg-navy col-xs-12" href="index.php?page=daftar_ujian&id_pelajaran=<?php echo $row['id_pelajaran']; ?>">
                            <i class="fa fa-edit"></i>Daftar Ujian
                        </a>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <?php 
                } ?>
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
