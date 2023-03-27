<?php

$t = new Grei\TanggalMerah();
    $bulan = 02;
    $tahun = date('Y'); //Mengambil tahun saat ini
    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    $anggota = $this->db->query("select npk ,area_kerja , wilayah , id_employee from employee where wilayah='WIL2' order by area_kerja ")->result();
    
    ?>
    
    <table id="example" class="mt-5 table table-bordered table-striped small" border=1 style="width: 100%;border:1px solid #000">
       <thead style="border: 1px solid #000;">
           <tr>
               <th colspan="<?= $tanggal + 5 ?>">Februari</th>
           </tr>
            <tr>
                <th rowspan="2">Nama</th>
                <th rowspan="2">NPK</th>
                <th rowspan="2">Instalasi</th>
                <?php
                for ($i = 1; $i <= $tanggal ; $i++) { ?>
                    <th colspan="2"><?= $i ?></th>
                <?php } ?>
                <td rowspan="2">Hari Kerja</td>
            </tr>
            <tr>
                <!--<th></th>-->
                <!--<th></th>-->
                <!--<th></th>-->
              <?php  for ($i = 1; $i <= $tanggal ; $i++) { ?>
                    <th>in</th>
                    <th>out</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody style="border: 1px solid #000;">
            <?php
                foreach($anggota as $agt) :  ?>
                    <tr>
                        <td>
                            <?php 
                                $getNama = $this->db->query("select nama from biodata where npk='". $agt->npk ."' ")->row();
                                echo $getNama->nama;
                            ?>
                        </td>
                        <td><?= $agt->npk ?></td>
                        <td><?= $agt->area_kerja ?></td>
                        <?php
                            for ($i = 1; $i <= $tanggal ; $i++) { ?>
                            
                                <?php
                                if($i <= 9){
                                    $i = "0". $i ;
                                }else {
                                    $i ;
                                }
                                 $tgl = $tahun . "-" . $bulan . "-" .  $i; ?>
                                <td>
                                <?php 
                                    $getAbsen = $this->db->query("select in_time from report_absen_wil2 where npk='". $agt->npk ."' and in_date='". $tgl ."' ");
                                    if($getAbsen->num_rows() > 0 ){
                                        $d = $getAbsen->row();
                                        echo $d->in_time ;
                                    }else {
                                        echo "" ;
                                    }
                                ?>
                                </td>
                                <td>
                                <?php 
                                    $getAbsen = $this->db->query("select out_time from report_absen_wil2 where npk='". $agt->npk ."' and in_date='". $tgl ."' ");
                                    if($getAbsen->num_rows() > 0 ){
                                        $d = $getAbsen->row();
                                        echo $d->out_time ;
                                    }else {
                                        echo "" ;
                                    }
                                ?>
                                </td>
                           <?php  }  ?>
                           <td>
                               <?php
                                $getAbsen = $this->db->query("select count(npk) as harikerja from report_absen_wil2 where npk='". $agt->npk ."' and 
                                in_date like '%". $tahun ."-". $bulan ."%' ")->row();
                                echo $getAbsen->harikerja;
                               ?>
                           </td>
                    </tr>
            <?php endforeach ; ?>
        </tbody>
    </table>