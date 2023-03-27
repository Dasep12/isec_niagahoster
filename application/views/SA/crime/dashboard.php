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
                            <span class="text-center">Periode <span id="monthly_jakut"></span> 2022</span>
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
                    <div class="maps_2" id="maps_jakarta">
                    </div>
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
                            <div class="progress-bar" id="penjaringan_perjudian" style="width:<?= $penjaringan_perjudian <= 2 ? 5 : $penjaringan_perjudian + 5 ?>%">
                                <?= $penjaringan_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="penjaringan_pencurian" style="width:<?= $penjaringan_pencurian <= 2 ? 5 : $penjaringan_pencurian + 5 ?>%">
                                <?= $penjaringan_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="penjaringan_penggelapan" style="width:<?= $penjaringan_penggelapan <= 2 ? 5 : $penjaringan_penggelapan + 5 ?>%">
                                <?= $penjaringan_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="penjaringan_narkoba" style="width:<?= $penjaringan_narkoba <= 2 ? 5 : $penjaringan_narkoba + 5 ?>%">
                                <?= $penjaringan_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="penjaringan_kekerasan" style="width:<?= $penjaringan_kekerasan <= 2 ? 5 : $penjaringan_kekerasan + 5 ?>%">
                                <?= $penjaringan_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Koja</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="koja_perjudian" style="width:<?= $koja_perjudian <= 2 ? 5 : $koja_perjudian + 5 ?>%">
                                <?= $koja_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="koja_pencurian" style="width:<?= $koja_pencurian <= 2 ? 5 : $koja_pencurian + 5 ?>%">
                                <?= $koja_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="koja_penggelapan" style="width:<?= $koja_penggelapan <= 2 ? 5 : $koja_penggelapan + 5 ?>%">
                                <?= $koja_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="koja_narkoba" style="width:<?= $koja_narkoba <= 2 ? 5 : $koja_narkoba + 5 ?>%">
                                <?= $koja_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="koja_kekerasan" style="width:<?= $koja_kekerasan <= 2 ? 5 : $koja_kekerasan + 5 ?>%">
                                <?= $koja_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tanjung Priok</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="tanjung_priok_perjudian" style="width:<?= $tanjung_priok_perjudian <= 2 ? 5 : $tanjung_priok_perjudian + 5 ?>%">
                                <?= $tanjung_priok_perjudian ?>
                            </div>
                            <div class="progress-bar  bg-success" id="tanjung_priok_pencurian" style="width:<?= $tanjung_priok_pencurian <= 2 ? 5 : $tanjung_priok_pencurian + 5 ?>%">
                                <?= $tanjung_priok_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="tanjung_priok_penggelapan" style="width:<?= $tanjung_priok_penggelapan <= 2 ? 5 : $tanjung_priok_penggelapan + 5 ?>%">
                                <?= $tanjung_priok_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="tanjung_priok_narkoba" style="width:<?= $tanjung_priok_narkoba <= 2 ? 5 : $tanjung_priok_narkoba + 5 ?>%">
                                <?= $tanjung_priok_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="tanjung_priok_kekerasan" style="width:<?= $tanjung_priok_kekerasan <= 2 ? 5 : $tanjung_priok_kekerasan + 5 ?>%">
                                <?= $tanjung_priok_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Pademangan</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="pademangan_perjudian" style="width:<?= $pademangan_perjudian <= 2 ? 5 : $pademangan_perjudian + 5 ?>%">
                                <?= $pademangan_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="pademangan_pencurian" style="width:<?= $pademangan_pencurian <= 2 ? 5 : $pademangan_pencurian + 5 ?>%">
                                <?= $pademangan_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="pademangan_penggelapan" style="width:<?= $pademangan_penggelapan <= 2 ? 5 : $pademangan_penggelapan + 5 ?>%">
                                <?= $pademangan_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="pademangan_narkoba" style="width:<?= $pademangan_narkoba <= 2 ? 5 : $pademangan_narkoba + 5 ?>%">
                                <?= $pademangan_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="pademangan_kekerasan" style="width:<?= $pademangan_kekerasan <= 2 ? 5 : $pademangan_kekerasan + 5 ?>%">
                                <?= $pademangan_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Cilincing</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="cilincing_perjudian" style="width:<?= $cilincing_perjudian <= 2 ? 5 : $cilincing_perjudian + 5 ?>%">
                                <?= $cilincing_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="cilincing_pencurian" style="width:<?= $cilincing_pencurian <= 2 ? 5 : $cilincing_pencurian + 5 ?>%">
                                <?= $cilincing_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="cilincing_penggelapan" style="width:<?= $cilincing_penggelapan <= 2 ? 5 : $cilincing_penggelapan + 5 ?>%">
                                <?= $cilincing_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="cilincing_narkoba" style="width:<?= $cilincing_narkoba <= 2 ? 5 : $cilincing_narkoba + 5 ?>%">
                                <?= $cilincing_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="cilincing_kekerasan" style="width:<?= $cilincing_kekerasan <= 2 ? 5 : $cilincing_kekerasan + 5 ?>%">
                                <?= $cilincing_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="">Kelapa Gading</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="kelapa_gading_perjudian" style="width:<?= $kelapa_gading_perjudian <= 2 ? 5 : $kelapa_gading_perjudian + 5 ?>%">
                                <?= $kelapa_gading_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="kelapa_gading_pencurian" style="width:<?= $kelapa_gading_pencurian <= 2 ? 5 : $kelapa_gading_pencurian + 5 ?>%">
                                <?= $kelapa_gading_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="kelapa_gading_penggelapan" style="width:<?= $kelapa_gading_penggelapan <= 2 ? 5 : $kelapa_gading_penggelapan + 5 ?>%">
                                <?= $kelapa_gading_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="kelapa_gading_narkoba" style="width:<?= $kelapa_gading_narkoba <= 2 ? 5 : $kelapa_gading_narkoba + 5 ?>%">
                                <?= $kelapa_gading_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="kelapa_gading_kekerasan" style="width:<?= $kelapa_gading_kekerasan <= 2 ? 5 : $kelapa_gading_kekerasan + 5 ?>%">
                                <?= $kelapa_gading_kekerasan ?>
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
                    <div class="col-lg-11">
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
                    </div>
                    <div class="form-group">
                        <label for="">Teluk Jambe Barat</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="teluk_jambe_barat_perjudian" id="teluk_jambe_barat_perjudian" style="width:<?= $teluk_jambe_barat_perjudian <= 2 ? 5 : $teluk_jambe_barat_perjudian + 5 ?>%">
                                <?= $teluk_jambe_barat_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="teluk_jambe_barat_pencurian" style="width:<?= $teluk_jambe_barat_pencurian <= 2 ? 5 : $teluk_jambe_barat_pencurian + 5 ?>%">
                                <?= $teluk_jambe_barat_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="teluk_jambe_barat_penggelapan" style="width:<?= $teluk_jambe_barat_penggelapan <= 2 ? 5 : $teluk_jambe_barat_penggelapan + 5 ?>%">
                                <?= $teluk_jambe_barat_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="teluk_jambe_barat_narkoba" style="width:<?= $teluk_jambe_barat_narkoba <= 2 ? 5 : $teluk_jambe_barat_narkoba + 5 ?>%">
                                <?= $teluk_jambe_barat_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="teluk_jambe_barat_kekerasan" style="width:<?= $teluk_jambe_barat_kekerasan <= 2 ? 5 : $teluk_jambe_barat_kekerasan + 5 ?>%">
                                <?= $teluk_jambe_barat_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Teluk Jambe Timur</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="teluk_jambe_timur_perjudian" s style="width:<?= $teluk_jambe_timur_perjudian <= 2 ? 5 : $teluk_jambe_timur_perjudian + 5 ?>%">
                                <?= $teluk_jambe_timur_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="teluk_jambe_timur_pencurian" style="width:<?= $teluk_jambe_timur_pencurian <= 2 ? 5 : $teluk_jambe_timur_pencurian + 5 ?>%">
                                <?= $teluk_jambe_timur_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="teluk_jambe_timur_penggelapan" style="width:<?= $teluk_jambe_timur_penggelapan <= 2 ? 5 : $teluk_jambe_timur_penggelapan + 5 ?>%">
                                <?= $teluk_jambe_timur_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="teluk_jambe_timur_narkoba" style="width:<?= $teluk_jambe_timur_narkoba <= 2 ? 5 : $teluk_jambe_timur_narkoba + 5 ?>%">
                                <?= $teluk_jambe_timur_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="teluk_jambe_timur_kekerasan" style="width:<?= $teluk_jambe_timur_kekerasan <= 2 ? 5 : $teluk_jambe_timur_kekerasan + 5 ?>%">
                                <?= $teluk_jambe_timur_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Klari</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="klari_perjudian" style="width:<?= $klari_perjudian <= 2 ? 5 : $klari_perjudian + 5 ?>%">
                                <?= $klari_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="klari_pencurian" style="width:<?= $klari_pencurian <= 2 ? 5 : $klari_pencurian + 5 ?>%">
                                <?= $klari_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="klari_penggelapan" style="width:<?= $klari_penggelapan <= 2 ? 5 : $klari_penggelapan + 5 ?>%">
                                <?= $klari_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="klari_narkoba" style="width:<?= $klari_narkoba <= 2 ? 5 : $klari_narkoba + 5 ?>%">
                                <?= $klari_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="klari_kekerasan" style="width:<?= $klari_kekerasan <= 2 ? 5 : $klari_kekerasan + 5 ?>%">
                                <?= $klari_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Ciampel</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="ciampel_perjudian" style="width:<?= $klari_perjudian <= 2 ? 5 : $klari_perjudian + 5 ?>%">
                                <?= $klari_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="ciampel_pencurian" style="width:<?= $klari_pencurian <= 2 ? 5 : $klari_pencurian + 5 ?>%">
                                <?= $klari_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="ciampel_penggelapan" style="width:<?= $klari_penggelapan <= 2 ? 5 : $klari_penggelapan + 5 ?>%">
                                <?= $klari_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="ciampel_narkoba" style="width:<?= $klari_narkoba <= 2 ? 5 : $klari_narkoba + 5 ?>%">
                                <?= $klari_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="ciampel_kekerasan" style="width:<?= $klari_kekerasan <= 2 ? 5 : $klari_kekerasan + 5 ?>%">
                                <?= $klari_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Majalaya</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="majalaya_perjudian" style="width:<?= $majalaya_perjudian <= 2 ? 5 : $majalaya_perjudian + 5 ?>%">
                                <?= $majalaya_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="majalaya_pencurian" style="width:<?= $majalaya_pencurian <= 2 ? 5 : $majalaya_pencurian + 5 ?>%">
                                <?= $majalaya_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="majalaya_penggelapan" style="width:<?= $majalaya_penggelapan <= 2 ? 5 : $majalaya_penggelapan + 5 ?>%">
                                <?= $majalaya_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="majalaya_narkoba" style="width:<?= $majalaya_narkoba <= 2 ? 5 : $majalaya_narkoba + 5 ?>%">
                                <?= $majalaya_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="majalaya_kekerasan" style="width:<?= $majalaya_kekerasan <= 2 ? 5 : $majalaya_kekerasan + 5 ?>%">
                                <?= $majalaya_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="">Karawang Barat</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="karawang_barat_perjudian" style="width:<?= $karawang_barat_perjudian <= 2 ? 5 : $karawang_barat_perjudian + 5 ?>%">
                                <?= $karawang_barat_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="karawang_barat_pencurian" style="width:<?= $karawang_barat_pencurian <= 2 ? 5 : $karawang_barat_pencurian + 5 ?>%">
                                <?= $karawang_barat_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="karawang_barat_penggelapan" style="width:<?= $karawang_barat_penggelapan <= 2 ? 5 : $karawang_barat_penggelapan + 5 ?>%">
                                <?= $karawang_barat_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="karawang_barat_narkoba" style="width:<?= $karawang_barat_narkoba <= 2 ? 5 : $karawang_barat_narkoba + 5 ?>%">
                                <?= $karawang_barat_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="karawang_barat_kekerasan" style="width:<?= $karawang_barat_kekerasan <= 2 ? 5 : $karawang_barat_kekerasan + 5 ?>%">
                                <?= $karawang_barat_kekerasan ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="">Karawang Timur</label>
                        <div class="progress" style="max-width: 100%">
                            <div class="progress-bar" id="karawang_timur_perjudian" style="width:<?= $karawang_timur_perjudian <= 2 ? 5 : $karawang_timur_perjudian + 5 ?>%">
                                <?= $karawang_timur_perjudian ?>
                            </div>
                            <div class="progress-bar bg-success" id="karawang_timur_pencurian" style="width:<?= $karawang_timur_pencurian <= 2 ? 5 : $karawang_timur_pencurian + 5 ?>%">
                                <?= $karawang_timur_pencurian ?>
                            </div>
                            <div class="progress-bar bg-danger progress-bar-stripped" id="karawang_timur_penggelapan" style="width:<?= $karawang_timur_penggelapan <= 2 ? 5 : $karawang_timur_penggelapan + 5 ?>%">
                                <?= $karawang_timur_penggelapan ?>
                            </div>
                            <div class="progress-bar bg-warning progress-bar-stripped" id="karawang_timur_narkoba" style="width:<?= $karawang_timur_narkoba <= 2 ? 5 : $karawang_timur_narkoba + 5 ?>%">
                                <?= $karawang_timur_narkoba ?>
                            </div>
                            <div class="progress-bar bg-dark progress-bar-stripped" id="karawang_timur_kekerasan" style="width:<?= $karawang_timur_kekerasan <= 2 ? 5 : $karawang_timur_kekerasan + 5 ?>%">
                                <?= $karawang_timur_kekerasan ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card cardIn2" style="height:620px;">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="form-group text-center">
                            <h3 class="ml-2 text-center">Mapping Crime Index Karawang</h3>
                            <span class="text-center">Periode <span id="monthly_karawang"></span> 2022</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <i style="cursor:pointer" onclick="myFunction2()" class="mr-5 fas fa-bars"></i>
                        <div id="myDropdown2" class="dropdown-content">
                            <a onclick="filterCrimeKategoriKarawang('01')">Januari</a>
                            <a onclick="filterCrimeKategoriKarawang('02')">Februari</a>
                            <a onclick="filterCrimeKategoriKarawang('03')">Maret</a>
                            <a onclick="filterCrimeKategoriKarawang('04')">April</a>
                            <a onclick="filterCrimeKategoriKarawang('05')">Mei</a>
                            <a onclick="filterCrimeKategoriKarawang('06')">Juni</a>
                            <a onclick="filterCrimeKategoriKarawang('07')">Juli</a>
                            <a onclick="filterCrimeKategoriKarawang('08')">Agustus</a>
                            <a onclick="filterCrimeKategoriKarawang('09')">September</a>
                            <a onclick="filterCrimeKategoriKarawang('10')">Oktober</a>
                            <a onclick="filterCrimeKategoriKarawang('11')">November</a>
                            <a onclick="filterCrimeKategoriKarawang('12')">Desember</a>
                        </div>
                    </div>
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
            text: 'Jumlah Kasus Periode 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            gridLineColor: '#ffffff'
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
            },
            // gridLineColor: '#ffffff'
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
        }, {
            type: 'spline',
            // options3d: {
            //     enabled: true,
            //     alpha: 0,
            //     beta: 0,
            //     depth: 0
            // },
            name: 'Total',
            data: [<?= $countPerAreaKarawang ?>],
            center: [1, 1],
            // size: 200,
            showInLegend: false,
            dataLabels: {
                enabled: false
            },
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
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
            text: 'Jumlah Kasus Periode 2022'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            gridLineColor: '#ffffff'
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
            },
            // gridLineColor: '#ffffff'
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
        }, {
            type: 'spline',
            // options3d: {
            //     enabled: true,
            //     alpha: 0,
            //     beta: 0,
            //     depth: 0
            // },
            name: 'Total',
            data: [<?= $countPerArea ?>],
            center: [1, 1],
            // size: 200,
            showInLegend: false,
            dataLabels: {
                enabled: false
            },
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
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
        }, {
            type: 'spline',
            name: 'TOTAL',
            data: [<?= $countPerArea ?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
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
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            },
            name: 'TELUK JAMBE BARAT',
            data: [<?= $teluk_jambe_barat ?>]
        }, {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            },
            name: 'TELUK JAMBE TIMUR',
            data: [<?= $teluk_jambe_timur ?>]
        }, {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            },
            name: 'KLARI',
            data: [<?= $klari ?>]
        }, {
            type: 'column',

            name: 'CIAMPEL',
            data: [<?= $ciampel ?>]
        }, {
            type: 'column',
            name: 'MAJALAYA',
            data: [<?= $majalaya ?>]
        }, {
            type: 'column',
            name: 'KARAWANG TIMUR',
            data: [<?= $karawang_timur ?>]
        }, {
            type: 'column',
            name: 'KARAWANG BARAT',
            data: [<?= $karawang_barat ?>]
        }, {
            type: 'spline',
            name: 'TOTAL',
            data: [<?= $countPerAreaKarawang ?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
    });

    function mappingJakut(bulan) {
        // m3 aman
        // m2 tidak aman
        // m4 sangat tidak aman
        document.getElementById("maps_jakarta").innerHTML = "<div id='map2'></div>";
        var mapAsal = L.map('map2').setView([-6.1387788, 106.829449], 12.4);
        // document.getElementById("map2").innerHTML = "<h2>dasep</h2>"
        mapAsalLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        var icon_standar = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker3.png') ?>',
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

        var icon_sangat_bahaya = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker4.png') ?>',
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
                        var res = feature.properties.res;
                        var marker = L.marker(latlng, {
                            'icon': res <= 5 ? icon_standar : (res <= 10 ? icon_bahaya : icon_sangat_bahaya)
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

    function mappingKarawang(bulan) {
        // m3 aman
        // m2 tidak aman
        // m4 sangat tidak aman
        document.getElementById("map_karawang").innerHTML = "<div id='map'></div>";
        var mapAsal = L.map('map').setView([-6.3505035, 107.2483852], 11.5);
        mapAsalLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        var icon_standar = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker3.png') ?>',
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

        var icon_sangat_bahaya = L.icon({
            iconUrl: '<?= base_url('assets/img/info/marker4.png') ?>',
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
        $.getJSON("<?= site_url('SA/Crime/mapKarawang?bulan='); ?>" + bulan)
            .then(function(data) {
                L.geoJson(data, {
                    pointToLayer: function(feature, latlng) {
                        var res = feature.properties.res;
                        var marker = L.marker(latlng, {
                            'icon': res <= 5 ? icon_standar : (res <= 10 ? icon_bahaya : icon_sangat_bahaya)
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
            [-6.2732436, 107.2426157],
            [-6.387137, 107.1218503],
            [-6.4809085, 107.2328302],
            [-6.318322, 107.3987053],
            // [-6.1113905, 106.9398002]
        ]).addTo(mapAsal);
        polygon.setStyle({
            fillColor: 'red',
            lineColor: 'red'
        })

    }


    mappingKarawang("<?= date('m') ?>");
    mappingJakut("<?= date('m') ?>");

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("show");
    }

    document.getElementById("monthly_jakut").innerHTML = bulanConvert("<?= date('m') ?>")
    document.getElementById("monthly_karawang").innerHTML = bulanConvert("<?= date('m') ?>")

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
                $("#myDropdown").removeClass("show");
            },
            complete: function() {},
            success: function(e) {
                console.log(id);
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
                mappingJakut(bulan)
            }
        })
    }

    function filterCrimeKategoriKarawang(bulan) {
        var id = bulan;
        $.ajax({
            url: "<?= base_url('SA/Crime/load_karawang') ?>",
            method: "POST",
            data: 'bulan=' + id,
            beforeSend: function() {
                $("#myDropdown2").removeClass("show");
            },
            complete: function() {},
            success: function(e) {
                document.getElementById("monthly_karawang").innerHTML = bulanConvert(bulan);
                var data = JSON.parse(e)
                var teluk_jambe_barat = data[0];
                var teluk_jambe_timur = data[1];
                var klari = data[2];
                var ciampel = data[3];
                var majalaya = data[4];
                var karawang_barat = data[5];
                var karawang_timur = data[6];
                const kecamatan = ['teluk_jambe_barat', 'teluk_jambe_timur', 'klari', 'ciampel', 'majalaya', 'karawang_barat', 'karawang_timur'];
                const params = [teluk_jambe_barat, teluk_jambe_timur, klari, ciampel, majalaya, karawang_barat, karawang_timur];

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
                mappingKarawang(bulan)
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