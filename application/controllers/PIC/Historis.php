<?php


class Historis extends CI_Controller
{

    public function index(Type $var = null)
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $data = [
            'link'  => $this->uri->segment(2),
            'data'  => $this->db->query("select wilayah , area_kerja , npk from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row(),

            'overtime'      =>  $data = $this->db->query("SELECT p.id , b.nama , p.date_lembur  ,p.npk , p.alasan_lembur ,  p.over_time_start , p.over_time_end ,  p.area , p.status_lembur
            from pengajuan_lembur p , biodata b  , employee e where p.npk = b.npk and p.wilayah='" . $wil . "' and p.status_lembur !='0' and e.id_employee = b.id_biodata and (e.jabatan = 'KORLAP' or e.jabatan='ANGGOTA' ) and p.date_lembur like '" . '%' . date('Y-m') . '%' . "'  "),

            'cuti'      => $this->db->query("select c.id , c.nama , c.npk ,  c.tanggal_cuti , c.alasan_cuti , c.status  from pengajuan_cuti c , biodata b  , employee e  where  c.wilayah='" . $wil . "' and c.status != 0  and b.npk = c.npk and b.id_biodata = e.id_employee and (e.jabatan = 'KORLAP' or e.jabatan='ANGGOTA' ) and c.tanggal_cuti like '" . '%' . date('Y-m') . '%' . "'  "),


            'skta'      =>  $this->db->query("select p.id , b.nama , p.npk , p.keterangan ,  p.date_in , p.in_time , p.out_time , p.date_out , p.area  , p.status
            from pengajuan_skta p , biodata b  , employee e where p.npk = b.npk and p.wil='" . $wil . "' and p.status !='0' and e.id_employee = b.id_biodata and  (e.jabatan = 'KORLAP' or e.jabatan='ANGGOTA' ) and p.date_in like '" . '%' . date('Y-m') . '%' . "'  "),


            'sakit'     => $this->db->query("SELECT pp.id , pp.id_perijinan , pp.npk , b.nama , pp.date_perijinan , pp.jenis_perijinan ,
            e.area_kerja , e.wilayah , pp.keterangan ,pp.dokumen_perijinan   , pp.status  , pp.link_dokumen 
            FROM pengajuan_perijinan pp , biodata b , employee e  
            WHERE pp.npk = b.npk AND b.id_biodata = e.id_employee AND pp.status != 0 AND pp.wilayah = '" . $wil . "' and  (e.jabatan = 'KORLAP' or e.jabatan='ANGGOTA' ) and pp.date_perijinan like '" . '%' . date('Y-m') . '%' . "'  ")

        ];
        $this->load->view("web/pic/header", $data);
        $this->load->view("PIC/approval/log_approval", $data);
        $this->load->view("web/pic/fotter");
    }
}
