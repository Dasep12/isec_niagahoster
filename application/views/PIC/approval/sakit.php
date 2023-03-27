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
    <h3>Daftar Approval Sakit</h3>
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
                            <th>Surat Dokter</th>
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
                                    <td><?= $dt->date_perijinan ?></td>
                                    <td><?= $dt->keterangan  ?></td>
                                     <td>
                                        <a href="#" onclick="openLink('<?= $dt->dokumen_perijinan ?>')"><img id="hallo" src="https://cdn-icons-png.flaticon.com/512/2659/2659360.png" height="30px" width="30px" data-image="tes"></a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Approve Ijin Sakit ?')" title="Approve Ijin Sakit" href="<?= base_url('PIC/Approval/approve_sakit?id=' . $dt->id . '&npk=' . $dt->npk) ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a onclick="return confirm('Tolak Ijin Sakit ?')" title="Tolak Ijin Sakit" href="<?= base_url('PIC/Approval/reject_sakit?id=' . $dt->id . '&npk=' . $dt->npk) ?>" class="btn btn-sm btn-danger"><i class="fas fa-window-close"></i></a>
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
<script>
    function openLink(image) {
        const url = "<?= base_url('assets/surat_sakit/') ?>" + image;
        window.open(url, '1429893142534', 'width=650', 'height=400', 'scrollbars=1,resizable=0,left=0,top=0');
        return;
    }
</script>