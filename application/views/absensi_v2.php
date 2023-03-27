<div style="margin-top:120px; background-color:#F9FAFA;" class="container fixed-top">
      <div class="container-md-3">
          <!-- <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
              <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center" >DAFTAR HADIR</label>
          </div> -->
          <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
          <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
          </div> 
      </div>
  </div>

  <div style="margin-top:100px; padding-top:30mm; background-color:#F9FAFA;"class="container-md mt-5 " >
    <div class="card">
        <div class="card-body">
            <input hidden type="text" class="form-control text-dark" value="<?= $employe->wilayah ?>" id="wilayah">
            <input hidden type="text" class="form-control text-dark" value="<?= $employe->npk ?>" id="npk">
            <input hidden type="text" class="form-control text-dark" value="<?= $employe->id_employee ?>" id="id_absen">
            <input hidden type="text" class="form-control text-dark" value="<?= $employe->area_kerja ?>" id="area_kerja">
            <input hidden type="text" class="form-control text-dark" value="<?= $employe->jabatan ?>" id="jabatan">
            <select id="pilihKamera" style="max-width:100px;"></select>
            <br>
            <video id="previewKamera" width="320" class="img-thumbnail" playsinline></video>
            <label id="procesScanning" style="display:none" class="text-danger small">processing presensi harap tunggu . . . </label>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
    <script type="text/javascript">
    
    // Zxing Scanner
    let selectedDeviceId = null;
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const sourceSelect = $("#pilihKamera");
        let audio = new Audio("assets/audio/beep.mp3");
 
         $(document).on('change','#pilihKamera',function(){
            selectedDeviceId = $(this).val();
            if(codeReader){
                codeReader.reset()
                initScanner()
            }
        })
 
        function initScanner() {
            codeReader
            .listVideoInputDevices()
            .then(videoInputDevices => {
                videoInputDevices.forEach(device =>
                    console.log(`${device.label}, ${device.deviceId}`)
                );
 
                if(videoInputDevices.length > 0){
                     
                    if(selectedDeviceId == null){
                        if(videoInputDevices.length > 1){
                            selectedDeviceId = videoInputDevices[1].deviceId
                        } else {
                            selectedDeviceId = videoInputDevices[0].deviceId
                        }
                    }
                     
                     
                    if (videoInputDevices.length >= 1) {
                        sourceSelect.html('');
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            if(element.deviceId == selectedDeviceId){
                                sourceOption.selected = 'selected';
                            }
                            sourceSelect.append(sourceOption)
                        })
                 
                    }
 
                    codeReader
                        .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                        .then(result => {
                                audio.play();
                                //hasil scan
                                console.log(result.text)
                                const barcode = result.text;
                                const brc = barcode.split(',', 2);
                                const la = brc[0];
                                const lo = brc[1];
                                var jabatan = document.getElementById("jabatan").value;
                                var wilayah = document.getElementById("wilayah").value;
                                var area_kerja = document.getElementById("area_kerja").value;
                                var id_absen = document.getElementById("id_absen").value;
                                var npk = document.getElementById("npk").value;
                
                                //jika status korlap jarak absen tidak di atur hanya di validasi berdasarkan wilayah
                                if (jabatan == "Korlap" || jabatan == "KORLAP"  ) {
                                    $.ajax({
                                        url: "<?= base_url('Absensi_v2/cekBarcodeKorlap') ?>",
                                        data: 'wilayah=' + wilayah + "&latitude=" + la,
                                        method: "POST",
                                        success: function(e) {
                                            if (e == 1) {
                                                $.ajax({
                                                    url: "<?= base_url('Absensi_v2/input_absen') ?>",
                                                    method: "POST",
                                                    data: "wilayah=" + wilayah + "&npk=" + npk + "&id_absen=" + id_absen + "&area_kerja=" + area_kerja,
                                                    beforeSend : function(){
                                                      document.getElementById("procesScanning").style.display = "block";  
                                                    },
                                                    complete : function(){
                                                      document.getElementById("procesScanning").style.display = "none";  
                                                    },
                                                    success: function(e) {
                                                        if(e == "Belum Waktunya Pulang"){
                                                            Swal.fire({
                                                                icon : 'warning' ,
                                                                title : 'Perhatian' ,
                                                                text : "Belum Waktunya Pulang"
                                                            })
                                                        }else if(e == "pulang"){
                                                            Swal.fire({
                                                                icon : 'success' ,
                                                                title : 'Terima Kasih' ,
                                                                text : "Absen Pulang Berhasil"
                                                            })
                                                        }else if(e == "masuk lagi nanti"){
                                                            Swal.fire({
                                                                icon : 'warning' ,
                                                                title : 'Perhatian' ,
                                                                text : "Silahkan Absen di Jam Berikutnya"
                                                            })
                                                        }else if(e == "masuk"){
                                                            Swal.fire({
                                                                icon : 'success' ,
                                                                title : 'Terima Kasih' ,
                                                                text : "Absen Masuk Berhasil"
                                                            })
                                                        } else{
                                                            Swal.fire({
                                                                icon : 'warning' ,
                                                                title : 'Perhatian' ,
                                                                text : e
                                                            })
                                                        }
                                                    }
                                                })
                                            } else {
                                                Swal.fire({
                                                    icon : 'warning' ,
                                                    title : 'Perhatian' ,
                                                    text : 'Absen Lintas Wilayah di Tolak'
                                                })
                                                // alert("absen lintas wilayah di tolak");
                                            }
                                        }
                                    })
                                } else {
                                    //jika absen anggota danru gunakan metode ukur jarak dari area kerja
                                    navigator.geolocation.getCurrentPosition(function(position) {
                
                                        //lokasi perangkat user 
                                        const latiUser = position.coords.latitude;
                                        const longiUser = position.coords.longitude;
                                        //lokasi barcode di tempel
                                        var lokasiBarcode = new google.maps.LatLng(la, lo);
                                        // lokasi handphone
                                        var posisi_user = new google.maps.LatLng(latiUser, longiUser);
                                        const jarak = (google.maps.geometry.spherical.computeDistanceBetween(lokasiBarcode, posisi_user) / 1000).toFixed(2);
                                        $.ajax({
                                            url: "<?= base_url('Absensi_v2/cekBarcodeAnggota') ?>",
                                            method: "POST",
                                            data: 'area_kerja=' + area_kerja + "&latitude=" + la,
                                            beforeSend : function(){
                                              document.getElementById("procesScanning").style.display = "block";  
                                            },
                                            complete : function(){
                                              document.getElementById("procesScanning").style.display = "none";  
                                            },
                                            success: function(e) {
                                                if (e == 0) {
                                                    Swal.fire({
                                                        icon : 'warning' ,
                                                        title : 'Perhatian' ,
                                                        text : 'Barcode Tidak Sesuai Area Kerja Anda'  
                                                    })
                                                    // alert("barcode tidak sesuai area kerja anda")
                                                } else {
                                                    if (jarak > 10) {
                                                        Swal.fire({
                                                            icon : 'warning' ,
                                                            title : 'Perhatian' ,
                                                            text : 'Anda Diluar Area  ' + area_kerja 
                                                        })
                                                        // alert("anda diluar area " + area_kerja);
                                                    } else {
                                                        $.ajax({
                                                            url: "<?= base_url('Absensi_v2/input_absen') ?>",
                                                            method: "POST",
                                                            beforeSend : function(){
                                                              document.getElementById("procesScanning").style.display = "block";  
                                                            },
                                                            complete : function(){
                                                              document.getElementById("procesScanning").style.display = "none";  
                                                            },
                                                            data: "wilayah=" + wilayah + "&npk=" + npk + "&id_absen=" + id_absen + "&area_kerja=" + area_kerja,
                                                            success: function(e) {
                                                               // alert(e)
                                                                if(e == "Belum Waktunya Pulang"){
                                                                    Swal.fire({
                                                                        icon : 'warning' ,
                                                                        title : 'Perhatian' ,
                                                                        text : "Belum Waktunya Pulang"
                                                                    })
                                                                }else if(e == "pulang"){
                                                                    Swal.fire({
                                                                        icon : 'success' ,
                                                                        title : 'Terima Kasih' ,
                                                                        text : "Absen Pulang Berhasil"
                                                                    })
                                                                }else if(e == "masuk lagi nanti"){
                                                                    Swal.fire({
                                                                        icon : 'warning' ,
                                                                        title : 'Perhatian' ,
                                                                        text : "Silahkan Absen di Jam Berikutnya"
                                                                    })
                                                                }else if(e == "masuk"){
                                                                    Swal.fire({
                                                                        icon : 'success' ,
                                                                        title : 'Terima Kasih' ,
                                                                        text : "Absen Masuk Berhasil"
                                                                    })
                                                                } else{
                                                                    Swal.fire({
                                                                        icon : 'warning' ,
                                                                        title : 'Perhatian' ,
                                                                        text : e
                                                                    })
                                                                }
                                                            }
                                                        })
                                                    }
                                                }
                                            }
                                        })
                                    })
                                }
                             
                                if(codeReader){
                                    codeReader.reset()
                                }
                        })
                        .catch(err => console.error(err));
                     
                } else {
                    alert("Camera not found!")
                }
            })
            .catch(err => console.error(err));
        }
        
        if (navigator.mediaDevices) {
            initScanner()
        } else {
            alert('Cannot access camera.');
        }
    // end of Zxing Scanner
    </script>
</body>

</html>