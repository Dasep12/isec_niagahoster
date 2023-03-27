<ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="biodata-tab" data-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status Pekerja</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <?php if ($data->foto != NULL) { ?>
                        <img height="200" width="200" src="<?= base_url('assets/berkas/Poto/' . $data->foto) ?>" class="rounded float-left" alt="<?= $data->nama ?>">
                    <?php } else { ?>
                        <img height="200" width="200" src="<?= base_url('assets/img/icon-header.png') ?>" class="rounded float-left" alt="<?= $data->nama ?>">

                    <?php   } ?>
                </div>
            </div>
            <div class="col-lg-8">
                <table class="table  small table-small table-striped">
                    <tr>
                        <td>Npk</td>
                        <td>:</td>
                        <td><?= $data->npk ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $data->nama ?></td>
                    </tr>
                    <tr>
                        <td>Nomor KTP</td>
                        <td>:</td>
                        <td><?= $data->ktp ?></td>
                    </tr>
                    <tr>
                        <td>Nomor KK</td>
                        <td>:</td>
                        <td><?= $data->ktp ?></td>
                    </tr>
                    <tr>
                        <td>Alamat KTP</td>
                        <td>:</td>
                        <td><?= $data->jl_ktp . ' ' . $data->kel_ktp . ' ' . $data->kec_ktp  . ' ' . $data->rw_ktp . ' ' . $data->rt_ktp  . ' ' . $data->kota_ktp . ' ' . $data->provinsi_ktp ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Domisili</td>
                        <td>:</td>
                        <td><?= $data->jl_dom . ' ' . $data->kel_dom . ' ' . $data->kec_dom  . ' ' . $data->rw_dom . ' ' . $data->rt_dom  . ' ' . $data->kota_dom . ' ' . $data->provinsi_dom ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Email</td>
                        <td>:</td>
                        <td><?= $data->email ?></td>
                    </tr>
                    <tr>
                        <td>No.Handphone</td>
                        <td>:</td>
                        <td><?= $data->no_hp ?></td>
                    </tr>
                    <tr>
                        <td>No.Emergency</td>
                        <td>:</td>
                        <td><?= $data->no_emergency ?></td>
                    </tr>
                    <tr>
                        <td>Tinggi Badan</td>
                        <td>:</td>
                        <td><?= $data->tinggi_badan ?></td>
                    </tr>
                    <tr>
                        <td>Berat Badan</td>
                        <td>:</td>
                        <td><?= $data->berat_badan ?></td>
                    </tr>
                    <tr>
                        <td>IMT</td>
                        <td>:</td>
                        <td><?= $data->imt ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan IMT</td>
                        <td>:</td>
                        <td><?= $data->keterangan ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <?php if ($data->foto != NULL) { ?>
                        <img height="200" width="200" src="<?= base_url('assets/berkas/Poto/' . $data->foto) ?>" class="rounded float-left" alt="<?= $data->nama ?>">
                    <?php } else { ?>
                        <img height="200" width="200" src="<?= base_url('assets/img/icon-header.png') ?>" class="rounded float-left" alt="<?= $data->nama ?>">

                    <?php   } ?>
                </div>
            </div>
            <div class="col-lg-8">
                <table class="table small table-small table-striped">
                    <tr>
                        <td>No KTA</td>
                        <td>:</td>
                        <td><?= $data->no_kta ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Berakhir KTA</td>
                        <td>:</td>
                        <td><?= $data->expired_kta ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?= $data->jabatan ?></td>
                    </tr>
                    <tr>
                        <td>Area Kerja</td>
                        <td>:</td>
                        <td><?= $data->area_kerja ?></td>
                    </tr>
                    <tr>
                        <td>Wilayah</td>
                        <td>:</td>
                        <td><?= $data->wilayah ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>