<?php

date_default_timezone_set('Asia/Jakarta');
class Tester extends CI_Controller
{
 
  
  public function index()
  {
       $id = "228572" ;
       $this->load->library('user_agent');
       date_default_timezone_set('Asia/Jakarta');
      // $this->session->userdata('id_akun')
        //   $data = array(
        //     'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $id ))->row(),
        //     'url'       => $this->uri->segment(2),
        //     'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $id ))->row(),
        //     'employe'   => $this->db->get_where('employee',array('id_employee' => $id ))->row(),
        //   );
        //   $this->load->view('mobile/header',$data);
        //   $this->load->view('tester',$data);
        $this->load->view('Tester/zxing_scanner');
     // $this->load->view('mobile/fotter');
  }
  
  
  function tester_absen()
  {
    $data = array(
        'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
        'url'       => $this->uri->segment(2),
        'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
        'employe'   => $this->db->get_where('employee',array('id_employee' => $this->session->userdata('id_akun')))->row(),
      );
      $this->load->view('mobile/header',$data);
      $this->load->view('test',$data);
      $this->load->view('mobile/fotter');
  }
  
  function tester_camera(){
      $this->load->library('user_agent');
      $agent = $this->agent->browser() ;
      $data = [
          'ca' => $agent
      ];
      $this->load->view("test_camera",$data);
  }
  
  
  public function zxing(){
      $this->load->view("Tester/zxing_scanner");
  }
  
  public function input(){
      
      $nama = $this->input->post("nama");
      $npk = $this->input->post("npk");
      $kamera = $this->input->post("kamera");
      $barcode = $this->input->post("barcode");
      $data = [
            'nama'  => $nama ,
            'npk'   => $npk ,
            'kamera' =>$kamera ,
            'barcode'   => $barcode   ,
            'waktu'  => date('Y-m-d H:i:s')
        ];
        
        $in = $this->db->insert("survey_kamera",$data);
            if($in){
                echo "Terimakasih " . $nama . " atas partisipasinya" ;
            }
  }
  
  
}