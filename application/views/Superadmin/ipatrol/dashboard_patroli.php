<div class="bg-tikor col-lg-11 container-fluid">

    <div class="tab-content" id="pills-tabContent">
        <div class="row">
           <div class="card">
               <div class="card-body">
                   
               <div class="row">
                      <div class="col-lg-6 mb-2">
                         <form method="post" target="_blank" action="<?= base_url('Superadmin/I_Patrol/tarikExcel') ?>">
                            <label for="">Pilih Area Kerja</label>
                            <select name="area_patrol" id="" class="form-control text-dark mb-2">
                                <option value="VLC">VLC</option>
                                <option value="HO">HEAD OFFICE</option>
                                <option value="DOR">DORMITORY</option>
                                <option value="PC">PART CENTER</option>
                                <option value="P1">PLANT 1</option>
                                <option value="P2">PLANT 2</option>
                                <option value="P3">PLANT 3</option>
                                <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                <option value="P5">PLANT 5</option>
                            </select>
                            
                            <select name="bulan" required class="form-control" id="bulan">
                                <option value="">Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Maret</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <button type="button" id="btnView" class="btn btn-sm btn-success mt-2"><i class="fas fa-eye"></i> Preview Report</button>
                            <button type="submit"  class="btn btn-sm  btn-primary mt-2"><i class="fas fa-file-excel"></i> Download Report</button>
                            <label class="text-danger" id="inf" style="display:none">sedang mengambil data harap tunggu . . . </label>
                        </form> 
                      </div>
                      <div class="col-lg-6 mb-2">
                          <form method="post" target="_blank" action="<?= base_url('Superadmin/I_Patrol/reportPeriodik') ?>">
                                    <label for="">Pilih Area Kerja</label>
                                    <select class="form-control text-dark" name="area_kerja">
                                        <option value="VLC">VLC</option>
                                        <option value="HO">HEAD OFFICE</option>
                                        <option value="DOR">DORMITORY</option>
                                        <option value="PC">PART CENTER</option>
                                        <option value="P1">PLANT 1</option>
                                        <option value="P2">PLANT 2</option>
                                        <option value="P3">PLANT 3</option>
                                        <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                        <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                        <option value="P5">PLANT 5</option>
                                    </select>
                                
                                    <label for="">Tanggal Awal</label>
                                    <input value="<?= date('Y-m-d') ?>" id="date12" type="text" name="day2"  class="form-control text-dark">
                    
                                    <label for="">Tanggal Akhir</label>
                                    <input value="<?= date('Y-m-d') ?>" type="text" id="date13" name="day3"  class="form-control text-dark">
                                    <button type="submit" class="btn btn-sm btn-danger mt-2"><i class="fas fa-file-pdf"></i> Preview Report</button>
                            </form>
                      </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
     
     <div class="row mt-2" id="rpt">
        <div class="card">
            <div class="card-body">
            <!-- isi disini -->
               <div id="convert" class="table-responsive">
                   
               </div>
            </div>
        </div>
    </div>
          

<!---->
<div class="row mt-2">
        <!-- isi disini -->
        <div class="card">
            <div class="card-body">
                <!-- report patroli -->
                <div class="flex justify-content-center">
                 <button id="btn-download" class="btn btn-success btn-sm ">
                    Download Grafik
                 </button>
                </div>
                 <canvas id="myChart"></canvas>
                 <div class="mt-2">
                     <fieldset>
                         <!--<legend>Report Patroli</legend>-->
                         <table class="table small table-bordered ">
                             <thead class="table-dark">
                                <tr>
                                    <th>Lokasi</th>
                                    <th>Total ( patroli )</th>
                                    <th >Durasi ( per 1x patroli )</th>
                                </tr>
                             </thead>
                        <tbody>
                            <?php
                            $area = ['P1', 'P2', 'P3', 'P4-ASSY1', 'P4-ASSY2', 'P5', 'PC' , 'VLC', 'DOR', 'HO'];
                            for ($g = 0; $g < count($area); $g++) { ?>
                                <tr>
                                    <td><?= $area[$g] ?></td>
                                    <td>
                                        <?php
                                           $c = $this->Super_model->countPatroli($area[$g], $tanggal);
                                           echo $c->total . " x" ;
                                           
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                          $durasi = $this->db->query("SELECT durasi_patroli.durasi , durasi_patroli.id_durasi FROM hasil_patroli  JOIN  durasi_patroli 
                                            WHERE   durasi_patroli.id_durasi = hasil_patroli.id_durasi AND tgl_kirim_patroli = '" . $tanggal . "' AND area_kerja = '" . $area[$g] . "'
                                            GROUP BY durasi_patroli.id_durasi ORDER BY durasi_patroli.id ASC  ");
                                            foreach($durasi->result() as $drs){
                                                echo "<li style='list-style-type:square'>". $drs->durasi ."</li>" ;
                                            }
                                         ?>
                                    </td>
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                     </fieldset>
                     
                 </div>
                <!-- end report patroli -->
            </div>
        </div>
</div>
</div>
<!---->


<script>
  const data = {
        labels: [
            'Head Office ',
            'Dormitori ',
            'Part Center ',
            'VLC ',
            'Plan 1 ',
            'Plan 2',
            'Plan 3',
            'Plan 4 - ASSY 1 ',
            'Plan 4 - ASSY 2 ',
            'Plan 5 ',
        ],
        datasets: [{
            label: 'Grafik Patroli ' + "<?= $tanggal ?>",
            data: [<?= $HO->total ?>, <?= $DOR->total ?>, <?= $PC->total ?>, <?= $VLC->total ?>, <?= $P1->total ?>, <?= $P2->total ?>, <?= $P3->total ?>, <?= $P4A->total ?>, <?= $P4B->total ?>, <?= $P5->total ?>],
            fill: false,
            borderColor: 'rgb(75, 192, 192)' , 
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            // animations: {
            //     tension: {
            //         duration: 1000,
            //         easing: 'linear',
            //         from: 1,
            //         to: 0,
            //         loop: true
            //     }
            // },
            scales: {
                    // defining min and max so hiding the dataset does not change scale range
                y: { 
                    min: 0,
                    max:6
                }
            }
        }
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    
    var image = myChart.toBase64Image();
    console.log(image);
    
    document.getElementById('btn-download').onclick = function() {
      // Trigger the download
      var a = document.createElement('a');
      a.href = myChart.toBase64Image();
      a.download = 'my_file_name.png';
      a.click();
    }
    
    $(function(){
        $('#date12').datepicker({
            dateFormat : 'yy-mm-dd' ,
            autoclose : true
        });
        
        $('#date13').datepicker({
             dateFormat : 'yy-mm-dd' ,
            autoclose : true
        });
        
        $('#example').DataTable({
            scrollY: "350px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                left: 2,
                // right: 1
            }
        });
        
        //show data bulanan
        $("#btnView").on('click',function(){
            var id = $("select[name=area_patrol] option:selected").val();
            var bulan = $("select[name=bulan] option:selected").val();
            
            if(bulan == null || bulan == ""){
                alert("Pilih Bulan");
            }else {
                $.ajax({
                    url : "<?= base_url("Superadmin/I_Patrol/showPatroli") ?>" ,
                    method : "POST" ,
                    data : "area=" + id +"&bulan=" + bulan ,
                    beforeSend : function(){
                      document.getElementById("inf").style.display="block" ;  
                    },
                    complete : function(){
                      document.getElementById("inf").style.display="none" ;  
                        
                    },
                    success : function(result){
                        document.getElementById("convert").innerHTML = result ;
                        console.log(result);
                    }
                })
            }
        })
        
        
    })
</script>