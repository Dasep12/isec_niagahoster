<?php


class Historis extends CI_Controller
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
        if ($role_id != 9) {
            redirect('LogOut');
        }
    }
    public function index(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $wil_ = "";
        $npk = $this->session->userdata('npk');
        if ($npk == 22325) {
            $wil_ = "WIL2";
        } else if ($npk == 46785) {
            $wil_ = "WIL4";
        }

        $data = [
            'link'  => $this->uri->segment(2),
            'data'  => $this->db->query("select wilayah , area_kerja , npk from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),

            'overtime'      =>  $data = $this->db->query("SELECT b.nama ,b.npk , e.wilayah , e.area_kerja , pl.over_time_start , pl.over_time_end , pl.status_lembur , date_lembur FROM `pengajuan_lembur` pl , biodata b , employee e WHERE 
            DATE_FORMAT(pl.date_lembur,'%Y-%m')= '" . date('Y-m') . "'  AND 
             status_lembur != 0  AND b.npk = pl.npk AND pl.npk = e.npk AND pl.wilayah = e.wilayah
            ORDER BY pl.date_lembur  "),

            'cuti'      => $this->db->query("SELECT c.id , c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti , c.status  , e.area_kerja
            FROM pengajuan_cuti c , biodata b  , employee e  
            WHERE DATE_FORMAT(c.tanggal_cuti,'%Y-%m')= '" . date('Y-m') . "' 
             AND c.status != 0  AND b.npk = c.npk AND b.id_biodata = e.id_employee"),

            'skta'      =>  $this->db->query("SELECT p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area  , p.status
            FROM pengajuan_skta p , biodata b  , employee e 
            WHERE 
            DATE_FORMAT(p.date_in,'%Y-%m')= '" . date('Y-m') . "' AND
            e.npk = p.npk
            AND p.STATUS !='0' AND e.id_employee = b.id_biodata  "),


            'sakit'     => $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan ,
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen 
            FROM pengajuan_perijinan pp , biodata b , employee e  
            WHERE 
            DATE_FORMAT(pp.date_perijinan,'%Y-%m')= '" . date('Y-m') . "'  AND 
            pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status != 0  ")
        ];
        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/approval/log_approval", $data);
        $this->load->view("web/superadmin/fotter");
    }
}
