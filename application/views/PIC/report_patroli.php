<div class="bg-tikor col-lg-11 container-fluid">

    <div class="tab-content" id="pills-tabContent">
        <div class="row">
            <div class="col-lg-6">
                <!-- isi disini -->
                <div class="card">
                    <div class="card-body">
                        <form method="post" target="_blank" action="<?= base_url('PIC/Report_Patroli/tarikExcel') ?>">
                            <label for="">Pilih Area Kerja</label>
                            <select name="area_patrol" id="" class="form-control text-dark mb-2">
                                <option value="VLC">VLC</option>
                                <option value="HO">HEAD OFFICE</option>
                                <option value="DOR">DOR</option>
                                <option value="PC">PC</option>
                                <option value="P1">PLANT 1</option>
                                <option value="P2">PLANT 2</option>
                                <option value="P3">PLANT 3</option>
                                <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                <option value="P5">PLANT 5</option>
                            </select>
                            
                            <select name="bulan" class="form-control" id="bulan">
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
                            <button type="submit" class="btn  btn-success mt-2">Generate Excel</button>
                        </form>
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                <!-- isi disini -->
                <form method="post" target="_blank" action="<?= base_url('PIC/Report_Patroli/reportPeriodik') ?>">
                <label for="">Pilih Area Kerja</label>
                <select class="form-control text-dark" name="area_kerja">
                    <option value="VLC">VLC</option>
                    <option value="HO">HEAD OFFICE</option>
                    <option value="DOR">DOR</option>
                    <option value="PC">PC</option>
                    <option value="P1">PLANT 1</option>
                    <option value="P2">PLANT 2</option>
                    <option value="P3">PLANT 3</option>
                    <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                    <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                    <option value="P5">PLANT 5</option>
                </select>
                
                
                <label for="">Tanggal Awal</label>
                <input value="<?= date('Y-m-d') ?>" id="date1" type="text" name="day2"  class="form-control text-dark">

                <label for="">Tanggal Akhir</label>
                <input value="<?= date('Y-m-d') ?>" type="text" id="date3" name="day3"  class="form-control text-dark">
                <button type="submit" class="btn btn-danger mt-2">Generate PDF</button>
            </form>
            </div>
        </div>
      </div>
    </div>  
        </div>
          

<!---->
<div class="row mt-2">
    <div class="col-lg-12">
        <!-- isi disini -->
        <div class="card">
            <div class="card-body">
                <!-- report patroli -->
                 <canvas id="myChart"></canvas>
                <!-- end report patroli -->
            </div>
        </div>
    </div>
</div>
<!---->


</div>
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
            label: 'Grafik Patroli',
            data: [<?= $HO->total ?>, <?= $DOR->total ?>, <?= $PC->total ?>, <?= $VLC->total ?>, <?= $P1->total ?>, <?= $P2->total ?>, <?= $P3->total ?>, <?= $P4A->total ?>, <?= $P4B->total ?>, <?= $P5->total ?>],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
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
                y: { // defining min and max so hiding the dataset does not change scale range
                    min: 0,
                    max: 6
                }
            }
        }
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    
    $(function(){
        $('#date1').datepicker({
            format : 'yyyy-mm-dd' ,
            autoclose : true
        });
        
        $('#date3').datepicker({
            format : 'yyyy-mm-dd' ,
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
    })
</script>