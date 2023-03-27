<?php

class Dashboard extends CI_Controller
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
    public function bulan($bln)
    {
        switch ($bln) {
            case '01':
                $bulan = 'JANUARI';
                break;
            case '02':
                $bulan = 'FEBRUARI';
                break;
            case '03':
                $bulan = 'MARET';
                break;
            case '04':
                $bulan = 'APRIL';
                break;
            case '05':
                $bulan = 'MEI';
                break;
            case '06':
                $bulan = 'JUNI';
                break;
            case '07':
                $bulan = 'JULI';
                break;
            case '08':
                $bulan = 'AGUSTUS';
                break;
            case '09':
                $bulan = 'SEPTEMBER';
                break;
            case '10':
                $bulan = 'OKTOBER';
                break;
            case '11':
                $bulan = 'NOVEMBER';
                break;
            case '12':
                $bulan = 'DESEMBER';
                break;
            default:
                '';
                break;
        }

        return $bulan;
    }


    public function index(Type $var = null)
    {
        $bulan = date('Y-m');
        $data  = [
            'link'      => $this->uri->segment(1),
            'biodata'   => $this->db->query("select b.nama ,e.wilayah , e.area_kerja , b.npk  from employee e , biodata b  where b.id_biodata = e.id_employee and e.id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),

            'data_mangkir' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  absen_wil1 ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
            AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
            GROUP BY ab.npk  ORDER BY total DESC"),

            'data_mangkir2' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  absen_wil2 ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
            AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
            GROUP BY ab.npk  ORDER BY total DESC"),

            'data_mangkir3' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  absen_wil3 ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
            AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
            GROUP BY ab.npk  ORDER BY total DESC"),

            'data_mangkir4' => $this->db->query("SELECT b.npk , b.nama , COUNT(ab.npk)  AS total , e.jabatan  ,e.area_kerja FROM  absen_wil4 ab , biodata b , employee e  WHERE ab.ket = 'MANGKIR'
            AND ab.npk = e.npk AND e.npk = b.npk AND ab.`in_date` LIKE '%" . $bulan . "%' 
            GROUP BY ab.npk  ORDER BY total DESC"),


            'bulan'     => strtolower($this->bulan(date('m')))

        ];
        $this->load->view('web/superadmin/header', $data);
        $this->load->view('SA/dashboard', $data);
        $this->load->view('web/superadmin/fotter');
    }
}
