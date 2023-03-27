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
        if ($role_id != 9){
            redirect('LogOut');
        }
  }
    public function index()
    {
        $b = date('m');
        switch($b){
         case"01":
             $b="Januari";
         break;
         case"02":
             $b="Februari";
         break;
         case"03":
            $b="Maret";
        break;
         case"04":
            $b="April";
        break;
         case"05":
             $b="Mei";
             break;
         case"06":
             $b="Juni";
             break;
         case"07":
             $b="Juli";
             break;
         case"08":
             $b="Agustus";
             break;
         case"09":
             $b="September"
             ;break;
         case"10":
             $b="Oktober";
             break;
         case"11":
             $b="Nopember";
             break;
         case"12":
             $b="Desember";
             break;
        }
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        $data = [
            'tanggal'  => $tgl_kemarin,
            'HO'       => $this->Super_model->countPatroli("HO", $tgl_kemarin),
            'VLC'       => $this->Super_model->countPatroli("VLC", $tgl_kemarin),
            'DOR'       => $this->Super_model->countPatroli("DOR", $tgl_kemarin),
            'PC'       => $this->Super_model->countPatroli("PC", $tgl_kemarin),
            'P1'       => $this->Super_model->countPatroli("P1", $tgl_kemarin),
            'P2'       => $this->Super_model->countPatroli("P2", $tgl_kemarin),
            'P3'       => $this->Super_model->countPatroli("P3", $tgl_kemarin),
            'P4A'       => $this->Super_model->countPatroli("P4-ASSY1", $tgl_kemarin),
            'P4B'       => $this->Super_model->countPatroli("P4-ASSY2", $tgl_kemarin),
            'P5'       => $this->Super_model->countPatroli("P5", $tgl_kemarin),
            'KTAaktif'  => $this->Super_model->countStatusKTA("AKTIF"),
            'KTAtidakAktif'  => $this->Super_model->countStatusKTA("TIDAK AKTIF"),
            'bulan'    => $b 
        ];
        $this->load->view('web/header');
        $this->load->view('Superadmin/dashboard', $data);
        $this->load->view('web/fotter');
        
    }
    
    
}
