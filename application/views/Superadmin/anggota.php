<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<div class="row mb-3 g-3">
        <div class="col-lg-12 col-xxl-9">
              <div class="card mb-3 d-flex align-items-content-start">
                  <div class="card-header pb-0 d-flex justify-content-between">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Jumlah Security</h6>
                </div>
                <div class="card-body d-flex justify-content-center"> 
                    <div class="table-responsive scrollbar">
                        <table id="daftar_anggota" class="table table-hover " >
                                 <thead>
                                    <tr>
                                        <th>NPK</th>
                                        <th>NAMA</th>
                                        <th>AREA KERJA</th>
                                        <th>WILAYAH</th>
                                        <th>MENU</th>
                                    </tr>
                                </thead> 
                        </table>
                    </div>
                </div>
            </div> 
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="display:block;" class="modal-body">
                    <div class="container-fluid">
                        <form action="" method="post" id="searchAbsensi">

                            <div class="row">
                               <div  class="col-md ms-left">
                                        <figure>
                                                <blockquote class="blockquote">
                                                    <p class="text-dark" id="Nama"></p>
                                                </blockquote>
                                                <figcaption class="blockquote-footer">
                                                    Area Kerja <cite id="AreaKerja" title="Area"></cite>
                                                </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-4 ms-right">
                                        <img style="width:100px;" class="rounded-circle" src="" alt="" id="Foto">
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="form-group  col-md-4 ms-left">
                                            <input hidden  type="text" name="npk" id="npk">
                                            <input hidden type="text" name="area" id="area">
                                            <label for="Wilayah">Wilayah</label>
                                            <input type="text" name="wilayah" placeholder="Wilayah" class="form-control" readonly id="Wilayah">
                                        </div>
                                        <div class="col-md-4 ms-auto">
                                            <label for="bulan">Bulan</label>
                                                <select name="bulan" class="form-control" id="bulan">
                                                    <option value="">Pilih Bulan</option>
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
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button style="float:right; display:none;" id="showBTN" class="btn btn-primary ">Cari Presensi</button>
                                        <label for="" style="display: none;" id="loadpresensi" class="text-danger small">sedang mengambil data . . . </label>
                                        <hr>
                                         <div style="overflow-y: auto;
                                              height: 350px;
                                              width: 100%;
                                              display:block;" id="showHasil">
                                            <!-- tampilkan data absen disini -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="BiodataModal" tabindex="-1" aria-labelledby="biodataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="biodataModalLabel">PROFILE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     
                        <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
                            <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                                <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0 active" id="crm-biodata-tab" data-bs-toggle="tab" href="#crm-biodata" role="tab" aria-controls="crm-biodata" aria-selected="true">Biodata</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-karyawan-tab" data-bs-toggle="tab" href="#crm-karyawan" role="tab" aria-controls="crm-karyawan" aria-selected="false">Karyawan</a></li>
               
                            </ul>
                        </div>
                        <div class="col-xxl-9">
                            <div class="tab-content">                              
                                                 <div class="tab-pane active" id="crm-biodata" role="tabpanel" aria-labelledby="crm-biodata-tab">
                                                    <div class="card-body">
                                                    <div class="col-lg-12">
                                                    <div class="row">   
                                                        <div class="col-lg-6 col-xs-auto">
                                                            <img id="Gambar" class="rounded-circle img-thumbnail shadow-sm" src="" width="200" alt="" />
                                                        </div>  
                                                        <div class="col-lg-6 col-xs-auto ">
                                                            <table class="table ">
                                                            <td><h6 class="mb-0 mt-2">Npk</h6></td>
                                                            <td>:</td>
                                                            <td><h6 id="nomorkaryawan" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Nama</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="nama" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Nomor KTP</h6></td>
                                                                <td>:</td>
                                                            <td><h6 id="ktp" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Nomor KK</h6></td>
                                                                <td>:</td>
                                                            <td><h6 id="kk" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Alamat KTP</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="alamatKTP" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Alamat Domisili</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="alamatDOM" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Alamat Email</h6></td>
                                                                <td>:</td>
                                                            <td><h6 id="mail" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">No Handhphone</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="nohp" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">No Emergency</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="nodar" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Tinggi Badan</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="tbadan" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Berat Badan</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="bbadan" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Nilai IMT</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="imt" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Keterangan IMT</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="keterangan" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <!-- <tr> -->
                                                                
                                                                <!-- <td> -->
                                                                <!-- Button update -->
                                                                <!-- <button type="button" class="btn btn-primary pull right" data-bs-toggle="modal" data-bs-target="#ModalBiodata">
                                                                    Update Biodata
                                                                </button> -->
                                                            <!-- </td> -->
                                                            <!-- </tr> -->
                                                            </table>
                                                        </div>         
                                                
                                                     </div>
                                                    </div>
                                                    </div> 
                                                </div>
                                                <div class="tab-pane" id="crm-karyawan" role="tabpanel" aria-labelledby="crm-karyawan-tab">
                                                    <div class="card-body">
                                                    <div class="col-lg-12">
                                                    <div class="row">    
                                                        <div class="col-lg-6 col-xs-auto ">
                                                            <table class="table ">
                                                            <td><h6 class="mb-0 mt-2">No KTA</h6></td>
                                                            <td>:</td>
                                                            <td><h6 id="noKTA" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Tanggal Berakhir KTA</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="tglKTA" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Jabatan</h6></td>
                                                                <td>:</td>
                                                            <td><h6 id="jabatan" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Status KTA</h6></td>
                                                                <td>:</td>
                                                            <td><h6 id="StatusKTA" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Area Kerja</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="areakerja" class="mb-0 mt-2"></h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6 class="mb-0 mt-2">Wilayah</h6></td>
                                                                <td>:</td>
                                                                <td><h6 id="wilayah" class="mb-0 mt-2"></h6></td>
                                                            </tr>   
                                                            <!-- <tr> -->
                                                                
                                                                <!-- <td> -->
                                                                <!-- Button update -->
                                                                <!-- <button type="button" class="btn btn-primary pull right" data-bs-toggle="modal" data-bs-target="#ModalBiodata">
                                                                    Update Biodata
                                                                </button> -->
                                                            <!-- </td> -->
                                                            <!-- </tr> -->
                                                            </table>
                                                        </div>         
                                                
                                                     </div>
                                                    </div>
                                                    </div> 
                                                </div>
                                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
              </div>
        

                       
                                   
                            


<script type="text/javascript">
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#daftar_anggota').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "ajax": {
                "url": "<?= base_url('Superadmin/Absensi/ajax_list')?>",
                "type": "POST"
                
            },
            "columnDefs": [ {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<center class='d-flex align-items-center'><a style='margin:7px;'  type='button' data-bs-toggle='modal' data-bs-target='#BiodataModal' class='btn btn-falcon-primary btn-sm '><i class='fa fa-address-card'></i> Biodata</a> <hr> <a type='button' data-bs-toggle='modal' data-bs-target='#exampleModal' class='btn btn-falcon-primary btn-sm'><i class='fa fa-barcode'></i>Absensi</a></center> "
                    } ],
        });
            $('#daftar_anggota tbody').on( 'click', 'a', function (e) {
                var data = table.row( $(this).parents('tr td') ).data();           
                 e.preventDefault();
                    $.ajax({
                        url: "<?= base_url('Superadmin/Anggota/profiling/') ?>" + data[0],
                        method: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(e) {
                            if(data[4] == null || data[4] == ""){
                            var img = document.getElementById("Gambar");
                            var newImg = new Image ;
                            newImg.onload = function(){
                                img.src = this.src 
                            };
                            newImg.src = "<?= base_url('assets/img/icon-header.png') ?>";
                            }else{
                            var img = document.getElementById("Gambar");
                            var newImg = new Image ;
                            newImg.onload = function(){
                                img.src = this.src 
                            };
                            newImg.src = "<?= base_url('assets/berkas/Poto/') ?>" + data[4];
                            }
                            document.getElementById('nomorkaryawan').innerText = e.npk
                            document.getElementById('nama').innerText = e.nama
                            document.getElementById('ktp').innerText = e.ktp
                            document.getElementById('kk').innerText = e.kk
                            document.getElementById('alamatKTP').innerText = e.jl_ktp + e.kel_ktp + e.kec_ktp + e.provinsi_ktp
                            document.getElementById('alamatDOM').innerText = e.jl_dom + e.kel_dom + e.kec_dom + e.provinsi_dom
                            // document.getElementById('tlahir').innerText = e.tempat_lahir;
                            // document.getElementById('tgllahir').innerText = e.tanggal_lahir;
                            document.getElementById('mail').innerText = e.email
                            document.getElementById('nohp').innerText = e.no_hp
                            document.getElementById('nodar').innerText = e.no_emergency
                            document.getElementById('tbadan').innerText = e.tinggi_badan
                            document.getElementById('bbadan').innerText = e.berat_badan
                            document.getElementById('imt').innerText = e.imt
                            document.getElementById('keterangan').innerText = e.keterangan
                            document.getElementById('noKTA').innerText = e.no_kta
                            document.getElementById('tglKTA').innerText = e.expired_kta
                            document.getElementById('jabatan').innerText = e.jabatan
                            document.getElementById('StatusKTA').innerText = e.status_kta
                            document.getElementById('areakerja').innerText = e.area_kerja
                            document.getElementById('wilayah').innerText = e.wilayah
                            
                            var exampleModal = document.getElementById('exampleModal')
                            exampleModal.addEventListener('show.bs.modal', function (event) {
                            // Button that triggered the modal
                            var button = event.relatedTarget
                            // Extract info from data-bs-* attributes
                            var recipient = button.getAttribute('data-bs-whatever')
                            // If necessary, you could initiate an AJAX request here
                            // and then do the updating in a callback.
                            //
                            // Update the modal's conten
                            })
                        }
                    })
                });

                 $('#daftar_anggota tbody').on( 'click', 'a', function () {
                var data = table.row( $(this).parents('tr td') ).data();           
                document.getElementById("npk").value = data[0];
                document.getElementById("area").value = data[2];
                document.getElementById("Nama").innerText = data[1];
                document.getElementById("AreaKerja").innerText = data[2];
                document.getElementById("Wilayah").value = data[3];
                if(data[4] == null || data[4] == ""){
                            var img = document.getElementById("Foto");
                            var newImg = new Image ;
                            newImg.onload = function(){
                                img.src = this.src 
                            };
                            newImg.src = "<?= base_url('assets/img/icon-header.png') ?>";
                            }else{
                            var img = document.getElementById("Foto");
                            var newImg = new Image ;
                            newImg.onload = function(){
                                img.src = this.src 
                            };
                            newImg.src = "<?= base_url('assets/berkas/Poto/') ?>" + data[4];
                            }
                var exampleModal = document.getElementById('exampleModal')
                exampleModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's conten
                })

                });

            // show tombol cari jika bulan di pilih
            $('select[name=bulan]').on('change', function() {
                var bulan = $(this).children("option:selected").val();
                if (bulan == null || bulan == "") {
                    document.getElementById("showBTN").style.display = "none";
                } else {
                    document.getElementById("showBTN").style.display = "block";
                }
            });

             // tampilkan data absensi ketika tombol submit di tekan
            $("#searchAbsensi").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('Superadmin/Absensi/showAbsensi') ?>",
                    data: new FormData(this),
                    method: "POST",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        document.getElementById("loadpresensi").style.display = "block";
                    },
                    complete: function() {
                        document.getElementById("loadpresensi").style.display = "none";
                    },
                    success: function(e) {
                        document.getElementById("showHasil").innerHTML = e;
                    }
                })

            })

            

            
    });

</script>