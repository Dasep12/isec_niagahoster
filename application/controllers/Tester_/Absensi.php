<?php
date_default_timezone_set('Asia/Jakarta');
class Absensi extends CI_Controller
{

    public function index()
    {
        $this->load->view("Tester/absensi");
    }


    //cek daerah korlap
    public function cekBarcodeKorlap()
    {
        # code...
        $wil = $this->input->post("wilayah");
        $lat = $this->input->post("latitude");
        $d = $this->db->get_where("barcode_absensi", ['wilayah' => $wil, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            echo 1; //jika satu maka korlap bisa absen berdasarkan wilayah
        } else {
            echo 0; //jika nol maka korlap tida bisa absen lintas wilayah
        }
    }

    //cek barcode untuk anggota dan danru 
    public function cekBarcodeAnggota()
    {
        $area = $this->input->post("area_kerja");
        $lat = $this->input->post("latitude");
        $d = $this->db->get_where("barcode_absensi", ['area_kerja' => $area, 'latitude' => $lat]);
        if ($d->num_rows() > 0) {
            //echo 1; //jika satu maka korlap bisa absen berdasarkan wilayah
            echo json_encode($d->result());
        } else {
            echo 0; //jika nol maka korlap tida bisa absen lintas wilayah
        }
    }

    public function input_absen()
    {
        $npk = $this->input->post("npk");
        $wil = $this->input->post("wilayah");
        $id_absen = $this->input->post("id_absen");
        $area = $this->input->post("area_kerja");
        $now = date('Y-m-d'); //ambil tanggal sekarang

        //tanggal kemarin
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

        //cek wilayah untuk  penentuan dimana anggota harus di simpan data absennya
       // $tabel = null ;
        switch ($wil) {
            case 'WIL1':
             $tabel = "absen_wil1";
             $presensiKemarin = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $tgl_kemarin]);
             $presensiSekarang = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $now]);
                break;
            case 'WIL2':
              $tabel = "absen_wil2";
              $presensiKemarin = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $now]);
                break;
            case 'WIL3':
              $tabel = "absen_wil3";
              $presensiKemarin = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $now]);
                 break;
            case 'WIL4':
              $tabel = "absen_wil4";
              $presensiKemarin = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => 228572 , 'in_date' => $now]);
                break;
            default:
                $tabel  = null ;
                break;
        }
        
        
        
        $kmrn = $presensiKemarin->num_rows() ;
        $skrg = $presensiSekarang->num_rows() ;
        if ($skrg > 0) {
            $absen = $presensiSekarang->row();
            if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {
                $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));
                if ($jam < 5) {
                    echo "anda bisa absen lagi 5 jam dari sekarang  ";
                } else {
                    //absen pulang
                    $data = [
                        'out_time'      => date('H:i:s'),
                        'out_date'  => date('Y-m-d'),
                        'validasi_kehadiran' => 2,
                        'ket'              => "HADIR"
                    ];
                    $this->db->where('id', $absen->id);
                    $this->db->update($tabel, $data);
                    echo "anda absen pulang bos";
                }
            } else if ($absen->validasi_kehadiran == 2) {
                $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;

                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));

                //jika kurang dari 6jam maka tidak bisa absen pulang
                if ($jam < 6) {
                    echo "anda bisa absen lagi  6 jam dari sekarang";
                } else if ($jam > 6 || $jam <= 18) {
                    $data = [
                        'id_absen' => $id_absen,
                        'npk'       => $npk,
                        'in_time'   => date('H:i:s'),
                        'in_date'   => date('Y-m-d'),
                        'area'      => $area,
                        'validasi_kehadiran' =>  1,
                        'ket'     => NULL
                    ];
                    $this->db->insert($tabel, $data);
                    echo "anda bisa absen masuk lagi";
                }
            }
        } else {
            if ($kmrn <= 0) {
                $data = [
                    'id_absen' => $id_absen,
                    'npk'       => $npk,
                    'in_time'   => date('H:i:s'),
                    'in_date'   => date('Y-m-d'),
                    'area'      => $area,
                    'validasi_kehadiran' =>  1
                ];
                $this->db->insert($tabel, $data);
                echo "input absen baru disini";
            } else if ($kmrn > 0) {
                $absen = $presensiKemarin->row();
                if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {

                    //hitung count jam dari jam masuk sampai jam sekarang
                    $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika jam kurang dari 6jam maka absen pulang di tolak
                    if ($jam < 6) {
                        echo "anda belum bisa absen pulang coy";
                    } else if ($jam > 6 || $jam <= 18) {
                        //absen pulang
                        $data = [
                            'out_time'           => date('H:i:s'),
                            'out_date'           => date('Y-m-d'),
                            'validasi_kehadiran' => 2,
                            'ket'                => "HADIR"
                        ];
                        $this->db->where('id', $absen->id);
                        $this->db->update($tabel, $data);
                        echo "anda bisa absen pulang";
                    }
                } else if ($absen->validasi_kehadiran == 2) {
                    $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika jam kurang dari 6jam maka absen masuk di tanggal sama  di tolak
                    if ($jam < 2) {
                        echo "anda belum bisa absen masuk lagi";
                    } else if ($jam > 6 || $jam <= 18) {
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
                        echo "anda bisa absen masuk lagi di tanggal yang sama ";
                    }
                }
            }
        }
    }
    
    
    public function getAbsenFull_get(){
        
        $t = new Grei\TanggalMerah();
        $bulan = date('02'); //Mengambil tahun saat ini
        $tahun = date('Y'); //Mengambil tahun saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $bln = $this->input->get("bulan");
        $npk = $this->input->get("npk");
        $wilayah  = $this->input->get('wilayah');
        switch($wilayah){
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
        for($i = 1 ; $i <= $tanggal ; $i++ ) {
            if($i <= 9 ){
                $i = "0" . $i ;
            }else {
                $i = $i ;
            }
            $time =  $tahun . "-" . $bulan . "-" . $i ;
            $dt = $this->db->get_where("absen_wil2" , ['in_date' => $time , 'npk'  => 228572 ]);
                
                if($dt->num_rows() > 0 ){
                    $data = $dt->row();
                     $d = [
                        'time'       => $time ,
                        'in_time'    => $data->in_time ,
                        'in_date'    => $data->in_date ,
                        'out_time'   => $data->out_time ,
                        'out_date'   => $data->out_date ,
                        'ket'        => $data->ket 
                    ];
                    array_push($absen , $d );
                }else {
                    $d = [
                        'time'       => $time ,
                        'in_time'    => "" ,
                        'in_date'    =>"",
                        'out_time'   =>"" ,
                        'out_date'   =>"" ,
                        'ket'        => ""
                    ];
                    array_push($absen , $d );
                }
        }
        
       echo json_encode($absen);
        
        
    }
}























