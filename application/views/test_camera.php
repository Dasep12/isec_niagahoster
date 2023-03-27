<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="<?= base_url('assets/js/') ?>instascan.min.js"></script>
    <!--<script type="text/javascript" src="<?= base_url('assets/js/') ?>instascanV2.min.js"></script>-->
    
    <!-- Jquery CDN -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
  <!--<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>-->
</head>
<body>
    

        
     <video width="250" class="img-thumbnail" id="preview"  playsinline></video><br>
    <input type="text" id="sample"><br>
    <label>untuk performa terbaik gunakan browser <?= $ca ?></label> <br>
    <label id="totalcamera"></label><br>
    <select id="listCamera"></select>
    <script>
        
        let scanner = new Instascan.Scanner({
          video: document.getElementById('preview'),
          mirror:false,
          scanPeriod: 3
          });
        scanner.addListener('scan', function (content) { 
                document.getElementById("sample").value = content ;
         
        });
            
        Instascan.Camera.getCameras().then(function (cameras) {
        var totalCamera = cameras.length;
        
           if (cameras.length > 0) {
              var selectedCam = cameras[0];
              $.each(cameras, (i, c) => {
                if (c.name.indexOf('back') !== -1) {
                  selectedCam = c;
                  return false;
                  //console.log(c.name.indexOf('back'));
                }
              });
              
              scanner.start(selectedCam);
             //  scanner.start(cameras[3]);
              document.getElementById("totalcamera").innerHTML = "total " + totalCamera + "  camera di perangkat anda " ; 
              
               scanner.start(selectedCam);
            }else {
              console.error('No cameras found.');
            }
        
      }).catch(function (e) {
        console.error(e);
      });
    </script>
</body>
</html>