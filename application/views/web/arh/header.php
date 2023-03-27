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
  <title>I-SECURITY</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ISECURITY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-5" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= $link == 'Dashboard' ? 'active' : '' ?>" href="<?= base_url('ARH/Dashboard') ?>" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <!-- <span class="fas fa-home"></span> -->
              </span>
              <span class="nav-link-text ps-1"> Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $link == 'Profiling' ? 'active' : '' ?>" href="<?= base_url('ARH/Profiling') ?>" role="button" aria-expanded="false">
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
            <a class="dropdown-item" href="<?= base_url('ARH/Absensi') ?>">Unduh Absensi</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('LogOut') ?>">Logout</a>
        </li>
      </ul>

    </div>
  </nav>