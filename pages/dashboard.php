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
                    <h2>Dashboard</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>    
                </div>        
            </div>
            <div class="row">     
                <div class="col-md-3">
                    <?php include 'menu_kiri.php'; ?>                 
                </div>
                <div class="col-md-4 ">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Menu Pelajaran</h3>
                      </div>
                      <div class="box-body">
                        <a href="index.php?page=pelajaran">
                            <img src="images/learn.jpg" class="img-responsive">
                        </a>
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
