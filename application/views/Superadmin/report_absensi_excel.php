<style>
table {
    width: 716px; /* 140px * 5 column + 16px scrollbar width */
    text-align: center;
    position: relative;
     border-collapse: collapse;
}
 thead tbody tr  {
    display: block;
}
table, thead, tbody, th, td {
  border: 1px solid black;
  }
 tbody {
    height: 350px;
    overflow-y: auto;
    overflow-x: hidden;
}

tbody td, thead th {
    width: 400px;
}

thead th:last-child {
    width: 156px; /* 140px + 16px scrollbar width */
 } 
</style>

<?php

$t = new Grei\TanggalMerah();
    $bulan;
    $tahun = date('Y'); //Mengambil tahun saat ini
    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    $anggota = $this->db->query("select npk ,area_kerja , wilayah , id_employee from employee where wilayah='$wilayah' order by area_kerja ")->result();
    
    ?>
    
    <table id="myTable" class="table table-bordered table-striped fs--1 mb-0 scroll">
       <thead class="bg-200 text-900">
            <tr class="collaps">    
                <th rowspan="2">Nama</th>
                <th rowspan="2">NPK</th>
                <th rowspan="2">Area Kerja</th>
                <?php
                for ($i = 1; $i <= $tanggal ; $i++) { ?>
                    <th colspan="2"><?= $i ?></th>
                <?php } ?>
              
                <th rowspan="2">Hari Kerja</th>
                <th rowspan="2">CUTI</th>
                <th rowspan="2">SAKIT</th>
                <th rowspan="2">IJIN</th>
            </tr>
            </tr>

            <tr>
             <?php  for ($i = 1; $i <= $tanggal ; $i++) { ?> 
                    <th>in</th>
                    <th>out</th>
             <?php } ?> 
              
            </tr> 
        </thead>
        <tbody> 
              <?php
                foreach($anggota as $agt) :  ?>
                    <tr>
                        <td class="name">
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
                                    $getAbsen = $this->db->query("select in_time from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and in_date='". $tgl ."' ");
                                    if($getAbsen->num_rows() > 0 ){
                                        $d = $getAbsen->row();
                                        echo $d->in_time ;
                                    }else {
                                        echo "-" ;
                                    }
                                ?>
                                </td>
                                <td>
                                <?php 
                                    $getAbsen = $this->db->query("select out_time from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and in_date='". $tgl ."' ");
                                    if($getAbsen->num_rows() > 0 ){
                                        $d = $getAbsen->row();
                                        echo $d->out_time ;
                                    }else {
                                        echo "-" ;
                                    }
                                ?>
                                </td>
                           <?php  }  ?>
                           <td>
                               <?php
                                $getAbsen = $this->db->query("select count(npk) as harikerja from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and 
                                in_date like '%". $tahun ."-". $bulan ."%' ")->row();
                                echo $getAbsen->harikerja;
                               ?>
                           </td>
                           <td>
                               <?php
                                $getAbsen = $this->db->query("select count(npk) as cuti from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and 
                                in_date like '%". $tahun ."-". $bulan ."%' and ket like 'CUTI' ")->row();
                                echo $getAbsen->cuti;
                               ?>
                           </td>
                           <td>
                               <?php
                                $getAbsen = $this->db->query("select count(npk) as sakit from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and 
                                in_date like '%". $tahun ."-". $bulan ."%' and ket like 'SAKIT' ")->row();
                                echo $getAbsen->sakit;
                               ?>
                           </td>
                                                      <td>
                               <?php
                                $getAbsen = $this->db->query("select count(npk) as ijin from ".$namaTable.$namaWilayah." where npk='". $agt->npk ."' and 
                                in_date like '%". $tahun ."-". $bulan ."%' and ket like 'IJIN' ")->row();
                                echo $getAbsen->ijin;
                               ?>
                           </td>
                    </tr>
            <?php endforeach ; ?>
        </tbody>
    </table>