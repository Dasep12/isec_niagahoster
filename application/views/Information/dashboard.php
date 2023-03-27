<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./assets/css/info.css?d=<?=date('YmdHis');?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css"
   integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"
   integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s="
   crossorigin=""></script>

    <title>Dashboard</title>
</head>

<body>
    <div class="container p-3">

        <section>
            <div class="row">
                <div class="col-lg-4 gender card-small p-3">
                    <h5 class="text-center mb-5">Jenis Kelamin</h5>
                    <div class="row pb-4">
                        <div class="col-6 position-relative text-center">
                            <span class="position-absolute val-male h4"><?= $genderLaki ?></span>
                            <img class="icon" src="./assets/img/info/male.png">
                        </div>

                        <div class="col-6 position-relative text-center">
                            <img class="icon" src="./assets/img/info/female.png">
                            <span class="position-absolute val-female h4"><?= $genderPerempuan ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 blood card-small p-3">
                    <h5 class="card-title text-center mb-5">Golongan Darah</h5>
                    <img class="img-fluid" src="./assets/img/info/golongan-darah.png">
                    <?php $gol = $golongan->result(); 
                        echo '<span class="position-absolute ab">'.$gol[1]->total.'</span>
                            <span class="position-absolute o">'.$gol[3]->total.'</span>
                            <span class="position-absolute a">'.$gol[0]->total.'</span>
                            <span class="position-absolute b">'.$gol[2]->total.'</span>';
                    ?>
                </div>

                <div class="col-lg-4 kta card-small p-3">
                    <h5 class="text-center mb-5">Status KTA</h5>
                    <div class="row pb-4">
                        <div class="col-6 position-relative text-center">
                            <img class="icon" src="./assets/img/info/kta-on.png">
                            <span class="val-on h4"><?= $statusKta->status_aktif; ?></span>
                        </div>

                        <div class="col-6 position-relative text-center">
                            <img class="icon" src="./assets/img/info/kta-off.png">
                            <span class="val-off h4"><?= $statusKta->status_tdk_aktif; ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 age p-3">
                    <?php $usia = $umur->result(); ?>

                    <h5 class="card-title text-center mb-5">Usia</h5>
                    <div class="row">
                        <div class="col age-1 d-flex flex-column text-center">
                            <span class="range h6"><?= $usia[0]->range_umur; ?></span>
                            <img class="icon" src="./assets/img/info/18-30.png">
                            <span class="val"><?= $usia[0]->jumlah; ?></span>
                        </div>
                        <div class="col age-2 d-flex flex-column text-center">
                            <span class="range h6"><?= $usia[1]->range_umur; ?></span>
                            <img class="icon" src="./assets/img/info/31-40.png">
                            <span class="val"><?= $usia[1]->jumlah; ?></span>
                        </div>
                        <div class="col age-3 d-flex flex-column text-center">
                            <span class="range h6"><?= $usia[2]->range_umur; ?></span>
                            <img class="icon" src="./assets/img/info/41-50.png">
                            <span class="val"><?= $usia[2]->jumlah; ?></span>
                        </div>
                        <div class="col age-4 d-flex flex-column text-center">
                            <span class="range h6"><?= $usia[3]->range_umur; ?></span>
                            <img class="icon" src="./assets/img/info/50.png">
                            <span class="val"><?= $usia[3]->jumlah; ?></span>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-lg-12 religion p-3">
                    <h5 class="card-title text-center mb-5">AGAMA</h5>
                    <div class="row">
                        <?php foreach ($agama as $key => $itm) {
                            echo '<div class="col d-flex flex-column text-center">
                                <img class="icon" src="./assets/img/info/'.$itm->icon.'">
                                <span style="font-size: 10px">'.$itm->name.'</span>
                                <span class="val h5">'.$itm->total.'</span>
                            </div>';

                        } ?>
                    </div>
                </div> -->

                <div class="col-lg-12 place p-3">
                    <!-- <div class="card">
                        <div class="card-body"> -->
                            <h5 class="card-title text-center mb-5">Tempat Tinggal</h5>
                            <!-- <img class="img-fluid" src="./assets/img/info/maps.png"> -->
                            <div id="map"></div>
                        <!-- </div>
                    </div> -->
                </div>

                <div class="col-lg-12 place-from mb-4 p-3">
                    <h5 class="card-title text-center mb-5">Tempat Asal</h5>
                    <!-- <img class="img-fluid" src="./assets/img/info/maps.png"> -->
                    <div id="mapAsal"></div>
                </div>
            </div>
        </section>

    </div>
    <script type="text/javascript" src="<?=base_url('assets/js/jquery-3.5.1.js');?>"></script>
    <script type="text/javascript">
        var planes = [

            <?php
                foreach ($tempatTinggalAll->result() as $key => $tgl) {
                    if($tgl->kota === 'BEKASI')
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.2348,106.9924';
                    }
                    elseif ($tgl->kota == 'JAKARTA BARAT') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.1767,106.7552';
                    }
                    elseif ($tgl->kota == 'JAKARTA SELATAN') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.2675,106.8077';
                    }
                    elseif ($tgl->kota == 'JAKARTA UTARA') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.1392,106.8723';
                    }
                    elseif ($tgl->kota == 'JAKARTA TIMUR') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.2409,106.8942';
                    }
                    elseif ($tgl->kota == 'JAKARTA PUSAT') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.1802,106.8379';
                    }
                    elseif ($tgl->kota == 'DEPOK') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.4064,106.8159';
                    }
                    elseif ($tgl->kota == 'BOGOR') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.59627,106.79723';
                    }
                    elseif ($tgl->kota == 'KARAWANG') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.3030,107.3076';
                    }
                    elseif ($tgl->kota == 'TANGERANG') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.1754,106.6378';
                    }
                    elseif ($tgl->kota == 'SUBANG') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.5689,107.7582';
                    }
                    elseif ($tgl->kota == 'PURWAKARTA') 
                    {
                        $name = $tgl->kota;
                        $total = $tgl->total;
                        $lang = '-6.5602,107.4429';
                    }

                    if(isset($name))
                    {
                        echo '["<center>'.$name.'<br><b>'.$total.'</b></center>", '.$lang.'],';
                    }
                }
                // ["Jakarta", -6.1952, 106.8173],
                // echo '["Jakarta Barat: '.$tmpTggl[0]->total.'", -6.1767, 106.7552],';
                // echo '["Bekasi: '.$tmpTggl[0]->total.'", -6.2443, 106.9794]';
            ?>
        ];

        var map = L.map('map').setView([-6.4159,106.9231], 9.10);
        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';

        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
            }).addTo(map);

        for (var i = 0; i < planes.length; i++) {
            marker = new L.marker([planes[i][1],planes[i][2]])
                // .bindPopup(planes[i][0])
                .bindTooltip(planes[i][0] , {permanent: true, direction: 'top'}).openTooltip()
                .addTo(map);

            // polygon = L.polygon([planes[i][1],planes[i][2]]).addTo(map);
            
            // var popup = L.popup()
            //     .setLatLng([planes[i][1],planes[i][2]])
            //     .setContent(planes[i][0])
            //     .openOn(map);
        }

        var listProvAsal = [
            <?php
                foreach ($tempatAsal as $key => $la) {
                    if($la->latitude !== '' && $la->longitude !== '')
                    echo '["<center>'.$la->prov_name.'<br><b>'.$la->total.'</b></center>", '.$la->latitude.','.$la->longitude.'],';
                }
            ?>
        ];

        var mapAsal = L.map('mapAsal').setView([-2.021,114.917], 5.10);
        mapAsalLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapAsalLink + ' Contributors',
            maxZoom: 18,
        }).addTo(mapAsal)
        
        $.getJSON("<?= site_url('information/leflateJson'); ?>")
        .then(function (data) {
            // var ratIcon = L.icon({
            //     iconUrl: 'http://maptimeboston.github.io/leaflet-intro/rat.png',
            //     iconSize: [60, 50]
            // });, { icon: ratIcon }
            L.geoJson(data, {
                pointToLayer: function (feature, latlng) {
                    var marker = L.marker(latlng);
                    marker.bindTooltip(feature.properties.popupContent, {permanent: true, direction: 'top'}).openTooltip();
                    // marker.on("add", function (event) {
                    //     console.log(event)
                    //    event.target.openPopup();
                    // });
                    return marker;
                }
            }).addTo(mapAsal);
        })
        .fail(function(err){
            console.log(err.responseText)
        });

        // L.tileLayer(
        //     'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; ' + mapAsalLink + ' Contributors',
        //     maxZoom: 18,
        // }).addTo(mapAsal)

        // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        // .openPopup();

        // for (var i = 0; i < listProvAsal.length; i++) {
        //     markerAsal = new L.marker([listProvAsal[i][1],listProvAsal[i][2]])
        //         // .bindPopup(listProvAsal[i][0])
        //         .bindTooltip(listProvAsal[i][0] , {permanent: true, direction: 'top'}).openTooltip()
        //         .addTo(mapAsal);
        // }

    </script>
</body>
</html>