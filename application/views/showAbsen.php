<div style="padding-bottom:65px;" class="content">
 <div class="container-md-3">
<table id="table_id"  class="table-responsive-md table table border-dark">
    <thead style="display:block;">
        <tr>
             <th>No</th>
             <th>Tanggal</th>
             <th>IN</th>      
             <th>Out</th>
             <th>OT</th>
             <th>Ket</th>
        </tr>
    </thead>
    <tbody style="overflow-y: auto;
  height: 350px;
  width: 102%;
  display:block;">
        <?php
            if ($absen) {
                $no = 1;
                $t = new Grei\TanggalMerah();

                $tahun = date('Y'); //Mengambil tahun saat ini
                // $bulan = date('m'); //Mengambil bulan saat ini
                $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                 <tr>
                     <td><?= $no++ ?></td>
                     <td>
                         <?php
                            $d = $tahun . "-" . $bulan . "-" . $i;
                            $result = preg_replace("/[^A-Za-z0-9]/", "", $d);
                            $t->set_date($result);
                            if ($t->is_holiday() > 0) {
                                echo '<label class="text-danger" style="text-color:black; ">' . date("d-m-y",strtotime($d))  . '</label>';
                            } else {
                                echo '<label>' . date("d-m-y",strtotime($d))  . '</label>';
                            }
                            ?>
                     </td>
                     <?php
                        $dr = $tahun . '-' . $bulan . '-' . $i;
                        $cek = $this->db->get_where($tabel, ['in_date' => $dr, 'id_absen' => $this->session->userdata('id_akun')]);
                        if ($cek->num_rows() > 0) {
                            foreach ($cek->result() as $r) {
                                echo "<td>" . date("H:i",strtotime($r->in_time)) . "</td>";
                                if( $r->out_time == "" || $r->out_time == null  ){
                                    echo "<td>-</td>" ;     
                                }else {
                                    echo "<td>" . date("H:i",strtotime($r->out_time)) . "</td>" ;     
                                } ;
                                
                                if( $r->over_time == "" || $r->over_time == null  ){
                                    echo "<td>-</td>" ;     
                                }else {
                                    echo "<td>" . date("H:i",strtotime($r->over_time)) . "</td>" ;     
                                } ;
                                
                                    echo "<td>" . $r->ket . "</td>" ;     
                                
                            }
                            // echo "<td>tanggal ada</td>";
                        } else {
                            // echo $absen[$i]->in_time;
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                        }
                        ?>
                 </tr>
         <?php }
            } else {
                echo "<td>Tidak ada data</td>";
            }
            ?>


    </tbody>
</table>
</div>
</div>