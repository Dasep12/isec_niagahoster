<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container mt-5">
        <div class="container-wrap">
            <div class="row">
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <th>Gender</th>
                        <th>Total</th>
                        <tbody>
                            <tr>
                                <td>Laki-Laki</td>
                                <td><?= $genderLaki ?></td>
                            </tr>
                            <tr>
                                <td>Perempuan</td>
                                <td><?= $genderPerempuan ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <th>Golongan Darah</th>
                        <th>Total</th>
                        <tbody>
                            <?php $d = 0;
                            foreach ($golongan->result() as $p) : ?>
                                <tr>
                                    <td><?= $p->gol_darah ?></td>
                                    <td><?= $p->total ?></td>
                                </tr>
                            <?php $d += $p->total;
                            endforeach ?>
                            <td>Tidak Mengisi</td>
                            <td><?= $master->total -  $d ?></td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <th>Usia</th>
                        <th>Total</th>
                        <tbody>
                            <?php $u = 0;
                            foreach ($umur->result() as $p) : ?>
                                <tr>
                                    <td><?= $p->range_umur ?></td>
                                    <td><?= $p->jumlah ?></td>
                                </tr>
                            <?php $u += $p->jumlah;
                            endforeach ?>
                            <td>Tidak Mengisi</td>
                            <td><?= $master->total -  $u ?></td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <th>Tempat Tinggal (DKI JAKARTA)</th>
                        <th>Total</th>
                        <tbody>
                            <?php $t = 0;
                            foreach ($tempatTinggal->result() as $p) : ?>
                                <tr>
                                    <td><?= $p->kecamatan ?></td>
                                    <td><?= $p->total ?></td>
                                </tr>
                            <?php $t += $p->total;
                            endforeach ?>
                            <td>Tidak Mengisi</td>
                            <td><?= $master->total -  $t ?></td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <th>Tempat Tinggal (JAWA BARAT)</th>
                        <th>Total</th>
                        <tbody>
                            <?php $tp = 0;
                            foreach ($tempatTinggal2->result() as $p) : ?>
                                <tr>
                                    <td><?= $p->kecamatan ?></td>
                                    <td><?= $p->total ?></td>
                                </tr>
                            <?php $tp += $p->total;
                            endforeach ?>
                            <td>Tidak Mengisi</td>
                            <td><?= $master->total -  $tp ?></td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>