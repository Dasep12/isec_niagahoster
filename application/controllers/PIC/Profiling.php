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
        if ($role_id != 6) {
            redirect('LogOut');
        }
    }

    public function index(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $sql = 'SELECT b.nama,b.npk , b.`tanggal_lahir`  , e.`area_kerja` , e.`wilayah` , b.`gol_darah` , b.`ktp` , b.kk , b.`email` , b.`no_hp` ,
        b.`no_emergency` , b.`tinggi_badan` , b.`berat_badan` , b.`imt` , b.`keterangan` , b.`jl_ktp` , b.`rt_ktp` , b.`rw_ktp`,
        b.`kel_ktp` , b.`kec_ktp` , b.`kota_ktp` , b.`provinsi_ktp` , 
        b.`rt_dom` , b.`rw_dom`   , b.`jl_dom` , b.`kel_dom` , b.`kec_dom` , b.`kota_dom` , b.`provinsi_dom` ,
        e.`no_kta` , e.`expired_kta` , e.`jabatan` , e.`status_kta`  , br.`foto` 
        FROM `biodata` b ,`employee` e , `berkas` br
        WHERE b.`id_biodata` = e.`id_employee`  AND e.`id_employee` = br.`id_berkas`  AND
        (e.`jabatan` != "MANAGER" OR e.`jabatan` != "SUPERVISOR" OR e.`jabatan` != "PIC" OR e.jabatan != "ARH") AND b.`nama` != "SUPERADMIN" 
        AND e.wilayah = "' . $wil . '" AND b.status = 1 and e.status = 1
        ORDER BY b.`nama` ASC';
        $data = [
            'link'  => $this->uri->segment(2),
            'data'  => $this->db->query("select wilayah , area_kerja , npk from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),
            'anggota'   => $this->db->query($sql)
        ];
        $this->load->view("web/pic/header", $data);
        $this->load->view("PIC/profiling/profiling", $data);
        $this->load->view("web/pic/fotter");
    }


    public function modalBiodata()
    {
        $npk = $this->input->post("npk");
        $data = [
            'data' => $this->db->get_where("profiling", ['npk' => $npk])->row()
        ];
        $this->load->view("PIC/profiling/detail_modal_biodata", $data);
    }


    public function modalAbsensi(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;

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
        $this->load->view("PIC/profiling/load_absensi", $data);
    }
}
