<?php
date_default_timezone_set('Asia/Jakarta');
class Absensi_v2 extends CI_Controller
{
    
  function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
    date_default_timezone_set('Asia/Jakarta');
    $id = $this->session->userdata('id_akun');
    $role_id = $this->session->userdata('role_id');
    if ($id == null || $id == "") {
      $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
      redirect('Login');
    }
  }

    public function index()
    {
        $device = $this->agent->platform();
        $browser = $this->agent->browser();
        if($device == "Android")
        {
            redirect('Absensi_v2/android');
        }else if($device == "iOS"){
            redirect('Absensi_v2/absen_ios');
        }else{
            $data = array(
            'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'       => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'employe'   => $this->db->get_where('employee',array('id_employee' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header',$data);
        $this->load->view("absensi_v2",$data);
        $this->load->view('mobile/fotter');    
        }
        
    }
    // untuk android
    public function android()
    {
        $data = array(
            'biodata'   => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'       => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'employe'   => $this->db->get_where('employee',array('id_employee' => $this->session->userdata('id_akun')))->row(),
        );
        $this->load->view('mobile/header',$data);
        $this->load->view("absensi_v2",$data);
        $this->load->view('mobile/fotter');
    }
    
    //absen untuk iphone
    public function absen_ios()
    {
        $v = $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row();
        $barc   = $v->area_kerja;

        $data = array(
            'biodata'       => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'           => $this->uri->segment(2),
            'berkas'        => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'employe'       => $this->db->get_where('employee', array('id_employee' => $this->session->userdata('id_akun')))->row(),
            'titik' => $this->db->get_where('barcode_absensi', ['area_kerja' => $barc])->row()
        );
        $this->load->view('mobile/header', $data);
        $this->load->view("absensi_ios", $data);
        $this->load->view('mobile/fotter', $data);
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
        
        // echo $npk . "/" . $area . "/" . $wil ;
        //tanggal kemarin
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

        //cek wilayah untuk  penentuan dimana anggota harus di simpan data absennya
       // $tabel = null ;
        switch ($wil) {
            case 'WIL1':
             $tabel = "absen_wil1";
             $presensiKemarin = $this->db->get_where($tabel,['npk' => $npk , 'in_date' => $tgl_kemarin]);
             $presensiSekarang = $this->db->get_where($tabel,['npk' => $npk, 'in_date' => $now]);
                break;
            case 'WIL2':
              $tabel = "absen_wil2";
              $presensiKemarin = $this->db->get_where($tabel,['npk' => $npk, 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => $npk , 'in_date' => $now]);
                break;
            case 'WIL3':
              $tabel = "absen_wil3";
              $presensiKemarin = $this->db->get_where($tabel,['npk' => $npk , 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => $npk , 'in_date' => $now]);
                 break;
            case 'WIL4':
              $tabel = "absen_wil4";
              $presensiKemarin = $this->db->get_where($tabel,['npk' =>$npk , 'in_date' => $tgl_kemarin]);
              $presensiSekarang = $this->db->get_where($tabel,['npk' => $npk , 'in_date' => $now]);
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
                if ($jam < 1) {
                    // echo "anda bisa absen lagi 6 jam dari sekarang ";
                    echo "Belum Waktunya Pulang" ;
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
                    // echo "anda absen pulang bos";
                    echo "pulang";
                }
            } else if ($absen->validasi_kehadiran == 2) {
                $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;

                //jam selisih untuk absen pulang
                $jam   = floor($diff / (60 * 60));

                //jika kurang dari 6jam setelah absen pulang maka tidak bisa absen masuk kembali
                if ($jam < 2) {
                    // echo "bisa absen masuk 6 jam dari sekarang";
                    echo "anda dapat masuk lagi nanti";
                } else if ($jam > 2 || $jam <= 15) {
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
                    // echo "bisa absen masuk lagi";
                    echo "masuk";
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
                // echo "input absen baru disini";
                echo "masuk";
            } else if ($kmrn > 0) {
                $absen = $presensiKemarin->row();
                if ($absen->validasi_kehadiran == 1 && $absen->ket == NULL) {

                    //hitung count jam dari jam masuk sampai jam sekarang
                    $awal  = strtotime($absen->in_time . " " . $absen->in_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //total jam selisih untuk bisa absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika total jam kurang dari 6jam maka absen pulang di tolak
                    if ($jam < 2) {
                        // echo "belum bisa absen pulang";
                        echo "Belum Waktunya Pulang";
                    } else if ($jam <= 19 && $jam > 3   ) {
                        //absen pulang di terima jika lebih lebih dari 6 jam dan dibawah 18 jam 
                        $data = [
                            'out_time'           => date('H:i:s'),
                            'out_date'           => date('Y-m-d'),
                            'validasi_kehadiran' => 2,
                            'ket'                => "HADIR"
                        ];
                        $this->db->where('id', $absen->id);
                        $this->db->update($tabel, $data);
                        // echo "anda bisa absen pulang";
                        echo "pulang";
                    }else if($jam > 20){
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
                        echo "masuk";
                    }
                } else if ($absen->validasi_kehadiran == 2) {
                    $awal  = strtotime($absen->out_time . " " . $absen->out_date);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;

                    //jam selisih untuk masuk lagi setelah absen pulang
                    $jam   = floor($diff / (60 * 60));

                    //jika dari jam pulang-sekarang kurang dari 6jam maka absen masuk di tanggal sama  di tolak
                    if ($jam < 2 ) {
                        echo "masuk lagi nanti" ;
                        // echo "anda belum bisa absen masuk lagi";
                    } else if ($jam > 3 || $jam <= 18) {
                        //jika dari jam absen pulang sudah lebih dari 6 jam dan di bawah 18 jam maka bisa masuk absen lagi di tanggal yang sama
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
                        echo "masuk";
                    }
                }
            }
        }
    }
}
