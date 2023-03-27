<?php
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Crime extends CI_Controller
{
    public function __construct(Type $var = null)
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        // $this->load->model('Information_model', 'informasi');
        $this->load->model('Crime_Model', 'informasi');
    }

    public function index(Type $var = null)
    {
        $bulan = date('m');

        $data = [
            'link'          => $this->uri->segment(2),

            // jakarta utara
            'kekerasan'     => $this->informasi->crimePerJenisKasusSetahun("KEKERASAN", "Jakarta Utara"),
            'narkoba'       => $this->informasi->crimePerJenisKasusSetahun("narkoba", "Jakarta Utara"),
            'perjudian'     => $this->informasi->crimePerJenisKasusSetahun("perjudian", "Jakarta Utara"),
            'pencurian'     => $this->informasi->crimePerJenisKasusSetahun("pencurian", "Jakarta Utara"),
            'penggelapan'   => $this->informasi->crimePerJenisKasusSetahun("penggelapan", "Jakarta Utara"),


            // karawang
            'kekerasan_'     => $this->informasi->crimePerJenisKasusSetahun("KEKERASAN", "KARAWANG"),
            'narkoba_'       => $this->informasi->crimePerJenisKasusSetahun("narkoba", "KARAWANG"),
            'perjudian_'     => $this->informasi->crimePerJenisKasusSetahun("perjudian", "KARAWANG"),
            'pencurian_'     => $this->informasi->crimePerJenisKasusSetahun("pencurian", "KARAWANG"),
            'penggelapan_'   => $this->informasi->crimePerJenisKasusSetahun("PENGGELAPAN", "KARAWANG"),


            // kecamatan Jakarta utara
            'penjaringan'      => $this->informasi->crimePerKecamatanSetahun("Penjaringan", "Jakarta Utara"),
            'koja'             => $this->informasi->crimePerKecamatanSetahun("koja", "Jakarta Utara"),
            'cilincing'        => $this->informasi->crimePerKecamatanSetahun("cilincing", "Jakarta Utara"),
            'pademangan'       => $this->informasi->crimePerKecamatanSetahun("pademangan", "Jakarta Utara"),
            'kelapa_gading'    => $this->informasi->crimePerKecamatanSetahun("kelapa gading", "Jakarta Utara"),
            'tanjung_priok'    => $this->informasi->crimePerKecamatanSetahun("tanjung priok", "Jakarta Utara"),
            'countPerArea'     =>  $this->informasi->countCrimeAreaSetahun("Jakarta Utara", "Jakarta Utara"),

            // kecamatan Karawang
            'teluk_jambe_timur'      => $this->informasi->crimePerKecamatanSetahun("TELUK JAMBE TIMUR", "Karawang"),
            'teluk_jambe_barat'      => $this->informasi->crimePerKecamatanSetahun("TELUK JAMBE Barat", "Karawang"),
            'ciampel'      => $this->informasi->crimePerKecamatanSetahun("ciampel", "Karawang"),
            'klari'      => $this->informasi->crimePerKecamatanSetahun("klari", "Karawang"),
            'karawang_barat'      => $this->informasi->crimePerKecamatanSetahun("karawang barat", "Karawang"),
            'karawang_timur'      => $this->informasi->crimePerKecamatanSetahun("karawang timur", "Karawang"),
            'karawang_barat'      => $this->informasi->crimePerKecamatanSetahun("karawang barat", "Karawang"),
            'majalaya'      => $this->informasi->crimePerKecamatanSetahun("majalaya", "Karawang"),
            'countPerAreaKarawang'     =>  $this->informasi->countCrimeAreaSetahun("Karawang", "Karawang"),
            // kriteria jakarta utara per bulan
            'penjaringan_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("penjaringan", "perjudian", $bulan, "jakarta utara"),
            'penjaringan_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("penjaringan", "pencurian", $bulan, "jakarta utara"),
            'penjaringan_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("penjaringan", "narkoba", $bulan, "jakarta utara"),
            'penjaringan_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("penjaringan", "penggelapan", $bulan, "jakarta utara"),
            'penjaringan_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("penjaringan", "kekerasan", $bulan, "jakarta utara"),
            // 
            'koja_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("koja", "perjudian", $bulan, "jakarta utara"),
            'koja_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("koja", "pencurian", $bulan, "jakarta utara"),
            'koja_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("koja", "narkoba", $bulan, "jakarta utara"),
            'koja_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("koja", "penggelapan", $bulan, "jakarta utara"),
            'koja_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("koja", "kekerasan", $bulan, "jakarta utara"),
            // 
            'tanjung_priok_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("tanjung priok", "perjudian", $bulan, "jakarta utara"),
            'tanjung_priok_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("tanjung priok", "pencurian", $bulan, "jakarta utara"),
            'tanjung_priok_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("tanjung priok", "narkoba", $bulan, "jakarta utara"),
            'tanjung_priok_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("tanjung priok", "penggelapan", $bulan, "jakarta utara"),
            'tanjung_priok_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("tanjung priok", "kekerasan", $bulan, "jakarta utara"),
            // 
            'pademangan_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "perjudian", $bulan, "jakarta utara"),
            'pademangan_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "pencurian", $bulan, "jakarta utara"),
            'pademangan_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "narkoba", $bulan, "jakarta utara"),
            'pademangan_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "penggelapan", $bulan, "jakarta utara"),
            'pademangan_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "kekerasan", $bulan, "jakarta utara"),
            // 
            'kelapa_gading_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("kelapa gading", "perjudian", $bulan, "jakarta utara"),
            'kelapa_gading_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("kelapa gading", "pencurian", $bulan, "jakarta utara"),
            'kelapa_gading_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("kelapa gading", "narkoba", $bulan, "jakarta utara"),
            'kelapa_gading_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("kelapa gading", "penggelapan", $bulan, "jakarta utara"),
            'kelapa_gading_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("kelapa gading", "kekerasan", $bulan, "jakarta utara"),
            // 
            'cilincing_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("cilincing", "perjudian", $bulan, "jakarta utara"),
            'cilincing_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("cilincing", "pencurian", $bulan, "jakarta utara"),
            'cilincing_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("cilincing", "narkoba", $bulan, "jakarta utara"),
            'cilincing_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("cilincing", "penggelapan", $bulan, "jakarta utara"),
            'cilincing_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("cilincing", "kekerasan", $bulan, "jakarta utara"),

            // 

            // kriteria karawang per kecamatan
            'teluk_jambe_barat_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_barat", "perjudian", $bulan, "karawang"),
            'teluk_jambe_barat_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_barat", "pencurian", $bulan, "karawang"),
            'teluk_jambe_barat_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_barat", "narkoba", $bulan, "karawang"),
            'teluk_jambe_barat_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_barat", "penggelapan", $bulan, "karawang"),
            'teluk_jambe_barat_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_barat", "kekerasan", $bulan, "karawang"),
            // 
            'teluk_jambe_timur_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_timur", "perjudian", $bulan, "karawang"),
            'teluk_jambe_timur_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_timur", "pencurian", $bulan, "karawang"),
            'teluk_jambe_timur_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_timur", "narkoba", $bulan, "karawang"),
            'teluk_jambe_timur_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_timur", "penggelapan", $bulan, "karawang"),
            'teluk_jambe_timur_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("teluk_jambe_timur", "kekerasan", $bulan, "karawang"),
            // 
            'klari_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("klari", "perjudian", $bulan, "karawang"),
            'klari_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("klari", "pencurian", $bulan, "karawang"),
            'klari_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("klari", "narkoba", $bulan, "karawang"),
            'klari_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("klari", "penggelapan", $bulan, "karawang"),
            'klari_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("klari", "kekerasan", $bulan, "karawang"),
            // 
            'ciampel_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "perjudian", $bulan, "karawang"),
            'ciampel_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "pencurian", $bulan, "karawang"),
            'ciampel_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "narkoba", $bulan, "karawang"),
            'ciampel_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "penggelapan", $bulan, "karawang"),
            'ciampel_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "kekerasan", $bulan, "karawang"),
            // 
            'majalaya_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "perjudian", $bulan, "karawang"),
            'majalaya_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "pencurian", $bulan, "karawang"),
            'majalaya_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "narkoba", $bulan, "karawang"),
            'majalaya_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "penggelapan", $bulan, "karawang"),
            'majalaya_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "kekerasan", $bulan, "karawang"),
            // 
            'karawang_barat_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "perjudian", $bulan, "karawang"),
            'karawang_barat_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "pencurian", $bulan, "karawang"),
            'karawang_barat_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "narkoba", $bulan, "karawang"),
            'karawang_barat_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "penggelapan", $bulan, "karawang"),
            'karawang_barat_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "kekerasan", $bulan, "karawang"),
            // 
            'karawang_timur_perjudian' => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "perjudian", $bulan, "karawang"),
            'karawang_timur_pencurian' => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "pencurian", $bulan, "karawang"),
            'karawang_timur_narkoba' => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "narkoba", $bulan, "karawang"),
            'karawang_timur_penggelapan' => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "penggelapan", $bulan, "karawang"),
            'karawang_timur_kekerasan' => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "kekerasan", $bulan, "karawang"),


        ];
        $this->load->view('web/superadmin/header', $data);
        $this->load->view('SA/crime/dashboard');
        $this->load->view('web/superadmin/fotter');
    }

    public function testModel()
    {
        echo $this->informasi->totalCrimePerKecamatan("ciampel", "02");
    }
    public function upload()
    {
        $data = [
            'link'  => $this->uri->segment(2),
        ];
        $this->load->view('web/superadmin/header', $data);
        $this->load->view("SA/crime/upload");
        $this->load->view('web/superadmin/fotter');
    }

    public function post()
    {
        $filename = 'data_crime_' . date('m');
        $upload = $this->informasi->upload_crime($filename);
        if ($upload['result'] == "success") {
            $path_xlsx        = "./assets/crime/" . $filename . ".xlsx";
            $reader           = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet      = $reader->load($path_xlsx);
            $crime       = $spreadsheet->getSheet(0)->toArray();
            unset($crime[0]);
            echo "<pre>";
            // var_dump($crime);
            $params = array();
            foreach ($crime as $crm) {
                $data = [
                    'tanggal'  => $crm[1],
                    'area_ktp' => $crm[2],
                    'jenis_kasus' => $crm[3],
                    'kategori' => $crm[4],
                    'pelapor' => $crm[5],
                    'tersangka' => $crm[6],
                    'korban' => $crm[7],
                    'barang_bukti' => $crm[8],
                    'jenis' => $crm[9],
                    'kerugian' => $crm[10],
                    'modus' => $crm[10],
                    'kronologi' => $crm[12],
                    'kota' => $crm[15],
                    'kelurahan' => $crm[13],
                    'kec' => $crm[14],
                ];
                array_push($params, $data);
            }
            // print_r($params);
            $upload = $this->informasi->mulitple_upload("tb_crime", $params);
            if ($upload) {
                $this->session->set_flashdata('info', 'Berhasil upload data');
                redirect('SA/Crime/upload');
            } else {
                $this->session->set_flashdata('fail', 'Gagal upload data');
                redirect('SA/Crime/upload');
            }
        } else {
            echo "failed";
        }
    }


    public function load_jakut()
    {
        $bulan = $this->input->post("bulan");
        $jakarta = array(
            array('Pademangan', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("pademangan", "kekerasan", $bulan, "Jakarta Utara"),
            )),
            array('Koja', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("koja", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("koja", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("koja", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("koja", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("koja", "kekerasan", $bulan, "Jakarta Utara"),
            )),
            array('Tanjung Priok', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("Tanjung Priok", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("Tanjung Priok", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("Tanjung Priok", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("Tanjung Priok", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("Tanjung Priok", "kekerasan", $bulan, "Jakarta Utara"),
            )),
            array('Penjaringan', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("Penjaringan", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("Penjaringan", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("Penjaringan", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("Penjaringan", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("Penjaringan", "kekerasan", $bulan, "Jakarta Utara"),
            )),
            array('Cilincing', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("Cilincing", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("Cilincing", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("Cilincing", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("Cilincing", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("Cilincing", "kekerasan", $bulan, "Jakarta Utara"),
            )),
            array('Kelapa Gading', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("Kelapa Gading", "perjudian", $bulan, "Jakarta Utara"),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("Kelapa Gading", "pencurian", $bulan, "Jakarta Utara"),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("Kelapa Gading", "penggelapan", $bulan, "Jakarta Utara"),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("Kelapa Gading", "narkoba", $bulan, "Jakarta Utara"),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("Kelapa Gading", "kekerasan", $bulan, "Jakarta Utara"),
            ))
        );
        echo json_encode($jakarta);
    }


    public function load_karawang()
    {
        $bulan = $this->input->post("bulan");
        $jakarta = array(
            array('Teluk Jambe Barat', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe barat", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe barat", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe barat", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe barat", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe barat", "kekerasan", $bulan, 'karawang'),
            )),
            array('Teluk Jambe Timur', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe timur", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe timur", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe timur", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe timur", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("teluk jambe timur", "kekerasan", $bulan, 'karawang'),
            )),
            array('Klari', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("klari", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("klari", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("klari", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("klari", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("klari", "kekerasan", $bulan, 'karawang'),
            )),
            array('Ciampel', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("ciampel", "kekerasan", $bulan, 'karawang'),
            )),
            array('Majalaya', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("majalaya", "kekerasan", $bulan, 'karawang'),
            )),
            array('Karawang Barat', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("karawang barat", "kekerasan", $bulan, 'karawang'),
            )),
            array('Karawang Timur', array(
                'perjudian'     => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "perjudian", $bulan, 'karawang'),
                'pencurian'     => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "pencurian", $bulan, 'karawang'),
                'penggelapan'   => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "penggelapan", $bulan, 'karawang'),
                'narkoba'       => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "narkoba", $bulan, 'karawang'),
                'kekerasan'     => $this->informasi->modelCrimeKategoriPerbulan("karawang timur", "kekerasan", $bulan, 'karawang'),
            ))
        );
        echo json_encode($jakarta);
    }


    public function mapJakut()
    {
        $aslData = array();
        $bulan = $this->input->get("bulan");
        $titik_jakut = array(
            ['name' => 'Pademangan', 'lat' => '106.8148804', 'long' => '-6.1291514', 'total' => $this->informasi->totalCrimePerKecamatan("pademangan", $bulan)],
            ['name' => 'Cilincing', 'lat' => '106.9147307', 'long' => '-6.1274945', 'total' => $this->informasi->totalCrimePerKecamatan("cilincing", $bulan)],
            ['name' => 'Penjaringan', 'lat' => '106.7796358', 'long' => '-6.1145129', 'total' => $this->informasi->totalCrimePerKecamatan("penjaringan", $bulan)],
            ['name' => 'Tanjong Priok', 'lat' => '106.8556447', 'long' => '-6.1275785', 'total' => $this->informasi->totalCrimePerKecamatan("tanjung priok", $bulan)],
            ['name' => 'Koja', 'lat' => '106.8887248', 'long' => '-6.1204506', 'total' => $this->informasi->totalCrimePerKecamatan("koja", $bulan)],
            ['name' => 'Kelapa Gading', 'lat' => ' 106.8830528', 'long' => '-6.1596475', 'total' => $this->informasi->totalCrimePerKecamatan("kelapa gading", $bulan)],
        );
        for ($i = 0; $i < count($titik_jakut); $i++) {
            $aslData[] = array(
                'type' => 'Feature',
                'properties' => array(
                    "name" => $titik_jakut[$i]['name'],
                    'popupContent' => '<center>' . $titik_jakut[$i]['name']  . ' <b>( ' . $titik_jakut[$i]['total'] . ' )</b></center>',
                    'res'   => $titik_jakut[$i]['total']
                ),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => [$titik_jakut[$i]['lat'], $titik_jakut[$i]['long']]
                )
            );
        }
        $data = $aslData;
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function mapKarawang()
    {
        $aslData = array();
        $bulan = $this->input->get("bulan");
        $titik_jakut = array(
            ['name' => 'Teluk Jambe Barat', 'lat' => '107.1710478', 'long' => '-6.3503106', 'total' => $this->informasi->totalCrimePerKecamatan("teluk jambe barat", $bulan)],
            ['name' => 'Teluk Jambe Timur', 'lat' => '107.2236389', 'long' => '-6.3426387', 'total' => $this->informasi->totalCrimePerKecamatan("Teluk Jambe Timur", $bulan)],
            ['name' => 'Klari', 'lat' => '107.3090157', 'long' => '-6.3957332', 'total' => $this->informasi->totalCrimePerKecamatan("Klari", $bulan)],
            ['name' => 'Ciampel', 'lat' => '107.2627573', 'long' => '-6.4281762', 'total' => $this->informasi->totalCrimePerKecamatan("Ciampel", $bulan)],
            ['name' => 'Majalaya', 'lat' => '107.3383852', 'long' => '-6.3005035', 'total' => $this->informasi->totalCrimePerKecamatan("majalaya", $bulan)],
            ['name' => 'Karawang Barat', 'lat' => '107.2455271', 'long' => '-6.3010751', 'total' => $this->informasi->totalCrimePerKecamatan("karawang barat", $bulan)],
            ['name' => 'Karawang Timur', 'lat' => '107.2954107', 'long' => '-6.2995816', 'total' => $this->informasi->totalCrimePerKecamatan("karawang timur", $bulan)],
        );
        for ($i = 0; $i < count($titik_jakut); $i++) {
            $aslData[] = array(
                'type' => 'Feature',
                'properties' => array(
                    "name" => $titik_jakut[$i]['name'],
                    'popupContent' => '<center>' . $titik_jakut[$i]['name']  . ' <b>( ' . $titik_jakut[$i]['total'] . ' )</b></center>',
                    'res'   => $titik_jakut[$i]['total']
                ),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => [$titik_jakut[$i]['lat'], $titik_jakut[$i]['long']]
                )
            );
        }
        $data = $aslData;
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}
