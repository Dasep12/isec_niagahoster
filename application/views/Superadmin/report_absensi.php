<div class="bg-tikor col-lg-11 container-fluid">

    <div class="tab-content" id="pills-tabContent">
        <div class="row">
           <div class="card">
               <div class="card-body">
                   
               <div class="row">
                      <div class="col-lg-6 mb-2">
                         <form method="post" target="_blank" action="<?= base_url('Superadmin/Report_absensi/DownloadABsensi') ?>">
                            <label for="">Pilih Area Kerja</label>
                            <select name="wilayah" id="" class="form-control text-dark mb-2">
                                <option value="">Pilih Wilayah</option>
                                <option value="WIL1">WILAYAH 1</option>
                                <option value="WIL2">WILAYAH 2</option>
                                <option value="WIL3">WILAYAH 3</option>
                                <option value="WIL4">WILAYAH 4</option>
                            </select>
                            
                            <select name="bulan" required class="form-control" id="bulan">
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
                            <button type="button" id="btnView" class="btn btn-sm btn-success mt-2"><i class="fas fa-eye"></i> Preview Absensi</button>
                            <button type="submit"  class="btn btn-sm  btn-primary mt-2"><i class="fas fa-file-excel"></i> Download Absensi</button>
                            <label class="text-danger" id="inf" style="display:none">sedang mengambil data harap tunggu . . . </label>
                        </form> 
                      </div>
                     
                    </div>
                </div>
           </div>
        </div>
    </div>

        <div class="row mt-2" >
            <div class="card h-10 mb-3 d-flex align-items-content-start">
                      <div class="card-header pb-0 d-flex justify-content-between">
                        <h6 class="mb-0 mt-2 ">Absensi Wilayah</h6>
                      </div>
                <div class="card-body d-flex flex-column justify-content-center">
                  <div class="table-responsive scrollbar" id="convert">
                      
                  </div>
                </div>
            </div>
        </div>
      </div>
    
  
<script type="text/javascript">
  //show data bulanan
  
        $("#btnView").on('click',function(){
            var wilayah = $("select[name=wilayah] option:selected").val();
            var bulan = $("select[name=bulan] option:selected").val();
            
            if(bulan == null || bulan == ""){
                alert("Silahkan pilih bulan");
            }else if(wilayah == null || wilayah == ""){
                alert("Silahkan pilih wilayah");
            }else {
                $.ajax({
                    url : "<?= base_url("Superadmin/Report_absensi/showAbsensi") ?>" ,
                    method : "POST" ,
                    data : "wilayah=" + wilayah +"&bulan=" + bulan ,
                    beforeSend : function(){
                      document.getElementById("inf").style.display="block" ;  
                    },
                    complete : function(){
                      document.getElementById("inf").style.display="none" ;  
                        
                    },
                    success : function(result){
                        document.getElementById("convert").innerHTML = result ;
                    }
                })
            }
        });
        $("#myTable").DataTable({
        info: false,
        searching:false,
        ordering:false,
        "scrollY": "5px",
        "scrollCollapse": true,
        "paging": false,
        "scrollX": true,
        });
        $('.table-header tr th').each(function(){
          $(this).append(html);
        });
</script>


