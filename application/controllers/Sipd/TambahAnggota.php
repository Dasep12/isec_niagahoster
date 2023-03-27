<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TambahAnggota extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
                redirect('Login');
            } 
            if ($role_id != 5){
                redirect('LogOut');
            }
    }
    function index()
    {
    $data = array(
    'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
    'url'  => $this->uri->segment(2),
    'berkas'    => $this->db->get_where('berkas',array('id_berkas' => $this->session->userdata('id_akun')))->row(),
    );
    $this->load->view('web/header',$data);
    $this->load->view('Sipd/tambahAnggota');
    $this->load->view('web/fotter');
    }
    
    function Upload()
    {
    $upload_file=$_FILES['Format_Upload']['name'];
    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension == 'csv'){
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
    }else if($extension == 'xls'){
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
    }else{
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
    }
    $spreadsheet = $reader->load($_FILES['Format_Upload']['tmp_name']);
    $sheetdata = $spreadsheet->getActiveSheet()->toArray(); 
    $sheetcount=count($sheetdata);
    $data   = array();
    $data1  = array();
    $data2  = array();
    $data3  = array();
    $data4  = array();
    
    // echo '<pre>';
    // print_r($sheetdata);
       
    if($sheetcount > 1){
        for ($i=1; $i < $sheetcount; $i++)
        {
            $Id                 = $sheetdata[$i][1];
            $Npk                = $sheetdata[$i][2];
            $Nama               = $sheetdata[$i][3];
            $AreaKerja          = $sheetdata[$i][4];
            $Jabatan            = $sheetdata[$i][5];
            $Role_id            = $sheetdata[$i][6];

            //Akun
            $data[]=array(
                'id_akun'   => $Id,
                'npk'       => $Npk,
                'password'  => md5($Npk),
                'role_id'   => $Role_id,
            );
            //Berkas
            $data1[]=array(
                'id_berkas' => $Id,
            );
            //Biodata
            $data2[]=array(
                'id_biodata'    => $Id,
                'npk'           => $Npk,
                'nama'          => $Nama,
            );
            //Employee
            $data3[]=array(
                'id_employee'           => $Id,
                'npk'                   => $Npk,
                'jabatan'               => $Jabatan,
                'area_kerja'            => $AreaKerja,
            );
            //Anggota
            $data4[]=array(
                'id_akun'           => $Id,
                'id_biodata'        => $Id,
                'id_employe'        => $Id,
                'id_berkas'         => $Id,
            );
          }
        }
              $CekAkun = $this->Sipd_model->cari(array("id_akun" => $Id),"akun")->num_rows();
              if($CekAkun > 0){
                $this->session->set_flashdata("Error", "Anggota telah terdaftar");
                redirect("Sipd/Anggota");
                }else{
                    $input =  $this->Sipd_model->inputArray("akun", $data);
                    $input =  $this->Sipd_model->inputArray("berkas", $data1);
                    $input =  $this->Sipd_model->inputArray("biodata", $data2);
                    $input =  $this->Sipd_model->inputArray("employee", $data3);
                    $input =  $this->Sipd_model->inputArray("anggota", $data4);
                         
                if($input) {
                echo "berhasil";
                }else {
                 echo "Gagal";
                } 
            }
    }
}

?>