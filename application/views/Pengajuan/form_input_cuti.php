<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">PENGAJUAN CUTI</label>
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
        <form id="kirimData" enctype="multipart/form-data" method="post" onsubmit="return cek()" action="<?= base_url('Pengajuan/input_cuti') ?>">
            <label for="" class="fw-bold">Tanggal Cuti</label>
            <input type="date" name="tanggal_cuti" id="tanggal_cuti" class="form-control text-dark">


            <input type="hidden" name="id_ijin" value="<?= $this->session->userdata("id_akun") ?>">
            <input type="hidden" name="npk" value="<?= $this->session->userdata("npk") ?>">
            <input type="hidden" name="nama" value="<?= $this->session->userdata("nama") ?>">
            <input type="hidden" name="wilayah" value="<?= $wilayah ?>">
            <input type="hidden" name="area" value="<?= $area ?>">



            <label for="" class="fw-bold">Alasan Cuti</label>
            <textarea name="alasan_cuti" class="form-control text-dark" id="alasan_cuti"></textarea>

            <label for="" class="fw-bold">Pilih Pic</label>
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
        if ($("#tanggal_cuti").val() == "") {
            alert("isi tanggal cuti");
            return false;
        } else if ($("#alasan_cuti").val() == "") {
            alert("isi alasan cuti");
            return false;
        }


        return
    }

    $(document).ready(function() {
        $('#datePick').multiDatesPicker();
    });
</script>