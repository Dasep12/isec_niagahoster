<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/icon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>I-SECURITY</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url('PIC/Approval') ?>">
            I-SECURITY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item <?= $link == 'Dashboard' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('PIC/Dashboard') ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $link == 'Approval' ? 'active' : '' ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Approval
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('PIC/Approval/overtime') ?>">Approve Overtime</a>
                        <a class="dropdown-item" href="<?= base_url('PIC/Approval/skta') ?>">Approve SKTA</a>
                        <a class="dropdown-item" href="<?= base_url('PIC/Approval/cuti') ?>">Approve Cuti</a>
                        <a class="dropdown-item" href="<?= base_url('PIC/Approval/sakit') ?>">Approve Sakit</a>
                    </div>
                </li>
                <li class="nav-item <?= $link == 'Absensi' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('PIC/Absensi') ?>">Unduh Absensi</a>
                </li>
                <li class="nav-item <?= $link == 'Profiling' ? 'active' : '' ?> ">
                    <a class="nav-link" href="<?= base_url('PIC/Profiling') ?>">Profiling</a>
                </li>
                <li class="nav-item <?= $link == 'Historis' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('PIC/Historis') ?>">Logs Approval</a>
                </li>
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="<?= base_url('LogOut') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </nav>