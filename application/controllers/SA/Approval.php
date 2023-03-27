<?php

class Approval extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
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


    public function overtime()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $area = $wl->area_kerja;
        $data = [
            'data'  => $this->db->query("SELECT p.id , b.nama , p.date_lembur  ,p.npk , p.alasan_lembur  as keterangan,  p.over_time_start , p.over_time_end ,  p.area , e.area_kerja 
            from pengajuan_lembur p , biodata b  , employee e where p.npk = b.npk and p.status_lembur ='0' and e.id_employee = b.id_biodata and (e.npk = '229529' or e.npk = '230251' or e.npk = '226869' or e.npk = '226904' or e.npk = '220927' )"),
            'link'  => $this->uri->segment(2),
        ];
        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/approval/overtime", $data);
        $this->load->view("web/superadmin/fotter");
    }

    public function approve_ot()
    {
        $id_lembur      = $this->input->get("id");
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
                $this->db->update("pengajuan_lembur", ['status_lembur' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
                $this->session->set_flashdata("ok", "Overtime di setujui");
                redirect('SA/Approval/overtime');
            } else {
                $this->session->set_flashdata("nok", "Terjadi kesalahan ");
                redirect('SA/Approval/overtime');
            }
        } else {
            $this->session->set_flashdata("nok", "Tidak ada data");
            redirect('SA/Approval/overtime');
        }
    }

    public function reject_ot()
    {
        $id_lembur = $this->input->get("id");
        $this->db->where("id", $id_lembur);
        $this->db->update("pengajuan_lembur", ['status_lembur' => 2]);
        $this->session->set_flashdata("nok", "Overtime di tolak");
        redirect('SA/Approval/overtime');
    }

    public function skta()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $data = [
            'data'  =>  $this->db->query("select b.id_biodata ,  p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area , e.area_kerja 
            from pengajuan_skta p , biodata b  , employee e where p.npk = b.npk and p.wil='" . $wil . "' and p.status='0' and e.id_employee = b.id_biodata and  (e.npk = '229529' or e.npk = '230251' or e.npk = '226869' or e.npk = '226904' ) "),
            'link'  => $this->uri->segment(2),
        ];
        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/approval/skta", $data);
        $this->load->view("web/superadmin/fotter");
    }

    public function approve_skta()
    {
        $id_skta      = $this->input->get("id");
        $id_absen     = $this->input->get('id_absen');
        $dataskta     = $this->db->get_where("pengajuan_skta", ['id' => $id_skta]);
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
                    'ket'                => 'HADIR',

                ];
                $update = $this->Api_Model->update(
                    $tabel,
                    $params,
                    ['in_date' => $data->date_in, 'npk' => $data->npk]
                );

                if ($update) {
                    $this->db->where("id", $id_skta);
                    $this->db->update("pengajuan_skta", ['status' => 1, 'updated_at' => date('Y-m-d')]);
                    $this->session->set_flashdata("ok", "SKTA di setujui");
                    redirect('SA/Approval/skta');
                } else {
                    $this->session->set_flashdata("nok", "SKTA di tolak");
                    redirect('SA/Approval/skta');
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
                $this->db->update("pengajuan_skta", ['status' => 1]);
                $this->session->set_flashdata("ok", "SKTA di setujui");
                redirect('SA/Approval/skta');
            }
        }
    }

    public function reject_skta()
    {
        $id_skta = $this->input->get("id");
        $this->db->where("id", $id_skta);
        $this->db->update("pengajuan_skta", ['status' => 2, 'updated_at' => date('Y-m-d')]);
        $this->session->set_flashdata("nok", "SKTA di tolak");
        redirect('SA/Approval/skta');
    }


    public function cuti()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $data = [
            'data'  =>  $this->db->query("select c.id , c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti  from pengajuan_cuti c , biodata b  , employee e  where  c.wilayah='" . $wil . "' and c.status = 0  and b.npk = c.npk and b.id_biodata = e.id_employee and (e.npk = '229529' or e.npk = '230251' or e.npk = '226869' or e.npk = '226904' ) "),
            'link'  => $this->uri->segment(2),
        ];

        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/approval/cuti", $data);
        $this->load->view("web/superadmin/fotter");
    }

    public function approve_cuti()
    {
        $id_cuti  = $this->input->get("id");
        $npk      = $this->input->get("npk");
        $data_cuti = $this->db->get_where("pengajuan_cuti", ['id' => $id_cuti]);
        if ($data_cuti->num_rows() > 0) {
            $data = $data_cuti->row();
            $variabel  = $this->db->query("select id_employee , area_kerja , wilayah from employee   where npk='" . $npk  . "' ")->row();
            $idakun    = $variabel->id_employee;
            $area      = $variabel->area_kerja;
            $wil       = $variabel->wilayah;
            $params = [
                'id_absen'              => $idakun,
                'npk'                   => $npk,
                'area'                  => $area,
                'in_date'               => $data->tanggal_cuti,
                'in_time'               => "00:00:00",
                'out_date'              => $data->tanggal_cuti,
                'out_time'              => "02:00:00",
                'validasi_kehadiran'    => 3,
                'ket'                   => 'CUTI',
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
                    'status'        => 1,
                    'updated_at'    => date('Y-m-d')
                ];
                $this->db->where('id', $id_cuti);
                $this->db->update("pengajuan_cuti", $params_update);
                $this->session->set_flashdata("ok", "Cuti di setujui");
                redirect('SA/Approval/cuti');
            } else {
                $this->session->set_flashdata("nok", "gagal terjadi kesalahan");
                redirect('SA/Approval/cuti');
            }
        }
    }


    public function reject_cuti(Type $var = null)
    {
        $id_cuti = $this->input->get("id");
        $params_update = [
            'status'  => 2,
            'updated_at'            => date('Y-m-d')
        ];
        $this->db->where('id', $id_cuti);
        $this->db->update("pengajuan_cuti", $params_update);
        $this->session->set_flashdata("nok", "cuti berhasil di tolak");
        redirect('SA/Approval/cuti');
    }

    public function sakit()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $data = [
            'data'  =>   $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan , 
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen 
            FROM pengajuan_perijinan pp , biodata b , employee e  
            WHERE pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status = 0 AND pp.wilayah = '" . $wil . "' and (e.npk = '229529' or e.npk = '230251' or e.npk = '226869' or e.npk = '226904' ) "),
            'link'  => $this->uri->segment(2),
        ];

        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/approval/sakit", $data);
        $this->load->view("web/superadmin/fotter");
    }


    public function approve_sakit(Type $var = null)
    {
        $id_sakit  = $this->input->get("id");
        $npk       = $this->input->get("npk");
        $data_sakit = $this->db->get_where("pengajuan_perijinan", ['id' => $id_sakit]);
        if ($data_sakit->num_rows() > 0) {
            $data = $data_sakit->row();
            $variabel  = $this->db->query("select id_employee , area_kerja , wilayah from employee   where npk='" . $npk  . "' ")->row();
            $idakun    = $variabel->id_employee;
            $area      = $variabel->area_kerja;
            $wil       = $variabel->wilayah;
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
                    'status'  => 1
                ];
                $this->db->where('id', $id_sakit);
                $this->db->update("pengajuan_perijinan", $params_update);
                $this->session->set_flashdata("ok", "ijin sakit berhasil di approve");
                redirect('SA/Approval/sakit');
            } else {
                $this->session->set_flashdata("nok", "terjadi kesalahan");
                redirect('SA/Approval/sakit');
            }
        }
    }


    public function reject_sakit(Type $var = null)
    {
        $id_sakit = $this->input->get("id");
        $params_update = [
            'status'        => 2,
            'updated_at'    => date('Y-m-d')
        ];
        $this->db->where('id', $id_sakit);
        $this->db->update("pengajuan_perijinan", $params_update);
        $this->session->set_flashdata("nok", "ijin sakit berhasil di tolak");
        redirect('SA/Approval/sakit');
    }
}
