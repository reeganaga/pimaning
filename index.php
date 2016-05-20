<?php 
session_start(); 
include 'config/db.php';
if (isset($_SESSION['id_user'])) {
    # code...

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard | Pimaning</title>
	
	<!-- core CSS -->
    <link rel="stylesheet" href="belakang/bootstrap/css/bootstrap.min.css">

    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="belakang/dist/css/AdminLTE.min.css" rel="stylesheet">
    <link rel="stylesheet" href="belakang/dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="belakang/plugins/datatables/dataTables.bootstrap.css">    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <!-- jquery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.plugin.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>

</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2 col-xs-2">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  0857-4396-8562</p></div>
                        
                    </div>
                    
                    <div class="col-sm-3 col-xs-3">
                        <b style="color: white;">EXP</b> 
                        <img src="images/exp1.png">
                        <b style="color: white;">80 point</b> 
                    </div>
                    <div class="col-sm-2 col-xs-2" style="color: white;">
                         <i class="fa fa-star"></i> 1 level
                    </div>
                    <div class="col-sm-5 col-xs-5">
                        <div class="pull-right">
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <a class="label bg-blue" href="home/index.php" target="_blank"><i class="fa fa-home"></i>Home</a>
                        <a class="label bg-blue" href="index.php?page=dashboard">Dashboard</a>
                        <a class="label bg-blue" href="index.php?page=pelajaran">Pelajaran</a>
                        <a class="label bg-blue" href="index.php?page=list_ujian">Ujian Anda</a>
                        <a href="pages/logout.php" class="label bg-green">logout</a>
                    <?php endif ?>
                        </div>
                    </div>    
                    
<!--                     <div class="col-sm-4 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div> -->
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <?php if (isset($_GET['page'])) {
        if ($_GET['page']!=='pelajaran' and $_GET['page']!=='list_ujian' and $_GET['page']!=='dashboard') {
        //    include 'menu_top.php';
            }
        }else{
          //  include 'menu_top.php';
            }
        ?>
    </header><!--/header-->

    <!-- start content -->
    <?php
    if (isset($_GET['page'])) {
        $page=$_GET['page'];
        if (file_exists('pages/'.$page.".php")) {
            include 'pages/'.$page.".php";
        }else{
            include 'pages/404.php';
        }
    }else{
        include 'pages/dashboard.php';
    }
    ?>
    <!-- end content -->

<!-- section_bottom.php dibackup -->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Pimaning</a>. All Rights Reserved.
                </div>
                <!-- <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </footer><!--/#footer-->

    <!-- <script src="js/jquery.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    <!-- <script src="belakang/plugins/wow.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="belakang/dist/js/app.min.js"></script>    
    <!-- AdminLTE for demo purposes -->
    <script src="belakang/dist/js/demo.js"></script>    
    <!-- DataTables -->
    <script src="belakang/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="belakang/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    
      // page kerjakan soal

    </script>

    <!-- page kerjakan soal -->

</body>
</html>
<?php 
}else{
header('Location:home/index.php');
 } ?>
