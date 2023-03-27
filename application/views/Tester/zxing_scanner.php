<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
      <!-- Jquery CDN -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('Tester/input') ?>" method="post">
                    <select id="pilihKamera " class="form-control" style="max-width:100px;"></select>
                    <video id="webcam-preview" class="img img-thumbnail"></video>
                    <input type="text" placeholder="hasil scan" required readonly class="form-control" id="barcode" name="barcode">
                    <input type="text" placeholder="Nama" required class="form-control" name="nama">
                    <input type="text" placeholder="NPK" required class="form-control" name="npk">
                    <select class="form-control" name="kamera">
                        <option>Kamera Depan</option>
                        <option>Kamera Belakang</option>
                        <option>Tidak Muncul Kamera</option>
                    </select>
                    <button class="btn btn-danger">Kirim Hasil</button>
                </form>
            </div>
        </div>
    </div>
<p id="result"></p>
<script>
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
                        .decodeOnceFromVideoDevice(selectedDeviceId, 'webcam-preview')
                        .then(result => {
                                audio.play();
                                //hasil scan
                                console.log(result.text)
                                const barcode = result.text;
                                document.getElementById("barcode").value = barcode;
                                // const brc = barcode.split(',', 2);
                                // const la = brc[0];
                                // const lo = brc[1];
                                // var jabatan = document.getElementById("jabatan").value;
                                // var wilayah = document.getElementById("wilayah").value;
                                // var area_kerja = document.getElementById("area_kerja").value;
                                // var id_absen = document.getElementById("id_absen").value;
                                // var npk = document.getElementById("npk").value;
                
                               
                             
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>