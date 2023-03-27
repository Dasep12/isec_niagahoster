<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">IJIN SAKIT</label>
        </div>
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>

<div style="margin-top:500px; padding-top:45mm; background-color:#F9FAFA;" class="container-md mt-5">

    <?php if ($this->session->flashdata('info_send')) : ?>
        <div style="margin-top:20px ;" class="alert alert-info alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('info_send') ?>
            <?php $this->session->unset_userdata("info_send") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <div class="form-group">
        <form id="kirimData" enctype="multipart/form-data" method="post" onsubmit="return cek()" action="<?= base_url('Pengajuan/input_sakit') ?>">
            <label for="" class="fw-bold">Tanggal Sakit</label>
            <input type="date" name="tanggal_ijin" id="tanggal_ijin" class="form-control text-dark">

            <input type="hidden" name="id_ijin" value="<?= $this->session->userdata("id_akun") ?>">
            <input type="hidden" name="npk" value="<?= $this->session->userdata("npk") ?>">
            <input type="hidden" name="nama" value="<?= $this->session->userdata("nama") ?>">
            <input type="hidden" name="wilayah" value="<?= $wilayah ?>">
            <input type="hidden" name="area" value="<?= $area ?>">

            <label for="" class="fw-bold">Lampirkan Surat Dokter</label>
            <div class="form-control text-dark">
                <input type="file" name="berkas" id="file">
            </div>

            <label for="" class="fw-bold">Keterangan Sakit</label>
            <textarea name="ket" class="form-control text-dark" id="ket"></textarea>

            <label for="" class="fw-bold">Pilih Pic</label>
            <?php if ($korlap->num_rows() > 0) { ?>
                <select name="korlap" id="" class="form-control text-dark">
                    <?php foreach ($korlap->result() as $kl) : ?>
                        <option value="<?= $kl->npk ?>"><?= $kl->nama ?></option>
                    <?php endforeach ?>
                </select>
            <?php } else { ?>
                <select name="korlap" id="" class="form-control text-dark">
                    <option value="">Tidak ada korlap</option>
                </select>
            <?php } ?>
            <a style="margin-bottom: 70px" href="<?= base_url('Pengajuan') ?>" class="btn btn-sm btn-info  mt-2 "> <span class="bx  bx-left-arrow"></span> Kembali</a>
            <button style="margin-bottom: 70px" name="kirim_data" class="btn btn-danger btn-sm mt-2">Kirim Ijin</button>
        </form>
    </div>



</div>


<script>
    $('.bs-timepicker').timepicker();
    $('.bs-timepicker2').timepicker();

    function cek() {
        if ($("#tanggal_ijin").val() == "") {
            alert("isi tanggal sakit");
            return false;
        } else if ($("#file").val() == "") {
            alert("isi file surat dokter");
            return false;
        } else if ($("#alasan_lembur").val() == "") {
            alert("isi alasan overtime");
            return false;
        }

        return
    }
</script>