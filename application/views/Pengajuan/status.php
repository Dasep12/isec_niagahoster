<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">STATUS PENGAJUAN</label>
        </div>

    </div>
</div>


<div style="margin-top:220px;padding-top:22mm; background-color:#F9FAFA;" class="container-md mt-5">
    <div class="row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="small nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">OVERTIME</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="small  nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">SAKIT</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="small  nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">CUTI</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="small nav-link" id="skta-tab" data-bs-toggle="tab" data-bs-target="#skta-tab-pane" type="button" role="tab" aria-controls="skta-tab-pane" aria-selected="false">SKTA</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <table class="table">
                    <tr>
                        <th>Tanggal OT</th>
                        <th>IN OT</th>
                        <th>OUT OT</th>
                        <th>STATUS</th>
                    </tr>
                    <tbody>
                        <?php foreach ($overtime->result() as $ov) : ?>
                            <tr>
                                <td><?= $ov->date_lembur ?></td>
                                <td><?= $ov->over_time_start ?></td>
                                <td><?= $ov->over_time_end ?></td>
                                <td>
                                    <?php
                                    if ($ov->status_lembur == 1) {
                                        echo '<span class="text-success">Diterima</span>';
                                    } else if ($ov->status_lembur == 0) {
                                        echo '<span class="text-primary">Pending</span>';
                                    } else if ($ov->status_lembur == 2) {
                                        echo '<span class="text-danger">Di tolak</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <table class="table">
                    <tr>
                        <th>Tanggal Sakit</th>
                        <th>SKD</th>
                        <th>STATUS</th>
                    </tr>
                    <tbody>
                        <tr><?php foreach ($sakit->result() as $skt) : ?>
                        <tr>
                            <td><?= $skt->date_perijinan ?></td>
                            <td>
                                <a class="text-dark" href="<?= base_url('assets/surat_sakit/') . $skt->dokumen_perijinan ?>">
                                    <i class="bx bx-book"></i>
                                </a>
                            </td>
                            <td>
                                <?php
                                if ($skt->status == 1) {
                                    echo '<span class="text-success">Diterima</span>';
                                } else if ($skt->status == 0) {
                                    echo '<span class="text-primary">Pending</span>';
                                } else if ($skt->status == 2) {
                                    echo '<span class="text-danger">Di tolak</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <table class="table">
                    <tr>
                        <th>Tanggal Cuti</th>
                        <th>STATUS</th>
                    </tr>
                    <tbody>
                        <?php foreach ($cuti->result() as $ct) : ?>
                            <tr>
                                <td><?= $ct->tanggal_cuti ?></td>
                                <td>
                                    <?php
                                    if ($ct->status == 1) {
                                        echo '<span class="text-success">Diterima</span>';
                                    } else if ($ct->status == 0) {
                                        echo '<span class="text-primary">Pending</span>';
                                    } else if ($ct->status == 2) {
                                        echo '<span class="text-danger">Di tolak</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="skta-tab-pane" role="tabpanel" aria-labelledby="skta-tab" tabindex="0">
                <table class="table">
                    <tr>
                        <th>Tanggal SKTA</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>STATUS</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>2022-02-04</td>
                            <td>20:02:04</td>
                            <td>07:02:04</td>
                            <td>Pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</div>