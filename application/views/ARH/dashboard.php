<div class="container  mt-4">

    <div class="row mb-3">
        <div class="col">
            <div class="pd-5 card bg-danger bg-200 shadow-none border">
                <div class="card-body">

                    <div class="row gx-0 flex-between-center">
                        <div style="padding-left:20px" class="col-sm-auto d-flex align-items-center">
                            <!-- <img class="ms-n2" src="https://isecuritydaihatsu.com/assets/img/icon.png" alt="" width="90" /> -->
                            <div style="padding-left:30px">
                                <h6 class="text-white fs--1 mb-0">Selamat Datang</h6>
                                <h4 class="text-white fw-bold mb-0"><?= $biodata->nama ?> </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6 mb-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6 class="fw-bold ">SECURITY MANGKIR WILAYAH 1 BULAN <?= strtoupper($bulan) ?></h6>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="small table-sm table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NPK</th>
                                        <th>AREA</th>
                                        <th>TOTAL MANGKIR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_mangkir->result() as $mk) : ?>
                                        <tr>
                                            <td><?= $mk->nama ?></td>
                                            <td><?= $mk->npk ?></td>
                                            <td><?php
                                                switch ($mk->area_kerja) {
                                                    case 'HO':
                                                        echo  "HEAD OFFICE";
                                                        break;
                                                    case 'P1':
                                                        echo "PLANT 1";
                                                        break;
                                                    case 'P2':
                                                        echo "PLANT 2";
                                                        break;
                                                    case 'P3':
                                                        echo "PLANT 3";
                                                        break;
                                                    case 'P4':
                                                        echo "PLANT 4";
                                                        break;
                                                    case 'P5':
                                                        echo "PLANT 5";
                                                        break;
                                                    case 'DOR':
                                                        echo "DORMITORI";
                                                        break;
                                                    case 'VLC':
                                                        echo "VEHICLE LOGISTIC CENTER";
                                                        break;
                                                    case 'PC':
                                                        echo "PART CENTER";
                                                        break;
                                                } ?></td>
                                            <td><?= $mk->total ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <span class="font-italic fw-bold small text-danger ">*total <?= $data_mangkir->num_rows() . ' MP' ?>*</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6>SECURITY MANGKIR WILAYAH 2 BULAN <?= strtoupper($bulan) ?></h6>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="small table-sm table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NPK</th>
                                        <th>AREA</th>
                                        <th>TOTAL MANGKIR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_mangkir2->result() as $mk) : ?>
                                        <tr>
                                            <td><?= $mk->nama ?></td>
                                            <td><?= $mk->npk ?></td>
                                            <td><?php
                                                switch ($mk->area_kerja) {
                                                    case 'HO':
                                                        echo  "HEAD OFFICE";
                                                        break;
                                                    case 'P1':
                                                        echo "PLANT 1";
                                                        break;
                                                    case 'P2':
                                                        echo "PLANT 2";
                                                        break;
                                                    case 'P3':
                                                        echo "PLANT 3";
                                                        break;
                                                    case 'P4':
                                                        echo "PLANT 4";
                                                        break;
                                                    case 'P5':
                                                        echo "PLANT 5";
                                                        break;
                                                    case 'DOR':
                                                        echo "DORMITORI";
                                                        break;
                                                    case 'VLC':
                                                        echo "VEHICLE LOGISTIC CENTER";
                                                        break;
                                                    case 'PC':
                                                        echo "PART CENTER";
                                                        break;
                                                } ?></td>
                                            <td><?= $mk->total ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <span class="font-italic fw-bold small text-danger ">*total <?= $data_mangkir2->num_rows() . ' MP' ?>*</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6>SECURITY MANGKIR WILAYAH 3 BULAN <?= strtoupper($bulan) ?></h6>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="small table-sm table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NPK</th>
                                        <th>AREA</th>
                                        <th>TOTAL MANGKIR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_mangkir3->result() as $mk) : ?>
                                        <tr>
                                            <td><?= $mk->nama ?></td>
                                            <td><?= $mk->npk ?></td>
                                            <td><?php
                                                switch ($mk->area_kerja) {
                                                    case 'HO':
                                                        echo  "HEAD OFFICE";
                                                        break;
                                                    case 'P1':
                                                        echo "PLANT 1";
                                                        break;
                                                    case 'P2':
                                                        echo "PLANT 2";
                                                        break;
                                                    case 'P3':
                                                        echo "PLANT 3";
                                                        break;
                                                    case 'P4':
                                                        echo "PLANT 4";
                                                        break;
                                                    case 'P5':
                                                        echo "PLANT 5";
                                                        break;
                                                    case 'DOR':
                                                        echo "DORMITORI";
                                                        break;
                                                    case 'VLC':
                                                        echo "VEHICLE LOGISTIC CENTER";
                                                        break;
                                                    case 'PC':
                                                        echo "PART CENTER";
                                                        break;
                                                } ?></td>
                                            <td><?= $mk->total ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <span class="font-italic fw-bold small text-danger ">*total <?= $data_mangkir3->num_rows() . ' MP' ?>*</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6>SECURITY MANGKIR WILAYAH 4 BULAN <?= strtoupper($bulan) ?></h6>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="small table-sm table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NPK</th>
                                        <th>AREA</th>
                                        <th>TOTAL MANGKIR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_mangkir4->result() as $mk) : ?>
                                        <tr>
                                            <td><?= $mk->nama ?></td>
                                            <td><?= $mk->npk ?></td>
                                            <td><?php
                                                switch ($mk->area_kerja) {
                                                    case 'HO':
                                                        echo  "HEAD OFFICE";
                                                        break;
                                                    case 'P1':
                                                        echo "PLANT 1";
                                                        break;
                                                    case 'P2':
                                                        echo "PLANT 2";
                                                        break;
                                                    case 'P3':
                                                        echo "PLANT 3";
                                                        break;
                                                    case 'P4':
                                                        echo "PLANT 4";
                                                        break;
                                                    case 'P5':
                                                        echo "PLANT 5";
                                                        break;
                                                    case 'DOR':
                                                        echo "DORMITORI";
                                                        break;
                                                    case 'VLC':
                                                        echo "VEHICLE LOGISTIC CENTER";
                                                        break;
                                                    case 'PC':
                                                        echo "PART CENTER";
                                                        break;
                                                } ?></td>
                                            <td><?= $mk->total ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <span class="font-italic fw-bold small text-danger ">*total <?= $data_mangkir4->num_rows() . ' MP' ?>*</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>