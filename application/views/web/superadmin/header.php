<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/su/') ?>bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap-datepicker.min.css" />

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/js/') ?>fontawesome.js"></script>
  <script src="<?= base_url('assets/js/') ?>popper.js"></script>
  <script src="<?= base_url('assets/js/') ?>bootstrap.min.js"></script>
  <script src="<?= base_url('assets/css/su/') ?>bootstrap-datetimepicker.min.js"></script>
  <script src="<?= base_url('assets/js/') ?>bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.0/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
  <style>
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
      opacity: 0.8;
    }

    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font: 14px arial;
    }

    #map2 {
      height: 400px;
    }

    #map {
      height: 480px;
    }

    #map_karawang {
      height: 400px;
    }

    .row>* {
      padding: 10px 0;
    }

    .cardIn {
      border: none;
      border-width: 1px 1px 1px 1px;
      border-color: #ccc;
      border-style: solid;
      border-radius: 0
    }

    .cardIn2 {
      border: none;
      border-width: 1px 0px 1px 1px;
      border-color: #ccc;
      border-style: solid;
      border-radius: 0
    }

    ul .first {
      margin-right: 10px;
    }

    ul .five,
    .third {
      margin-left: 14px;
    }

    .first::marker {
      content: url('<?= base_url('assets/img/info/list_icon.png') ?>');
      padding-left: 20px;
      position: relative;
    }

    .second::marker {
      content: url('<?= base_url('assets/img/info/list_icon_2.png') ?>');
    }

    .third::marker {
      content: url('<?= base_url('assets/img/info/list_icon_3.png') ?>');
    }

    .four::marker {
      content: url('<?= base_url('assets/img/info/list_icon_4.png') ?>');
    }

    .five::marker {
      content: url('<?= base_url('assets/img/info/list_icon_5.png') ?>');
    }

    .dropbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .dropbtn:hover,
    .dropbtn:focus {
      background-color: #3e8e41;
    }

    #myDropdown2 a:hover,
    #myDropdown a:hover {
      background-color: #3e8e41;
      cursor: pointer;

    }

    #myInput {
      box-sizing: border-box;
      background-image: url('searchicon.png');
      background-position: 14px 12px;
      background-repeat: no-repeat;
      font-size: 16px;
      padding: 14px 20px 12px 45px;
      border: none;
      border-bottom: 1px solid #ddd;
    }

    #myInput:focus {
      outline: 3px solid #ddd;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f6f6f6;
      min-width: 230px;
      overflow: auto;
      border: 1px solid #ddd;
      z-index: 999;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    /* .dropdown a:hover {
      background-color: #ddd;
    } */

    .show {
      display: block;
    }

    .show_hide {
      display: none;
    }
  </style>
  <title>I-SECURITY</title>
</head>

<body>
  <div class="preloader">
    <div class="loading">
      <img src="https://miro.medium.com/max/240/0*EWRe6WPyccnxVeY3.gif" width="80">
      <p>Harap Tunggu</p>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ISECURITY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-5" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= $link == 'Dashboard' ? 'active' : '' ?>" href="<?= base_url('SA/Dashboard') ?>" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <!-- <span class="fas fa-home"></span> -->
              </span>
              <span class="nav-link-text ps-1"> Dashboard</span>
            </div>
          </a>
        </li>

        <?php if ($this->session->userdata("npk") != 31570) { ?>
          <li class="nav-item">
            <a class="nav-link <?= $link == 'Profiling' ? 'active' : '' ?>" href="<?= base_url('SA/Profiling') ?>" role="button" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <!-- <span class="fas fa-users"></span> -->
                </span>
                <span class="nav-link-text ps-1"> Profiling</span>
              </div>
            </a>
          </li>
          <li class="nav-item dropdown <?= $link == 'Absensi' || $link == 'Historis' ? 'active' : '' ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Report
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?= base_url('SA/Absensi') ?>">Unduh Absensi</a>
              <a class="dropdown-item" href="<?= base_url('SA/Historis') ?>">Logs Approval</a>
            </div>
          </li>
          <li class="nav-item <?= $link == 'Patrol'  ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('SA/Patrol') ?>">I-Patrol</a>
          </li>
          <!-- <li class="nav-item <?= $link == 'Patrol'  ? 'active' : '' ?>">
            <a class="nav-link" href="#">File Sharing</a>
          </li> -->
          <li class="nav-item dropdown <?= $link == 'Crime'  ? 'active' : '' ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Crime
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?= base_url('SA/Crime/upload') ?>">Upload</a>
              <a class="dropdown-item" href="<?= base_url('SA/Crime') ?>">Dashboard</a>
            </div>
          </li>
          <?php
          if ($this->session->userdata("npk") == 41583) { ?>
            <li class="nav-item dropdown <?= $link == 'Approval'  ? 'active' : '' ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Approval
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?= base_url('SA/Approval/overtime') ?>">Overtime</a>
                <a class="dropdown-item" href="<?= base_url('SA/Approval/skta') ?>">SKTA</a>
                <a class="dropdown-item" href="<?= base_url('SA/Approval/sakit') ?>">Sakit</a>
                <a class="dropdown-item" href="<?= base_url('SA/Approval/cuti') ?>">Cuti</a>
              </div>
            </li>
          <?php } ?>
        <?php } else if ($this->session->userdata("npk") == 31570) { ?>
          <li class="nav-item">
            <a class="nav-link <?= $link == 'Profiling' ? 'active' : '' ?>" href="<?= base_url('SA/Profiling') ?>" role="button" aria-expanded="false">
              <div class="d-flex align-items-center">
                <span class="nav-link-icon">
                  <!-- <span class="fas fa-users"></span> -->
                </span>
                <span class="nav-link-text ps-1"> Profiling</span>
              </div>
            </a>
          </li>
          <li class="nav-item <?= $link == 'Absensi'  ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('SA/Absensi') ?>">Unduh Absensi</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('LogOut') ?>">Logout</a>
        </li>

      </ul>

    </div>
  </nav>