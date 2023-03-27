<?php

class Information extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Information_model', 'information');
    }

    public function index()
    {
        $data = [
            'master'    => $this->information->masterTotal()->row(),
            'golongan'  => $this->information->golonganDarah(),
            'umur'  => $this->information->umur(),
            'tempatTinggal'  => $this->information->tempatTinggal("DKI JAKARTA"),
            'tempatTinggal2'  => $this->information->tempatTinggal("JAWA BARAT"),
            'tempatTinggalAll'  => $this->information->tempatTinggalAll(),
            'genderPerempuan'  => $this->information->gender("PEREMPUAN"),
            'genderLaki'  => $this->information->gender("LAKI-LAKI"),
            'agama'  => $this->information->agama()->result(),
            'tempatAsal'  => $this->information->tempatAsal()->result(),
            'statusKta'  => $this->information->statusKta()->row(),
        ];

        // echo '<pre>'; print_r($data['tempatAsal']);die();

        $this->load->view("Information/dashboard", $data);
    }

    public function leflateJson()
    {
        $asal = $this->information->tempatAsal()->result();

        $aslData = array();
        foreach ($asal as $aslKey => $asl) {
            $aslData[] = array(
                'type' => 'Feature',
                'properties' => array(
                    "name" => $asl->total,
                    'popupContent' => '<center><b>' . $asl->total . '</b><br>' . $asl->prov_name . '</center>',
                    // "show_on_map" => true
                    // 'denom' => 'a',
                    // 'info' => $asl->total
                ),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => [$asl->longitude, $asl->latitude]
                )
            );
        }

        $data = $aslData;

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}
