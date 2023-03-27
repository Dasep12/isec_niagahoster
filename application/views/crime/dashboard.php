<div class="container col-11">
    <div class="row mt-5 md-2">
        <div class="col-lg-6">
            <div class="card cardIn2">
                <div class="card-body">
                    <div id="jakartaUtaraSetahun"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card cardIn">
                <div class="card-body">
                    <div id="karawangSetahun"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top:-20px ;">
        <div class="col-lg-6">
            <div class="card cardIn2">
                <div class="card-body">
                    <div id="CrimeperAreaJakut"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card cardIn">
                <div class="card-body">
                    <div id="CrimeperAreaKarawang"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pd-2" style="margin-top:-20px ;">
        <div class="col-lg-8">
            <div class="card cardIn2" style="height:530px;">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="form-group text-center">
                            <h3 class="ml-2 text-center">Mapping Crime Index Jakarta Utara</h3>
                            <span class="text-center">Periode <span id="monthly_jakut">September</span> 2022</span>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <i style="cursor:pointer" onclick="myFunction()" class="fas fa-bars"></i>
                        <div id="myDropdown" class="dropdown-content">
                            <a onclick="filterCrimeKategori('01')">Januari</a>
                            <a onclick="filterCrimeKategori('02')">Februari</a>
                            <a onclick="filterCrimeKategori('03')">Maret</a>
                            <a onclick="filterCrimeKategori('04')">April</a>
                            <a onclick="filterCrimeKategori('05')">Mei</a>
                            <a onclick="filterCrimeKategori('06')">Juni</a>
                            <a onclick="filterCrimeKategori('07')">Juli</a>
                            <a onclick="filterCrimeKategori('08')">Agustus</a>
                            <a onclick="filterCrimeKategori('09')">September</a>
                            <a onclick="filterCrimeKategori('10')">Oktober</a>
                            <a onclick="filterCrimeKategori('11')">November</a>
                            <a onclick="filterCrimeKategori('12')">Desember</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card cardIn" style="height:530px;">
                <div class="card-body">
                    <div class="form-group ml-4">
                        <ul class="nav">
                            <li class="nav-item first">
                                <span class="nav-link">Perjudian</span>
                            </li>
                            <li class="nav-item second">
                                <span class="nav-link"> Pencurian</span>
                            </li>
                            <li class="nav-item third">
                                <span class="nav-link">Penggelapan</span>
                            </li>
                            <li class="nav-item four">
                                <span class="nav-link">Narkoba</span>
                            </li>
                            <li class="nav-item five">
                                <span class="nav-link"> Kekerasan</span>
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="">Penjaringan</label>
                        <span id="sample"></span>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="penjaringan_perjudian" style="width: 35%">35
                            </div>
                            <div class="progress-bar bg-success" id="penjaringan_pencurian" style="width: 9%">9
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" id="penjaringan_penggelapan" style="width: 30%">30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" id="penjaringan_narkoba" style="width: 27%">27
                            </div>
                            <div class="progress-bar bg-dark
                                progress-bar-stripped" id="penjaringan_kekerasan" style="width: 5%">5
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Koja</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="koja_perjudian" style="width: 6%">6
                            </div>
                            <div class="progress-bar bg-success" id="koja_pencurian" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="koja_penggelapan" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="koja_narkoba" style="width: 11%">
                                11
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="koja_kekerasan" style="width: 40%">
                                40
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tanjung Priok</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="tanjung_priok_perjudian" style="width: 24%">24
                            </div>
                            <div class="progress-bar  bg-success" id="tanjung_priok_pencurian" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%" id="tanjung_priok_penggelapan">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" id="tanjung_priok_narkoba" style="width: 40%">
                                40
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" id="tanjung_priok_kekerasan" style="width: 40%">
                                40
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Pademangan</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="pademangan_perjudian" style="width: 29%">29
                            </div>
                            <div class="progress-bar bg-success" id="pademangan_pencurian" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%" id="pademangan_penggelapan">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 40%" id="pademangan_narkoba">
                                40
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 40%" id="pademangan_kekerasan">
                                40
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Cilincing</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="cilincing_perjudian" style="width: 15%">15
                            </div>
                            <div class="progress-bar bg-success" id="cilincing_pencurian" style="width: 18%">18
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%" id="cilincing_penggelapan">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 45%" id="cilincing_narkoba">
                                45
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 11%" id="cilincing_kekerasan">
                                11
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="">Kelapa Gading</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="kelapa_gading_perjudian" style="width: 13%">13
                            </div>
                            <div class="progress-bar bg-success" id="kelapa_gading_pencurian" style="width: 19%">19
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 24%" id="kelapa_gading_penggelapan">
                                24
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 55%" id="kelapa_gading_narkoba">
                                55
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 27%" id="kelapa_gading_kekerasan">
                                27
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pd-2" style="margin-top:-20px ;">
        <div class="col-lg-4">
            <div class="card cardIn" style="height:620px;">
                <div class="card-body">
                    <div class="form-group ml-4">
                        <ul class="nav">
                            <li class="nav-item first">
                                <span class="nav-link">Perjudian</span>
                            </li>
                            <li class="nav-item second">
                                <span class="nav-link"> Pencurian</span>
                            </li>
                            <li class="nav-item third">
                                <span class="nav-link">Penggelapan</span>
                            </li>
                            <li class="nav-item four">
                                <span class="nav-link">Narkoba</span>
                            </li>
                            <li class="nav-item five">
                                <span class="nav-link"> Kekerasan</span>
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="">Teluk Jambe Barat</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 35%">35
                            </div>
                            <div class="progress-bar bg-success" style="width: 9%">9
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 27%">
                                27
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 5%">
                                5
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Teluk Jambe Timur</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 6%">6
                            </div>
                            <div class="progress-bar bg-success" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 11%">
                                11
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 40%">
                                40
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Klari</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 24%">24
                            </div>
                            <div class="progress-bar bg-success" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 40%">
                                40
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 40%">
                                40
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ciampel</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 29%">29
                            </div>
                            <div class="progress-bar bg-success" style="width: 20%">20
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 40%">
                                40
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 40%">
                                40
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Majalaya</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 15%">15
                            </div>
                            <div class="progress-bar bg-success" style="width: 18%">18
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 30%">
                                30
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 45%">
                                45
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 11%">
                                11
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Karawang Barat</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" style="width: 13%">13
                            </div>
                            <div class="progress-bar bg-success" style="width: 19%">19
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 24%">
                                24
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 55%">
                                55
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 27%">
                                27
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Karawang Timur</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar " style="width: 12%">12
                            </div>
                            <div class="progress-bar bg-success" style="width: 19%">19
                            </div>
                            <div class="progress-bar bg-danger
                                    progress-bar-stripped" style="width: 24%">
                                24
                            </div>
                            <div class="progress-bar bg-warning
                                    progress-bar-stripped" style="width: 22%">
                                22
                            </div>
                            <div class="progress-bar bg-dark
                                    progress-bar-stripped" style="width: 27%">
                                27
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card cardIn2" style="height:620px;">
                <div class="form-group">
                    <h3 class="ml-2 text-center">Mapping Crime Index Karawang</h3>
                    <span class="text-center">Periode September 2022</span>
                </div>
                <div class="card-body">
                    <div id="map_karawang"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" style="margin-top:-30px ;">
        <div class="col-lg-12">
            <div class="card cardIn2 ">
                <div class="card-body">
                    <div id="trendCrime"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="row" style="margin-top:-30px ;">
        <div class="col-lg-12">
            <div class="card cardIn2 ">
                <div class="card-body">
                    <div id="contain"></div>
                </div>
            </div>
        </div>
    </div> -->
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script src="https://unpkg.com/leaflet@1.9.0/dist/leaflet.js" integrity="sha256-oH+m3EWgtpoAmoBO/v+u8H/AdwB/54Gc/SgqjUKbb4Y=" crossorigin=""></script>




<script>
    Highcharts.chart('karawangSetahun', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Crime Index Karawang',
            align: 'center'
        },
        subtitle: {
            text: 'Jumlah Kasus September 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray',
                    textOutline: 'none'
                }
            }
        },
        legend: {
            align: 'center',
            x: -10,
            verticalAlign: 'top',
            y: 10,
            // floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            // borderColor: '#CCC',
            // borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'KEKERASAN',
            data: [<?= $kekerasan_ ?>]
        }, {
            name: 'NARKOBA',
            data: [<?= $narkoba_ ?>]
        }, {
            name: 'PERJUDIAN',
            data: [<?= $perjudian_ ?>]
        }, {
            name: 'PENCURIAN',
            data: [<?= $pencurian_ ?>]
        }, {
            name: 'PENGGELAPAN',
            data: [<?= $penggelapan_ ?>]
        }]
    });

    Highcharts.chart('jakartaUtaraSetahun', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },

        title: {
            text: 'Crime Index Jakarta Utara',
            align: 'center'
        },
        subtitle: {
            text: 'Jumlah Kasus September 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray',
                    textOutline: 'none'
                }
            }
        },
        legend: {
            align: 'center',
            x: -10,
            verticalAlign: 'top',
            y: 20,
            // floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            // borderColor: '#CCC',
            // borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'KEKERASAN',
            data: [<?= $kekerasan ?>]
        }, {
            name: 'NARKOBA',
            data: [<?= $narkoba ?>]
        }, {
            name: 'PERJUDIAN',
            data: [<?= $perjudian ?>]
        }, {
            name: 'PENCURIAN',
            data: [<?= $pencurian ?>]
        }, {
            name: 'PENGGELAPAN',
            data: [<?= $penggelapan ?>]
        }]
    });



    Highcharts.chart('CrimeperAreaJakut', {
        title: {
            text: 'Index Crime Per Area Jakarta Utara',
            align: 'center'
        },
        subtitle: {
            text: 'Periode 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            max: 150,
            title: {
                text: ''
            }
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                },
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
        },
        series: [{
                type: 'column',
                name: 'PENJARINGAN',
                data: [<?= $penjaringan ?>]
            }, {
                type: 'column',
                name: 'CILINCING',
                data: [<?= $cilincing ?>]
            }, {
                type: 'column',
                name: 'KOJA',
                data: [<?= $koja ?>]
            }, {
                type: 'column',
                name: 'PADEMANGAN',
                data: [<?= $pademangan ?>]
            }, {
                type: 'column',
                name: 'TANJUNG PRIOK',
                data: [<?= $tanjung_priok ?>]
            }, {
                type: 'column',
                name: 'KELAPA GADING',
                data: [<?= $kelapa_gading ?>]
            },
            //  {
            //     type: 'column',
            //     name: 'TANPA KET',
            //     data: [0, 0, 0, 0, 0, 2, 2, 2, 7, 3, 2, 6]
            // }, 
            {
                type: 'spline',
                name: 'TOTAL',
                data: [<?= $countPerArea ?>],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }
        ]
    });

    Highcharts.chart('CrimeperAreaKarawang', {
        title: {
            text: 'Index Crime Per Area Karawang',
            align: 'center'
        },
        subtitle: {
            text: 'Periode 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            type: 'column',
            name: 'TELUK JAMBE BARAT',
            data: [2, 4, 12, 21, 20, 2, 4, 12, 21, 20, 22, 11]
        }, {
            type: 'column',
            name: 'TELUK JAMBE TIMUR',
            data: [24, 12, 11, 2, 17, 2, 4, 12, 21, 20, 11, 11]
        }, {
            type: 'column',
            name: 'KLARI',
            data: [3, 5, 5, 6, 12, 2, 4, 12, 21, 20, 21, 11]
        }, {
            type: 'column',
            name: 'CIAMPEL',
            data: [2, 4, 12, 21, 20, 2, 4, 12, 21, 20, 1, 7]
        }, {
            type: 'column',
            name: 'MAJALAYA',
            data: [24, 12, 11, 2, 17, 2, 4, 12, 21, 20, 1, 7]
        }, {
            type: 'column',
            name: 'KARAWANG TIMUR',
            data: [3, 5, 5, 6, 12, 2, 4, 12, 21, 20, 1, 7]
        }, {
            type: 'column',
            name: 'KARAWANG BARAT',
            data: [3, 5, 5, 6, 12, 2, 4, 12, 21, 20, 1, 7]
        }, {
            type: 'spline',
            name: 'TOTAL',
            data: [111, 200, 130, 120, 159, 112, 120, 130, 127, 130, 170, 120],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
    });

    function mappingJakut(bulan) {
        var mapAsal = L.map('map').setView([-6.1387788, 106.829449], 12.4);
        mapAsalLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        var icon_standar = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker6.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var icon_bahaya = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker2.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapAsalLink + ' Contributors',
                maxZoom: 18,
            }).addTo(mapAsal)
        $.getJSON("<?= site_url('SA/Crime/mapJakut?bulan='); ?>" + bulan)
            .then(function(data) {
                L.geoJson(data, {
                    pointToLayer: function(feature, latlng) {
                        var marker = L.marker(latlng, {
                            'icon': feature.properties.res == 0 ? icon_standar : icon_standar
                        });
                        marker.bindTooltip(feature.properties.popupContent, {
                            permanent: true,
                            direction: 'top',
                            offset: L.point({
                                x: 0,
                                y: -30
                            })
                        }).openTooltip();
                        return marker;
                    }
                }).addTo(mapAsal);
            })
            .fail(function(err) {
                console.log(err.responseText)
            });

        var polygon = L.polygon([
            [-6.1160022, 106.7670129],
            [-6.166766, 106.8848369],
            [-6.1113905, 106.9398002]
        ]).addTo(mapAsal);
        polygon.setStyle({
            fillColor: 'red',
            lineColor: 'red'
        })

    }

    function mappingKarawang() {

        var map = L.map('map_karawang').setView([-6.3505035, 107.2483852], 11.5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var iconPademangan = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker1.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var iconCilincing = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker2.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var iconKelapaGading = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker3.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var iconKoja = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker6.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var iconPenjaringan = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker4.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });

        var iconTanjungPriok = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker5.png') ?>',
            iconSize: [60, 60], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [30, 36], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
        });


        L.marker([-6.3503106, 107.1710478], {
                icon: iconPademangan
            })
            .bindTooltip('Teluk Jambe Barat (20)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)

        L.marker([-6.3426387, 107.2236389], {
                icon: iconCilincing
            })
            .bindTooltip('Teluk Jambe Timur (30)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)



        L.marker([-6.3957332, 107.3090157], {
                icon: iconPenjaringan
            })
            .addTo(map)
            .bindTooltip('Klari (76)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()

        L.marker([-6.4281762, 107.2627573], {
                icon: iconTanjungPriok
            })
            .bindTooltip('Ciampel (26)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)

        L.marker([-6.3005035, 107.3383852], {
                icon: iconKoja
            })
            .bindTooltip('Majalaya (81)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)

        L.marker([-6.3010751, 107.2455271], {
                icon: iconKelapaGading
            })
            .bindTooltip('Karawang Barat (69)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)

        L.marker([-6.2995816, 107.2954107], {
                icon: iconKelapaGading
            })
            .bindTooltip('Karawang Timur (69)', {
                permanent: true,
                direction: 'top',
                offset: L.point({
                    x: 0,
                    y: -30
                })
            }).openTooltip()
            .addTo(map)


        var polygon = L.polygon([
            [-6.2732436, 107.2426157],
            [-6.387137, 107.1218503],
            [-6.4809085, 107.2328302],
            [-6.318322, 107.3987053],
            // [-6.1113905, 106.9398002]
        ]).addTo(map);
        polygon.setStyle({
            fillColor: 'red',
            lineColor: 'red'
        })
    }

    mappingKarawang();

    mappingJakut("September")

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function bulanConvert(bulan) {
        var bln = "";
        switch (bulan) {
            case '01':
                bln = "Januari";
                break;
            case '02':
                bln = "Februari";
                break;
            case '03':
                bln = "Maret";
                break;
            case '04':
                bln = "April";
                break;
            case '05':
                bln = "Mei";
                break;
            case '06':
                bln = "Juni";
                break;
            case '07':
                bln = "Juli";
                break;
            case '08':
                bln = "Agustus";
                break;
            case '09':
                bln = "September";
                break;
            case '10':
                bln = "Oktober";
                break;
            case '11':
                bln = "November";
                break;
            case '12':
                bln = "Desember";
                break;
        }

        return bln;
    }

    function filterCrimeKategori(bulan) {
        var id = bulan;

        $.ajax({
            url: "<?= base_url('SA/Crime/load_jakut') ?>",
            method: "POST",
            data: 'bulan=' + id,
            beforeSend: function() {
                $("#myDropdown").removeClass("show")
            },
            complete: function() {
                // console.log('end')
            },
            success: function(e) {
                document.getElementById("monthly_jakut").innerHTML = bulanConvert(bulan);
                var data = JSON.parse(e)
                var pademangan = data[0];
                var koja = data[1];
                var tanjung_priok = data[2];
                var penjaringan = data[3];
                var cilincing = data[4];
                var kelapa_gading = data[5];
                const kecamatan = ['penjaringan', 'koja', 'tanjung_priok', 'pademangan', 'cilincing', 'kelapa_gading'];
                const params = [penjaringan, koja, tanjung_priok, pademangan, cilincing, kelapa_gading];
                const kategori = ['perjudian']

                // console.log(params[0][1].perjudian);
                for (var i = 0; i < kecamatan.length; i++) {
                    // console.log(kecamatan[i] + '=' + params[i][1].narkoba + '\n');
                    document.getElementById(kecamatan[i] + '_perjudian').innerHTML = params[i][1].perjudian;
                    document.getElementById(kecamatan[i] + '_pencurian').innerHTML = params[i][1].pencurian;
                    document.getElementById(kecamatan[i] + '_penggelapan').innerHTML = params[i][1].penggelapan;
                    document.getElementById(kecamatan[i] + '_narkoba').innerHTML = params[i][1].narkoba;
                    document.getElementById(kecamatan[i] + '_kekerasan').innerHTML = params[i][1].kekerasan;


                    document.getElementById(kecamatan[i] + "_perjudian").style.width = params[i][1].perjudian < 5 ? 5 + '%' : params[i][1].perjudian + 5 + '%'
                    document.getElementById(kecamatan[i] + "_pencurian").style.width = params[i][1].pencurian < 5 ? 5 + '%' : params[i][1].pencurian + 5 + '%'
                    document.getElementById(kecamatan[i] + "_penggelapan").style.width = params[i][1].penggelapan < 5 ? 5 + '%' : params[i][1].penggelapan + 5 + '%'
                    document.getElementById(kecamatan[i] + "_kekerasan").style.width = params[i][1].kekerasan < 5 ? 5 + '%' : params[i][1].kekerasan + 5 + '%'
                    document.getElementById(kecamatan[i] + "_narkoba").style.width = params[i][1].narkoba < 5 ? 5 + '%' : params[i][1].narkoba + 5 + '%'
                }
            }
        })
    }

    Highcharts.chart('trendCrime', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Trend Index Crime Selama 3 Bulan'
        },

        subtitle: {
            text: 'Periode 2022'
        },

        legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },

        xAxis: {
            categories: ['Januari', 'Februari', 'Februari'],
            labels: {
                x: -10
            }
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Total'
            }
        },

        series: [{
            name: 'Pencurian',
            data: [38, 51, 34]
        }, {
            name: 'Perjudian',
            data: [31, 26, 27]
        }, {
            name: 'Narkoba',
            data: [38, 42, 41]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    yAxis: {
                        labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                        },
                        title: {
                            text: null
                        }
                    },
                    subtitle: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    }
                }
            }]
        }
    });
</script>