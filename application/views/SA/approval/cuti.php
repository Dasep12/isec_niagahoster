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
    <h3>Daftar Approval Cuti</h3>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table id="table_id" class="table-bordered table table-sm small">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>NAMA</th>
                            <th>NPK</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data->num_rows() > 0) {
                            foreach ($data->result() as $dt) : ?>
                                <tr>
                                    <td><?= $dt->nama ?></td>
                                    <td><?= $dt->npk ?></td>
                                    <td><?= $dt->tanggal_cuti  ?></td>
                                    <td><?= $dt->alasan_cuti  ?></td>
                                    <td>
                                        <a onclick="return confirm('Approve Cuti ?')" title="Approve Cuti" href="<?= base_url('SA/Approval/approve_cuti?id=' . $dt->id . '&npk=' . $dt->npk) ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a onclick="return confirm('Tolak Cuti ?')" title="Tolak Overtime" href="<?= base_url('SA/Approval/reject_cuti?id=' . $dt->id . '&npk=' . $dt->npk) ?>" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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