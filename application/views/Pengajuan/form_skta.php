<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">PENGAJUAN SKTA</label>
        </div>
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>

<div style="margin-top:500px; padding-top:45mm; background-color:#F9FAFA;" class="container-md mt-5">
    <form action="" method="post">
        <div class="form-group">
            <label for="" class="fw-bold">Cari Tanggal Hari Kerja</label>
            <input autocomplete="off" type="date" id="datepicker22" name="search_in_date" class="form-control text-dark">
            <a href="<?= base_url('Pengajuan') ?>" class=" mt-1 btn btn-sm btn-info"><span class="bx  bx-left-arrow"></span>Kembali</a>
            <button name="cari_absen" class="btn btn-sm btn-success mt-1">cari absensi <i class="bx  bx-search"></i></button>
        </div>

        <?php if ($this->session->flashdata('info_send')) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('info_send') ?>
                <?php $this->session->unset_userdata("info_send") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
    </form>

    <div class="">
        <?php
        if (isset($_POST['cari_absen'])) {

            if ($histori_absensi->num_rows() > 0) {
                $data = $histori_absensi->row(); ?>
                <div class="form-group">
                    <form id="kirimData" method="post" onsubmit="return cek()" action="<?= base_url('Pengajuan/input_skta') ?>">
                        <label for="" class="fw-bold">Tanggal Masuk</label>
                        <input type="hidden" name="wilayah" value="<?= $wilayah ?>">
                        <input type="hidden" name="area" value="<?= $area ?>">
                        <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                        <input type="date" value="<?= $data->in_date ?>" id="date_in" name="date_in" class="form-control text-dark ">
                        <label for="" class="fw-bold">Edit Jam Masuk</label>
                        <input type="text" name="time_in" id="time_in" value="<?= $data->in_time ?>" class="form-control text-dark bs-timepicker">

                        <label for="" class="fw-bold">Tanggal Pulang</label>
                        <input type="date" id="date_out" name="date_out" value="<?= $data->out_date ?>" class="form-control text-dark">


                        <label for="" class="fw-bold">Edit Jam Pulang</label>
                        <input type="text" autocomplete="off" id="time_out" value="<?= $data->out_time ?>" name="time_out" class="bs-timepicker2 form-control text-dark">

                        <label for="" class="fw-bold">Alasan Pengajuan SKTA</label>
                        <textarea name="keterangan" class="form-control text-dark" id="keterangan"></textarea>

                        <label for="" class="fw-bold">Pilih Pic</label>
                        <?php if ($korlap->num_rows() > 0) { ?>
                            <select name="korlap" id="" class="form-control text-dark">
                                <?php foreach ($korlap->result() as $kl) : ?>
                                    <option value="<?= $kl->npk ?>"><?= $kl->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php } else { ?>
                            <select name="korlap" id="" class="form-control text-dark">
                                <option value="">Tidak ada Pic</option>
                            </select>
                        <?php } ?>

                        <button name="kirim_data" class="btn btn-danger btn-sm mt-2 " style="margin-bottom: 60px">Kirim SKTA</button>
                    </form>
                </div>
            <?php  } else { ?>
                <div class="alert alert-danger">
                    tidak ada data
                </div>
        <?php     }
        } ?>

    </div>

</div>


<script>
    $('.bs-timepicker').timepicker({
        showSeconds: true,
    });
    $('.bs-timepicker2').timepicker({
        timeFormat: 'HH:mm:ss p',
        showSeconds: true,
    });

    function cek() {
        if ($("#date_in").val() == "") {
            alert("isi tanggal masuk kerja");
            return false;
        } else if ($("#time_in").val() == "") {
            alert("isi jam masuk kerja");
            return false;
        } else if ($("#date_out").val() == "") {
            alert("isi tanggal pulang kerja");
            return false;
        } else if ($("#time_ot").val() == "") {
            alert("isi jam pulang kerja");
            return false;
        } else if ($("#keterangan").val() == "") {
            alert("isi keterangan");
            return false;
        }

        return
    }
</script>