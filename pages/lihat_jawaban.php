<?php 

if (isset($_SESSION['username'])) {
     # code...
                // $id_pelajaran=$_GET['id_pelajaran'];
$id_ujian = $_REQUEST['id_ujian'];
$sql_ujian = "select * from pelajaran,ujian where pelajaran.id_pelajaran=ujian.id_pelajaran and ujian.id_ujian='".$id_ujian."'";
$sql_ujian_exe = mysql_query($sql_ujian);
$data_ujian = mysql_fetch_assoc($sql_ujian_exe);
$nilai_exe = mysql_query("select nilai,detail_jawaban from nilai where id_user='".$_SESSION['id_user']."' and id_ujian='".$id_ujian."'");
$data_nilai = mysql_fetch_assoc($nilai_exe);
$jawaban_siswa_terpilih = explode(",",$data_nilai["detail_jawaban"]);
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
                
                <div class="box">
                    <div class="box-header">
                        <?php $nama_ujian=mysql_result(mysql_query("SELECT nama_ujian from ujian where id_ujian=$id_ujian"), 0) ?>
                      <h3 class="box-title">Jawaban Ujian <?php echo $nama_ujian; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- awal div tempat_soal -->
                        <div id="tempat_soal">
                        <?php
                        // ambil pilihan jawaban dari database dan simpan de dalam array
                        $sql_pil = "select * from pil_jawaban where id_soal in (select id_soal from soal where id_ujian='".$id_ujian."') order by rand()";
                        $sql_pil_exe = mysql_query($sql_pil);
                        // echo mysql_num_rows($sql_pil_exe);
                        // echo $sql_pil."</br>";
                        if(mysql_num_rows($sql_pil_exe) > 0){   
                        $data_pil_arr = array();
                        while($data = mysql_fetch_assoc($sql_pil_exe)){
                            if(isset($data_pil_arr[$data['id_soal']])){
                                $pil_jawabannya = array("id_jawaban" => $data['id_jawaban'],"status" => $data['status'],"jawaban" => $data['jawaban']);
                                array_push($data_pil_arr[$data['id_soal']],$pil_jawabannya);
                                }
                            else {
                                $data_pil_arr[$data['id_soal']] = array();
                                $pil_jawabannya = array("id_jawaban" => $data['id_jawaban'],"status" => $data['status'],"jawaban" => $data['jawaban']);
                                array_push($data_pil_arr[$data['id_soal']],$pil_jawabannya);
                                }   
                            }
                        // tampilkan soal ujian
                        $sql_soal = "select * from soal where id_ujian='".$id_ujian."' order by rand()";
                        $sql_soal_exe = mysql_query($sql_soal);
                        $no = 0;
                        while($soalnya = mysql_fetch_assoc($sql_soal_exe)){
                            $no++;
                            echo '
                                <div class="soal_ujian">
                                    <div class="no_soal">'.$no.'</div>
                                    <div class="isi_soal">
                                        <div class="pertanyaan">'.$soalnya["isi_soal"].'</div>';
                                    //  $sql_pil = "select * from pil_jawaban where id_soal='".$soalnya['id_soal']."' order by rand()";
                                    //  $sql_pil_exe = mysql_query($sql_pil);
                                    //  while($data_pil = mysql_fetch_assoc($sql_pil_exe)){
                                    //      echo '<div class="pilihan_jawaban"><input type="radio" name="'.$data_pil['id_soal'].'" value="'.$data_pil['status'].'" onclick="koreksi(this)"/><div>'.$data_pil['jawaban'].'</div></div>';
                                    //      }
                                    foreach($data_pil_arr[$soalnya["id_soal"]] as $data_pil) {
                                        if(in_array($data_pil["id_jawaban"],$jawaban_siswa_terpilih)){
                                            $checked_radio = "checked";
                                            $class_div = "radio_terpilih";
                                            }
                                        else {
                                            $checked_radio = "";
                                            $class_div = "";
                                            }   
                                        echo '<div class="pilihan_jawaban '.$class_div.'"><input alt="'.$data_pil["id_jawaban"].'" type="radio" name="'.$soalnya["id_soal"].'" value="'.$data_pil['status'].'" '.$checked_radio.' /><div>'.$data_pil['jawaban'].'</div></div>';
                                        }
                            echo '</div>
                                </div>
                            ';
                            }
                        }
                        else {
                            echo "soal masih belum ada !!!!!!!!!";
                            }   
                        ?>      
                        </div><!-- akhir div tempat_soal -->

                    </div><!-- /.box-body -->
                </div><!-- /.box -->    
                
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->    
<style>
.pilihan_jawaban > div{
    padding-left:5px;
    margin-left:25px;
    }
.radio_terpilih{
    background:#F4F4BA;
    }   
</style>
<?php 
}else{
 include 'home.php';
 // print_r($_SESSION);
 }

 ?>
