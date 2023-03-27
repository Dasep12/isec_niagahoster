<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">PENGAJUAN OVERTIME</label>
        </div>
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>

<div style="margin-top:500px; padding-top:45mm; background-color:#F9FAFA;" class="container-md mt-5">
    <div class="row">
        <form action="" method="post">
            <div class="form-group">
                <label for="" class="fw-bold">Cari Tanggal Hari Kerja </label>
                <input autocomplete="off" type="date" id="datepicker22" name="search_in_date" class="form-control text-dark">
                <a href="<?= base_url('Pengajuan') ?>" class=" mt-1 btn btn-sm btn-info"> <span class="bx  bx-left-arrow"></span> Kembali</a>
                <button name="cari_absen" class="btn btn-sm btn-success mt-1">cari absensi <i class="bx  bx-search"></i></button>
            </div>

        </form>

        <?php if ($this->session->flashdata('info_send')) : ?>

            <div style="margin-bottom: 30px" class="mb-5 alert alert-info alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('info_send') ?>
                <?php $this->session->unset_userdata("info_send") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="">
            <?php
            if (isset($_POST['cari_absen'])) {

                if ($histori_absensi->num_rows() > 0) {
                    $data = $histori_absensi->row(); ?>
                    <div class="form-group">
                        <form id="kirimData" method="post" onsubmit="return cek()" action="<?= base_url('Pengajuan/input_overtime') ?>">
                            <label for="" class="fw-bold">Tanggal Overtime</label>
                            <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                            <input readonly type="text" value="<?= $data->in_date ?>" name="in_date_ot" class="form-control text-dark">
                            <label for="" class="fw-bold">Jam Masuk Kerja</label>
                            <input type="text" readonly name="time_in" value="<?= $data->in_time ?>" class="form-control text-dark">

                            <label for="" class="fw-bold">Jam Selesai Kerja</label>
                            <input type="text" readonly name="time_out" value="<?= $data->out_time ?>" class="form-control text-dark">

                            <label for="" class="fw-bold">Jam Mulai Overtime</label>
                            <input type="text" autocomplete="off" id="in_ot" name="in_ot" class="bs-timepicker form-control text-dark">

                            <label for="" class="fw-bold">Jam Selesai Overtime</label>
                            <input type="text" autocomplete="off" id="out_ot" name="out_ot" class="bs-timepicker2 form-control text-dark">

                            <label for="" class="fw-bold">Alasan Overtime</label>
                            <textarea name="alasan_lembur" class="form-control text-dark" id="alasan_lembur"></textarea>

                            <label for="" class=" fw-bold">Pilih Pic</label>
                            <?php if ($korlap->num_rows() > 0) { ?>
                                <select name="korlap" id="" class="form-control text-dark">
                                    <?php foreach ($korlap->result() as $kl) : ?>
                                        <option value="<?= $kl->npk ?>"><?= $kl->nama ?></option>
                                    <?php endforeach ?>
                                    <?php
                                        $npk = $this->session->userdata('npk');
                                        if ($npk == 229529 || $npk ==  226904 || $npk == 230251 || $npk ==  226869) { ?>
                                            <option value="41583">ANTON GIARTO</option>
                                    <?php   } ?>
                                </select>
                            <?php } else { ?>
                                <select name="korlap" id="" class="form-control text-dark">
                                    <option value="">Tidak ada pic</option>
                                </select>
                            <?php } ?>

                            <button name="kirim_data" class="btn btn-danger btn-sm mt-2 " style="margin-bottom: 60px">Kirim Overtime</button>
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
</div>


<script>
    $('.bs-timepicker').timepicker();
    $('.bs-timepicker2').timepicker();

    function cek() {
        if ($("#in_ot").val() == "") {
            alert("isi jam mulai overtime");
            return false;
        } else if ($("#out_ot").val() == "") {
            alert("isi jam selesai overtime");
            return false;
        } else if ($("#alasan_lembur").val() == "") {
            alert("isi alasan overtime");
            return false;
        }


        return
    }
</script>