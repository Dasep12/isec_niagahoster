<div class="container  mt-4">

    <div class="card mb-5">
        <div class="card-header">
            <h3>Profiling Anggota</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_id" class="table-sm small table-bordered table table-small">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>NAMA</th>
                            <th>NPK</th>
                            <th>WILAYAH</th>
                            <th>AREA KERJA</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota->result() as $agt) :  ?>
                            <tr>
                                <td><?= $agt->nama ?></td>
                                <td><?= $agt->npk ?></td>
                                <td><?php
                                    switch ($agt->wilayah) {
                                        case 'WIL1':
                                            echo "WILAYAH 1";
                                            break;
                                        case 'WIL2':
                                            echo "WILAYAH 2";
                                            break;
                                        case 'WIL3':
                                            echo "WILAYAH 3";
                                            break;
                                        case 'WIL4':
                                            echo "WILAYAH 4";
                                            break;
                                        default:

                                            break;
                                    } ?></td>
                                <td><?php
                                    switch ($agt->area_kerja) {
                                        case 'HO':
                                            echo  "HEAD OFFICE";
                                            break;
                                        case 'P1':
                                            echo "PLANT 1";
                                            break;
                                        case 'P2':
                                            echo "PLANT 2";
                                            break;
                                        case 'P3':
                                            echo "PLANT 3";
                                            break;
                                        case 'P4':
                                            echo "PLANT 4";
                                            break;
                                        case 'P5':
                                            echo "PLANT 5";
                                            break;
                                        case 'DOR':
                                            echo "DORMITORI";
                                            break;
                                        case 'VLC':
                                            echo "VEHICLE LOGISTIC CENTER";
                                            break;
                                        case 'PC':
                                            echo "PART CENTER";
                                            break;
                                    } ?></td>
                                <td>
                                    <a href="#" data-backdrop="static" class="text-danger" data-keyboard="false" data-toggle="modal" data-target="#edit-data" title="Detail Biodata" data-npk="<?= $agt->npk ?>"><i class="fa fa-id-card"></i>
                                    </a>

                                    <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-npk="<?= $agt->npk ?>" data-nama="<?= $agt->nama ?>" data-area="<?= $agt->area_kerja ?>" data-target="#absensi-data" title="Absensi" href="#" class=" ms-3"><i class="fa fa-clock"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- modal  -->
<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
            </div>
            <div class="modal-body" id="inputBiodata">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- -->


<!-- modal  -->
<div class="modal fade" id="absensi-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Absensi</h5>
            </div>
            <div class="modal-body" id="">
                <div class="row">
                    <div class="col lg-4">
                        <table class="table">
                            <tr>
                                <td>NAMA</td>
                                <td>:</td>
                                <td><label for="" id="nama_agt"></label></td>
                            </tr>
                            <tr>
                                <td>NPK</td>
                                <td>:</td>
                                <td><label for="" id="npk_agt"></label></td>
                            </tr>

                            <tr>
                                <td>AREA KERJA</td>
                                <td>:</td>
                                <td><label for="" id="area_agt"></label></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col lg-6">
                        <form name="report_absensi" id="report_absen" action="#">
                            <input type="hidden" name="npk_" id="npk_">
                            <label for="">TAHUN</label>
                            <select name="tahun_absensi" class="form-control" id="tahun_absensi">
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                            </select>

                            <label for="">BULAN</label>
                            <select name="bulan_absensi" class="form-control" id="bulan_absensi">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Maret</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>

                            <button class="mt-2 btn btn-info btn-sm">Cari Absensi <i class="fas fa-search"></i></button>
                        </form>
                        <span id="info" style="display: none;" class="text-danger small font-italic">sedang mengambil data absensi . . . </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div id="absensi">
                            <!-- show absensi disini -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- -->


<script>
    $("#edit-data").on("show.bs.modal", function(event) {
        var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
        var modal = $(this);
        var npk = div.data("npk")
        $.ajax({
            url: "<?= base_url('PIC/Profiling/modalBiodata') ?>",
            method: "POST",
            data: 'npk=' + npk,
            success: function(e) {
                console.log(npk)
                document.getElementById("inputBiodata").innerHTML = e;
            }
        })
    });



    $("#absensi-data").on("show.bs.modal", function(event) {
        var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
        var modal = $(this);
        var npk = div.data("npk")
        var nama = div.data("nama")
        var area = div.data("area")
        console.log(area)
        switch (area) {
            case 'HO':
                area = "HEAD OFFICE";
                break;
            case 'P1':
                area = "PLANT 1";
                break;
            case 'P2':
                area = "PLANT 2";
                break
            case 'P3':
                area = "PLANT 3";
                break
            case 'P4':
                area = "PLANT 4";
                break;
            case 'P5':
                area = "PLANT 5";
                break
            case 'DOR':
                area = "DORMITORI";
                break;
            case 'VLC':
                area = "VEHICLE LOGISTIC CENTER";
                break
            case 'PC':
                area = "PART CENTER";
                break;
        }
        document.getElementById("nama_agt").innerHTML = nama;
        document.getElementById("npk_agt").innerHTML = npk;
        document.getElementById("area_agt").innerHTML = area;
        document.getElementById("npk_").value = npk;
        document.getElementById('absensi').innerHTML = "";
    });

    $("#report_absen").on('submit', function(e) {
        e.preventDefault();
        var npk = document.getElementById("npk_").value;
        var tahun = $("select[name=tahun_absensi] option:selected").val();
        var bulan = $("select[name=bulan_absensi] option:selected").val();
        $.ajax({
            url: "<?= base_url('PIC/Profiling/modalAbsensi') ?>",
            method: "POST",
            data: "npk=" + npk + "&bulan=" + bulan + "&tahun=" + tahun,
            beforeSend: function() {
                document.getElementById('info').style.display = "block";
            },
            complete: function() {
                document.getElementById('info').style.display = "none";

            },
            success: function(e) {
                document.getElementById('absensi').innerHTML = e;
                // console.log(e)
            }
        })
    })
</script>