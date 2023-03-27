<?php

class Patrol extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $id = $this->session->userdata('id_akun');
        $role_id = $this->session->userdata('role_id');
        if ($id == null || $id == "") {
            $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
            redirect('Login');
        }
        if ($role_id != 6) {
            redirect('LogOut');
        }
    }

    public function index()
    {
        $wl  = $this->db->query("select wilayah , area_kerja , npk  from employee where id_employee='" . $this->session->userdata('id_akun') . "' ")->row();
        $wil  =  $wl->wilayah;
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        $data = [
            'link'      => $this->uri->segment(2),
            'tanggal'   => $tgl_kemarin,
            'wilayah'   => $wil,
            'HO'       => $this->Super_model->countPatroli("HO", $tgl_kemarin),
            'VLC'      => $this->Super_model->countPatroli("VLC", $tgl_kemarin),
            'DOR'      => $this->Super_model->countPatroli("DOR", $tgl_kemarin),
            'PC'       => $this->Super_model->countPatroli("PC", $tgl_kemarin),
            'P1'       => $this->Super_model->countPatroli("P1", $tgl_kemarin),
            'P2'       => $this->Super_model->countPatroli("P2", $tgl_kemarin),
            'P3'       => $this->Super_model->countPatroli("P3", $tgl_kemarin),
            'P4A'      => $this->Super_model->countPatroli("P4-ASSY1", $tgl_kemarin),
            'P4B'      => $this->Super_model->countPatroli("P4-ASSY2", $tgl_kemarin),
            'P5'       => $this->Super_model->countPatroli("P5", $tgl_kemarin),
        ];
        $this->load->view("web/pic/header", $data);
        $this->load->view("PIC/patrol/patrol", $data);
        $this->load->view("web/pic/fotter");
    }

    public function showPatroli()
    {
        $area = $this->input->post("area");
        $bulan = $this->input->post("bulan");
        // $area = "VLC" ;
        // $bulan = "02";
        $data = array(
            'area'          => $area,
            'bulan'         => $bulan,
            'data'          => $this->db->get_where("durasi_patroli", ['area' => $area])->result()
        );
        // $this->load->view('web/header', $data);
        $this->load->view("PIC/patrol/reporting_patrol", $data);
        // $this->load->view('web/fotter');
    }


    public function tarikExcel()
    {

        $area = $this->input->post("area_patrol");
        //  $id = "P5";
        $d = $this->db->get_where("titik_area", ['id_plan' => $area]);
        $bulan  = $this->input->post("bulan");
        $this->db->order_by("lokasi", 'asc');
        $data = array(
            'titik'          => $d,
            'area'           => $area,
            'bulan'          => $bulan
        );
        $filename = 'laporan-patrol-' . $area;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("PIC/patrol/excel_patroli", $data);
    }


    public function reportPeriodik()
    {
        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area_kerja");
        $this->db->where('area_kerja', $area);
        $this->db->where('tgl_kirim_patroli >=', $day);
        $this->db->where('tgl_kirim_patroli <=', $day2);
        $result = $this->db->get('hasil_patroli');
        $data = [
            'patrol'  =>  $result,
            'area'    => $area,
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $data = $this->load->view('PIC/patrol/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'D');
    }
}
