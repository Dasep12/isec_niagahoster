<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center">PENGAJUAN </label>
        </div>
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>


<div style="margin-top:250px;  background-color:#F9FAFA;" class="container-md">
    <div class="row">
        <div class="col-lg-3 mb-1">
            <div class="small-box bg-primary">
                <div class="inner">
                    <img height="80px" width="80px" src="https://cdn-icons-png.flaticon.com/512/6312/6312486.png" alt="">
                    <a href="<?= base_url('Pengajuan/form_input_overtime') ?>" class="fw-bold text-white">Pengajuan Overtime</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-1">
            <div class="small-box bg-primary ">
                <div class="inner">
                    <img height="80px" width="80px" src="https://cdn-icons-png.flaticon.com/512/3567/3567331.png" alt="">
                    <span style="color:#F9FAFA;border-radius: 3px;width:auto;">
                        <a href="<?= base_url('Pengajuan/form_input_skta') ?>" class="fw-bold text-white">Pengajuan SKTA <i class="fas fa-arrow-left"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-1">
            <div class="small-box bg-primary">
                <div class="inner">
                    <img height="80px" width="80px" src="https://cdn-icons-png.flaticon.com/512/4861/4861682.png" alt="">
                    <a href="<?= base_url('Pengajuan/form_input_sakit') ?>" class="fw-bold text-white">Sakit</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3" style="margin-bottom: 5px">
            <div class="small-box bg-primary">
                <div class="inner">
                    <img height="80px" width="80px" src="https://cdn-icons-png.flaticon.com/512/4861/4861792.png" alt="">
                    <a href="<?= base_url('Pengajuan/form_input_cuti') ?>" class="fw-bold text-white">Pengajuan Cuti</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3" style="margin-bottom: 100px">
            <div class="small-box bg-primary">
                <div class="inner">
                    <img height="80px" width="80px" src="https://cdn-icons-png.flaticon.com/512/4861/4861792.png" alt="">
                    <a href="<?= base_url('Pengajuan/status') ?>" class="fw-bold text-white">Status Pengajuan</a>
                </div>
            </div>
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