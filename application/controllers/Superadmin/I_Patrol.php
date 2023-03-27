<?php
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;


class I_Patrol extends CI_Controller
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
    
    public function bulan(){
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
        
       return $b ;
    }
    
    public function index()
    {
        $area = $this->input->post("area_patrol");
        $d = $this->db->get_where("titik_area", ['id_plan' => "P2"]);
        
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        // $tgl_kemarin    = date('Y-m-d');
        
        $tgl1 = "2022-01-01" ;
        $tgl2 = "2022-01-31" ;
    
        $data = array(
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'total'   => $this->Sipd_model->countAll()->num_rows(),
            'titik'         => $d,
            'tanggal'  => $tgl_kemarin,
            'HO'       => $this->Super_model->countPatroli("HO", $tgl_kemarin),
            'VLC'      => $this->Super_model->countPatroli("VLC", $tgl_kemarin),
            'DOR'      => $this->Super_model->countPatroli("DOR", $tgl_kemarin),
            'PC'       => $this->Super_model->countPatroli("PC", $tgl_kemarin),
            'P1'       => $this->Super_model->countPatroli("P1", $tgl_kemarin),
            'P2'       => $this->Super_model->countPatroli("P2", $tgl_kemarin),
            'P3'       => $this->Super_model->countPatroli("P3", $tgl_kemarin),
            'P4A'      => $this->Super_model->countPatroli("P4-ASSY1", $tgl_kemarin),
            'P4B'      => $this->Super_model->countPatroli("P4-ASSY2", $tgl_kemarin),
            'P5'       => $this->Super_model->countPatroli("P5", $tgl_kemarin),
            'bulan'    => $this->bulan()
        );
        $this->load->view('web/header', $data);
        $this->load->view('Superadmin/ipatrol/dashboard_patroli', $data);
        $this->load->view('web/fotter');

    }
    
    //show data patroli per area selama sebulan
    public function showPatroli(){
          $area = $this->input->post("area");
          $bulan = $this->input->post("bulan");
        // $area = "VLC" ;
        // $bulan = "02";

        $data = array(
            'area'          => $area  ,
            'bulan'         => $bulan   ,
            'data'          => $this->db->get_where("durasi_patroli",['area' => $area])->result()
        );
        // $this->load->view('web/header', $data);
        $this->load->view("Superadmin/ipatrol/dashboard_patroli_excel", $data);
        // $this->load->view('web/fotter');
    }


    //format excel download laporan patroli 
    public function tarikExcel()
    {

        $area = $this->input->post("area_patrol");
        //  $id = "P5";
        $d = $this->db->get_where("titik_area", ['id_plan' => $area]);
        $bulan  = $this->input->post("bulan");
        $this->db->order_by("lokasi", 'asc');
        $data = array(
            'titik'         => $d,
            'area'           => $area  ,
            'bulan'         => $bulan 
        );
        $filename = 'laporan-patrol-' . $area;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("Superadmin/ipatrol/excel_patroli", $data);
    }



    //format pdf download laporan patroli 
    public function reportPeriodik()
    {
        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area_kerja");
        $this->db->where('area_kerja', $area);
        $this->db->where('tgl_kirim_patroli >=', $day);
        $this->db->where('tgl_kirim_patroli <=', $day2);
        $result = $this->db->get('hasil_patroli');
        $data = [
            'patrol'  =>  $result,
            'area'    => $area,
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $data = $this->load->view('Superadmin/ipatrol/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'I');
    }
}
