<?php


class Profiling extends CI_Controller
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
        if ($role_id != 7) {
            redirect('LogOut');
        }
    }

    public function index()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;

        //
        $npk = $this->session->userdata('npk');
        if ($npk == 22325) {
            $wil_ = "WIL2";
        } else if ($npk == 46785) {
            $wil_ = "WIL4";
        }

        $data = [
            'link'  => $this->uri->segment(2),
            'data'  => $this->db->query("select wilayah , area_kerja , npk from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),
            'anggota'   => $this->db->query("select * from profiling where wilayah='" . $wil . "' or wilayah ='" . $wil_ . "' order by nama ")
        ];
        $this->load->view("web/spv/header", $data);
        $this->load->view("SPV/profiling/profiling", $data);
        $this->load->view("web/spv/fotter");
    }


    public function modalBiodata()
    {
        $npk = $this->input->post("npk");
        $data = [
            'data' => $this->db->get_where("profiling", ['npk' => $npk])->row()
        ];
        $this->load->view("SPV/profiling/detail_modal_biodata", $data);
    }


    public function modalAbsensi(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        // $wil  =  $wl->wilayah;

        $wil = $this->input->post("wilayah");
        switch ($wil) {
            case 'WIL1':
                $tabel = "absen_wil1";
                break;
            case 'WIL2':
                $tabel = "absen_wil2";
                break;
            case 'WIL3':
                $tabel = "absen_wil3";
                break;
            case 'WIL4':
                $tabel = "absen_wil4";
                break;
                $tabel  = null;
                break;
        }
        $npk = $this->input->post("npk");
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        $data = [
            'npk'   => $npk,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tabel' => $tabel
        ];
        $this->load->view("SPV/profiling/load_absensi", $data);
    }
}
