                    <?php 
                    $nilai=mysql_query("SELECT * from nilai where id_user=".$_SESSION['id_user']);
                    $byknilai=mysql_num_rows($nilai);

                    $bykpelajaran=mysql_result(mysql_query("SELECT count(id_pelajaran) from pelajaran"), 0);
                     ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                        Dashboard
                      </li>
                      <li class="list-group-item">
                        Pengaturan
                      </li>
                      <li class="list-group-item">
                      	<span class="label btn-success pull-right"><?php echo $bykpelajaran; ?></span>
                        <a href="index.php?page=pelajaran">Pelajaran</a>
                      </li>
                      <li class="list-group-item">
                      	<?php if ($byknilai>0): ?>
                        <span class="label bg-orange pull-right"><?php echo $byknilai; ?></span>
				                      		
                      	<?php endif ?>
                        <a href="index.php?page=list_ujian">Ujian Anda</a>
                      </li>
                    </ul>