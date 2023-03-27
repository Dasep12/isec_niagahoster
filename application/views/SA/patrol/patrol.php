<div class="container  mt-4">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h6>Patrol Guard</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <form method="post" target="_blank" action="<?= base_url('SA/Patrol/tarikExcel') ?>">
                                <label for="">Pilih Area Kerja</label>
                                <select name="area_patrol" id="" class="form-control text-dark mb-2">
                                    <option value="P1">PLANT 1</option>
                                    <option value="P2">PLANT 2</option>
                                    <option value="P3">PLANT 3</option>
                                    <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                    <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                    <option value="P5">PLANT 5</option>
                                    <option value="VLC">VLC</option>
                                    <option value="HO">HEAD OFFICE</option>
                                    <option value="PC">PART CENTER</option>
                                    <option value="DOR">DORMITORY</option>

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
                                <!-- <button type="button" id="btnView" class="btn btn-sm btn-success mt-2"><i class="fas fa-eye"></i> Preview Report</button> -->

                                <button type="submit" class="btn btn-sm  btn-success mt-2"><i class="fas fa-file-excel"></i> Download Report Excel</button>
                                <label class="text-danger" id="inf" style="display:none">sedang mengambil data harap tunggu . . . </label>
                            </form>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <form method="post" target="_blank" action="<?= base_url('SA/Patrol/reportPeriodik') ?>">
                                <label for="">Pilih Area Kerja</label>
                                <select class="form-control text-dark" name="area_kerja">
                                    <option value="P1">PLANT 1</option>
                                    <option value="P2">PLANT 2</option>
                                    <option value="P3">PLANT 3</option>
                                    <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                    <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                    <option value="P5">PLANT 5</option>
                                    <option value="VLC">VLC</option>
                                    <option value="HO">HEAD OFFICE</option>
                                    <option value="PC">PART CENTER</option>
                                    <option value="DOR">DORMITORY</option>
                                </select>

                                <label for="">Tanggal Awal</label>
                                <input value="<?= date('Y-m-d') ?>" id="date12" type="text" name="day2" class="form-control text-dark">

                                <label for="">Tanggal Akhir</label>
                                <input value="<?= date('Y-m-d') ?>" type="text" id="date13" name="day3" class="form-control text-dark">
                                <button type="submit" class="btn btn-sm btn-danger mt-2"><i class="fas fa-file-pdf"></i> Download Report PDF</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="card mt-2 bg-secondary">
                <div class="card-body">
                    <canvas style="" id="myChart" class="bg-white"></canvas>
                </div>
            </div> -->
        </div>

    </div>
</div>


<script>
    const wilayah = "<?= $wilayah ?>";
    var label2 = [];
    var data2 = [];
    if (wilayah === 'WIL1') {
        label2 = [
            'PLANT 4 - LINE 1',
            'PLANT 4 - LINE 2',
        ];
        data2 = [
            <?= $P4A->total ?>,
            <?= $P4B->total ?>
        ]
    } else if (wilayah === 'WIL2') {
        label2 = [
            'PLANT 4 - LINE 1',
            'PLANT 4 - LINE 2',
        ];
    };

    const data = {


        labels: label2,
        datasets: [{
            label: 'Grafik Patroli ' + "<?= $tanggal ?>",
            data: data2,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                // defining min and max so hiding the dataset does not change scale range
                y: {
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

    $(function() {

        $('#date12').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#date13').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    })
</script>