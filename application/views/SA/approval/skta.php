<div class="container  mt-4">
    <?php if ($this->session->flashdata('ok')) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('ok')  ?>
            <?php $this->session->unset_userdata("ok") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php  } else if ($this->session->flashdata('nok')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('nok') ?>
            <?php $this->session->unset_userdata("nok") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <h3>Daftar Approval SKTA</h3>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table id="table_id" class="table-bordered table table-sm small">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>NAMA</th>
                            <th>NPK</th>
                            <th>AREA</th>
                            <th>TANGGAL</th>
                            <th>JAM</th>
                            <th>KETERANGAN</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data->num_rows() > 0) {
                            foreach ($data->result() as $dt) : ?>
                                <tr>
                                    <td><?= $dt->nama ?></td>
                                    <td><?= $dt->npk ?></td>
                                    <td><?= $dt->area_kerja ?></td>
                                    <td><?= $dt->date_in  ?></td>
                                    <td><?= $dt->in_time . ' s/d ' . $dt->out_time  ?></td>
                                    <td><?= $dt->keterangan  ?></td>
                                    <td>
                                        <a onclick="return confirm('Approve SKTA ?')" title="Approve SKTA" href="<?= base_url('SA/Approval/approve_skta?id=' . $dt->id . '&id_absen=' . $dt->id_biodata) ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>

                                        <a onclick="return confirm('Tolak SKTA ?')" title="Tolak Overtime" href="<?= base_url('SA/Approval/reject_skta?id=' . $dt->id) ?>" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach  ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="justiy-content-center">
                                    <h4 class="text-center">Tidak ada data</h4>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>