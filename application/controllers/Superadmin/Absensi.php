<?php


class Absensi extends CI_Controller
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

    public function index(Type $var = null)
    {
        $this->load->view('web/header');
        $this->load->view("Superadmin/absensi");
        $this->load->view('web/fotter');
    }

    //form absensi manual 
    public function absen_manual()
    {
        $this->load->view('web/header');  
        $this->load->view("Superadmin/form_absen_manual");
        $this->load->view('web/fotter');
        
    }

    
    //method yang digunakan untuk request data anggota
    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->Super_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $Data_anggota) {
            $no++;
            $row = array();
            $row[] = $Data_anggota->npk;
            $row[] = $Data_anggota->nama;
            $row[] = $Data_anggota->area_kerja;
            $row[] = $Data_anggota->wilayah;
            $row[] = $Data_anggota->foto;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
			"recordsTotal" => $this->Super_model->count_all(),
			"recordsFiltered" => $this->Super_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        // $this->output->set_output(json_encode($output));
        echo json_encode($output);
    }

    //input absensi manual
    public function input_absensi_manual()
    {
        $in = $this->input->post("in");
        $id = $this->input->post("id_absen");
        $wilayah  = $this->input->post("wilayah");
        $area  = $this->input->post("area");
        $npk  = $this->input->post("npk");
        $data = explode(" ", $in,  2);
        $tgl_masuk = $data[0];
        $jam_masuk = $data[1];
        switch ($wilayah) {
            case 'WIL1':
                $tabel = "absen_wil1";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL2':
                $tabel = "absen_wil2";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL3':
                $tabel = "absen_wil3";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            case 'WIL4':
                $tabel = "absen_wil4";
                $d = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl_masuk]);
                break;
            default:
                $tabel = "not found";
                break;
        }

        if ($d->num_rows() > 0) {
            $this->session->set_flashdata("fail", "Presensi " . $npk .  " sudah ada");
                redirect('Superadmin/Absensi/absen_manual');
        } else {
            $data = [
                'id_absen'  => $id,
                'npk'       => $npk,
                'in_time'  => $jam_masuk,
                'in_date' => $tgl_masuk,
                'area'          => $area,
                'validasi_kehadiran' => 1
            ];
            $input = $this->Super_model->input($tabel, $data);
            if ($input > 0) {
                $this->session->set_flashdata("ok", "Presensi " . $npk .  " di Input");
                redirect('Superadmin/Absensi/absen_manual');
            } else {
                $this->session->set_flashdata("fail", "Presensi " . $npk .  " gagal di Input");
                redirect('Superadmin/Absensi/absen_manual');
            }
        }
    }


    //ambil data anggota untuk di tampilkan di select 
    public function listAnggota()
    {
        $nama = $this->input->get("nama");
        $list = $this->Super_model->getDaftarAnggota($nama);
        echo json_encode($list);
    }

    //ambil data wilayah anggota
    public function listWilayahAnggota()
    {

        $npk = $this->input->post("npk");
        $list = $this->Super_model->getWilayahAnggota($npk);
        echo json_encode($list);
    }

    public function showAbsensi(Type $var = null)
    {
        $tahun = date('Y');
        $bulan = $this->input->post("bulan");
        $npk = $this->input->post("npk");
        $wilayah = $this->input->post("wilayah");
        $area = $this->input->post("area");
        $tabel = "";
        switch ($wilayah) {
            case 'WIL1':
                $tabel = "absen_wil1";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil1");
                break;
            case 'WIL2':
                $tabel = "absen_wil2";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil2");
                break;
            case 'WIL3':
                $tabel = "absen_wil3";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil3");
                break;
            case 'WIL4':
                $tabel = "absen_wil4";
                $d = $this->Super_model->getPresensi($npk, $tahun . "-" . $bulan, "absen_wil4");
                break;
            default:
                $tabel = "not found";
                break;
        }
        $data = [
            'npk' => $npk,
            'tabel' => $tabel,
            'bulan' => $bulan
        ];
        $this->load->view("Superadmin/daftar_absen", $data);
    }

    public function form_edit($id, $tabel)
    {
        // $id = $this->input->get("id");
        // $tabel = $this->input->get("table");
        $data = [
            'data' => $this->db->get_where($tabel, ['id' => $id])->row(),
            'tabel'  => $tabel
        ];
        $this->load->view("Superadmin/form_editabsen", $data);
    }
    
     public function form_edit2()
    {
        $id = $this->input->get("id");
        $tabel = $this->input->get("table");
        $data = $this->db->get_where($tabel, ['id' => $id])->row();
        echo json_encode($data);
    }

    //update data absensi 
    public function update_absensi()
    {
        $in = $this->input->post("in");
        $out = $this->input->post("out");

        $masuk = explode(" ", $in, 2);
        $pulang = explode(" ", $out, 2);
        $in_date = $masuk[0];
        $in_time = $masuk[1];
        $out_date = $pulang[0];
        $out_time = $pulang[1];

        $tabel = $this->input->post("tabel");
        $id = $this->input->post("id");
        $keterangan = $this->input->post("ket");
        $where = ['id' => $id];
        $data = [
            'in_time' => $in_time,
            'in_date'  => $in_date,
            'out_time' => $out_time,
            'out_date'  => $out_date,
            'ket'  => $keterangan
        ];

        $update = $this->Super_model->updateAbsensi($where, $tabel, $data);
        if ($update > 0) {
            $this->session->set_flashdata('ok', 'Presensi di Ubah');
            redirect('Superadmin/Absensi');
        } else {
            $this->session->set_flashdata('fail', 'Presensi gagal di Ubah');
            redirect('Superadmin/Absensi');
        }
    }
    
    
    //download absensi
    public function downloadAbsensiWil1(){
        $filename = 'laporan-absensi-wilayah 1';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("Superadmin/download_absen_wil1");
    }
    
    public function downloadAbsensiWil2(){
        $filename = 'laporan-absensi-wilayah 2';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("Superadmin/download_absen_wil2");
    }
    
    public function downloadAbsensiWil3(){
        $filename = 'laporan-absensi-wilayah 3';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("Superadmin/download_absen_wil3");
    }
    
    public function downloadAbsensiWil4(){
        $filename = 'laporan-absensi-wilayah 4';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("Superadmin/download_absen_wil4");
    }
    
    
    
}
