<?php


class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
    if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
    }
    if ($role_id != 7) {
      redirect('LogOut');
    }
  }


  public function bulan($bln)
  {
    switch ($bln) {
      case '01':
        $bulan = 'JANUARI';
        break;
      case '02':
        $bulan = 'FEBRUARI';
        break;
      case '03':
        $bulan = 'MARET';
        break;
      case '04':
        $bulan = 'APRIL';
        break;
      case '05':
        $bulan = 'MEI';
        break;
      case '06':
        $bulan = 'JUNI';
        break;
      case '07':
        $bulan = 'JULI';
        break;
      case '08':
        $bulan = 'AGUSTUS';
        break;
      case '09':
        $bulan = 'SEPTEMBER';
        break;
      case '10':
        $bulan = 'OKTOBER';
        break;
      case '11':
        $bulan = 'NOVEMBER';
        break;
      case '12':
        $bulan = 'DESEMBER';
        break;
      default:
        '';
        break;
    }

    return $bulan;
  }

  public function index(Type $var = null)
  {
    $bulan = date('Y-m');
    $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
    $wil  =  $wl->wilayah;
    $npk = $this->session->userdata('npk');
    if ($npk == 22325) {
      $wil_ = "WIL2";
    } else if ($npk == 46785) {
      $wil_ = "WIL4";
    }

    switch ($wil) {
      case 'WIL1':
        $tabel = "absen_wil1";
        break;
      case 'WIL2':
        $tabel = "absen_wil2";
        break;
      case 'WIL3':
        $tabel = "absen_wil3";
        break;
      case 'WIL4':
        $tabel = "absen_wil4";
        break;
      default:
        break;
    }

    switch ($wil_) {
      case 'WIL1':
        $tabel_ = "absen_wil1";
        break;
      case 'WIL2':
        $tabel_ = "absen_wil2";
        break;
      case 'WIL3':
        $tabel_ = "absen_wil3";
        break;
      case 'WIL4':
        $tabel_ = "absen_wil4";
        break;
      default:
        break;
    }

    $data = [
      'bidoata'  => $this->db->query("select b.nama ,e.wilayah , e.area_kerja , b.npk  from employee e , biodata b  where b.id_biodata = e.id_employee and e.id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),

      'link'  => $this->uri->segment(2),

      'wilayah'      => $wil,
      'data_mangkir' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  $tabel ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
      AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
      GROUP BY ab.npk  ORDER BY total DESC"),

      'wilayah_'     => $wil_,
      'data_mangkir2' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  $tabel_ ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
      AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
      GROUP BY ab.npk  ORDER BY total DESC"),

      'bulan'   => strtolower($this->bulan(date('m')))
    ];
    $this->load->view("web/spv/header", $data);
    $this->load->view("SPV/dashboard", $data);
    $this->load->view("web/spv/fotter");
  }
}
