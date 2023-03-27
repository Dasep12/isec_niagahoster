<?php
switch ($data->wilayah) {
    case 'WIL1':
        $wil = "Wilayah 1";
        break;
    case 'WIL2':
        $wil = "Wilayah 2";
        break;
    case 'WIL3':
        $wil = "Wilayah 3";
        break;
    case 'WIL4':
        $wil = "Wilayah 4";
        break;
        $wil  = null;
        break;
}
?>
<div class="container  mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Histori Approval</h4>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overtime</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#cuti" role="tab" aria-controls="cuti" aria-selected="false">Cuti</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="skta-tab" data-toggle="tab" href="#skta" role="tab" aria-controls="skta" aria-selected="false">SKTA</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="sakit-tab" data-toggle="tab" href="#sakit" role="tab" aria-controls="sakit" aria-selected="false">Sakit</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <!-- overtime -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="table_id" class="table table-sm small table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPK</th>
                                <th>Area</th>
                                <th>Tanggal Overtime</th>
                                <th>Jam Overtime</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($overtime->result() as $ot) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $ot->nama ?></td>
                                    <td><?= $ot->npk ?></td>
                                    <td><?php
                                        switch ($ot->area_kerja) {
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
                                        }   ?></td>
                                    <td><?= $ot->date_lembur ?></td>
                                    <td><?= $ot->over_time_start . ' s/d ' . $ot->over_time_end ?></td>
                                    <td><?= $ot->status_lembur == 1 ? '<span class="badge badge-success btn-success">Approve</span>' : '<span class="badge badge-danger  btn-danger">Rejected</span>' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- cuti -->
                <div class="tab-pane fade" id="cuti" role="tabpanel" aria-labelledby="cuti-tab">
                    <table id="table_id4" class="table table-sm small table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPK</th>
                                <th>Area</th>
                                <th>Tanggal Cuti</th>
                                <th>keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($cuti->result() as $ct) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $ct->nama ?></td>
                                    <td><?= $ct->npk ?></td>
                                    <td><?php switch ($ct->area_kerja) {
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
                                        }   ?></td>
                                    <td><?= $ct->tanggal_cuti ?></td>
                                    <td><?= $ct->alasan_cuti ?></td>
                                    <td><?= $ct->status == 1 ? '<span class="badge badge-success btn-success">Approve</span>' : '<span class="badge badge-danger  btn-danger">Rejected</span>' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- perijinan skta -->
                <div class="tab-pane fade" id="skta" role="tabpanel" aria-labelledby="skta-tab">
                    <table id="table_id2" class="table table-sm small table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPK</th>
                                <th>Area</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Pulang</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($skta->result() as $st) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $st->nama ?></td>
                                    <td><?= $st->npk ?></td>
                                    <td><?php switch ($st->area_kerja) {
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
                                        }   ?></td>
                                    <td><?= $st->date_in . ' ' . $st->in_time ?></td>
                                    <td><?= $st->date_out . ' ' . $st->out_time ?></td>
                                    <td><?= $st->keterangan ?></td>
                                    <td><?= $st->status == 1 ? '<span class="badge badge-success btn-success">Approve</span>' : '<span class="badge badge-danger  btn-danger">Rejected</span>' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- perijinan sakit -->
                <div class="tab-pane fade" id="sakit" role="tabpanel" aria-labelledby="sakit-tab">
                    <table id="table_id3" class="table table-sm small table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPK</th>
                                <th>Area</th>
                                <th>Tanggal Sakit</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($sakit->result() as $sk) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $sk->nama ?></td>
                                    <td><?= $sk->npk ?></td>
                                    <td><?php switch ($sk->area_kerja) {
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
                                        }   ?></td>
                                    <td><?= $sk->date_perijinan ?></td>
                                    <td><?= $sk->keterangan ?></td>
                                    <td><?= $sk->status == 1 ? '<span class="badge badge-success btn-success">Approve</span>' : '<span class="badge badge-danger  btn-danger">Rejected</span>' ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>