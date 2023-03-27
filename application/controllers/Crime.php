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
        $this->load->model('Information_model', 'informasi');
    }

    public function index(Type $var = null)
    {
        $this->load->view('crime/dashboard');
    }
    public function upload()
    {
        $this->load->view("crime/upload");
    }

    public function post(Type $var = null)
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
                    'pelapor' => $crm[4],
                    'tersangka' => $crm[5],
                    'korban' => $crm[6],
                    'barang_bukti' => $crm[7],
                    'jenis' => $crm[8],
                    'kerugian' => $crm[9],
                    'modus' => $crm[10],
                    'kronologi' => $crm[11],
                    'kota' => $crm[14],
                    'kelurahan' => $crm[13],
                    'kec' => $crm[12]
                ];
                array_push($params, $data);
            }
            // print_r($params);
            $upload = $this->informasi->mulitple_upload("tb_crime", $params);
            if ($upload) {
                echo "berhasil";
            } else {
                echo "gagal upload";
            }
        } else {
            echo "failed";
        }
    }
}
