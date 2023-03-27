<?php


class Update_data extends CI_Controller
{

    private $filename = "Format_Status_Kerja";
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
        if(isset($_POST['submit'])){
			$upload = $this->Sipd_model->uploadfile4($this->filename);
			if($upload['result'] =="success") {
            
        
                    // $excelreader = new PHPExcel_Reader_Excel2007();
                    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $loadexcel = $spreadsheet->load('assets/upload/status_karyawan/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel               
                    $sheet = $loadexcel->getActiveSheet()->toArray(null,true,true,true);

                    // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                    // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                     $data['sheet'] = $sheet ;
                    // echo '<pre>';
                    // print_r($sheet);
				 }else{
                     $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                     echo $upload['error'];
                 }

		}
        $this->load->view('web/header');
        $this->load->view('Superadmin/update_data',$data);
        // $this->load->view('web/fotter');
    }

    function posting()
 	{

 		date_default_timezone_set('Asia/Jakarta');
        // Load plugin PHPExcel nya
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

            $spreadsheet = $reader->load('assets/upload/status_karyawan/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel               
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
		    $sheetcount = count($sheetdata);
            $data1 = array();
            $data2 = array();
                
            if($sheetcount > 1){
                    for ($i = 1; $i < $sheetcount; $i++){
                            $IdAnggota      = $sheetdata[$i][1];
                            $Npk            = $sheetdata[$i][2];
                            $Nama           = $sheetdata[$i][3];
                            $AreaKerja      = $sheetdata[$i][4];
                            $Jabatan        = $sheetdata[$i][5];
                            $Role_id        = $sheetdata[$i][6];

                            $data1[]= array(
                            'id_employee'			    => $IdAnggota,
                            'npk'					    => $Npk,
                            'area_kerja'                => $AreaKerja,
                            'jabatan'                   => $Jabatan,
                            );
                            $data2[]=array(
                             'id_akun'              => $IdAnggota,
                             'role_id'              => $Role_id   
                            );
                    }
                }
                // echo '<pre>';
                // echo print_r($sheetdata);
                    $input =  $this->db->update_batch('employee',$data1,'id_employee');
                    $input =  $this->db->update_batch('akun',$data2,'id_akun');
                    if($input){                  
                        echo 'Sukses';
                    }else{
                        echo "Gagal";
                    }

 	}
}

?>