<?php

date_default_timezone_set('Asia/Jakarta');

class Login_ extends CI_Controller
{
    
    public function index(){
        $id_akun = $this->input->get("id");
        $password = $this->input->get("pwd");
        
        $where = ['id_akun' => $id_akun , 'password' => $password];
        $data = $this->db->get_where("akun",$where);
        // echo $data->num_rows();
        if($data->num_rows () > 0 ){
            $akun = $data->row();
            $data2 = $this->db->query("select nama from biodata where id_biodata = '" . $id_akun . "' ")->row();
            $this->session->set_userdata('id_akun',$akun->id_akun);
            $this->session->set_userdata('role_id',$akun->role_id);
            $this->session->set_userdata('npk',$akun->npk);
            $this->session->set_userdata('nama', $data2->nama);
            $this->session->set_userdata('status_patrol',$akun->status_patrol);
         
            redirect('Ipatrol/Patrolv2');
        }
        // echo $this->session->userdata("nama");
    }
}