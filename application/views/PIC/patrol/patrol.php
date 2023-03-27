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
                            <form method="post" target="_blank" action="<?= base_url('PIC/Patrol/tarikExcel') ?>">
                                <label for="">Pilih Area Kerja</label>
                                <select name="area_patrol" id="" class="form-control text-dark mb-2">
                                    <?php
                                    if ($wilayah == 'WIL1') { ?>
                                        <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                        <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                    <?php } else if ($wilayah == 'WIL2') { ?>
                                        <option value="HO">HEAD OFFICE</option>
                                        <option value="P1">PLANT 1</option>
                                        <option value="VLC">VLC</option>
                                    <?php } else if ($wilayah == 'WIL3') { ?>
                                        <option value="P3">PLANT 3</option>
                                        <option value="P2">PLANT 2</option>
                                        <option value="PC">PART CENTER</option>
                                        <option value="DOR">DORMITORY</option>
                                    <?php } else if ($wilayah == 'WIL4') { ?>
                                        <option value="P5">PLANT 5</option>
                                    <?php }
                                    ?>
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
                            <form method="post" target="_blank" action="<?= base_url('PIC/Patrol/reportPeriodik') ?>">
                                <label for="">Pilih Area Kerja</label>
                                <select class="form-control text-dark" name="area_kerja">
                                    <?php
                                    if ($wilayah == 'WIL1') { ?>
                                        <option value="P4-ASSY1">PLANT 4 - ASSY1</option>
                                        <option value="P4-ASSY2">PLANT 4 - ASSY2</option>
                                    <?php } else if ($wilayah == 'WIL2') { ?>
                                        <option value="HO">HEAD OFFICE</option>
                                        <option value="P1">PLANT 1</option>
                                        <option value="VLC">VLC</option>
                                    <?php } else if ($wilayah == 'WIL3') { ?>
                                        <option value="P3">PLANT 3</option>
                                        <option value="P2">PLANT 2</option>
                                        <option value="PC">PART CENTER</option>
                                        <option value="DOR">DORMITORY</option>
                                    <?php } else if ($wilayah == 'WIL4') { ?>
                                        <option value="P5">PLANT 5</option>
                                    <?php }
                                    ?>
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
            <div class="card mt-2  mb-5">
                <div class="card-body">
                    <table class="table small table-bordered ">
                        <thead class="table-dark">
                            <tr>
                                <th>Lokasi</th>
                                <th>Total ( patroli )</th>
                                <th>Durasi ( per 1x patroli )</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $area = ['P1', 'P2', 'P3', 'P4-ASSY1', 'P4-ASSY2', 'P5', 'PC', 'VLC', 'DOR', 'HO'];
                            for ($g = 0; $g < count($area); $g++) { ?>
                                <tr>
                                    <td><?= $area[$g] ?></td>
                                    <td>
                                        <?php
                                        $c = $this->Super_model->countPatroli($area[$g], $tanggal);
                                        echo $c->total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $durasi = $this->db->query("SELECT durasi_patroli.durasi , durasi_patroli.id_durasi FROM hasil_patroli  JOIN  durasi_patroli 
                                            WHERE   durasi_patroli.id_durasi = hasil_patroli.id_durasi AND tgl_kirim_patroli = '" . $tanggal . "' AND area_kerja = '" . $area[$g] . "' and durasi_patroli.persentasi = 100 
                                            GROUP BY durasi_patroli.id_durasi ORDER BY durasi_patroli.id ASC  ");
                                        foreach ($durasi->result() as $drs) {
                                            echo "<li style='list-style-type:square'>" . $drs->durasi . "</li>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-2 bg-secondary mb-5">
                <div class="card-body">
                    <canvas id="myChart" class="bg-white"></canvas>
                </div>
            </div>
        </div>

    </div>
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
            label: 'Patroli ' + "<?= $tanggal ?>",
            data: [
                <?= $HO->total == null || $HO->total == 0 ? '0' : $HO->total ?>,
                <?= $DOR->total == null || $DOR->total == 0 ? '0' : $DOR->total ?>,
                <?= $PC->total == null || $PC->total == 0 ? '0' : $PC->total ?>,
                <?= $VLC->total == null || $VLC->total == 0 ? '0' : $VLC->total ?>,
                <?= $P1->total == null || $P1->total == 0 ? '0' : $P1->total ?>,
                <?= $P2->total == null || $P2->total == 0 ? '0' : $P2->total ?>,
                <?= $P3->total == null || $P3->total == 0 ? '0' : $P3->total ?>,
                <?= $P4A->total == null || $P4A->total == 0 ? '0' : $P4A->total  ?>,
                <?= $P4B->total == null || $P4B->total == 0 ? '0' : $P4B->total ?>,
                <?= $P5->total  == null || $P5->total == 0 ? '0' : $P5->total ?>
            ],
            fill: true,
            borderColor: 'rgb(10, 192, 202)',
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


    $('#date12').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#date13').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
</script>