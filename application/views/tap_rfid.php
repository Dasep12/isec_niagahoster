<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
        </div>
        <a style="position:relative;width:100%" class="fixed-top btn btn-danger btn-sm mb-2" href="#">
            <span class="bx bx-street-view"></span> I - PATROL
        </a>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
    <div class="row">
        <div class="graph-wr">

            <br>
            <br>
            <br>
            <input type="text" autocomplete="off" id="rfidcard" class=" mb-5">

            <img src="<?= base_url("assets/img/rfidanimasi.png") ?>" alt="">
            <div class="alert alert-info">
                <label class="text-center text-primary">Tempel Kartu Ke Perangkat Tambahan di Handphone Anda</label>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $("#rfidcard").focus();
        // var field = document.getElementById("rfidcard");

        // $('body').mousemove(function() {
        //     $("#rfidcard").focus()
        // })

        // $("#rfidcard").keyup(function() {
        //     var card = document.getElementById("rfidcard").value
        //     console.log(card);
        // })
    })

    document.activeElement.blur();
</script>