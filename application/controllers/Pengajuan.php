<?php


class Pengajuan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('user_agent');
        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        }
    }


    public function index()
    {
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),

        );
        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/pengajuan', $data);
        $this->load->view('mobile/fotter');
    }


    public function form_input_overtime(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wilayah  =  $wl->wilayah;

        if (isset($_POST['cari_absen'])) {
            $npk            = $this->input->post("id_akun");
            $tanggal        = $this->input->post("search_in_date");

            switch ($wilayah) {
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
                default:
                    break;
            }
            $query          = $this->db->get_where($tabel, ['in_date' => $tanggal, 'id_absen' => $this->session->userdata('id_akun')]);

            $data['histori_absensi']  = $query;
            $data['korlap']    =  $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
            where e.jabatan = 'PIC' and e.wilayah = '" . $wilayah . "' and b.npk = e.npk");
        }

        $data['biodata']   = $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row();
        $data['url']       = $this->uri->segment(2);
        $data['berkas']    = $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row();

        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/form_overtime', $data);
        $this->load->view('mobile/fotter');
    }


    public function input_overtime(Type $var = null)
    {
        $data = $this->db->query("SELECT b.id_biodata ,  b.nama , b.npk ,  e.jabatan , e.wilayah , e.area_kerja from biodata b ,employee  e where  b.id_biodata = e.id_employee  and b.id_biodata = '" . $this->session->userdata("id_akun") . "'  ")->row();
        $wilayah        = $data->wilayah;
        $area           = $data->area_kerja;
        $nama           = $data->nama;
        $tanggal        = $this->input->post("in_date_ot");
        $jam_mulai      = $this->input->post("in_ot");
        $jam_selesai    = $this->input->post("out_ot");
        $alasan_lembur  = $this->input->post("alasan_lembur");
        $params = [
            'id_lembur'         => $data->id_biodata,
            'npk'               => $this->session->userdata("npk"),
            'nama'              => $nama,
            'date_lembur'       => $tanggal,
            'area'              => $area,
            'wilayah'           => $wilayah,
            'over_time_start'   => $jam_mulai,
            'over_time_end'     => $jam_selesai,
            'alasan_lembur'     => $alasan_lembur,
            'status_lembur'     => 0
        ];

        $save = $this->db->insert("pengajuan_lembur", $params);
        if ($save) {
            $this->session->set_flashdata("info_send", 'Overtime berhasil terkirim');
            redirect('Pengajuan/form_input_overtime');
        } else {
            $this->session->set_flashdata("info_send", 'Overtime gagal terkirim');
            redirect('Pengajuan/form_input_overtime');
        }
    }



    // form pengajuan skta 
    public function form_input_skta(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wilayah  =  $wl->wilayah;

        if (isset($_POST['cari_absen'])) {
            $npk            = $this->input->post("id_akun");
            $tanggal        = $this->input->post("search_in_date");

            switch ($wilayah) {
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
                default:
                    break;
            }
            $query          = $this->db->get_where($tabel, ['in_date' => $tanggal, 'id_absen' => $this->session->userdata('id_akun')]);

            $data['histori_absensi']  = $query;
            $data['korlap']    =  $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
            where e.jabatan = 'PIC' and e.wilayah = '" . $wilayah . "' and b.npk = e.npk");
        }

        $data['biodata']   = $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row();
        $data['url']       = $this->uri->segment(2);
        $data['wilayah']   = $wilayah;
        $data['area']      = $wl->area_kerja;
        $data['berkas']    = $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row();

        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/form_skta', $data);
        $this->load->view('mobile/fotter');
    }


    public function input_skta(Type $var = null)
    {
        $dateIN = $this->input->post("date_in");
        $dateOUT = $this->input->post("date_out");
        $in  = $this->input->post("time_in");
        $out = $this->input->post("time_out");
        $area = $this->input->post("area");
        $ket = $this->input->post("keterangan");
        $tabel = "pengajuan_skta";
        $wil = $this->input->post("wilayah");

        $params = [
            'npk'           => $this->session->userdata('npk'),
            'area'          =>  $area,
            'wil'           => $wil,
            'date_in'       => $dateIN,
            'in_time'       => $in,
            'out_time'      => $out,
            'date_out'      => $dateOUT,
            'keterangan '   => $ket
        ];

        $insert = $this->db->insert($tabel, $params);
        if ($insert) {
            $this->session->set_flashdata("info_send", 'Pengajuan SKTA berhasil terkirim');
            redirect('Pengajuan/form_input_skta');
        } else {
            $this->session->set_flashdata("info_send", 'Pengajuan SKTA gagal terkirim');
            redirect('Pengajuan/form_input_skta');
        }
    }



    // form pengajuan sakit
    public function form_input_sakit(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wilayah  =  $wl->wilayah;
        $data['biodata']   = $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row();
        $data['url']       = $this->uri->segment(2);
        $data['wilayah']   = $wilayah;
        $data['area']      = $wl->area_kerja;
        $data['berkas']    = $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row();
        $data['korlap']    =  $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
        where e.jabatan = 'PIC' and e.wilayah = '" . $wilayah . "' and b.npk = e.npk");
        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/form_input_sakit', $data);
        $this->load->view('mobile/fotter');
    }

    //input surat sakit 
    public function input_sakit(Type $var = null)
    {
        $tanggal         = $this->input->post("tanggal_ijin");
        $id              = $this->input->post('id_ijin');
        $npk             = $this->input->post('npk');
        $nama            = $this->input->post('nama');
        $wilayah         = $this->input->post('wilayah');
        $area            = $this->input->post('area');
        $ket             = $this->input->post('ket');

        $this->load->library('upload');
        $file = $_FILES['berkas']['name'];
        $exe = pathinfo($file, PATHINFO_EXTENSION);
        $config['upload_path']      = './assets/surat_sakit/';
        $config['allowed_types']    = 'jpg|png|jpeg|pdf';
        $config['file_name']        = "Surat_Sakit_" . $tanggal . "_" . $npk .  date('is') . "." . $exe;
        $config['overwrite']        = true;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("berkas")) {
            $this->response([
                'status'    => 'failed',
                'message'   => $this->upload->display_errors()
            ], 500);
        } else {
            $data = [
                'id_perijinan'              => $id,
                'dokumen_perijinan'         => $this->upload->data("file_name"),
                'npk'                       => $npk,
                'nama'                      => $nama,
                'date_perijinan'            => $tanggal,
                'area'                      => $area,
                'wilayah'                   => $wilayah,
                'keterangan'                => $ket,
                'status'                    => 0,
                'jenis_perijinan'           => 'SAKIT',
                'link_dokumen'              => base_url('assets/surat_sakit/' . $this->upload->data("file_name"))
            ];

            $save =  $this->db->insert("pengajuan_perijinan", $data);
            if ($save) {
                $this->session->set_flashdata("info_send", 'Data ijin sakit berhasil terkirim');
                redirect('Pengajuan/form_input_sakit');
            } else {
                $this->session->set_flashdata("info_send", 'Data ijin sakit gagal terkirim');
                redirect('Pengajuan/form_input_sakit');
            }
        }
    }



    // form pengajuan cuti
    public function form_input_cuti(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wilayah  =  $wl->wilayah;
        $data['biodata']   = $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row();
        $data['url']       = $this->uri->segment(2);
        $data['wilayah']   = $wilayah;
        $data['area']      = $wl->area_kerja;
        $data['berkas']    = $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row();
        $data['korlap']    =  $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
        where e.jabatan = 'PIC' and e.wilayah = '" . $wilayah . "' and b.npk = e.npk");
        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/form_input_cuti', $data);
        $this->load->view('mobile/fotter');
    }


    public function input_cuti(Type $var = null)
    {
        $wil                = $this->input->post("wilayah");
        $npk                = $this->input->post("npk");
        $nama               = $this->input->post("nama");
        $area               = $this->input->post("area");
        $tanggalCuti        = $this->input->post("tanggal_cuti");
        $alasan             = $this->input->post("alasan_cuti");
        $tabel              = "pengajuan_cuti";


        $params = [
            'npk'               => $npk,
            'nama'              => $nama,
            'area'              => $area,
            'wilayah'           => $wil,
            'alasan_cuti'       => $alasan,
            'tanggal_cuti'      => $tanggalCuti,
            'status'            => 0,
        ];
        $insert = $this->db->insert($tabel, $params);
        if ($insert) {
            $this->session->set_flashdata("info_send", 'Cuti berhasil terkirim');
            redirect('Pengajuan/form_input_cuti');
        } else {
            $this->session->set_flashdata("info_send", 'Cuti gagal terkirim');
            redirect('Pengajuan/form_input_cuti');
        }
    }


    public function status()
    {

        $npk = $this->session->userdata('npk');
        $idakun = $this->session->userdata('id_akun');
        $bln = date('Y-m');
        $data['biodata']   = $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row();
        $data['url']       = $this->uri->segment(2);
        $data['berkas']    = $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row();

        $data['overtime']   = $this->db->query('select * from pengajuan_lembur where npk="' . $npk . '" and date_lembur like "%' . $bln . '%"   ORDER BY id DESC  ');
        $data['sakit']   = $this->db->query('select * from pengajuan_perijinan where npk="' . $npk . '" and date_perijinan like "%' . $bln . '%" ORDER BY id DESC  ');
        $data['cuti']   = $this->db->query('select * from pengajuan_cuti where npk="' . $npk . '" and tanggal_cuti like "%' . $bln . '%" ORDER BY id DESC  ');
        $data['skta']   = $this->db->query('select * from pengajuan_skta where npk="' . $npk . '" and date_in like "%' . $bln . '%" 
        ORDER BY id DESC  ');


        $this->load->view('mobile/header', $data);
        $this->load->view('Pengajuan/status', $data);
        $this->load->view('mobile/fotter');
    }
}
