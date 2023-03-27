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
                                <h4 class="text-white fw-bold mb-0"><?= $bidoata->nama ?> </h4>
                            </div><img class="ms-n4 d-md-none d-lg-block" src="../assets/img/illustrations/crm-line-chart.png" alt="" width="150" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-100 shadow-none border mt-4">
                <div class="card-header">
                    <h5>Security Mangkir di Bulan <?= ucwords($bulan) ?></h5>
                </div>
                <div class="card-body">
                    <div class="row gx-0 flex-between-center">
                        <table class="table table-hover table-bordered ">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Npk</th>
                                    <th>Nama</th>
                                    <th>Area Kerja</th>
                                    <th>Jabatan</th>
                                    <th>Total Mangkir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data_mangkir->num_rows() > 0) {
                                    foreach ($data_mangkir->result() as $rsl) : ?>
                                        <tr>
                                            <td><?= $rsl->npk ?></td>
                                            <td><?= $rsl->nama ?></td>
                                            <td><?= $rsl->area_kerja ?></td>
                                            <td><?= $rsl->jabatan ?></td>
                                            <td><?= $rsl->total ?> kali</td>
                                        </tr>
                                    <?php endforeach;
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="justiy-content-center">
                                            <h4 class="text-center">Tidak ada data</h4>
                                        </td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>