<?php


class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
    if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
    }
    if ($role_id != 2) {
      redirect('LogOut');
    }
  }



  function index()
  {
    $data = array(
      'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
      'url'  => $this->uri->segment(2),
      'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    );
    $today = date("Y-m-d");
    $cektgl = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
    $q = $cektgl->expired_kta;
     $where = array('id_employee'  => $this->session->userdata('id_akun'));
    //masukan data update karyawan ke array data
    if ($q >= $today) {
      $this->db->set('status_kta', 'AKTIF');
      $this->db->where($where, "employee");
      $this->db->update('employee');
    } else if ($q <= $today) {
      $this->db->set('status_kta', 'TIDAK AKTIF');
      $this->db->where($where, "employee");
      $this->db->update('employee');
    }
    $this->load->view('mobile/header', $data);
    $this->load->view('Danru/dashboard', $data);
    $this->load->view('mobile/fotter');
  }
}
