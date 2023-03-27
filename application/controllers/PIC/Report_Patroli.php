<?php


class Report_Patroli extends CI_Controller
{
    // function __construct()
    // {
    //     parent::__construct();

    //     $id = $this->session->userdata('id_akun');
    //     $role_id = $this->session->userdata('role_id');
    //     if ($id == null || $id == "") {
    //         $this->session->set_flashdata('info', 'sessi berakhir silahkan login kembali');
    //         redirect('Login');
    //     }
    //     if ($role_id != 5) {
    //         redirect('LogOut');
    //     }
    // }


    public function index()
    {
        
        $anggota = array('role_id' => 1);
        $danru = array('role_id' => 2);
        $korlap = array('role_id' => 3);
        $sipd = array('role_id' => 4);
        
        
        $area = $this->input->post("area_patrol");
        $d = $this->db->get_where("titik_area", ['id_plan' => "P2"]);
        
        $b = date('m');
        switch($b){
         case"01":
             $b="Januari";
         break;
         case"02":
             $b="Februari";
         break;
         case"03":
            $b="Maret";
        break;
         case"04":
            $b="April";
        break;
         case"05":
             $b="Mei";
             break;
         case"06":
             $b="Juni";
             break;
         case"07":
             $b="Juli";
             break;
         case"08":
             $b="Agustus";
             break;
         case"09":
             $b="September"
             ;break;
         case"10":
             $b="Oktober";
             break;
         case"11":
             $b="Nopember";
             break;
         case"12":
             $b="Desember";
             break;
        }
        $tgl_kemarin    = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
    
        $data = array(
            'biodata' => $this->db->get_where('biodata', array('id_biodata' => $this->session->userdata('id_akun')))->row(),
            'url'  => $this->uri->segment(2),
            'berkas'    => $this->db->get_where('berkas', array('id_berkas' => $this->session->userdata('id_akun')))->row(),
            'anggota'   => $this->Sipd_model->infoDashboard("akun", $anggota)->num_rows(),
            'danru'   => $this->Sipd_model->infoDashboard("akun", $danru)->num_rows(),
            'korlap'   => $this->Sipd_model->infoDashboard("akun", $korlap)->num_rows(),
            'total'   => $this->Sipd_model->countAll()->num_rows(),
            'titik'         => $d,
            'tanggal'  => $tgl_kemarin,
            'HO'       => $this->Super_model->countPatroli("HO", $tgl_kemarin),
            'VLC'       => $this->Super_model->countPatroli("VLC", $tgl_kemarin),
            'DOR'       => $this->Super_model->countPatroli("DOR", $tgl_kemarin),
            'PC'       => $this->Super_model->countPatroli("PC", $tgl_kemarin),
            'P1'       => $this->Super_model->countPatroli("P1", $tgl_kemarin),
            'P2'       => $this->Super_model->countPatroli("P2", $tgl_kemarin),
            'P3'       => $this->Super_model->countPatroli("P3", $tgl_kemarin),
            'P4A'       => $this->Super_model->countPatroli("P4-ASSY1", $tgl_kemarin),
            'P4B'       => $this->Super_model->countPatroli("P4-ASSY2", $tgl_kemarin),
            'P5'       => $this->Super_model->countPatroli("P5", $tgl_kemarin),
            'bulan'    => $b
        );
        $this->load->view('web/header', $data);
        $this->load->view('PIC/report_patroli', $data);
        $this->load->view('web/fotter');
    }
    
    
    public function cekSessi(){
        
        $b = 2;
        if($b == 2){
            $this->session->set_flashdata("info_patroli",'data masuk');
            redirect("Danru/Patrol");
        }else {
            $this->session->set_flashdata("info_patroli",'data hilang');
            redirect("Danru/Patrol");
        }
    }
    
    


    public function reportHarian(Type $var = null)
    {
        # code...

        $day = $this->input->post("day");
        $area = $this->input->post("area_kerja1");
        $this->db->where('area_kerja',$area);
        $result = $this->db->get_where('report_patrol', ['tanggal' => $day, 'area_kerja' => $area]);

        $data = [
            'patrol'  =>  $result,
            'area'    => $area ,
            'tgl1'    => $day,
            'tgl2'     => ""
        ];
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf" , 'I');
    }


    public function reportPeriodik(Type $var = null)
    {
        # code...

        $day = $this->input->post("day2");
        $day2 = $this->input->post("day3");
        $area = $this->input->post("area_kerja");
        $this->db->where('area_kerja',$area);
        $this->db->where('tgl_kirim_patroli >=', $day);
        $this->db->where('tgl_kirim_patroli <=', $day2);
        $result = $this->db->get('hasil_patroli');

        $data = [
            'patrol'  =>  $result,
            'area'    => $area ,
            'tgl1'    => $day,
            'tgl2'     => $day2
        ];

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        // $data = $this->load->view('PIC/pdf_patroli', $data,  TRUE);
        $data = $this->load->view('PIC/report_patroli_pdf', $data,  TRUE);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Report Patroli " . $area . ".pdf", 'D');
    }
    
    
    //report excel per bulan
    public function tarikExcel()
    {
        $area = $this->input->post("area_patrol");
        $bulan = $this->input->post("bulan");
        // $d = $this->Sipd_model->patrolReporting($wil);
        $d = $this->db->get_where("titik_area", ['id_plan' => $area]);
        // $this->db->order_by("urutan", 'asc');
        $data = array(
            'titik'         => $d,
            'bulan'         => $bulan 
        );
        $filename = 'laporan-patroli-' . $area;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        $this->load->view("PIC/report_patroli_excel", $data);
    }
}
