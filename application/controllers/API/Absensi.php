    <?php


require_once(APPPATH . './libraries/RestController.php');

use chriskacerguis\RestServer\RestController;

date_default_timezone_set('Asia/Jakarta');
class Absensi extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Api_Model');
    }
    
    public function loginPic_get()
    {
        $id = $this->get("id");
        $npk = $this->get("npk");
        $pwd = $this->get("password");
        $data = $this->db->get_where("akun",['npk' => $npk , 'password' => md5($pwd)]);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => true,
                'result'  => $data->row()
            ], 200);
        } else {
            $this->response([
                'status'  => false,
                'message' => 'data not found '
            ], 200);
        }
    }
    

    public function cekDataDiri_get()
    {
        $id = $this->get("id");
        $data = $this->Api_Model->getDataDiriAbsensi($id);
        if ($data->num_rows() > 0) {
            $this->response([
                'status'  => true,
                'result'  => $data->row()
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data not found '
            ], 200);
        }
    }


    public function cekBarcodeKorlap_get()
    {

        $wil = $this->get("wilayah");
        $lat = $this->get("latitude");
        $d = $this->db->get_where("barcode_absensi", ['wilayah' => $wil, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            $this->response([
                'status'  => true,
                'message' => 1
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 0
            ], 200);
        }
    }



    public function cekBarcodeAnggota_get()
    {
        $area = $this->get("area_kerja");
        $lat = $this->get("latitude");
        $d = $this->db->get_where("barcode_absensi", ['area_kerja' => $area, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            $this->response([
                'status'  => true,
                'message' => 1
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 0
            ], 200);
        }
    }

    //input data absensi ke dalam databasen
    public function inputAbsensi_post(Type $var = null)
    {
        $npk = $this->post("npk");
        $wil = $this->post("wilayah");
        $area = $this->post("area_kerja");
        $id_absen = $this->post("id_absen");
        $now = date('Y-m-d'); //ambil tanggal sekarang

        //tanggal kemarin
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        //cek wilayah untuk  penentuan dimana anggota harus di simpan data absennya
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
            default:
                break;
        }

        $presensiKemarin = $this->Anggota_model->absenKemarin($npk, $tgl_kemarin, $wil);
        $presensiSekarang = $this->Anggota_model->absenKemarin($npk, $now, $wil);

        if ($presensiSekarang->num_rows() > 0) {
            $absen = $presensiSekarang->row();
            if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {
                $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));
                if ($jam <= 1) {
                    $this->response([
                        "status"     => "fail",
                        "info"       => "Absen Pulang",
                        "time"       =>  date('Y-m-d H:i:s'),
                        "message"    => "Silahkan Absen di Jam Berikutnya"
                    ], 200);
                    // echo "anda bisa absen lagi 5 jam dari sekarang";
                } else {
                    //absen pulang
                    $data = [
                        'out_time'           => date('H:i:s'),
                        'out_date'           => date('Y-m-d'),
                        'validasi_kehadiran' => 2,
                        'ket'                => "HADIR"
                    ];
                    $this->db->where('id', $absen->id);
                    $this->db->update($tabel, $data);
                    $this->response([
                        "status"       => "success",
                        "message"       => "Absen Pulang Berhasil",
                        "time"          =>  date('Y-m-d H:i:s'),
                        "info"          => "Absen Pulang",
                    ], 200);
                    // echo "anda absen pulang bos";
                }
            } else if ($absen->validasi_kehadiran == 2) {
                $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));

                //jika kurang dari 6jam maka tidak bisa absen pulang
                if ($jam < 6) {
                    $this->response([
                        "status"     => "fail",
                        "message"    =>  "Silahkan Absen di Jam Berikutnya ",
                        "time"       => date('Y-m-d H:i:s'),
                        "info"       => "Absen Masuk",
                    ], 200);

                    // echo "anda bisa absen lagi  6 jam dari sekarang";

                } else if ($jam > 6 || $jam <= 18) {
                    $data = [
                        'id_absen'  => $id_absen,
                        'npk'       => $npk,
                        'in_time'   => date('H:i:s'),
                        'in_date'   => date('Y-m-d'),
                        'area'      => $area,
                        'validasi_kehadiran' =>  1,
                        'ket'     => NULL
                    ];
                    $this->db->insert($tabel, $data);
                    $this->response([
                        "status"     => "success",
                        "message"    =>  "Absen Masuk Berhasil",
                        "time"       =>  date('Y-m-d H:i:s'),
                        "info"       => "Absen Masuk",
                    ], 200);
                    // echo "anda bisa absen masuk lagi";
                }
            }
        } else {
            if ($presensiKemarin->num_rows() <= 0) {
                $data = [
                    'id_absen'              => $id_absen,
                    'npk'                   => $npk,
                    'in_time'               => date('H:i:s'),
                    'in_date'               => date('Y-m-d'),
                    'area'                  => $area,
                    'validasi_kehadiran'    =>  1
                ];
                $this->db->insert($tabel, $data);
                $this->response([
                    "status"        => "success",
                    "message"       =>  "Absen Masuk Berhasil",
                    "info"          => "Absen Masuk",
                    "time"          =>  date('Y-m-d H:i:s'),
                ], 200);
                // echo "input absen baru disini";
            } else if ($presensiKemarin->num_rows() > 0) {
                $absen = $presensiKemarin->row();
                if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {
                    //hitung count jam dari jam masuk sampai jam sekarang
                    $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;
                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));
                    //jika jam kurang dari 6jam maka absen pulang di tolak
                    if ($jam <= 4) {
                        $this->response([
                            "status"        =>  "fail",
                            "message"       =>  "Silahkan Absen di Jam Berikutnya",
                            "info"         =>  "Absen Pulang",
                            "time"          =>  date('Y-m-d H:i:s'),
                        ], 200);
                        // echo "anda belum bisa absen pulang coy";
                    } else if ($jam <= 19 && $jam > 3) {
                        //absen pulang
                        $data = [
                            'out_time'           => date('H:i:s'),
                            'out_date'           => date('Y-m-d'),
                            'validasi_kehadiran' => 2,
                            'ket'                => "HADIR"
                        ];
                        $this->db->where('id', $absen->id);
                        $this->db->update($tabel, $data);
                        $this->response([
                            "status"     => "success",
                            "message"    =>  "Absen Pulang Berhasil",
                            "info"       => "Absen Pulang",
                            "time"       => date('Y-m-d H:i:s'),
                        ], 200);
                        // echo "anda bisa absen pulang";
                    } else if ($jam >= 19) {
                        //MANGKIR
                        $data2 = [
                            'validasi_kehadiran' => 0,
                            'ket'                => "MANGKIR"
                        ];

                        $this->db->where('id', $absen->id);
                        $this->db->update($tabel, $data2);

                        //jika sudah lebih 18 jam dari jam masuk maka input absen masuk 
                        $data = [
                            'id_absen'  => $id_absen,
                            'npk'       => $npk,
                            'in_time'   => date('H:i:s'),
                            'in_date'   => date('Y-m-d'),
                            'area'      => $area,
                            'validasi_kehadiran' =>  1,
                            'ket'     => ""
                        ];
                        $this->db->insert($tabel, $data);
                        // echo "masuk";
                        $this->response([
                            "status"     => "success",
                            "message"    => "Absen Masuk Berhasil",
                            "info"       => "Absen Masuk",
                            "time"       => date('Y-m-d H:i:s'),
                        ], 200);
                    }
                } else if ($absen->validasi_kehadiran == 2) {
                    $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));
                    //jika jam kurang dari 6jam maka absen masuk di tanggal sama  di tolak
                    if ($jam <= 1) {
                        $this->response([
                            "status"     => "fail",
                            "info"       => "Absen Masuk",
                            "message"    => "Silahkan Absen di Jam Berikutnya",
                            "time"       => date('Y-m-d H:i:s'),
                        ], 200);
                        // echo "anda belum bisa absen masuk lagi";
                    } else if ($jam >= 2 || $jam <= 18) {
                        $data = [
                            'id_absen'           => $id_absen,
                            'npk'                => $npk,
                            'in_time'            => date('H:i:s'),
                            'in_date'            => date('Y-m-d'),
                            'area'               => $area,
                            'validasi_kehadiran' =>  1,
                            'ket'                => ""
                        ];
                        $this->db->insert($tabel, $data);
                        $this->response([
                            "status"     => "success",
                            "message"    => "Absen Masuk Berhasil",
                            "info"       => "Absen Masuk",
                            "time"       => date('Y-m-d H:i:s'),
                        ], 200);
                        // echo "anda bisa absen masuk lagi di tanggal yang sama ";
                    }
                } else if ($absen->validasi_kehadiran == 3) {
                    $data = [
                        'id_absen'  => $id_absen,
                        'npk'       => $npk,
                        'in_time'   => date('H:i:s'),
                        'in_date'   => date('Y-m-d'),
                        'area'      => $area,
                        'validasi_kehadiran' =>  1,
                        'ket'     => ""
                    ];
                    $this->db->insert($tabel, $data);
                    // echo "masuk";
                    $this->response([
                        "status"     => "success",
                        "message"    => "Absen Masuk Berhasil",
                        "info"       => "Absen Masuk",
                        "time"       => date('Y-m-d H:i:s'),
                    ], 200);
                } else if ($absen->validasi_kehadiran == 4) {
                    $data = [
                        'id_absen'  => $id_absen,
                        'npk'       => $npk,
                        'in_time'   => date('H:i:s'),
                        'in_date'   => date('Y-m-d'),
                        'area'      => $area,
                        'validasi_kehadiran' =>  1,
                        'ket'     => ""
                    ];
                    $this->db->insert($tabel, $data);
                    // echo "masuk";
                    $this->response([
                        "status"     => "success",
                        "message"    => "Absen Masuk Berhasil",
                        "info"       => "Absen Masuk",
                        "time"       => date('Y-m-d H:i:s'),
                    ], 200);
                }
            }
        }
    }



    public function showAbsensi_get()
    {
        $t = new Grei\TanggalMerah();
        $bulan = date('02');
        $tahun = date('Y'); //Mengambil tahun saat ini
        // $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $bln = $this->input->get("bulan");
        $npk = $this->input->get("npk");
        $wilayah  = $this->input->get('wilayah');
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
        $sheet = $this->db->query('select  in_date , in_time , out_time , over_time_start , over_time_end , ket  from ' . $tabel . ' where npk = "' . $npk . '" and in_date like "%2022-' . $bln . '%" ');

        if ($sheet->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'   =>  $sheet->result()
            ], 200);
        } else {
            $this->response([
                'status'     => 'failed',
                'result'      => 'not found'
            ], 200);
        }
    }





    // 
    public function getAbsenFull_get()
    {
        $t = new Grei\TanggalMerah();
        // $bulan = date('02'); //Mengambil tahun saat ini
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bln = $this->input->get("bulan");
        $npk = $this->input->get("npk");
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bln, $tahun);
        $wilayah  = $this->input->get('wilayah');
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

        $absen = array();
        for ($i = 1; $i <= $tanggal; $i++) {
            if ($i <= 9) {
                $i = "0" . $i;
            } else {

                $i = $i;
            }
            $time =  $tahun . "-" . $bln . "-" . $i;
            $dt = $this->db->get_where($tabel, ['in_date' => $time, 'npk'  => $npk]);


            if ($dt->num_rows() > 0) {
                $data = $dt->row();
                $d = [
                    'time'            => $time,
                    'in_time'         => $data->in_time,
                    'in_date'         => $data->in_date,
                    'out_time'        => $data->out_time,
                    'out_date'        => $data->out_date,
                    'over_time_start' => $data->over_time_start,
                    'over_time_end'   => $data->over_time_end,
                    'ket'             => $data->ket
                ];
                array_push($absen, $d);
            } else {
                $d = [
                    'time'       => $time,
                    'in_time'    => "-",
                    'in_date'    => "-",
                    'out_time'   => "-",
                    'out_date'   => "-",
                    'over_time_start' => '-',
                    'over_time_end'   => '-',
                    'ket'        => "-"
                ];
                array_push($absen, $d);
            }
        }

        if (count($absen) > 0) {
            $this->response([
                'status'   => 'success',
                'count'    => count($absen),
                'result'   => $absen,
            ], 200);
        } else {
            $this->response([
                'status'     => 'failed',
                'result'     => 'not found'
            ], 200);
        }
    }

    // 
    //daftar pengajuan lembur

    public function daftarLembur_get()

    {

        $wil = $this->get("wilayah");
        $jabatan = $this->get("jabatan");
        $tabel = "pengajuan_lembur";

        if ($jabatan == "PIC") {
            $data = $this->db->query("SELECT p.id , b.nama , p.date_lembur  ,p.npk , p.alasan_lembur ,  p.over_time_start , p.over_time_end ,  p.area 
            from pengajuan_lembur p , biodata b  , employee e where p.npk = b.npk and p.wilayah='" . $wil . "' and p.status_lembur ='0' 
            and e.id_employee = b.id_biodata and e.jabatan = 'KORLAP' ");
        } else {
            /* and e.jabatan != 'KORLAP' */
            $data = $this->db->query("SELECT p.id , b.nama , p.date_lembur  ,p.npk , p.alasan_lembur ,  p.over_time_start , p.over_time_end ,  p.area 
        from pengajuan_lembur p , biodata b  , employee e where p.npk = b.npk and p.wilayah='" . $wil . "' and p.status_lembur ='0' 
        and e.id_employee = b.id_biodata and e.jabatan != 'KORLAP'  ");
        }
        if ($data->num_rows() > 0) {
            $this->response([
               'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }



    //daftar pengajuan lembur
    public function statusLembur_get()
    {

        $npk = $this->get("npk");
        $hari_ini = date("Y-m-d");
        $bulan_kemarin = date('Y-m-t', strtotime("-1 month", strtotime(date("Y-m-d"))));
        $bulan_2 = date('Y-m-d', strtotime("-5 day", strtotime($bulan_kemarin)));
        $bulan_ini = date('Y-m-t', strtotime($hari_ini));
        $data = $this->db->query("select * from pengajuan_lembur where npk='" . $npk . "' 
        and date_lembur between '" . $bulan_2 . "' AND '" . $bulan_ini . "' ORDER BY id DESC  ");

        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }



    //daftar status skta
    public function statusSKTA_get()
    {
       $npk = $this->get("npk");
        $hari_ini = date("Y-m-d");
        $bulan_kemarin = date('Y-m-t', strtotime("-1 month", strtotime(date("Y-m-d"))));
        $bulan_2 = date('Y-m-d', strtotime("-5 day", strtotime($bulan_kemarin)));
        $bulan_ini = date('Y-m-t', strtotime($hari_ini));
        $data = $this->db->query("select * from pengajuan_skta 
        where npk='" . $npk . "' and date_in between '" . $bulan_2 . "' AND '" . $bulan_ini . "' ORDER BY id DESC  ");

        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
               'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }



    //ambil token untuk notifikasi approve absensi

    public function showToken_get()
    {
        $wil = $this->get("wilayah");
        $query = $this->db->query('SELECT mt.npk ,   b.nama , e.jabatan , e.wilayah , mt.token  FROM master_token mt , biodata b , employee e
            WHERE mt.npk = e.npk AND b.npk = mt.npk AND e.wilayah = "' . $wil . '" AND e.jabatan = "KORLAP" ');
        if ($query->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'   => $query->result(),
            ], 200);
        } else {
            $this->response([
               'status'     => 'failed',
                'result'     => 'not found'
            ], 200);
        }
    }


    //
    public function ambilToken_get()
    {
        $npk = $this->get("npk");
        $query = $this->db->query("select token from master_token where npk= '" . $npk . "' ");
        if ($query->num_rows() > 0) {
            $this->response([
               'status'   => 'success',
                'result'   => $query->row(),
            ], 200);
        } else {
            $this->response([
                'status'     => 'failed',
                'result'     => 'not found'
            ], 200);
        }
    }



    //

    //pengajuan lembur
    public function ajukanLembur_post()
    {
        $npk            = $this->post("npk");
        $tanggal        = $this->post("tanggal_lembur");
        $jam_mulai      = $this->post("jam_mulai");
        $jam_selesai    = $this->post("jam_selesai");
        $alasan_lembur  = $this->post("alasan_lembur");
        $dataSG         = $this->db->query("select b.id_biodata ,  b.nama , b.npk , e.area_kerja , e.wilayah from biodata b , employee e  
        where e.npk = b.npk and e.npk = '" . $npk . "' and b.npk = '" . $npk . "'   ");
        
        if ($jam_mulai == $jam_selesai) {
            $this->response([
                'status'   => 'failed',
                'message'  => 'jam mulai dan jam selesai overtime tidak boleh sama'
            ], 200);
        } else {
            if ($dataSG->num_rows() > 0) {
                $data    = $dataSG->row();
                $wilayah = $data->wilayah;
                $area    = $data->area_kerja;
                $nama    = $data->nama;
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

                $histori_absen = $this->db->get_where($tabel, ['in_date' => $tanggal, 'npk' => $npk]);

                if ($histori_absen->num_rows() > 0) {
                    $params = [
                        'id_lembur'         => $data->id_biodata,
                        'npk'               => $npk,
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
                        $this->response([
                            'status'   => 'sukses',
                            'message'  => 'lembur sudah di ajukan , menunggu approval KORLAP',
                            'data'     => $params
                        ], 200);
                    } else {
                        $this->response([
                            'status'   => 'failed',
                            'message'  => 'gagal input lembur'
                        ], 200);
                    }
                } else {
                    $this->response([
                        'status'   => 'failed',
                        'data'     => $tanggal,
                        'message'  =>  "lembur bisa diajukan jika sudah absen masuk"

                    ], 200);
                }
            } else {
                $this->response([
                    'status'   => 'failed',
                    'message' =>  "not user found"
                ], 200);
            }
        }
    }





    //approval data lemburan

    public function approvalLemburan_put()
    {
        $id_lembur = $this->put("id");
        $status    = $this->put("status_approve");
        if ($status == 1) {
            $dataLembur = $this->db->get_where("pengajuan_lembur", ['id' => $id_lembur]);
            if ($dataLembur->num_rows() > 0) {
                $data = $dataLembur->row();
                $wil = $data->wilayah;
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
                    default:
                        break;
                }
               $params = [
                    'over_time_start'   => $data->over_time_start,
                    'over_time_end'     => $data->over_time_end
                ];

                $update = $this->Api_Model->update(
                    $tabel,
                    $params,
                    ['in_date' => $data->date_lembur, 'npk' => $data->npk]
                );
                if ($update) {
                    $this->db->where("id", $id_lembur);
                   $this->db->update("pengajuan_lembur", ['status_lembur' => 1 , 'updated_at' => date('Y-m-d H:i:s')]);
                    $this->response([
                        'status'   => 'success',
                        'result'   => 'lembur di aprrove'
                    ], 200);
                } else {
                    $this->response([
                        'status'   => 'fail',
                        'result'    => 'terjadi kesalahan'
                    ], 200);
                }
            } else {
                $this->response([
                    'status'   => 'fail',
                    'result'   => 'not found data'
                ], 200);
            }
        } else {
            $this->db->where("id", $id_lembur );
            $this->db->update("pengajuan_lembur", ['status_lembur' => 2 , 'updated_at' => date('Y-m-d H:i:s') ]);
            $this->response([
                'status'   => 'fail',
               'result'   => 'lemburan di tolak'
            ], 200);
        }
    }



    public function detailAbsen_get()
    {
        $wil = $this->get("wilayah");
        $npk = $this->get("npk");
        $tgl = $this->get("tanggal");
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
            default:
                break;
        }


        $h = $this->db->get_where($tabel, ['npk' => $npk, 'in_date' => $tgl]);
        if ($h->num_rows() > 0) {
            $this->response([
               'status'   =>  'success',
                'result'    => $h->row()
            ], 200);
        } else {
            $this->response([
                'status'   => 'fail',
                'result'   => 'terjadi kesalahan'
            ], 200);
        }
    }





    //daftar korlap per wilayah 

    public function daftar_korlap_get()
    {
        $wil  = $this->get("wilayah");
        $jabatan = $this->get("jabatan");
        $npk = $this->get("npk");
        
        // if ($jabatan == "KORLAP") {
        //     $data = $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
        // where e.jabatan = 'PIC' and e.wilayah = '" . $wil . "' and b.npk = e.npk");
        // } else {
        //     $data = $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  from biodata b ,employee  e  
        // where e.jabatan = 'KORLAP' and e.wilayah = '" . $wil . "' and b.npk = e.npk");
        // }
        
        
        if ($npk == 229529 || $npk == 230251 || $npk ==  226869 ) {
            $data = $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  , e.area_kerja from biodata b ,employee  e  
        where e.npk = '41583'  and b.npk = e.npk ");
        } else {
            $data = $this->db->query("SELECT b.nama , b.npk ,  e.jabatan , e.wilayah  , e.area_kerja from biodata b ,employee  e  
        where e.jabatan = 'PIC' and e.wilayah = '" . $wil . "' and b.npk = e.npk ");
        }
        
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   =>  'success',

                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'fail',
               'result'   => 'terjadi kesalahan'
            ], 200);
        }
    }



    //pengajuan SKTA

    public function ajukanSKTA_post()
    {
        $wil = $this->post("wilayah");
        $npk = $this->post("npk");
        $dateIN = $this->post("date_in");
        $dateOUT = $this->post("date_out");
        $in  = $this->post("in");
        $out = $this->post("out");
        $area = $this->post("area");
        $ket = $this->post("keterangan");
        $tabel = "pengajuan_skta";
        $params = [
            'npk' => $npk,
            'area' =>  $area,
            'wil' => $wil,
            'date_in' => $dateIN,
            'in_time' => $in,
            'out_time'  => $out,
            'date_out'  => $dateOUT,
            'keterangan ' => $ket
        ];

        if ($dateIN == date('Y-m-d')) {
            $this->response([
                'status'    => 'failed',
                'result'    => 'SKTA gagal input',
                'message'   => 'skta tidak bisa di input di hari yang sama'
            ], 404);
        } else {
            $insert = $this->db->insert($tabel, $params);
            if ($insert) {
                $this->response([
                    'status'    => 'success',
                    'result'    => 'SKTA menunggu approve PIC',
                    'message'   => 'SKTA menunggu approve PIC'
                ], 200);
            } else {
                $this->response([
                    'status'    => 'failed',
                    'result'    => 'SKTA gagal input',
                    'message'   => 'SKTA gagal input , coba ulangi'
                ], 404);
            }
        }
    }





    //daftar pengajuan skta

    public function daftarSKTA_get()
    {

        $wil = $this->get("wilayah");
        $jabatan = $this->get("jabatan");
        $tabel = "pengajuan_skta";

        if ($jabatan == "PIC") {
            $data = $this->db->query("select p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area  ,
            e.wilayah , e.area_kerja , e.id_employee
            from pengajuan_skta p , biodata b  , employee e where p.npk = b.npk and p.wil='" . $wil . "' and status='0' and e.id_employee = b.id_biodata and 
            e.jabatan = 'KORLAP' ");
        } else {
            // and e.jabatan != 'KORLAP'
            $data = $this->db->query("select p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area  ,
             e.wilayah , e.area_kerja , e.id_employee
            from pengajuan_skta p , biodata b  , employee e where p.npk = b.npk and p.wil='" . $wil . "' and p.status='0' and e.id_employee = b.id_biodata and 
             e.jabatan != 'KORLAP' ");
        }
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }





    //approval data skta
    public function updateSKTA_put()
    {

        $id_skta  = $this->put("id");
        $id_absen = $this->put("id_absen");
        $status    = $this->put("status_approve");
        if ($status == 1) {
            $dataskta = $this->db->get_where("pengajuan_skta", ['id' => $id_skta]);
            if ($dataskta->num_rows() > 0) {
                $data = $dataskta->row();
                $wil  = $data->wil;
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
                    default:
                        break;
                }

                $absensi = $this->db->get_where($tabel, ['in_date' => $data->date_in, 'npk' => $data->npk]);
                if ($absensi->num_rows() > 0) {
                    $params = [
                        'in_time'            => $data->in_time,
                        'out_time'           => $data->out_time,
                        'out_date'           => $data->date_out,
                        'validasi_kehadiran' => 2,
                        'ket'                => 'HADIR' 
                    ];
                    $update = $this->Api_Model->update(
                        $tabel,
                        $params,
                        ['in_date' => $data->date_in, 'npk' => $data->npk]
                    );

                    if ($update) {
                        $this->db->where("id", $id_skta);
                        $this->db->update("pengajuan_skta", ['status' => 1 ,'updated_at' => date('Y-m-d H:i:s') ]);
                        $this->response([
                            'status'   => 'success',
                            'result'   => 'skta di terima'
                        ], 200);
                    } else {
                        $this->response([
                            'status'    => 'fail',
                            'result'    => 'terjadi kesalahan'
                        ], 200);
                    }
                } else {
                    $var = [
                        'id_absen'           => $id_absen,
                        'npk'                => $data->npk,
                        'in_time'            => $data->in_time,
                        'out_time'           => $data->out_time,
                        'in_date'            => $data->date_in,
                        'out_date'           => $data->date_out,
                        'area'               => $data->area,
                        'validasi_kehadiran' => 2,
                        'ket'                => 'HADIR'

                    ];
                    $this->db->insert($tabel, $var);
                    $this->db->where("id", $id_skta);
                    $this->db->update("pengajuan_skta", ['status' => 1,'updated_at' => date('Y-m-d H:i:s') ]);
                    $this->response([
                        'status'   => 'success',
                        'message'  =>  "skta di terima",
                        'result'   => "skta di approve"

                    ], 200);
                }
            } else {
                $this->response([
                    'status'   => 'fail',
                    'result'   => 'not found data',
                    'message'  =>  "skta tidak ada",

                ], 200);
            }
        } else {
            $this->db->where("id", $id_skta);
            $this->db->update("pengajuan_skta", ['status' => 2 , 'updated_at' => date('Y-m-d H:i:s') ]);
            $this->response([
                'status'   => 'fail',
                'result'   => 'skta di tolak',
                'message'  =>  "skta di tolak",
            ], 200);
        }
    }





    //ajukan cuti

    public function ajukanCuti_post()
    {
        $wil                = $this->post("wilayah");
        $npk                = $this->post("npk");
        $nama               = $this->post("nama");
        $area               = $this->post("area");
        $tanggalCuti        = $this->post("tanggal_cuti");
        $alasan             = $this->post("alasan_cuti");
        $pengganti          = $this->post("pengganti");
        $tabel              = "pengajuan_cuti";


        $params = [
            'npk'               => $npk,
            'nama'              => $nama,
            'area'              => $area,
            'wilayah'           => $wil,
            'alasan_cuti'       => $alasan,
            'tanggal_cuti'      => $tanggalCuti,
            'status'            => 0,
            'pengganti_cuti'    => $pengganti
        ];
        $insert = $this->db->insert($tabel, $params);
        if ($insert) {
            $this->response([
                'status'    => 'success',
                'result'    => 'Pengajuan cuti dikirim , menunggu approve PIC',
                'message'   => 'Pengajuan cuti dikirim , menunggu approve PIC'
            ], 200);
        } else {
            $this->response([
                'status'    => 'failed',
                'result'    => 'Cuti gagal input',
                'message'   => 'Cuti gagal input'
            ], 200);
        }
    }



    //tampilkan daftar pengajuan cuti 
    public function daftarCuti_get()
    {
        $wil = $this->get("wilayah");
        $jabatan =  $this->get("jabatan");
        if ($jabatan == "PIC") {
            $data = $this->db->query("select c.id , e.id_employee ,  c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti , e.wilayah , e.area_kerja 
            from pengajuan_cuti c , biodata b  , employee e  where  
            c.wilayah='" . $wil . "' and c.status = 0  and b.npk = c.npk 
            and b.id_biodata = e.id_employee and e.jabatan = 'KORLAP' ");
        } else {
            $data = $this->db->query("select c.id , e.id_employee , c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti , e.wilayah , e.area_kerja
            from pengajuan_cuti c , biodata b  , employee e  where 
            c.wilayah='" . $wil . "' and c.status = 0  and b.npk = c.npk 
            and b.id_biodata = e.id_employee and e.jabatan !='KORLAP' ");
            //  and e.jabatan !='KORLAP'
        }
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }



    //approve cuti anggota
    public function approveCuti_put(Type $var = null)
    {
        // note
        // 1 jika cuti di accept 
        // 2 jika di tolak
        // 0 cuti masih pending
        $id_cuti = $this->put("id");
        $npk     = $this->put("npk");
        $idakun  = $this->put("id_token");
        $area    = $this->put("area");
        $wil     = $this->put("wilayah");
        $accept  = $this->put("accept");


        if ($accept == 0) {
            $params_update = [
                'status'  => 2 ,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->where('id', $id_cuti );
            $this->db->update("pengajuan_cuti", $params_update);
            $this->response([
                'status'    => 'failed',
                'result'    => "Di Approve",
                'message'   =>  "Cuti di tolak"
            ], 200);
        } else if ($accept == 1) {

            $data_cuti = $this->db->get_where("pengajuan_cuti", ['id' => $id_cuti]);
            if ($data_cuti->num_rows() > 0) {
                $data = $data_cuti->row();
                $params = [
                    'id_absen'              => $idakun,
                    'npk'                   => $npk,
                    'area'                  => $area,
                    'in_date'               => $data->tanggal_cuti,
                    'in_time'               => "00:00:00",
                    'out_date'              => $data->tanggal_cuti,
                    'out_time'              => "02:00:00",
                    'validasi_kehadiran'    => 3,
                    'ket'                   => 'CUTI'
                ];

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
                    default:
                        break;
                }
                $insert = $this->db->insert($tabel, $params);
                if ($insert) {
                    $params_update = [
                        'status'  => 1 ,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $this->db->where('id', $id_cuti);
                    $this->db->update("pengajuan_cuti", $params_update);
                    $this->response([

                        'status'    => 'success',
                        'result'    => "Di Approve",
                        'message'   => "Pengajuan cuti di setujui"
                    ], 200);
                } else {
                    $this->response([
                        'status'    => 'failed',
                        'result'    => 'error',
                        'message'   => "Terjadi Kesalahan"
                    ], 400);
                }
            } else {
                $this->response([
                    'status'   => 'failed',
                    'result'    => 'data tidak ada'
                ], 200);
            }
        }
    }


    //daftar anggota pengganti cuti 
    public function ListpenggantiCuti_get(Type $var = null)
    {
        $area = $this->get("area");
        $data = $this->db->query('SELECT b.nama , b.npk , e.area_kerja FROM biodata b , employee e
        WHERE e.area_kerja = "' . $area . '" AND b.npk = e.npk order by b.nama ASC');
        if ($data->num_rows() > 0) {
            $this->response([
                'status'    => 'success',
                'result'    => $data->result(),
                'message'   => "Data tersedia"
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => 'data tidak ada'
            ], 200);
        }
    }



    //status pengajuan cuti 

    public function statusCuti_get(Type $var = null)
    {
        $npk = $this->get("npk");
        $bln = date('Y-m');
        $data = $this->db->query('select * from pengajuan_cuti where npk="' . $npk . '" and tanggal_cuti like "%' . $bln . '%" ORDER BY id DESC  ');
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }





    //status pengajuan sakit 
    public function ajukanSakit_post()
    {

        $tanggal         = $this->post("tanggal_ijin");
        $id              = $this->post('id_ijin');
        $npk             = $this->post('npk');
        $nama            = $this->post('nama');
        $wilayah         = $this->post('wilayah');
        $area            = $this->post('area');
        $ket             = $this->post('ket');

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
                $this->response([
                    'result'   => $data,
                    'status'   => 'success',
                    'message'  => "data di kirim"
                ], 200);
            } else {
                $this->response([

                    'status'   => "failed",
                    'message'  => "terjadi kesalahan"
                ], 502);
            }
        }
    }





    //daftar sakit anggota 
    public function daftarSakit_get(Type $var = null)
    {
        $wil = $this->get("wilayah");
         $jabatan    = $this->get("jabatan");

        if ($jabatan == "PIC") {
            $data = $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan , 
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen , e.wilayah , e.area_kerja 
            FROM pengajuan_perijinan pp , biodata b , employee e   
            WHERE pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status = 0 AND pp.wilayah = '" . $wil . "' and e.jabatan = 'KORLAP' ");
        } else {
            $data = $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan , 
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen , e.wilayah , e.area_kerja 
            FROM pengajuan_perijinan pp , biodata b , employee e  
            WHERE pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status = 0 AND pp.wilayah = '" . $wil . "' and e.jabatan != 'KORLAP'  ");
            // and e.jabatan != 'KORLAP'
        }
        
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }





    //approve ijin sakit anggota
    public function approveSakit_put()
    {
        $id_sakit = $this->put("id");
        $npk      = $this->put("npk");
        $idakun   = $this->put("id_token");
        $area     = $this->put("area");
        $wil      = $this->put("wilayah");
        $accept   = $this->put("accept");

        if ($accept == 0) {
            $params_update = [
                'status'  => 2 ,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->where('id', $id_sakit);
            $this->db->update("pengajuan_perijinan", $params_update);
            $this->response([
                'status'    => 'failed',
                'result'    => "Di Tolak",
                'message'   => "Perijinan tidak di tolak"
            ], 200);
        } else if ($accept == 1) {
            $data_sakit = $this->db->get_where("pengajuan_perijinan", ['id' => $id_sakit]);
            if ($data_sakit->num_rows() > 0) {
                $data = $data_sakit->row();
                $params = [
                    'id_absen'              => $idakun,
                    'npk'                   => $npk,
                    'area'                  => $area,
                    'in_date'               => $data->date_perijinan,
                    'in_time'               => "00:00:00",
                    'out_date'              => $data->date_perijinan,
                    'out_time'              => "02:00:00",
                    'validasi_kehadiran'    => 4,
                    'ket'                   => 'SAKIT'

                ];

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
                    default:

                        break;
                }
                $insert = $this->db->insert($tabel, $params);
                if ($insert) {
                    $params_update = [
                        'status'  => 1 ,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $this->db->where('id', $id_sakit);
                    $this->db->update("pengajuan_perijinan", $params_update);
                    $this->response([
                        'status'    => 'success',
                        'result'    => "Di Approve",
                        'message'   => "Pengajuan sakit di setujui"
                    ], 200);
                } else {
                    $this->response([
                        'status'    => 'failed',
                        'result'    => 'error',
                        'message'   => "Terjadi Kesalahan"
                    ], 200);
                }
            } else {
                $this->response([
                    'status'    => 'failed',
                    'result'    => 'data tidak ada'
                ], 200);
            }
        }
    }



    //status pengajuan sakit

    public function statusSakit_get()
    {
        $npk = $this->get("npk");
        $bln = date('Y-m');
        $data = $this->db->query('select * from pengajuan_perijinan where npk="' . $npk . '" and date_perijinan like "%' . $bln . '%" ORDER BY id DESC  ');
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }
    
    
    //daftar log status approval 
    public function logApprovalOT_get()
    {
        $wil = $this->get("wilayah");
        $data = $this->db->query("SELECT p.id , b.nama , p.date_lembur  ,p.npk , p.alasan_lembur ,  p.over_time_start , p.over_time_end ,  p.area , p.status_lembur ,
        p.updated_at
            from pengajuan_lembur p , biodata b  , employee e where p.npk = b.npk and p.wilayah='" . $wil . "' 
            and p.status_lembur !='0' and e.id_employee = b.id_biodata and e.jabatan = 'KORLAP' and p.date_lembur like '" . '%' . date('Y-m') . '%' . "'  ");
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }
    
    public function logApprovalCuti_get()
    {
        $wil = $this->get("wilayah");
        $data =$this->db->query("select c.id , c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti ,  c.updated_at ,
            c.status  from pengajuan_cuti c , biodata b  , employee e 
            where  c.wilayah='" . $wil . "' and c.status != 0  and 
            b.npk = c.npk and b.id_biodata = e.id_employee and e.jabatan = 'KORLAP' and c.tanggal_cuti like '" . '%' . date('Y-m') . '%' . "'  ");
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
        
    }
    
    public function logApprovalSakit_get()
    {
        $wil = $this->get("wilayah");
        $data = $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan ,
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen  , pp.updated_at
            FROM pengajuan_perijinan pp , biodata b , employee e  
            WHERE pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status != 0 AND pp.wilayah = '" . $wil . "' 
            and e.jabatan = 'KORLAP' and pp.date_perijinan like '" . '%' . date('Y-m') . '%' . "'  ");
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
    }
    
    public function logApprovalSKTA_get()
    {
        $wil = $this->get("wilayah");
        $data = $this->db->query("select p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area  , p.status ,
        p.updated_at
            from pengajuan_skta p , biodata b  , employee e where p.npk = b.npk and p.wil='" . $wil . "' and p.status !='0' 
            and e.id_employee = b.id_biodata and e.jabatan = 'KORLAP' and p.date_in like '" . '%' . date('Y-m') . '%' . "'  ");
        if ($data->num_rows() > 0) {
            $this->response([
                'status'   => 'success',
                'result'    => $data->result()
            ], 200);
        } else {
            $this->response([
                'status'   => 'failed',
                'result'    => $data->result()
            ], 200);
        }
        
    }
}
