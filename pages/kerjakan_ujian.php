<?php 

if (isset($_SESSION['username'])) {
     # code...
                $id_ujian=$_GET['id_ujian'];
$sql_ujian = "select * from pelajaran,ujian where id_ujian='".$id_ujian."' and pelajaran.id_pelajaran=ujian.id_pelajaran";
$sql_ujian_exe = mysql_query($sql_ujian);
$data_ujian = mysql_fetch_assoc($sql_ujian_exe);

if(isset($_SESSION["mulai_".$id_ujian])){
    $telah_berlalu = time() - $_SESSION["mulai_".$id_ujian];
    }
else {
    $_SESSION["mulai_".$id_ujian] = time();
    $telah_berlalu = 0;
    }   
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
                    <div class="box fix-timer">
                        <div class="box-header">
                            <h3 class="box-title">Sisa Waktu</h3>
                        </div>
                        <div class="box-body">
                            <div id="timer">00 : 00 : 00</div>
                        </div>
                    </div>
                    <!-- <div id="timer">00 : 00 : 00</div> -->
                </div>
                <div class="col-md-9">
                
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Selamat Mengerjakan</h3>
                        

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- awal div tempat_soal -->
                        <div id="tempat_soal">
                    <?php
                    // ambil pilihan jawaban dari database dan simpan de dalam array
                    $sql_pil = "select * from pil_jawaban where id_soal in (select id_soal from soal where id_ujian='".$id_ujian."') order by rand()";
                    $sql_pil_exe = mysql_query($sql_pil);
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
                                    echo '<div class="pilihan_jawaban radio" onclick=""><label><input alt="'.$data_pil["id_jawaban"].'" type="radio" name="'.$soalnya["id_soal"].'" value="'.$data_pil['status'].'" />'.$data_pil['jawaban'].'</label></div>';
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
                        <div style="margin-top:25px"><span style="padding:6px;font-size:95%" class="tombol btn bg-green btn-flat" onclick="koreksi_simpan()">Koreksi dan Simpan</span></div>
                        </div><!-- akhir div tempat_soal -->

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

//js content
 ?>
<script type="text/javascript">
function waktuHabis(){
    alert("waktu habis ......");
    koreksi_simpan();
    }       
function hampirHabis(periods){
    if($.countdown.periodsToSeconds(periods) == 60){
        $(this).css({color:"red"});
        }
    }
function tutup_redirect(id_info,id_pelajaran){
    $("#"+id_info).parent().remove();
    // $("#content").html(info_loading).load("daftar_ujian_siswa.php?id_pelajaran="+id_pelajaran);
    window.location="index.php?page=daftar_ujian&id_pelajaran="+id_pelajaran;
            };  
function coba_lagi(id_info){
    $("#"+id_info).parent().remove();
    koreksi_simpan();       
    }
function pilih_jawaban(elm){
    $(elm).find("input:radio").attr("checked",true);
    }               
function koreksi_simpan(){
    // hapus timer countdown
    $("#timer").countdown("destroy");
    var id_pelajaran = "<?php echo $data_ujian['id_pelajaran'] ?>";
    var id_ujian ="<?php echo $id_ujian ?>";
    var id_user = "<?php echo $_SESSION['id_user'] ?>";
    var id_info ="<?php echo 'info_'.$id_ujian ?>";
    var jum_soal = "<?php echo $no ?>";
    // lihat berapa jawaban yang benar
    var benar = 0;
    // tandai jawaban yang benar
    $(":radio").each(function(){
        if($(this).val() == 1){
        $(this).parent().addClass("yang_benar");
        }
        })
    // koreksi gan
    var jawaban_siswa = new Array();
    $(":checked").each(function(){
        if($(this).val() == 1){
            benar++;
            };
        jawaban_siswa += $(this).attr("alt")+",";   
        })
    if(jawaban_siswa.length > 0){
    jawaban_siswa = jawaban_siswa.substr(0,jawaban_siswa.length - 1);   
    }   
//  alert(jawaban_siswa);
    var nilai = (benar / jum_soal) * 100;
    // simpan ke database
    var tinggi_div_soal = $("#tempat_soal").outerHeight();
    var lebar_div_soal = $("#tempat_soal").outerWidth();
    var posisi = $("#tempat_soal").position();
    var div_overlay = "<div style='position:absolute;top:"+posisi.top+";left:"+posisi.left;
        div_overlay +=";width:"+lebar_div_soal+"px;height:"+tinggi_div_soal+";background:#FFFFFF;opacity:0.4;z-index:9' >"; 
        div_overlay +="</div>";
        div_overlay +="<div id='"+id_info+"' style='position:absolute;border:1px solid #000000;font-weight:bolder;z-index:10";
        div_overlay +=";width:"+0.25 * lebar_div_soal+"px;background:#CEF3CE;padding:6px;border:1px solid #00FF00;border-radius:3px;' >";
        div_overlay +="Sedang menyimpan ...........</div>";
    $(div_overlay).appendTo("#tempat_soal");
    var atas = (($(window).height() - $("#"+id_info).height()) / 2) + $(window).scrollTop();
    var kiri = (($(window).width() - $("#"+id_info).width()) / 2) + $(window).scrollLeft();
    // $("#"+id_info).css({"top":atas+"px","left":kiri+"px"});

    // custom info setelah simpan
    // $("#"+id_info).css({"top":atas+"px","left":kiri+"px"});
    $("#"+id_info).css({"top":"-15%","left":"20%"});
    
    //simpan ke database
    var url = "pages/simpan_form.php";
    var tabel = "nilai";
    var data = [{"name":"id_user","value":id_user},{"name":"id_ujian","value":id_ujian},{"name":"nilai","value":nilai},{"name":"detail_jawaban","value":jawaban_siswa}];
    /*
    $.post(url,{tbl:tabel,data:data},function(hasil){
        if(hasil == 1){
            var ket_nilai = "<div>Nilai Anda : "+nilai+"</div><div>Jawaban Yang benar :"+benar+"</div><div>Jumlah soal "+jum_soal+"</div>";
                ket_nilai +="<div style='margin-top:5px'><span class='tombol' onclick='tutup_redirect(\""+id_info+"\",\""+id_pelajaran+"\")'>OK</span></div>";
            $("#"+id_info).html(ket_nilai);
            // hapus overlay
            //$("#"+id_info).parent().remove();
            //$("#content").html("").load("daftar_ujian_siswa.php?id_pelajaran="+id_pelajaran);
            }
        else {
            var lagi = confirm("Gagal disimpan, mungkin koneksi terputus <br /> Coba lagi");
            if(lagi){
            // hapus overlay
            $("#"+id_info).parent().remove();
            koreksi_simpan();       
                }
            
            }   
        })
        */  
        $.ajax({
            type:"POST",
            url: url,
            data:{tbl:tabel,data:data},
            success:function(){
                var ket_nilai = "<div>Nilai Anda : "+nilai+"</div><div>Jawaban Yang benar :"+benar+"</div><div>Jumlah soal "+jum_soal+"</div>";
                ket_nilai +="<div style='margin-top:5px'><span class='tombol btn bg-green btn-flat' onclick='tutup_redirect(\""+id_info+"\",\""+id_pelajaran+"\")'>OK</span></div>";
            $("#"+id_info).html(ket_nilai);
            },
            error:function(){
            $("#"+id_info).html("Gagal menyimpan ...........<span class='tombol' onclick='coba_lagi(\""+id_info+"\")'>Coba lagi</span>");
            }
            })
    }           
$(function(){
    var longWayOff = "<?php echo ($data_ujian['waktu'] * 60) - $telah_berlalu; ?>";
    if(parseInt(longWayOff) <= 0 ){
        waktuHabis();
        }
    else {  
    $("#timer").countdown({
        until: longWayOff,
        compact:true,
        onExpiry:waktuHabis,
        onTick: hampirHabis
        }); 
    }   
})
</script>
