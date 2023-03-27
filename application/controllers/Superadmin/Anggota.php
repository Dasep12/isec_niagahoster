<?php



 /**
  * 
  */
 class Anggota extends CI_Controller
 {

  public function __construct()
  {
    parent::__construct();

    $role = $this->session->userdata('role_id');
      
      if(empty($role)){
        $this->session->userdata("logout","Sesi Berakhir");
        redirect('Login');
      }elseif($role != 9 ){
          redirect("LogOut");
      }
      
  }


  public function json()
  {
    $p = $this->m_admin->Rjson();
    
    print_r($p);
  }


  public function index()
  {
    $this->load->view("web/header");
    $this->load->view("Superadmin/anggota");
    $this->load->view("web/fotter");
  }

  function profiling($npk)
    {
        header('Content-Type: application/json');
        $data = $this->Super_model->getProfiling($npk)->row();
         echo json_encode($data);
    }

  

  public function form_edit($npk)
    {
      $where = array('id_karyawan'  => $npk) ;
      //ambil data diri karyawan 
      $data['item'] = $this->m_admin->getKar('karyawan',$where)->row();

      //get informasi data kelengkapan berkas karyawan
      $data['item2'] = $this->m_admin->getKar('employe_karyawan',$where)->row();

      //get data pendidikan karyawan
      $data['item3'] =$this->m_admin->getKar('pendidikan',$where)->row();

      //get keluarga anggota istri/suami
      $data['keluarga'] = $this->m_admin->getKar('pasangan',$where)->row();

      //get pengalaman user
      $data['pengalaman'] = $this->m_admin->getKar('pengalaman',$where)->result();

      //ambil data keahlian dari anggota
      $data['skill'] = $this->m_admin->getKar('skill',$where)->result();

      //ambil data anak dari anggota/user / karyawan
      $data['keluarga2'] = $this->m_admin->getKar('anak',$where)->result();

      //data cari anak
      $data['cari_anak'] = $this->db->get_where("anak",$where)->result();

      $this->load->view("template/header");
      $this->load->view("superadmin/Edit_user",$data);
      $this->load->view("template/footer");
    }

 public function updateEmploye()
    {

      $where = array('id_karyawan'    => $this->input->post('id_karyawan'));

      $data = array(
          'status'              => $this->input->post('status'),
          'instalasi'           => $this->input->post('instalasi'),
          'posisi_status'       => $this->input->post('posisi_status'),
          'no_kta'              => $this->input->post('no_kta'),
          'arh1'                 => $this->input->post('arh'),
          'tgl_berakhir_kta'    => $this->input->post('tgl_berakhir_kta'),
          'gada_madya'          => $this->input->post('gada_madya'),
          'gada_pratama'        => $this->input->post('gada_pratama'),
          'status_pajak'        => $this->input->post('status_pajak'),
          'bpjs_kesehatan'      => $this->input->post('bpjs_kesehatan'),
          'bpjs_ktu'            => $this->input->post('bpjs_ktu'),
      );
      $data2 = array(
        'arh'  => $this->input->post('arh')
      );
     $p =  $this->m_admin->updateInstalasi($data,$where,'employe_karyawan');
     $q =  $this->m_admin->updateInstalasi($data2,$where,'karyawan');
      if($p && $q){
        echo "Sukses";
      }
    }


    public function updateBiodata()
    {
          $where = array('id_karyawan'  => $this->input->post('id_karyawan') );
        
        
        //masukan data update karyawan ke array data 
        $data = array(
          'nama'              => $this->input->post("nama"),
          'tempat_lahir'      => $this->input->post("tempat_lahir"),
          'tgl_lahir'         => $this->input->post("tgl_lahir"),
          'agama'             => $this->input->post("agama"),
          'alamat'            => $this->input->post("alamat"),
	  'no_telp'           => $this->input->post("no_telp"),
          'nik'               => $this->input->post("nik"),
          'no_kk'             => $this->input->post("no_kk"),
          'celana'            => $this->input->post("celana"),
          'baju'              => $this->input->post("baju"),
          'sepatu'            => $this->input->post("sepatu")
        );

        //input update karyawan 
        $updateInfouser =  $this->m_admin->updateInstalasi($data,$where,'karyawan');
        echo "Sukses";
    }

    //reset password anggota
    public function rstpsword($id_karyawan)
    {
      $s = $this->m_admin->getData('akun');
      $data = array(
          "pass" => md5(123)
        );
        $update = $this->m_admin->rstpsword($data,"akun",array("id_karyawan" => $id_karyawan));
        if($update){
          $this->session->set_flashdata('ok','Password Default 123');
          echo "Password adalah 123";
        }else{
           echo "gagal" ; 
        }
    }

    

 }