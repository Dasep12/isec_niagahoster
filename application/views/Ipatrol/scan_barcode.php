<?php date_default_timezone_set('Asia/Jakarta'); ?>

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

    <br>

    <br>

    <div class="row">

        <!--<div class="container-md-3">-->

        <!--    <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">-->

        <!--        <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>-->

        <!--    </div>-->

        <!--</div>-->



        <div class="graph-wr">

            <div class="card mb-5">

                <div class="card-header">

                    <label for="" class="text-right" id="patrol_time"></label>

                </div>

                <div class="card-body">



                    <form id="formTikor" data-url="<?= base_url('Ipatrol/Patrolv2/getPlan') ?>">

                        <div id="dataPLAN" class="form-group">

                            <?php if ($this->session->flashdata('info_patroli')) { ?>

                                <div class="alert alert-info alert-dismissible fade show" role="alert">

                                    <?= $this->session->flashdata('info_patroli') ?>

                                    <?php $this->session->unset_userdata("info_patroli") ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                            <?php } ?>

                            <!-- isi plan nanti disini -->

                            <!--<label>trial kamera</label>-->

                            <input type="hidden" id="areaKERJAPATROLI" value="<?= $employee->area_kerja ?>">

                            <select class="form-control text-dark " name="area" id="area_kerja">
                                <option value="" data-icon="bx bx-street-view">Pilih Area Kerja </option>
                                <option value="P1" data-thumbnail="bx bx-street-view">PLANT 1 </option>
                                <option value="P2">PLANT 2</option>
                                <option value="P3">PLANT 3</option>
                                <option value="P4-ASSY1">PLANT 4 - ASSY 1</option>
                                <option value="P4-ASSY2">PLANT 4 - ASSY 2</option>
                                <option value="P5">PLANT 5</option>
                                <option value="VLC">VLC</option>
                                <option value="HO">HEAD OFFICE</option>
                                <option value="DOR">DORMITORY</option>
                                <option value="PC">PART CENTER</option>
                            </select>


                            <div class="mt-2" id="showLokasi">

                            </div>

                            <label class="text-danger small" style="display:none" id="infoScan">scanning barcode harap tunggu . . . </label>
                            <!--<label id="scanInfo" class="text-danger small scanInfo"><i>* scanning barcode . . . *</i></label>-->

                        </div>

                    </form>

                    <div class="form-group ps-4 " style="margin-left:15%;position:relative">
                        <video width="200" class="img-thumbnail" id="preview" playsinline></video>
                    </div>

                    <?php

                    $now = strtotime(date('H:i:s'));
                    // $now = strtotime(date('21:50:00'));
                    $shift = "";
                    $batas_shift1 = strtotime(date('15:00:00'));
                    $batas_shift2 = strtotime(date('23:00:00'));
                    $batas_shift3 = strtotime(date('07:00:00'));

                    if ($now > $batas_shift3 && $now <= $batas_shift1) {
                        $shift = 1;
                        echo "Patroli Pagi <br>7.00 - 15.00";
                        echo "<input type='hidden' id='shift' value='1'> ";
                        $cek_histori = $this->db->get_where('report_patrol', ['shift' => 3, 'area_kerja' => $employee->area_kerja]);
                        if ($cek_histori->num_rows() > 0) {
                            redirect(base_url('Ipatrol/Patrolv2/resetTime/' . $employee->area_kerja . '?shift=3'));
                        }
                    } else if ($now > $batas_shift1 && $now <= $batas_shift2) {
                        $shift = 2;
                        echo "Patroli Siang <br>15.00 - 23.00";
                        echo "<input type='hidden' id='shift' value='2'> ";
                        $cek_histori = $this->db->get_where('report_patrol', ['shift' => 1, 'area_kerja' => $employee->area_kerja]);
                        if ($cek_histori->num_rows() > 0) {
                            redirect(base_url('Ipatrol/Patrolv2/resetTime/' . $employee->area_kerja . '?shift=1'));
                        }
                    } else if ($now > $batas_shift2 || $now < $batas_shift3) {
                        $shift = 3;
                        echo "<input type='hidden' id='shift' value='3'> ";
                        echo "Patroli  Malam <br>23.00 - 7.00";
                        $cek_histori = $this->db->get_where('report_patrol', ['shift' => 2, 'area_kerja' => $employee->area_kerja]);
                        if ($cek_histori->num_rows() > 0) {
                            redirect(base_url('Ipatrol/Patrolv2/resetTime/' . $employee->area_kerja . '?shift=2'));
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->

<script>
    //zonasi area patroli
    function showMe(evt) {
        // console.log("evt.value ",evt.value);
    }


    function makeDd() {
        'use strict';
        let json = new Function(`return ${document.getElementById('json_data').innerHTML}`)();
        /*  new MsDropdown("#json_dropdown", {
              byJson: {
                  data: json, selectedIndex:1
              }
          })*/
        MsDropdown.make("#json_dropdown", {
            byJson: {
                data: json,
                selectedIndex: 0
            }
        });
    }





    // pilih plan dan titik barcode
    $(function() {
        // $('#mySelect').selectpicker();
        //pilih area kerja
        $('select[name=area').on('change', function() {
            var id = $("select[name=area] option:selected").val();
            // console.log(id);
            if (id == null || id == "") {
                document.getElementById("showLokasi").innerHTML = "";
                Instascan.Camera.getCameras().then(function(cameras) {
                    // if (cameras.length > 0) {
                    //     scanner.start(cameras[2]);
                    // } else {
                    //     console.error('No cameras found.');
                    // }
                }).catch(function(e) {
                    console.error(e);
                });
            } else {
                $.ajax({
                    url: "<?= base_url('Ipatrol/Patrolv2/getIDPLAN') ?>",
                    method: "POST",
                    data: "id_plan=" + id,
                    cache: false,
                    success: function(e) {
                        document.getElementById("showLokasi").innerHTML = e;
                    }
                })
            }
        });
    })

    // end


    Instascan.Camera.getCameras().then(function(cameras) {
        console.log(cameras.length);
        var totalCamera = cameras.length;
        if (cameras.length > 0) {
            var selectedCam = cameras[0];
            $.each(cameras, (i, c) => {
                if (c.name.indexOf('back') != -1) {
                    selectedCam = c;
                    return false;
                }
            });
            scanner.start(selectedCam);
            console.log(selectedCam);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });

    //tampilkan camera untuk scan barcode
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
        scanPeriod: 5,
    });



    scanner.addListener('scan', function(content) {
        //  console.log(content);
        var idLokasi = $("select[is='ms-dropdown'] option:selected").val();
        const areaPATROLI = document.getElementById("areaKERJAPATROLI").value;

        //console.log(idLokasi);
        const txt = content.split(",", 2);
        const lo = txt[0];
        const la = txt[1];
        // alert(idLokasi);

        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            // console.log("lat user" + lat);
            // console.log("long user " + long);
            $.ajax({
                url: $("#formTikor").attr('data-url'),
                method: "POST",
                beforeSend: function() {
                    document.getElementById("infoScan").style.display = "block";
                },
                complete: function() {
                    document.getElementById("infoScan").style.display = "none";
                },
                data: "tikor=" + idLokasi + '&barcode=' + content,
                success: function(e) {
                    console.log(e);
                    if (e == "OK") {
                        Swal.fire({
                            title: 'Attention!',
                            text: 'Area Sudah Di Lewati',
                            icon: 'error',
                        })
                    } else if (e == 0) {
                        Swal.fire({
                            title: 'Attention!',
                            text: 'Barcode Invalid',
                            icon: 'error',
                        })
                    } else {
                        // ambil shift
                        var shift = document.getElementById("shift").value;
                        //ambil data titik koordinat dari db
                        var result = JSON.parse(e);
                        const latitudeBarcode = result[0].latitude;
                        const longitudeBarcode = result[0].longitude;
                        const lokasi = result[0].id;
                        //   console.log("lat barcode " + latitudeBarcode);
                        //   console.log("long barcode " + longitudeBarcode);
                        //lokasi titik barcode disimpan 
                        var plan = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);
                        //lokasi perangkat user 
                        var posisi_user = new google.maps.LatLng(lat, long);
                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(plan, posisi_user) / 1000).toFixed(2);
                        // console.log(jarak);
                        var jarakRadius = "";
                        switch (areaPATROLI) {
                            case 'VLC':
                                if (jarak <= 0.20) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("VLC < 09 " + jarakRadius);
                                break;
                            case 'HO':
                                if (jarak <= 0.10) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("HO <= 11 " + jarakRadius);
                                break;
                            case 'DOR':
                                if (jarak <= 0.09) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("DOR < 11 " + jarakRadius);
                                break;
                            case 'PC':
                                if (jarak <= 0.11) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("PC < 11 " + jarakRadius);
                                break;
                            case 'P1':
                                if (jarak <= 0.10) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("P1 < 11 " + jarakRadius);
                                break;
                            case 'P2':
                                if (jarak <= 0.11) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("P2 < 11 " + jarakRadius);
                                break;
                            case 'P3':
                                if (jarak <= 0.11) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("P3 < 11 " + jarakRadius);
                                break;
                            case 'P4':
                                if (jarak <= 0.11) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("P4 < 11 " + jarakRadius);
                                break;
                            case 'P5':
                                if (jarak <= 1.5) {
                                    jarakRadius = "ok";
                                } else {
                                    jarakRadius = "nok";
                                }
                                console.log("P5 < 10 " + jarakRadius);
                                break;
                        }
                        //cek jarak titik dan lokasi
                        // if (jarak <= 0.09) {
                        if (jarakRadius == "ok") {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Lanjut Documentasi ',
                                icon: "success",
                            }).then(function() {
                                window.location = "<?= base_url("Ipatrol/Patrolv2/input_report/") ?>" + idLokasi + "?shift=" + shift;
                            })
                        } else {
                            Swal.fire({
                                title: 'Attention!',
                                text: 'Anda di Luar Area ' + jarak,
                                icon: 'error',
                            })
                        }
                        //end of cek titik dan lokasi barcode
                    }
                }
            })
        });
    });



    // reset status patroli jika sudah terlewati semua
    function reset() {
        var id = $("select[name=area] option:selected").val();
        // ambil shift
        var shift = document.getElementById("shift").value;
        console.log(shift);
        const url = $("#infoUpdate").attr("data-url");
        const refresh = $("#infoUpdate").attr("data-refresh");
        console.log(id);
        console.log(url);
        Swal.fire({
            title: 'Kirim Report ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: "GET",
                    data: 'id=' + id + "&shift=" + shift,
                    success: function(e) {
                        Swal.fire(
                            e,
                        ).then(function() {
                            window.location.href = refresh;
                        })
                    }
                })
            }
        })
    }
    // end of reset
</script>