<?php

class Report_absensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Super_model");
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
    function index()
    {
        
        $this->load->view('web/header');
        $this->load->view('Superadmin/report_absensi');
        $this->load->view('web/fotter');
    }

    //show data Absensi  selama sebulan
    public function showAbsensi(){
          $wilayah = $this->input->post("wilayah");
          $bulan =   $this->input->post("bulan");
          $namaTable = 'report_absen_';
        

        switch ($wilayah) {
            case 'WIL1':
                $namaWilayah = 'wil1';
                $table = $this->db->query("SELECT * FROM report_absen_wil1")->result();
                break;

            case 'WIL2':
                $namaWilayah = 'wil2';
                $table = $this->db->query("SELECT * FROM report_absen_wil2")->result();
                break;

            case 'WIL3':
                $namaWilayah = 'wil3';
                $table = $this->db->query("SELECT * FROM report_absen_wil3")->result();
                break;

            case 'WIL4':
                $namaWilayah = 'wil4';
                $table = $this->db->query("SELECT * FROM report_absen_wil4")->result();
                break;
            
            default:
                # code...
                break;
        }
        $data = array(
            'namaTable'     => $namaTable,
            'namaWilayah'   => $namaWilayah,
            'wilayah'       => $wilayah,
            'bulan'         => $bulan   ,
            'data'          => $table
        );
        // echo '<pre>';
        // var_dump($data);

        // $this->load->view('web/header', $data);
        $this->load->view("Superadmin/report_absensi_excel", $data);
        // $this->load->view('web/fotter');
    }
    
     //show data Absensi  selama sebulan
    public function DownloadABsensi(){
          $wilayah = $this->input->post("wilayah");
          $bulan =   $this->input->post("bulan");
          $namaTable = 'report_absen_';
        

        switch ($wilayah) {
            case 'WIL1':
                $namaWilayah = 'wil1';
                $table = $this->db->query("SELECT * FROM report_absen_wil1")->result();
                break;

            case 'WIL2':
                $namaWilayah = 'wil2';
                $table = $this->db->query("SELECT * FROM report_absen_wil2")->result();
                break;

            case 'WIL3':
                $namaWilayah = 'wil3';
                $table = $this->db->query("SELECT * FROM report_absen_wil3")->result();
                break;

            case 'WIL4':
                $namaWilayah = 'wil4';
                $table = $this->db->query("SELECT * FROM report_absen_wil4")->result();
                break;
            
            default:
                # code...
                break;
        }
        $data = array(
            'namaTable'     => $namaTable,
            'namaWilayah'   => $namaWilayah,
            'wilayah'       => $wilayah,
            'bulan'         => $bulan   ,
            'data'          => $table
        );
        // echo '<pre>';
        // var_dump($data);
         // Proses file excel
 
        $filename = 'Report Absensi-' . $wilayah;
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        header('Cache-Control: max-age=0');
        $this->load->view("Superadmin/report_absensi_excel", $data);
        
    }
}

?>