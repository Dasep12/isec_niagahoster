<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<div class="row mb-3 g-3">
        <div class="col-lg-12 col-xxl-9">
            <!---->
            <!--<button id="button2">open the dialog</button>-->
            <!---->
              <div class="card mb-3">
                  <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Jumlah Security</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end"> 
                    <div class="table-responsive scrollbar">
                        <table id="daftar_anggota" class="table table-hover">
                                 <thead>
                                    <tr>
                                        <th>NPK</th>
                                        <th>NAMA</th>
                                        <th>AREA KERJA</th>
                                        <th>WILAYAH</th>
                                        <th>VIEW</th>
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
                <div class="modal-body">
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
                                        <img style="width:100px;" class="rounded-circle" src="" alt="" id="myGambar">
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
                                         <div id="showHasil">
                                            <!-- tampilkan data absen disini -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                    
                    
                    <!--  modal edit absen -->
                    <form action="demo_form.asp" id="dase" method="get" style="display: none;">
                      IN:
                      <input id="in" type="text" id name="fname">
                      <br> OUT:
                      <input id="out" type="text" name="lname">
                      <br>
                      <input type="submit" value="Submit">
                    </form>
                    <div id="dialog">
                    
                    </div>
                    <!-- end edit absen -->
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
                        "defaultContent": "<a type='button'   data-bs-toggle='modal' data-bs-target='#exampleModal' class='btn btn-danger btn-sm'><i class='fa fa-edit'></i>View!</a>"
                    } ],
        });
            $('#daftar_anggota tbody').on( 'click', 'a', function () {
                var data = table.row( $(this).parents('tr td') ).data();           
                document.getElementById("npk").value = data[0];
                document.getElementById("area").value = data[2];
                document.getElementById("Nama").innerText = data[1];
                document.getElementById("AreaKerja").innerText = data[2];
                document.getElementById("Wilayah").value = data[3];
                if(data[4] == null || data[4] == ""){
                        var img = document.getElementById("myGambar");
                        var newImg = new Image ;
                        newImg.onload = function(){
                            img.src = this.src 
                        };
                        newImg.src = "<?= base_url('assets/img/icon-header.png') ?>";
                }else{
                var img = document.getElementById("myGambar");
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

    function show(id,table){
        $.ajax({
            url : "<?= base_url('Superadmin/Absensi/form_edit2') ?>" ,
            method : "GET" ,
            data : "id=" + id + "&table=" + table   ,
            success : function(e){
                  var result = JSON.parse(e);
                  document.getElementById("in").value = result.in_date + " " +  result.in_time ;
                  document.getElementById("out").value = result.out_date + " " + result.out_time ;
                  console.log(result);
                  $("#dase").dialog({
                    appendTo: '#dialog',
                    title: "Ubah Absensi"
                  });
            }
        })
    }

</script>