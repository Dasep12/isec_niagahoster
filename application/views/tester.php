  <!--<div style="margin-top:120px; background-color:#F9FAFA;" class="container fixed-top">-->
  <!--    <div class="container-md-3">-->
          <!-- <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
  <!--            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center" >DAFTAR HADIR</label>-->
  <!--        </div> -->-->
  <!--        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">-->
  <!--        <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>-->
  <!--        </div> -->
  <!--    </div>-->
  <!--</div>-->



  <!--<div style="margin-top:100px; padding-top:30mm; background-color:#F9FAFA;"class="container-md mt-5 " >-->
  <!--              <div class="row"> -->
  <!--                <div class="container-md-3">-->
  <!--                     <div style="background-color:#6f9390; height:50px;" class=" alert alert" role="alert">-->
  <!--                   <label style="background-color:#6f9390; font-size:13px; font-weight:solid" type="button"  data-bs-toggle="modal" data-bs-target="#pengumuman" class="text-white  d-flex align-items-center justify-content-center">-->
  <!--                      MOHON SCAN BARCODE UNTUK ABSENSI</label>-->
  <!--                      </div >-->
  <!--                      <form id="formAbsen" data-url="<?= base_url('Absen/getPlan') ?>" method="post" action="<?= base_url('Absen/getPlan') ?>" id="pilih-form">-->
  <!--                       <input hidden type="text" name="id_absen" value="<?= $biodata->id_biodata?>" id="id_absen">-->
  <!--                       <input hidden type="text" name="npk" value="<?= $biodata->npk?>" id="npk">-->
  <!--                       <select hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="AreaKerja" id="AreaKerja">-->
  <!--                                <option hidden value="<?=  $employe->area_kerja  ?>"> </option>-->
  <!--                        </select>-->
  <!--                         <input hidden style="border:2px solid #ccc;width:100%" class="mb-2" name="Jabatan" id="Jabatan" value="<?=  $employe->jabatan  ?>"> -->
  <!--                          <select hidden  style="border:2px solid #ccc;width:100%" class="mb-2" name="Wilayah" id="Wilayah">-->
  <!--                                <option hidden value="<?= $employe->wilayah ?>"></option>-->
  <!--                        </select>-->
  <!--                    </form>  -->
                      <div class="form-group ms-3 ps-4">
                         <center> <video width="250" class="img-thumbnail" id="preview" playsinline></video>
                         <h1 id="infoCamera"></h1></center> 
                         <h1 id="listCamera"></h1></center> 
                         <select id="list" onChange="update()"></select>
                      </div>
                  </div>
                </div>
            
  </div>
  <script type="text/javascript" src="<?= base_url('assets/js/') ?>instascan.min.js"></script>
     <script type="text/javascript">
        let scanner = new Instascan.Scanner({
          video: document.getElementById('preview'),
          mirror:false,
          scanPeriod: 3
          });
        scanner.addListener('scan', function (content) { 
          navigator.geolocation.getCurrentPosition(function(position) {
                  var Jabatan = document.getElementById('Jabatan').value;
                  var idTikor = $("select[name=AreaKerja] option:selected").val();
                  const long = position.coords.longitude;
                  const lat = position.coords.latitude;
                  const acc = position.coords.accuracy;
            $.ajax({
              url: $("#formAbsen").attr('data-url'),
              method: "POST",
              data: "AreaKerja=" + idTikor,
              success: function(e){
                var result = JSON.parse(e);
                const latitudeBarcode = result[0].latitude;
                const longitudeBarcode = result[0].longtitude;
                var Koma = ", ";
                const db = latitudeBarcode + Koma + longitudeBarcode ;
                const text = content.split(",",2);
                          const la = text[0];
                          const lo = text[1];
                    if(Jabatan == "KORLAP"){
                    var willl = $("select[name=Wilayah] option:selected").val();
                    $.ajax({
                      url: "<?= base_url('Absen/getlatitude')?>",
                      method: "POST",
                      data : "latitude=" + la,
                      success : function(response){
                          var raa = JSON.parse(response); 
                          var id_absen = document.getElementById('id_absen').value;
                          const latitude = raa[0].wilayah;
                          console.log(latitude);
                          if(latitude == willl ){
                              $.ajax({
                                url: "<?= base_url("Absen/input/")?>" + id_absen,
                                method: "POST",
                                contentTYpe: false,
                                processData: true,
                                cache: false,
                                success : function(response){
                                    if(response == "AndaTelahAbsen" ){
                                          Swal.fire({
                                            icon : "warning",
                                            title : "Perhatian",
                                            text : "Anda Telah Absen Masuk, Silahkan Absen Pada Jam Pulang",
                                            dangerMode : [true , "Ok"]
                                          }).then(function(){
                                              window.location.href="<?= base_url('Profile')?>"
                                          })
                                    }else  if(response == "AbsenPulang"){
                                          Swal.fire({
                                            icon : "success",
                                            title : "Berhasil",
                                            text : "Absen Pulang Berhasil",
                                            dangerMode : [true , "Ok"]
                                          }).then(function(){
                                              window.location.href="<?= base_url('Profile')?>"
                                          })
                                    }else if(response == "AbsenMasuk"){
                                          Swal.fire({
                                            icon : "success",
                                            title : "Berhasil",
                                            text : "Absen Masuk Berhasil",
                                            dangerMode : [true , "Ok"]
                                          }).then(function(){
                                              window.location.href="<?= base_url('Profile')?>"
                                          })
                                  }else if(response == "AndaTelahMasuk"){
                                            Swal.fire({
                                            icon : "info",
                                            title : "Perhatian",
                                            text : "Anda Telah Masuk Hari Ini Silahakan Istirahat",
                                            dangerMode : [true , "Ok"]
                                          })
                                  }else{
                                      Swal.fire({
                                            icon : "error",
                                            title : "Perhatian",
                                            text : "Anda Gagal Absen Silahkan Hubungi PIC Anda",
                                            dangerMode : [true , "Ok"]
                                                  })
                                          }
                                        }   
                                     })  
                          }else{
                            Swal.fire({
                            icon : "warning",
                            title : "Perhatian",
                            text : "Anda Tidak Bisa Absen Di Luar Wilayah Anda",
                            dangerMode : [true , "Ok"]
                                  })
                          }
                        }
                      });
                    }else if(content == db ){
                        var id_absen = document.getElementById('id_absen').value;
                        var npk = document.getElementById('npk').value;
                        var barcode = new google.maps.LatLng(latitudeBarcode, longitudeBarcode);
                        // lokasi handphone
                        var posisi_user = new google.maps.LatLng(lat, long);
                        console.log(content);
                        console.log(db);
                        
                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(barcode, posisi_user)/ 1000).toFixed(2); 
                        console.log(jarak);
                        if(jarak <= 0.05){
                              $.ajax({
                                      url: "<?= base_url("Absen/input/")?>" + id_absen,
                                      methode: "POST",
                                      contentTYpe: false,
                                      processData: true,
                                      cache: false,
                                      success : function(response){
                                              if(response == "AndaTelahAbsen" ){
                                                    Swal.fire({
                                                      icon : "warning",
                                                      title : "Perhatian",
                                                      text : "Anda Telah Absen Masuk, Silahkan Absen Pada Jam Pulang",
                                                      dangerMode : [true , "Ok"]
                                                    }).then(function(){
                                                        window.location.href="<?= base_url('Profile')?>"
                                                    })
                                              }else  if(response == "AbsenPulang"){
                                                    Swal.fire({
                                                      icon : "success",
                                                      title : "Berhasil",
                                                      text : "Absen Pulang Berhasil",
                                                      dangerMode : [true , "Ok"]
                                                    }).then(function(){
                                                        window.location.href="<?= base_url('Profile')?>"
                                                    })
                                              }else if(response == "AbsenMasuk"){
                                                    Swal.fire({
                                                      icon : "success",
                                                      title : "Berhasil",
                                                      text : "Absen Masuk Berhasil",
                                                      dangerMode : [true , "Ok"]
                                                    }).then(function(){
                                                        window.location.href="<?= base_url('Profile')?>"
                                                    })
                                              }else if(response == "AndaTelahMasuk"){
                                                     Swal.fire({
                                                        icon : "info",
                                                        title : "Perhatian",
                                                        text : "Anda Telah Masuk Hari Ini Silahakan Istirahat",
                                                        dangerMode : [true , "Ok"]
                                                      })
                                              }else{
                                                  Swal.fire({
                                                        icon : "eror",
                                                        title : "Perhatian",
                                                        text : "Gagal",
                                                        dangerMode : [true , "Ok"]
                                                      })
                                              }
                                            }   
                                        });           
                                  }else{
                                      Swal.fire({
                                      icon : "warning",
                                      title : "Perhatian",
                                      text : "Anda Diluar Area Absen",
                                      dangerMode : [true , "Ok"]
                                    })
                                  }
                                }
                  }
                })
              })
            });
            
            
            
        Instascan.Camera.getCameras().then(function (cameras) {
        var totalCamera = cameras.length;
        if(totalCamera == 1){
            scanner.start(cameras[1]);
        }else if (totalCamera == 2) {
            scanner.start(cameras[1]);
        } else if (totalCamera >= 3) {
            scanner.start(cameras[2]);
        }else {
            console.error('No cameras found.');
        }
        
        // console.log(cameras);
        // for (var i = 0 ; i <=  totalCamera ; i++) {
        //      var added = document.createElement('option');
        //      var test = document.getElementById("list");
        //      added.value = i ;
        //      added.innerHTML =  cameras[i].name ;
        //      test.append(added);
        // }
        
        
        // scanner.start(cameras[0]);
        
         document.getElementById("infoCamera").innerHTML =  "terdeteksi " + totalCamera + " kamera ";
      }).catch(function (e) {
        console.error(e);
      });
      
        function update() {
				var select = document.getElementById('list');
				var option = select.options[select.selectedIndex];
			
				//document.getElementById('text').value = option.text;
	    }
      </script>



