<?php
defined('BASEPATH') or exit('No direct script access allowed');


// require './libraries/RestController.php' ;
require_once(APPPATH.'./libraries/RestController.php');
use chriskacerguis\RestServer\RestController;

class ISECURITY extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->load->model('Api_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    //ambil biodata anggota
    public function biodata_get()
    {
        $id = $this->get('id');
        $url = $this->uri->segment(3);

        $where = ['id_biodata' => $id];
        $data = $this->Api_Model->getData("biodata", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
            ], 200);
        } else {

            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }

    //update biodata
    public function updateBiodata_put()
    {
        # code...
        $id  = $this->put('id');
        $data = [
            'ktp'               => $this->put("ktp"),
            'kk'                => $this->put("kk"),
            'tempat_lahir'      => $this->put("tempat_lahir"),
            'tanggal_lahir'     => $this->put("tanggal_lahir"),
            'no_hp'             => $this->put("no_hp"),
            'no_emergency'      => $this->put("no_emergency"),
            'email'             => $this->put("email"),
            'gol_darah'         => $this->put("gol_darah"),
        ];
        

        $where = ['id_biodata'  => $id];
        $update = $this->Api_Model->update("biodata", $data, $where);

        if ($update) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data,
                'pesan'   => 'update sukses',
            ], 200);
        } else {
            $this->response([
                'status'  => 'nok',
                'pesan'   => 'update failed',
            ], 401);
        }
    }
    //
    
     //update alamat ktp 
    public function updateKTP_put ()
    {
        $id  = $this->put('id');
        
        $data = [
            'jl_ktp'        => strtoupper($this->put('jl_ktp')) ,
            'rt_ktp'        => strtoupper($this->put('rt_ktp')) ,
            'rw_ktp'        => strtoupper($this->put('rw_ktp')) ,
            'kel_ktp'       => strtoupper($this->put('kel_ktp')) ,
            'kec_ktp'       => strtoupper($this->put('kec_ktp')) ,
            'kota_ktp'      => strtoupper($this->put('kota_ktp')) ,
            'provinsi_ktp'  => strtoupper($this->put('provinsi_ktp')) ,
        ];
        
        $where = ['id_biodata'  => $id];
        $update = $this->Api_Model->update("biodata", $data, $where);

        if ($update) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data,
                'pesan'   => 'update sukses',
            ], 200);
        } else {
            $this->response([
                'status'  => 'nok',
                'pesan'   => 'update failed',
            ], 401);
        }
        
    }
    //
    
    
   //update alamat domisili
    public function updateDomisili_put ()
    {
        $id  = $this->put('id');
        
        $data = [
            'jl_dom'        => strtoupper($this->put('jl_dom')) ,
            'rt_dom'        => strtoupper($this->put('rt_dom')) ,
            'rw_dom'        => strtoupper($this->put('rw_dom')) ,
            'kel_dom'       => strtoupper($this->put('kel_dom')) ,
            'kec_dom'       => strtoupper($this->put('kec_dom')) ,
            'kota_dom'      => strtoupper($this->put('kota_dom')) ,
            'provinsi_dom'  => strtoupper($this->put('provinsi_dom')) ,
        ];
        
        // $this->response([
        //         'status'  => 'ok',
        //         'id'      => $id ,
        //         'result'  => $data,
        //         'pesan'   => 'update sukses',
        //     ], 200);
        
        $where = ['id_biodata'  => $id];
        $update = $this->Api_Model->update("biodata", $data, $where);

        if ($update) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data,
                'pesan'   => 'update sukses',
            ], 200);
        } else {
            $this->response([
                'status'  => 'nok',
                'pesan'   => 'update failed',
            ], 401);
        }
        
    }
    //
    
    //update imt 
    public function updateIMT_put()
    {
        $id  = $this->put('id');
        $data = [
            'tinggi_badan'      => strtoupper($this->put('tinggi_badan')) ,
            'berat_badan'       => strtoupper($this->put('berat_badan')) ,
            'imt'               => strtoupper($this->put('imt')) ,
            'keterangan'        => strtoupper($this->put('keterangan')) ,
        ];
        
        $where = ['id_biodata'  => $id];
        $update = $this->Api_Model->update("biodata", $data, $where);

        if ($update) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data,
                'pesan'   => 'update sukses',
            ], 200);
        } else {
            $this->response([
                'status'  => 'nok',
                'pesan'   => 'update failed',
            ], 401);
        }
    }
    
    
    //




    //ambil data employee 
    public function employe_get()
    {
        $id = $this->get('id');
        $where = ['id_employee' => $id];
        $data = $this->Api_Model->getData("employee", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }

    //update data kta
    public function update_employe_put()
    {
        $data = [
            'no_kta'                       => $this->put("no_kta"),
            'expired_kta'                  => $this->put("ex_kta"),
            'tgl_masuk_sigap'              => $this->put("masuk_sigap"),
            'tgl_masuk_adm'                => $this->put("masuk_adm"),
        ];
        $id = $this->put('id');
            
        $where = ['id_employee'  => $id];
        $update = $this->Api_Model->update("employee", $data, $where);

        if ($update) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data,
                'pesan'   => 'update sukses',
            ], 200);
        } else {
            $this->response([
                'status'  => 'nok',
                'pesan'   => 'update failed',
            ], 401);
        }
    }
    
   

    //ambil data berkas
    public function berkas_get()
    {
        $id = $this->get('id');
        $where = ['id_berkas' => $id];
        $data = $this->Api_Model->getData("berkas", $where);
        if ($data->num_rows() > 0) {
        $image = $data->row();
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
                'poto'    => $image->foto ,
                'url'     => base_url('assets/berkas/Poto/')
            ], 200);
        } else {

            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }



   //API untuk cek user dan login 
    public function cekUser_post()
    {
        // $npk         = $this->input->post("npk");
        // $password    = $this->input->post("password");
        // $where       = ['npk' => $npk, 'password'    =>  md5($password)];
        // $data        = $this->Api_Model->getData("akun", $where);
        // if ($data->num_rows() > 0) {
        //     $this->response([
        //         'status'  => 'ok' ,
        //         'result'  => $data->result(),
        //     ], 200);
        // } else {

        //     $this->response([
        //         'status' => false,
        //         'message' => 'Tidak ada data'
        //     ], 404);
        // }
        
        $npk         = $this->post("npk");
        $password    = $this->post("password");
        $token       = $this->post("token") . '.' . $npk;
        $where       = ['npk' => $npk, 'password'    =>  md5($password)];
        $data        = $this->Api_Model->getData("akun", $where);
        if ($data->num_rows() > 0) {
            $cek_token = $this->Api_Model->getData("master_token", ['npk' => $npk]);
            if ($cek_token->num_rows() > 0) {
                $v = $cek_token->row();
                if ($token != $v->token) {
                    $this->response([
                        'status' => false,
                        'message' => 'user sudah login di perangkat lain'
                    ], 404);
                } else {
                    $this->response([
                        'result'  => $data->result(),
                        'token'   => $v->token,
                        'status'  => 'ok',
                        'message' => 'login'
                    ], 200);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'NPK belum teregistrasi'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }
    
    
    
    //api upload gambar 
    public function uploadImage_post()
    {
        $this->load->library('upload');
        $file = $_FILES['image']['name'];
        $id   = $this->post('id_akun');
        $exe = pathinfo($file, PATHINFO_EXTENSION);
        // $config['upload_path'] = './assets/img/sample/';
        $config['upload_path'] = './assets/berkas/Poto/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name']      = "Poto".$id . "." . $exe;
        $config['overwrite']        = true ;
        // $this->response([
        //         'message'   => $id ,
        //         'file'      => $this->upload->data("file_name") ,
        //         'File'      => $file
        // ],500);

        
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("image")) {
            $this->response([
                'status'    => 'failed',
                'message'   => $this->upload->display_errors()
            ], 500);
        } else {
            // $data = [
            //     'nama'  => $id,
            //     'file'  => $this->upload->data("file_name")
            // ];
            
            $data = [
                'foto'  => $this->upload->data("file_name") ,
            ];
            
            $where = ['id_berkas'  => $id];
           $update =  $this->Api_Model->update("berkas", $data, $where);
            if($update){
                 $this->response([
                'result'   => $data,
                'status'   => 'Berhasil Upload',
                'message'  => "success"
            ], 200);
            }else {
                 $this->response([
                'message'  => "failed"
            ], 502);
            }
           
        }
    }
    
    
    
    //API register device user 
    public function registerDevice_post()
    {
        $npk = $this->post("npk");
        $token = $this->post("token") . '.' . $npk ;

        $cekNPK = $this->db->query('select npk from akun where npk = "' . $npk . '" ');
        if ($cekNPK->num_rows() > 0) {
            $cekToken = $this->db->query('select * from master_token where token = "' . $token . '" ');
            $cekNPK = $this->db->query('select * from master_token where npk  = "' . $npk . '" ');
            if ($cekToken->num_rows() > 0) {
                $this->response([
                    'status' => false,
                    'message' => 'Perangkat Sudah Terdaftar'
                ], 404);
            }else if($cekNPK->num_rows() > 0){
                $this->response([
                    'status' => false,
                    'message' => 'NPK Sudah Teregistrasi'
                ], 404);
            } else {
                $data = [
                    'npk'        => $npk,
                    'token'      => $token ,
                    'created_at' => date('Y-m-d H:i:s')    
                ];
                $this->db->insert("master_token", $data);
                $this->response([
                    'message'  => 'device terdaftar',
                    'status'   => 'ok'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'NPK Tidak ditemukan'
            ], 404);
        }
    }
    
    
    public function profiling_get(){
        $npk = $this->get("npk");
        $where = ['npk' => $npk];
        $data = $this->Api_Model->getData("profiling", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }
    
     public function profilingAll_get(){
        $data = $this->db->get("profiling");
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }
    
    
    public function course_get(){
        $where = ['type' => 'course'];
        $data = $this->Api_Model->getData("setting", $where);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => 'ok',
                'result'  => $data->result(),
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data'
            ], 404);
        }
    }
    
    
}
