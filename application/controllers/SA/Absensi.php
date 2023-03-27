<?php
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Absensi extends CI_Controller
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
        if ($role_id != 9) {
            redirect('LogOut');
        }
    }

    public function index()
    {

        $wil_ = array();

        $npk = $this->session->userdata('npk');
        $npk = $this->session->userdata('npk');
        if ($npk == 22325) {
            $wil_ = ["WIL1", "WIL2"];
        } else if ($npk == 46785) {
            $wil_ = ["WIL3", "WIL4"];
        }
        $data = [
            'link'  => $this->uri->segment(2),
            'data'  => $wil_
        ];
        $this->load->view("web/superadmin/header", $data);
        $this->load->view("SA/form_unduh_absen", $data);
        $this->load->view("web/superadmin/fotter");
    }

    public function bulan($bln)
    {
        switch ($bln) {
            case '01':
                $bulan = 'JANUARI';
                break;
            case '02':
                $bulan = 'FEBRUARI';
                break;
            case '03':
                $bulan = 'MARET';
                break;
            case '04':
                $bulan = 'APRIL';
                break;
            case '05':
                $bulan = 'MEI';
                break;
            case '06':
                $bulan = 'JUNI';
                break;
            case '07':
                $bulan = 'JULI';
                break;
            case '08':
                $bulan = 'AGUSTUS';
                break;
            case '09':
                $bulan = 'SEPTEMBER';
                break;
            case '10':
                $bulan = 'OKTOBER';
                break;
            case '11':
                $bulan = 'NOVEMBER';
                break;
            case '12':
                $bulan = 'DESEMBER';
                break;
            default:
                '';
                break;
        }

        return $bulan;
    }

    public function download(Type $var = null)
    {
        // $bulan = date('05');
        // $tahun = date('Y');
        // $wilayah = 'WIL2';
        $tahun   = $this->input->post("tahun");
        $bulan   = $this->input->post("bulan");
        $wilayah = $this->input->post("wilayah");
        $month = strtolower($this->bulan($bulan));
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
                $tabel  = null;
                break;
        }
       $anggota = $this->db->query("SELECT b.nama , b.npk ,e.area_kerja FROM employee e , biodata b 
        WHERE b.id_biodata = e.id_employee AND e.wilayah = '" . $wilayah . "' and (e.jabatan = 'ANGGOTA' or e.jabatan = 'KORLAP' or e.jabatan = 'PKD' 
        or e.jabatan = 'DANRU') 
         AND e.status = 1 AND b.status = 1
        ORDER BY area_kerja ASC ");

        $wyh = $wilayah;
        $l = "";
        switch ($wyh) {
            case 'WIL1':
                $l = "Wilayah 1";
                break;
            case 'WIL2':
                $l = "Wilayah 2";
                break;
            case 'WIL3':
                $l = "Wilayah 3";
                break;
            case 'WIL4':
                $l = "Wilayah 4";
                break;
        }

        $filename = "Timesheet " . ucfirst($month) . ' ' . $tahun . ' ( ' . $l . ' )';
        header('Content-Type:application/vnd-ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Timesheet-' . ucfirst($month));
        $sheet->getColumnDimension('A')->setAutoSize(TRUE);
        $sheet->mergeCells('A1:A3')->setCellValue('A1', 'Nama');
        $sheet->mergeCells('B1:B3')->setCellValue('B1', 'NPK');
        $sheet->mergeCells('C1:C3')->setCellValue('C1', 'Instalasi');
        $sheet->mergeCells('D1:CR1')->setCellValue('D1', $this->bulan($bulan));
        $sheet->mergeCells('CS1:CU2')->setCellValue('CS1', 'Total');
        $sheet->setCellValue("CS3", "KEHADIRAN");
        $sheet->setCellValue("CT3", "SAKIT");
        $sheet->setCellValue("CU3", "CUTI");

        $sheet->mergeCells('D2:F2')->setCellValue('D2', '1');
        $sheet->setCellValue("D3", "IN");
        $sheet->setCellValue("E3", "OUT");
        $sheet->setCellValue("F3", "KET");
        $sheet->mergeCells('G2:I2')->setCellValue('G2', '2');
        $sheet->setCellValue("G3", "IN");
        $sheet->setCellValue("H3", "OUT");
        $sheet->setCellValue("I3", "KET");
        $sheet->mergeCells('J2:L2')->setCellValue('J2', '3');
        $sheet->setCellValue("J3", "IN");
        $sheet->setCellValue("K3", "OUT");
        $sheet->setCellValue("L3", "KET");
        $sheet->mergeCells('M2:O2')->setCellValue('M2', '4');
        $sheet->setCellValue("M3", "IN");
        $sheet->setCellValue("N3", "OUT");
        $sheet->setCellValue("O3", "KET");
        $sheet->mergeCells('P2:R2')->setCellValue('P2', '5');
        $sheet->setCellValue("P3", "IN");
        $sheet->setCellValue("Q3", "OUT");
        $sheet->setCellValue("R3", "KET");
        $sheet->mergeCells('S2:U2')->setCellValue('S2', '6');
        $sheet->setCellValue("S3", "IN");
        $sheet->setCellValue("T3", "OUT");
        $sheet->setCellValue("U3", "KET");
        $sheet->mergeCells('V2:X2')->setCellValue('V2', '7');
        $sheet->setCellValue("V3", "IN");
        $sheet->setCellValue("W3", "OUT");
        $sheet->setCellValue("X3", "KET");
        $sheet->mergeCells('Y2:AA2')->setCellValue('Y2', '8');
        $sheet->setCellValue("Y3", "IN");
        $sheet->setCellValue("Z3", "OUT");
        $sheet->setCellValue("AA3", "KET");
        $sheet->mergeCells('AB2:AD2')->setCellValue('AB2', '9');
        $sheet->setCellValue("AB3", "IN");
        $sheet->setCellValue("AC3", "OUT");
        $sheet->setCellValue("AD3", "KET");
        $sheet->mergeCells('AE2:AG2')->setCellValue('AE2', '10');
        $sheet->setCellValue("AE3", "IN");
        $sheet->setCellValue("AF3", "OUT");
        $sheet->setCellValue("AG3", "KET");
        $sheet->mergeCells('AH2:AJ2')->setCellValue('AH2', '11');
        $sheet->setCellValue("AH3", "IN");
        $sheet->setCellValue("AI3", "OUT");
        $sheet->setCellValue("AJ3", "KET");
        $sheet->mergeCells('AK2:AM2')->setCellValue('AK2', '12');
        $sheet->setCellValue("AK3", "IN");
        $sheet->setCellValue("AL3", "OUT");
        $sheet->setCellValue("AM3", "KET");
        $sheet->mergeCells('AN2:AP2')->setCellValue('AN2', '13');
        $sheet->setCellValue("AN3", "IN");
        $sheet->setCellValue("AO3", "OUT");
        $sheet->setCellValue("AP3", "KET");
        $sheet->mergeCells('AQ2:AS2')->setCellValue('AQ2', '14');
        $sheet->setCellValue("AQ3", "IN");
        $sheet->setCellValue("AR3", "OUT");
        $sheet->setCellValue("AS3", "KET");
        $sheet->mergeCells('AT2:AV2')->setCellValue('AT2', '15');
        $sheet->setCellValue("AT3", "IN");
        $sheet->setCellValue("AU3", "OUT");
        $sheet->setCellValue("AV3", "KET");
        $sheet->mergeCells('AW2:AY2')->setCellValue('AW2', '16');
        $sheet->setCellValue("AW3", "IN");
        $sheet->setCellValue("AX3", "OUT");
        $sheet->setCellValue("AY3", "KET");
        $sheet->mergeCells('AZ2:BB2')->setCellValue('AZ2', '17');
        $sheet->setCellValue("AZ3", "IN");
        $sheet->setCellValue("BA3", "OUT");
        $sheet->setCellValue("BB3", "KET");
        $sheet->mergeCells('BC2:BE2')->setCellValue('BC2', '18');
        $sheet->setCellValue("BC3", "IN");
        $sheet->setCellValue("BD3", "OUT");
        $sheet->setCellValue("BE3", "KET");
        $sheet->mergeCells('BF2:BH2')->setCellValue('BF2', '19');
        $sheet->setCellValue("BF3", "IN");
        $sheet->setCellValue("BG3", "OUT");
        $sheet->setCellValue("BH3", "KET");
        $sheet->mergeCells('BI2:BK2')->setCellValue('BI2', '20');
        $sheet->setCellValue("BI3", "IN");
        $sheet->setCellValue("BJ3", "OUT");
        $sheet->setCellValue("BK3", "KET");
        $sheet->mergeCells('BL2:BN2')->setCellValue('BL2', '21');
        $sheet->setCellValue("BL3", "IN");
        $sheet->setCellValue("BM3", "OUT");
        $sheet->setCellValue("BN3", "KET");
        $sheet->mergeCells('BO2:BQ2')->setCellValue('BO2', '22');
        $sheet->setCellValue("BO3", "IN");
        $sheet->setCellValue("BP3", "OUT");
        $sheet->setCellValue("BQ3", "KET");
        $sheet->mergeCells('BR2:BT2')->setCellValue('BR2', '23');
        $sheet->setCellValue("BR3", "IN");
        $sheet->setCellValue("BS3", "OUT");
        $sheet->setCellValue("BT3", "KET");
        $sheet->mergeCells('BU2:BW2')->setCellValue('BU2', '24');
        $sheet->setCellValue("BU3", "IN");
        $sheet->setCellValue("BV3", "OUT");
        $sheet->setCellValue("BW3", "KET");
        $sheet->mergeCells('BX2:BZ2')->setCellValue('BX2', '25');
        $sheet->setCellValue("BX3", "IN");
        $sheet->setCellValue("BY3", "OUT");
        $sheet->setCellValue("BZ3", "KET");
        $sheet->mergeCells('CA2:CC2')->setCellValue('CA2', '26');
        $sheet->setCellValue("CA3", "IN");
        $sheet->setCellValue("CB3", "OUT");
        $sheet->setCellValue("CC3", "KET");
        $sheet->mergeCells('CD2:CF2')->setCellValue('CD2', '27');
        $sheet->setCellValue("CD3", "IN");
        $sheet->setCellValue("CE3", "OUT");
        $sheet->setCellValue("CF3", "KET");
        $sheet->mergeCells('CG2:CI2')->setCellValue('CG2', '28');
        $sheet->setCellValue("CG3", "IN");
        $sheet->setCellValue("CH3", "OUT");
        $sheet->setCellValue("CI3", "KET");
        $sheet->mergeCells('CJ2:CL2')->setCellValue('CJ2', '29');
        $sheet->setCellValue("CJ3", "IN");
        $sheet->setCellValue("CK3", "OUT");
        $sheet->setCellValue("CL3", "KET");
        $sheet->mergeCells('CM2:CO2')->setCellValue('CM2', '30');
        $sheet->setCellValue("CM3", "IN");
        $sheet->setCellValue("CN3", "OUT");
        $sheet->setCellValue("CO3", "KET");
        $sheet->mergeCells('CP2:CR2')->setCellValue('CP2', '31');
        $sheet->setCellValue("CP3", "IN");
        $sheet->setCellValue("CQ3", "OUT");
        $sheet->setCellValue("CR3", "KET");
        $sheet->getStyle('A1:CU3')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],

        ];
        $styleArray2 = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],

        ];

        $sheet->getStyle('A1:C3')->applyFromArray($styleArray2);
        $sheet->getStyle('CS1:CU3')->applyFromArray($styleArray2);
        $sheet->getStyle('A1:CU3')
            ->getFont()
            ->setSize(11)
            ->setBold(true);
        $sheet->getStyle('A1:A3')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('ffff00');
        $st = 4;

        foreach ($anggota->result() as $agt) {
            $sheet->setCellValue('A' . $st, $agt->nama);
            $sheet->setCellValue('B' . $st, $agt->npk);
            $sheet->setCellValue('C' . $st, $agt->area_kerja);

            //get tanggal 1 absensi 
            $absensi_tgl1 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "01'  ");
            if ($absensi_tgl1->num_rows() > 0) {
                $tgl_1 = $absensi_tgl1->row();
                if ($tgl_1->ket == 'CUTI') {
                    $sheet->getStyle('D' . $st . ':E' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('D' . $st . ':E' . $st)->setCellValue('D' . $st, '-');
                    $sheet->setCellValue('F' . $st, $tgl_1->ket);
                } else if ($tgl_1->ket == 'SAKIT') {
                    $sheet->getStyle('D' . $st . ':E' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('D' . $st . ':E' . $st)->setCellValue('D' . $st, '-');
                    $sheet->setCellValue('F' . $st, $tgl_1->ket);
                } else {
                    $sheet->setCellValue('D' . $st, $tgl_1->in_time);
                    $sheet->setCellValue('E' . $st, $tgl_1->out_time);
                    $sheet->setCellValue('F' . $st, $tgl_1->ket);
                }
            } else {
                $sheet->setCellValue('D' . $st, '-');
                $sheet->setCellValue('E' . $st, '-');
                $sheet->setCellValue('F' . $st, '-');
            }

            //get tanggal 2 absensi 
            $absensi_tgl2 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "02'  ");
            if ($absensi_tgl2->num_rows() > 0) {
                $tgl_2 = $absensi_tgl2->row();
                if ($tgl_2->ket == 'CUTI') {
                    $sheet->getStyle('G' . $st . ':H' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('G' . $st . ':H' . $st)->setCellValue('G' . $st, '-');
                    $sheet->setCellValue('I' . $st, $tgl_2->ket);
                } else if ($tgl_2->ket == 'SAKIT') {
                    $sheet->getStyle('G' . $st . ':H' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('G' . $st . ':H' . $st)->setCellValue('G' . $st, '-');
                    $sheet->setCellValue('I' . $st, $tgl_2->ket);
                } else {
                    $sheet->setCellValue('G' . $st, $tgl_2->in_time);
                    $sheet->setCellValue('H' . $st, $tgl_2->out_time == null ? '-' : $tgl_2->out_time);
                    $sheet->setCellValue('I' . $st, $tgl_2->ket);
                }
            } else {
                $sheet->setCellValue('G' . $st, '-');
                $sheet->setCellValue('H' . $st, '-');
                $sheet->setCellValue('I' . $st, '-');
            }


            //get tanggal 3 absensi 
            $absensi_tgl3 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "03'  ");
            if ($absensi_tgl3->num_rows() > 0) {
                $tgl_3 = $absensi_tgl3->row();
                if ($tgl_3->ket == 'CUTI') {
                    $sheet->getStyle('J' . $st . ':K' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('J' . $st . ':K' . $st)->setCellValue('J' . $st, '-');
                    $sheet->setCellValue('L' . $st, $tgl_3->ket);
                } else if ($tgl_3->ket == 'SAKIT') {
                    $sheet->getStyle('J' . $st . ':K' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('J' . $st . ':K' . $st)->setCellValue('J' . $st, '-');
                    $sheet->setCellValue('L' . $st, $tgl_3->ket);
                } else {
                    $sheet->setCellValue('J' . $st, $tgl_3->in_time);
                    $sheet->setCellValue('K' . $st, $tgl_3->out_time);
                    $sheet->setCellValue('L' . $st, $tgl_3->ket);
                }
            } else {
                $sheet->setCellValue('J' . $st, '-');
                $sheet->setCellValue('K' . $st, '-');
                $sheet->setCellValue('L' . $st, '-');
            }



            //get tanggal 4 absensi 
            $absensi_tgl4 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "04'  ");
            if ($absensi_tgl4->num_rows() > 0) {
                $tgl_4 = $absensi_tgl4->row();
                if ($tgl_4->ket == 'CUTI') {
                    $sheet->getStyle('M' . $st . ':N' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('M' . $st . ':N' . $st)->setCellValue('M' . $st, '-');
                    $sheet->setCellValue('O' . $st, $tgl_4->ket);
                } else if ($tgl_4->ket == 'SAKIT') {
                    $sheet->getStyle('M' . $st . ':N' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('M' . $st . ':N' . $st)->setCellValue('M' . $st, '-');
                    $sheet->setCellValue('O' . $st, $tgl_4->ket);
                } else {
                    $sheet->setCellValue('M' . $st, $tgl_4->in_time);
                    $sheet->setCellValue('N' . $st, $tgl_4->out_time);
                    $sheet->setCellValue('O' . $st, $tgl_4->ket);
                }
            } else {
                $sheet->setCellValue('M' . $st, '-');
                $sheet->setCellValue('N' . $st, '-');
                $sheet->setCellValue('O' . $st, '-');
            }

            //get tanggal 5 absensi 
            $absensi_tgl5 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "05'  ");
            if ($absensi_tgl5->num_rows() > 0) {
                $tgl_5 = $absensi_tgl5->row();
                if ($tgl_5->ket == 'CUTI') {
                    $sheet->getStyle('P' . $st . ':Q' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('P' . $st . ':Q' . $st)->setCellValue('P' . $st, '-');
                    $sheet->setCellValue('R' . $st, $tgl_5->ket);
                } else if ($tgl_5->ket == 'SAKIT') {
                    $sheet->getStyle('P' . $st . ':Q' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('P' . $st . ':Q' . $st)->setCellValue('P' . $st, '-');
                    $sheet->setCellValue('R' . $st, $tgl_5->ket);
                } else {
                    $sheet->setCellValue('P' . $st, $tgl_5->in_time);
                    $sheet->setCellValue('Q' . $st, $tgl_5->out_time);
                    $sheet->setCellValue('R' . $st, $tgl_5->ket);
                }
            } else {
                $sheet->setCellValue('P' . $st, '-');
                $sheet->setCellValue('Q' . $st, '-');
                $sheet->setCellValue('R' . $st, '-');
            }



            //get tanggal 6 absensi 
            $absensi_tgl6 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "06'  ");
            if ($absensi_tgl6->num_rows() > 0) {
                $tgl_6 = $absensi_tgl6->row();
                if ($tgl_6->ket == 'CUTI') {
                    $sheet->getStyle('S' . $st . ':T' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('S' . $st . ':T' . $st)->setCellValue('S' . $st, '-');
                    $sheet->setCellValue('U' . $st, $tgl_6->ket);
                } else if ($tgl_6->ket == 'SAKIT') {
                    $sheet->getStyle('S' . $st . ':T' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('S' . $st . ':T' . $st)->setCellValue('S' . $st, '-');
                    $sheet->setCellValue('U' . $st, $tgl_6->ket);
                } else {
                    $sheet->setCellValue('S' . $st, $tgl_6->in_time);
                    $sheet->setCellValue('T' . $st, $tgl_6->out_time);
                    $sheet->setCellValue('U' . $st, $tgl_6->ket);
                }
            } else {
                $sheet->setCellValue('S' . $st, '-');
                $sheet->setCellValue('T' . $st, '-');
                $sheet->setCellValue('U' . $st, '-');
            }

            //get tanggal 7 absensi 
            $absensi_tgl7 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "07'  ");
            if ($absensi_tgl7->num_rows() > 0) {
                $tgl_7 = $absensi_tgl7->row();
                if ($tgl_7->ket == 'CUTI') {
                    $sheet->getStyle('V' . $st . ':W' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('V' . $st . ':W' . $st)->setCellValue('V' . $st, '-');
                    $sheet->setCellValue('X' . $st, $tgl_7->ket);
                } else if ($tgl_7->ket == 'SAKIT') {
                    $sheet->getStyle('V' . $st . ':W' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('V' . $st . ':W' . $st)->setCellValue('V' . $st, '-');
                    $sheet->setCellValue('X' . $st, $tgl_7->ket);
                } else {
                    $sheet->setCellValue('V' . $st, $tgl_7->in_time);
                    $sheet->setCellValue('W' . $st, $tgl_7->out_time);
                    $sheet->setCellValue('X' . $st, $tgl_7->ket);
                }
            } else {
                $sheet->setCellValue('V' . $st, '-');
                $sheet->setCellValue('W' . $st, '-');
                $sheet->setCellValue('X' . $st, '-');
            }


            //get tanggal 8 absensi 
            $absensi_tgl8 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "08'  ");
            if ($absensi_tgl8->num_rows() > 0) {
                $tgl_8 = $absensi_tgl8->row();
                if ($tgl_8->ket == 'CUTI') {
                    $sheet->getStyle('Y' . $st . ':Z' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('Y' . $st . ':Z' . $st)->setCellValue('Y' . $st, '-');
                    $sheet->setCellValue('AA' . $st, $tgl_8->ket);
                } else if ($tgl_8->ket == 'SAKIT') {
                    $sheet->getStyle('Y' . $st . ':Z' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('Y' . $st . ':Z' . $st)->setCellValue('Y' . $st, '-');
                    $sheet->setCellValue('AA' . $st, $tgl_8->ket);
                } else {
                    $sheet->setCellValue('Y' . $st, $tgl_8->in_time);
                    $sheet->setCellValue('Z' . $st, $tgl_8->out_time);
                    $sheet->setCellValue('AA' . $st, $tgl_8->ket);
                }
            } else {
                $sheet->setCellValue('Y' . $st, '-');
                $sheet->setCellValue('Z' . $st, '-');
                $sheet->setCellValue('AA' . $st, '-');
            }


            //get tanggal 9 absensi 
            $absensi_tgl9 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "09'  ");
            if ($absensi_tgl9->num_rows() > 0) {
                $tgl_9 = $absensi_tgl9->row();
                if ($tgl_9->ket == 'CUTI') {
                    $sheet->getStyle('AB' . $st . ':AC' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AB' . $st . ':AC' . $st)->setCellValue('AB' . $st, '-');
                    $sheet->setCellValue('AD' . $st, $tgl_9->ket);
                } else if ($tgl_9->ket == 'SAKIT') {
                    $sheet->getStyle('AB' . $st . ':AC' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AB' . $st . ':AC' . $st)->setCellValue('AB' . $st, '-');
                    $sheet->setCellValue('AD' . $st, $tgl_9->ket);
                } else {
                    $sheet->setCellValue('AB' . $st, $tgl_9->in_time);
                    $sheet->setCellValue('AC' . $st, $tgl_9->out_time);
                    $sheet->setCellValue('AD' . $st, $tgl_9->ket);
                }
            } else {
                $sheet->setCellValue('AB' . $st, '-');
                $sheet->setCellValue('AC' . $st, '-');
                $sheet->setCellValue('AD' . $st, '-');
            }

            //get tanggal 10 absensi 
            $absensi_tgl10 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "10'  ");
            if ($absensi_tgl10->num_rows() > 0) {
                $tgl_10 = $absensi_tgl10->row();
                if ($tgl_10->ket == 'CUTI') {
                    $sheet->getStyle('AE' . $st . ':AF' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AE' . $st . ':AF' . $st)->setCellValue('AE' . $st, '-');
                    $sheet->setCellValue('AG' . $st, $tgl_10->ket);
                } else if ($tgl_10->ket == 'SAKIT') {
                    $sheet->getStyle('AE' . $st . ':AF' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AE' . $st . ':AF' . $st)->setCellValue('AE' . $st, '-');
                    $sheet->setCellValue('AD' . $st, $tgl_10->ket);
                } else {
                    $sheet->setCellValue('AE' . $st, $tgl_10->in_time);
                    $sheet->setCellValue('AF' . $st, $tgl_10->out_time);
                    $sheet->setCellValue('AG' . $st, $tgl_10->ket);
                }
            } else {
                $sheet->setCellValue('AE' . $st, '-');
                $sheet->setCellValue('AF' . $st, '-');
                $sheet->setCellValue('AG' . $st, '-');
            }


            //get tanggal 11 absensi 
            $absensi_tgl11 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "11'  ");
            if ($absensi_tgl11->num_rows() > 0) {
                $tgl_11 = $absensi_tgl11->row();
                if ($tgl_11->ket == 'CUTI') {
                    $sheet->getStyle('AH' . $st . ':AI' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AH' . $st . ':AI' . $st)->setCellValue('AH' . $st, '-');
                    $sheet->setCellValue('AJ' . $st, $tgl_11->ket);
                } else if ($tgl_11->ket == 'SAKIT') {
                    $sheet->getStyle('AH' . $st . ':AI' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AH' . $st . ':AI' . $st)->setCellValue('AH' . $st, '-');
                    $sheet->setCellValue('AD' . $st, $tgl_11->ket);
                } else {
                    $sheet->setCellValue('AH' . $st, $tgl_11->in_time);
                    $sheet->setCellValue('AI' . $st, $tgl_11->out_time);
                    $sheet->setCellValue('AJ' . $st, $tgl_11->ket);
                }
            } else {
                $sheet->setCellValue('AH' . $st, '-');
                $sheet->setCellValue('AI' . $st, '-');
                $sheet->setCellValue('AJ' . $st, '-');
            }


            //get tanggal 12 absensi 
            $absensi_tgl12 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "12'  ");
            if ($absensi_tgl12->num_rows() > 0) {
                $tgl_12 = $absensi_tgl12->row();
                if ($tgl_12->ket == 'CUTI') {
                    $sheet->getStyle('AK' . $st . ':AL' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AK' . $st . ':AL' . $st)->setCellValue('AK' . $st, '-');
                    $sheet->setCellValue('AM' . $st, $tgl_12->ket);
                } else if ($tgl_12->ket == 'SAKIT') {
                    $sheet->getStyle('AK' . $st . ':AL' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AK' . $st . ':AL' . $st)->setCellValue('AK' . $st, '-');
                    $sheet->setCellValue('AM' . $st, $tgl_12->ket);
                } else {
                    $sheet->setCellValue('AK' . $st, $tgl_12->in_time);
                    $sheet->setCellValue('AL' . $st, $tgl_12->out_time);
                    $sheet->setCellValue('AM' . $st, $tgl_12->ket);
                }
            } else {
                $sheet->setCellValue('AK' . $st, '-');
                $sheet->setCellValue('AL' . $st, '-');
                $sheet->setCellValue('AM' . $st, '-');
            }

            //get tanggal 13 absensi 
            $absensi_tgl13 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "13'  ");
            if ($absensi_tgl13->num_rows() > 0) {
                $tgl_13 = $absensi_tgl13->row();
                if ($tgl_13->ket == 'CUTI') {
                    $sheet->getStyle('AN' . $st . ':AO' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AN' . $st . ':AO' . $st)->setCellValue('AN' . $st, '-');
                    $sheet->setCellValue('AP' . $st, $tgl_13->ket);
                } else if ($tgl_13->ket == 'SAKIT') {
                    $sheet->getStyle('AN' . $st . ':AO' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AN' . $st . ':AO' . $st)->setCellValue('AN' . $st, '-');
                    $sheet->setCellValue('AP' . $st, $tgl_13->ket);
                } else {
                    $sheet->setCellValue('AN' . $st, $tgl_13->in_time);
                    $sheet->setCellValue('AO' . $st, $tgl_13->out_time);
                    $sheet->setCellValue('AP' . $st, $tgl_13->ket);
                }
            } else {
                $sheet->setCellValue('AN' . $st, '-');
                $sheet->setCellValue('AO' . $st, '-');
                $sheet->setCellValue('AP' . $st, '-');
            }



            //get tanggal 14 absensi 
            $absensi_tgl14 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "14'  ");
            if ($absensi_tgl14->num_rows() > 0) {
                $tgl_14 = $absensi_tgl14->row();
                if ($tgl_14->ket == 'CUTI') {
                    $sheet->getStyle('AQ' . $st . ':AR' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AQ' . $st . ':AR' . $st)->setCellValue('AQ' . $st, '-');
                    $sheet->setCellValue('AS' . $st, $tgl_14->ket);
                } else if ($tgl_14->ket == 'SAKIT') {
                    $sheet->getStyle('AQ' . $st . ':AR' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AQ' . $st . ':AR' . $st)->setCellValue('AQ' . $st, '-');
                    $sheet->setCellValue('AS' . $st, $tgl_14->ket);
                } else {
                    $sheet->setCellValue('AQ' . $st, $tgl_14->in_time);
                    $sheet->setCellValue('AR' . $st, $tgl_14->out_time);
                    $sheet->setCellValue('AS' . $st, $tgl_14->ket);
                }
            } else {
                $sheet->setCellValue('AQ' . $st, '-');
                $sheet->setCellValue('AR' . $st, '-');
                $sheet->setCellValue('AS' . $st, '-');
            }

            //get tanggal 15 absensi 
            $absensi_tgl15 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "15'  ");
            if ($absensi_tgl15->num_rows() > 0) {
                $tgl_15 = $absensi_tgl15->row();
                if ($tgl_15->ket == 'CUTI') {
                    $sheet->getStyle('AT' . $st . ':AU' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AT' . $st . ':AU' . $st)->setCellValue('AT' . $st, '-');
                    $sheet->setCellValue('AV' . $st, $tgl_15->ket);
                } else if ($tgl_15->ket == 'SAKIT') {
                    $sheet->getStyle('AT' . $st . ':AU' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AT' . $st . ':AU' . $st)->setCellValue('AT' . $st, '-');
                    $sheet->setCellValue('AV' . $st, $tgl_15->ket);
                } else {
                    $sheet->setCellValue('AT' . $st, $tgl_15->in_time);
                    $sheet->setCellValue('AU' . $st, $tgl_15->out_time);
                    $sheet->setCellValue('AV' . $st, $tgl_15->ket);
                }
            } else {
                $sheet->setCellValue('AT' . $st, '-');
                $sheet->setCellValue('AU' . $st, '-');
                $sheet->setCellValue('AV' . $st, '-');
            }


            //get tanggal 16 absensi 
            $absensi_tgl16 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "16'  ");
            if ($absensi_tgl16->num_rows() > 0) {
                $tgl_16 = $absensi_tgl16->row();
                if ($tgl_16->ket == 'CUTI') {
                    $sheet->getStyle('AW' . $st . ':AX' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AW' . $st . ':AX' . $st)->setCellValue('AW' . $st, '-');
                    $sheet->setCellValue('AX' . $st, $tgl_16->ket);
                } else if ($tgl_16->ket == 'SAKIT') {
                    $sheet->getStyle('AW' . $st . ':AX' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AW' . $st . ':AX' . $st)->setCellValue('AW' . $st, '-');
                    $sheet->setCellValue('AY' . $st, $tgl_16->ket);
                } else {
                    $sheet->setCellValue('AW' . $st, $tgl_16->in_time);
                    $sheet->setCellValue('AX' . $st, $tgl_16->out_time);
                    $sheet->setCellValue('AY' . $st, $tgl_16->ket);
                }
            } else {
                $sheet->setCellValue('AW' . $st, '-');
                $sheet->setCellValue('AX' . $st, '-');
                $sheet->setCellValue('AY' . $st, '-');
            }

            //get tanggal 17 absensi 
            $absensi_tgl17 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "17'  ");
            if ($absensi_tgl17->num_rows() > 0) {
                $tgl_17 = $absensi_tgl17->row();
                if ($tgl_17->ket == 'CUTI') {
                    $sheet->getStyle('AZ' . $st . ':BA' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AZ' . $st . ':BA' . $st)->setCellValue('AZ' . $st, '-');
                    $sheet->setCellValue('BB' . $st, $tgl_17->ket);
                } else if ($tgl_17->ket == 'SAKIT') {
                    $sheet->getStyle('AZ' . $st . ':BA' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('AZ' . $st . ':BA' . $st)->setCellValue('AZ' . $st, '-');
                    $sheet->setCellValue('BB' . $st, $tgl_17->ket);
                } else {
                    $sheet->setCellValue('AZ' . $st, $tgl_17->in_time);
                    $sheet->setCellValue('BA' . $st, $tgl_17->out_time);
                    $sheet->setCellValue('BB' . $st, $tgl_17->ket);
                }
            } else {
                $sheet->setCellValue('AZ' . $st, '-');
                $sheet->setCellValue('BA' . $st, '-');
                $sheet->setCellValue('BB' . $st, '-');
            }


            //get tanggal 18 absensi 
            $absensi_tgl18 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "18'  ");
            if ($absensi_tgl18->num_rows() > 0) {
                $tgl_18 = $absensi_tgl18->row();
                if ($tgl_18->ket == 'CUTI') {
                    $sheet->getStyle('BC' . $st . ':BD' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BC' . $st . ':BD' . $st)->setCellValue('BC' . $st, '-');
                    $sheet->setCellValue('BE' . $st, $tgl_18->ket);
                } else if ($tgl_18->ket == 'SAKIT') {
                    $sheet->getStyle('BC' . $st . ':BD' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BC' . $st . ':BD' . $st)->setCellValue('BC' . $st, '-');
                    $sheet->setCellValue('BE' . $st, $tgl_18->ket);
                } else {
                    $sheet->setCellValue('BC' . $st, $tgl_18->in_time);
                    $sheet->setCellValue('BD' . $st, $tgl_18->out_time);
                    $sheet->setCellValue('BE' . $st, $tgl_18->ket);
                }
            } else {
                $sheet->setCellValue('BC' . $st, '-');
                $sheet->setCellValue('BD' . $st, '-');
                $sheet->setCellValue('BE' . $st, '-');
            }

            //get tanggal 19 absensi 
            $absensi_tgl19 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "19'  ");
            if ($absensi_tgl19->num_rows() > 0) {
                $tgl_19 = $absensi_tgl19->row();
                if ($tgl_19->ket == 'CUTI') {
                    $sheet->getStyle('BF' . $st . ':BG' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BF' . $st . ':BG' . $st)->setCellValue('BF' . $st, '-');
                    $sheet->setCellValue('BH' . $st, $tgl_19->ket);
                } else if ($tgl_19->ket == 'SAKIT') {
                    $sheet->getStyle('BF' . $st . ':BG' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BF' . $st . ':BG' . $st)->setCellValue('BF' . $st, '-');
                    $sheet->setCellValue('BH' . $st, $tgl_19->ket);
                } else {
                    $sheet->setCellValue('BF' . $st, $tgl_19->in_time);
                    $sheet->setCellValue('BG' . $st, $tgl_19->out_time);
                    $sheet->setCellValue('BH' . $st, $tgl_19->ket);
                }
            } else {
                $sheet->setCellValue('BF' . $st, '-');
                $sheet->setCellValue('BG' . $st, '-');
                $sheet->setCellValue('BH' . $st, '-');
            }


            //get tanggal 20 absensi 
            $absensi_tgl20 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "20'  ");
            if ($absensi_tgl20->num_rows() > 0) {
                $tgl_20 = $absensi_tgl20->row();
                if ($tgl_20->ket == 'CUTI') {
                    $sheet->getStyle('BI' . $st . ':BK' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BI' . $st . ':BJ' . $st)->setCellValue('BI' . $st, '-');
                    $sheet->setCellValue('BK' . $st, $tgl_20->ket);
                } else if ($tgl_20->ket == 'SAKIT') {
                    $sheet->getStyle('BI' . $st . ':BJ' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BI' . $st . ':BJ' . $st)->setCellValue('BI' . $st, '-');
                    $sheet->setCellValue('BK' . $st, $tgl_20->ket);
                } else {
                    $sheet->setCellValue('BI' . $st, $tgl_20->in_time);
                    $sheet->setCellValue('BJ' . $st, $tgl_20->out_time);
                    $sheet->setCellValue('BK' . $st, $tgl_20->ket);
                }
            } else {
                $sheet->setCellValue('BI' . $st, '-');
                $sheet->setCellValue('BJ' . $st, '-');
                $sheet->setCellValue('BK' . $st, '-');
            }


            //get tanggal 21 absensi 
            $absensi_tgl21 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "21'  ");
            if ($absensi_tgl21->num_rows() > 0) {
                $tgl_21 = $absensi_tgl21->row();
                if ($tgl_21->ket == 'CUTI') {
                    $sheet->getStyle('BL' . $st . ':BM' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BL' . $st . ':BM' . $st)->setCellValue('BL' . $st, '-');
                    $sheet->setCellValue('BN' . $st, $tgl_21->ket);
                } else if ($tgl_21->ket == 'SAKIT') {
                    $sheet->getStyle('BL' . $st . ':BM' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BL' . $st . ':BM' . $st)->setCellValue('BL' . $st, '-');
                    $sheet->setCellValue('BN' . $st, $tgl_21->ket);
                } else {
                    $sheet->setCellValue('BL' . $st, $tgl_21->in_time);
                    $sheet->setCellValue('BM' . $st, $tgl_21->out_time);
                    $sheet->setCellValue('BN' . $st, $tgl_21->ket);
                }
            } else {
                $sheet->setCellValue('BL' . $st, '-');
                $sheet->setCellValue('BM' . $st, '-');
                $sheet->setCellValue('BN' . $st, '-');
            }


            //get tanggal 22 absensi 
            $absensi_tgl22 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "22'  ");
            if ($absensi_tgl22->num_rows() > 0) {
                $tgl_22 = $absensi_tgl22->row();
                if ($tgl_22->ket == 'CUTI') {
                    $sheet->getStyle('BO' . $st . ':BP' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BO' . $st . ':BP' . $st)->setCellValue('BO' . $st, '-');
                    $sheet->setCellValue('BQ' . $st, $tgl_22->ket);
                } else if ($tgl_22->ket == 'SAKIT') {
                    $sheet->getStyle('BO' . $st . ':BP' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BO' . $st . ':BP' . $st)->setCellValue('BO' . $st, '-');
                    $sheet->setCellValue('BQ' . $st, $tgl_22->ket);
                } else {
                    $sheet->setCellValue('BO' . $st, $tgl_22->in_time);
                    $sheet->setCellValue('BP' . $st, $tgl_22->out_time);
                    $sheet->setCellValue('BQ' . $st, $tgl_22->ket);
                }
            } else {
                $sheet->setCellValue('BO' . $st, '-');
                $sheet->setCellValue('BP' . $st, '-');
                $sheet->setCellValue('BQ' . $st, '-');
            }


            //get tanggal 23 absensi 
            $absensi_tgl23 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "23'  ");
            if ($absensi_tgl23->num_rows() > 0) {
                $tgl_23 = $absensi_tgl23->row();
                if ($tgl_23->ket == 'CUTI') {
                    $sheet->getStyle('BR' . $st . ':BS' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BR' . $st . ':BS' . $st)->setCellValue('BR' . $st, '-');
                    $sheet->setCellValue('BT' . $st, $tgl_23->ket);
                } else if ($tgl_23->ket == 'SAKIT') {
                    $sheet->getStyle('BR' . $st . ':BS' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BR' . $st . ':BS' . $st)->setCellValue('BS' . $st, '-');
                    $sheet->setCellValue('BT' . $st, $tgl_23->ket);
                } else {
                    $sheet->setCellValue('BR' . $st, $tgl_23->in_time);
                    $sheet->setCellValue('BS' . $st, $tgl_23->out_time);
                    $sheet->setCellValue('BT' . $st, $tgl_23->ket);
                }
            } else {
                $sheet->setCellValue('BR' . $st, '-');
                $sheet->setCellValue('BS' . $st, '-');
                $sheet->setCellValue('BT' . $st, '-');
            }


            //get tanggal 24 absensi 
            $absensi_tgl24 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "24'  ");
            if ($absensi_tgl24->num_rows() > 0) {
                $tgl_24 = $absensi_tgl24->row();
                if ($tgl_24->ket == 'CUTI') {
                    $sheet->getStyle('BU' . $st . ':BV' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BU' . $st . ':BV' . $st)->setCellValue('BU' . $st, '-');
                    $sheet->setCellValue('BW' . $st, $tgl_24->ket);
                } else if ($tgl_24->ket == 'SAKIT') {
                    $sheet->getStyle('BU' . $st . ':BV' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BU' . $st . ':BV' . $st)->setCellValue('BU' . $st, '-');
                    $sheet->setCellValue('BW' . $st, $tgl_24->ket);
                } else {
                    $sheet->setCellValue('BU' . $st, $tgl_24->in_time);
                    $sheet->setCellValue('BV' . $st, $tgl_24->out_time);
                    $sheet->setCellValue('BW' . $st, $tgl_24->ket);
                }
            } else {
                $sheet->setCellValue('BU' . $st, '-');
                $sheet->setCellValue('BV' . $st, '-');
                $sheet->setCellValue('BW' . $st, '-');
            }

            //get tanggal 25 absensi 
            $absensi_tgl25 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "25'  ");
            if ($absensi_tgl25->num_rows() > 0) {
                $tgl_25 = $absensi_tgl25->row();
                if ($tgl_25->ket == 'CUTI') {
                    $sheet->getStyle('BX' . $st . ':BY' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BX' . $st . ':BY' . $st)->setCellValue('BX' . $st, '-');
                    $sheet->setCellValue('BZ' . $st, $tgl_25->ket);
                } else if ($tgl_25->ket == 'SAKIT') {
                    $sheet->getStyle('BX' . $st . ':BY' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('BX' . $st . ':BY' . $st)->setCellValue('BX' . $st, '-');
                    $sheet->setCellValue('BZ' . $st, $tgl_25->ket);
                } else {
                    $sheet->setCellValue('BX' . $st, $tgl_25->in_time);
                    $sheet->setCellValue('BY' . $st, $tgl_25->out_time);
                    $sheet->setCellValue('BZ' . $st, $tgl_25->ket);
                }
            } else {
                $sheet->setCellValue('BX' . $st, '-');
                $sheet->setCellValue('BY' . $st, '-');
                $sheet->setCellValue('BZ' . $st, '-');
            }


            //get tanggal 26 absensi 
            $absensi_tgl26 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "26'  ");
            if ($absensi_tgl26->num_rows() > 0) {
                $tgl_26 = $absensi_tgl26->row();
                if ($tgl_26->ket == 'CUTI') {
                    $sheet->getStyle('CA' . $st . ':CB' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CA' . $st . ':CB' . $st)->setCellValue('CA' . $st, '-');
                    $sheet->setCellValue('CC' . $st, $tgl_26->ket);
                } else if ($tgl_26->ket == 'SAKIT') {
                    $sheet->getStyle('CA' . $st . ':CB' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CA' . $st . ':CB' . $st)->setCellValue('CA' . $st, '-');
                    $sheet->setCellValue('CC' . $st, $tgl_26->ket);
                } else {
                    $sheet->setCellValue('CA' . $st, $tgl_26->in_time);
                    $sheet->setCellValue('CB' . $st, $tgl_26->out_time);
                    $sheet->setCellValue('CC' . $st, $tgl_26->ket);
                }
            } else {
                $sheet->setCellValue('CA' . $st, '-');
                $sheet->setCellValue('CB' . $st, '-');
                $sheet->setCellValue('CC' . $st, '-');
            }

            //get tanggal 27 absensi 
            $absensi_tgl27 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "27'  ");
            if ($absensi_tgl27->num_rows() > 0) {
                $tgl_27 = $absensi_tgl27->row();
                if ($tgl_27->ket == 'CUTI') {
                    $sheet->getStyle('CD' . $st . ':CE' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CD' . $st . ':CE' . $st)->setCellValue('CD' . $st, '-');
                    $sheet->setCellValue('CF' . $st, $tgl_27->ket);
                } else if ($tgl_27->ket == 'SAKIT') {
                    $sheet->getStyle('CD' . $st . ':CE' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CD' . $st . ':CE' . $st)->setCellValue('CF' . $st, '-');
                    $sheet->setCellValue('CF' . $st, $tgl_27->ket);
                } else {
                    $sheet->setCellValue('CD' . $st, $tgl_27->in_time);
                    $sheet->setCellValue('CE' . $st, $tgl_27->out_time);
                    $sheet->setCellValue('CF' . $st, $tgl_27->ket);
                }
            } else {
                $sheet->setCellValue('CD' . $st, '-');
                $sheet->setCellValue('CE' . $st, '-');
                $sheet->setCellValue('CF' . $st, '-');
            }

            //get tanggal 28 absensi 
            $absensi_tgl28 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "28'  ");
            if ($absensi_tgl28->num_rows() > 0) {
                $tgl_28 = $absensi_tgl28->row();
                if ($tgl_28->ket == 'CUTI') {
                    $sheet->getStyle('CG' . $st . ':CH' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CG' . $st . ':CH' . $st)->setCellValue('CG' . $st, '-');
                    $sheet->setCellValue('CI' . $st, $tgl_28->ket);
                } else if ($tgl_28->ket == 'SAKIT') {
                    $sheet->getStyle('CG' . $st . ':CH' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CG' . $st . ':CH' . $st)->setCellValue('CI' . $st, '-');
                    $sheet->setCellValue('CI' . $st, $tgl_28->ket);
                } else {
                    $sheet->setCellValue('CG' . $st, $tgl_28->in_time);
                    $sheet->setCellValue('CH' . $st, $tgl_28->out_time);
                    $sheet->setCellValue('CI' . $st, $tgl_28->ket);
                }
            } else {
                $sheet->setCellValue('CG' . $st, '-');
                $sheet->setCellValue('CH' . $st, '-');
                $sheet->setCellValue('CI' . $st, '-');
            }

            //get tanggal 29     absensi 
            $absensi_tgl29 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "29'  ");
            if ($absensi_tgl29->num_rows() > 0) {
                $tgl_29 = $absensi_tgl29->row();
                if ($tgl_29->ket == 'CUTI') {
                    $sheet->getStyle('CJ' . $st . ':CK' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CJ' . $st . ':CK' . $st)->setCellValue('CJ' . $st, '-');
                    $sheet->setCellValue('CL' . $st, $tgl_29->ket);
                } else if ($tgl_29->ket == 'SAKIT') {
                    $sheet->getStyle('CJ' . $st . ':CK' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CJ' . $st . ':CK' . $st)->setCellValue('CJ' . $st, '-');
                    $sheet->setCellValue('CL' . $st, $tgl_29->ket);
                } else {
                    $sheet->setCellValue('CJ' . $st, $tgl_29->in_time);
                    $sheet->setCellValue('CK' . $st, $tgl_29->out_time);
                    $sheet->setCellValue('CL' . $st, $tgl_29->ket);
                }
            } else {
                $sheet->setCellValue('CJ' . $st, '-');
                $sheet->setCellValue('CK' . $st, '-');
                $sheet->setCellValue('CL' . $st, '-');
            }

            //get tanggal 30     absensi 
            $absensi_tgl30 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "30'  ");
            if ($absensi_tgl30->num_rows() > 0) {
                $tgl_30 = $absensi_tgl30->row();
                if ($tgl_30->ket == 'CUTI') {
                    $sheet->getStyle('CM' . $st . ':CN' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CM' . $st . ':CN' . $st)->setCellValue('CM' . $st, '-');
                    $sheet->setCellValue('CO' . $st, $tgl_30->ket);
                } else if ($tgl_30->ket == 'SAKIT') {
                    $sheet->getStyle('CM' . $st . ':CN' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CM' . $st . ':CN' . $st)->setCellValue('CM' . $st, '-');
                    $sheet->setCellValue('CO' . $st, $tgl_30->ket);
                } else {
                    $sheet->setCellValue('CM' . $st, $tgl_30->in_time);
                    $sheet->setCellValue('CN' . $st, $tgl_30->out_time);
                    $sheet->setCellValue('CO' . $st, $tgl_30->ket);
                }
            } else {
                $sheet->setCellValue('CM' . $st, '-');
                $sheet->setCellValue('CN' . $st, '-');
                $sheet->setCellValue('CO' . $st, '-');
            }


            //get tanggal 31     absensi 
            $absensi_tgl31 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt->npk . "' AND in_date = '" . $tahun . '-' . $bulan . '-' . "31'  ");
            if ($absensi_tgl31->num_rows() > 0) {
                $tgl_31 = $absensi_tgl31->row();
                if ($tgl_31->ket == 'CUTI') {
                    $sheet->getStyle('CP' . $st . ':CQ' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CP' . $st . ':CQ' . $st)->setCellValue('CP' . $st, '-');
                    $sheet->setCellValue('CR' . $st, $tgl_31->ket);
                } else if ($tgl_31->ket == 'SAKIT') {
                    $sheet->getStyle('CP' . $st . ':CQ' . $st)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                    $sheet->mergeCells('CP' . $st . ':CQ' . $st)->setCellValue('CP' . $st, '-');
                    $sheet->setCellValue('CR' . $st, $tgl_31->ket);
                } else {
                    $sheet->setCellValue('CP' . $st, $tgl_31->in_time);
                    $sheet->setCellValue('CQ' . $st, $tgl_31->out_time);
                    $sheet->setCellValue('CR' . $st, $tgl_31->ket);
                }
            } else {
                $sheet->setCellValue('CP' . $st, '-');
                $sheet->setCellValue('CQ' . $st, '-');
                $sheet->setCellValue('CR' . $st, '-');
            }


            //hitung total jumlah sakit 
            $kehadiran = $this->db->query("SELECT count(ket) as total_hadir from $tabel where npk = '" . $agt->npk . "' and in_date like '%" . $tahun . "-'  '" . $bulan . "%' and ket = 'HADIR' ");
            if ($kehadiran->num_rows() > 0) {
                $hd = $kehadiran->row();
                $sheet->setCellValue('CS' . $st, $hd->total_hadir);
            }


            $cuti = $this->db->query("SELECT count(ket) as total_cuti from $tabel where npk = '" . $agt->npk . "' and in_date like '%" . $tahun . "-'  '" . $bulan . "%' and ket = 'CUTI' ");
            if ($cuti->num_rows() > 0) {
                $ct = $cuti->row();
                $sheet->setCellValue('CU' . $st, $ct->total_cuti);
            }

            $sakit = $this->db->query("SELECT count(ket) as total_sakit from $tabel where npk = '" . $agt->npk . "' and in_date like '%" . $tahun . "-'  '" . $bulan . "%' and ket = 'SAKIT' ");
            if ($sakit->num_rows() > 0) {
                $sk = $sakit->row();
                $sheet->setCellValue('CT' . $st, $sk->total_sakit);
            }
            $st++;
        }

        $sheet->getStyle('A1:CU' . $st - 1)->applyFromArray($styleArray);
        $sheet->freezePane('D4');




        //overtime
        $spreadsheet->createSheet();
        // Add some data
        $sheet2 =  $spreadsheet->setActiveSheetIndex(1);
        $sheet2->getStyle('A1:BO3')->applyFromArray($styleArray2);


        //warnain headers
        $sheet2->getStyle('A5:AG6')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('00FF7F');

        //bold  headers
        $sheet2->getStyle('A1:BO3')
            ->getFont()
            ->setSize(11)
            ->setBold(true);

        //title sheet
        $sheet2->setTitle('Overtime-' . ucfirst($month));
        $sheet2->getColumnDimension('A')->setAutoSize(TRUE);
        $sheet2->mergeCells('A1:A3')->setCellValue('A1', 'Nama');
        $sheet2->mergeCells('B1:B3')->setCellValue('B1', 'NPK');
        $sheet2->mergeCells('C1:C3')->setCellValue('C1', 'Instalasi');
        $sheet2->mergeCells('D1:BM1')->setCellValue('D1', $this->bulan($bulan));
        $sheet2->mergeCells('D2:E2')->setCellValue('D2', '1');
        $sheet2->setCellValue("D3", "IN OT");
        $sheet2->setCellValue("E3", "OUT OT");
        $sheet2->mergeCells('F2:G2')->setCellValue('F2', '2');
        $sheet2->setCellValue("F3", "IN OT");
        $sheet2->setCellValue("G3", "OUT OT");
        $sheet2->mergeCells('H2:I2')->setCellValue('H2', '3');
        $sheet2->setCellValue("H3", "IN OT");
        $sheet2->setCellValue("I3", "OUT OT");
        $sheet2->mergeCells('J2:K2')->setCellValue('J2', '4');
        $sheet2->setCellValue("J3", "IN OT");
        $sheet2->setCellValue("K3", "OUT OT");
        $sheet2->mergeCells('L2:M2')->setCellValue('L2', '5');
        $sheet2->setCellValue("L3", "IN OT");
        $sheet2->setCellValue("M3", "OUT OT");
        $sheet2->mergeCells('N2:O2')->setCellValue('N2', '6');
        $sheet2->setCellValue("N3", "IN OT");
        $sheet2->setCellValue("O3", "OUT OT");
        $sheet2->mergeCells('P2:Q2')->setCellValue('P2', '7');
        $sheet2->setCellValue("P3", "IN OT");
        $sheet2->setCellValue("Q3", "OUT OT");
        $sheet2->mergeCells('R2:S2')->setCellValue('R2', '8');
        $sheet2->setCellValue("R3", "IN OT");
        $sheet2->setCellValue("S3", "OUT OT");
        $sheet2->mergeCells('T2:U2')->setCellValue('T2', '9');
        $sheet2->setCellValue("T3", "IN OT");
        $sheet2->setCellValue("U3", "OUT OT");
        $sheet2->mergeCells('V2:W2')->setCellValue('V2', '10');
        $sheet2->setCellValue("V3", "IN OT");
        $sheet2->setCellValue("W3", "OUT OT");
        $sheet2->mergeCells('X2:Y2')->setCellValue('X2', '11');
        $sheet2->setCellValue("X3", "IN OT");
        $sheet2->setCellValue("Y3", "OUT OT");
        $sheet2->mergeCells('Z2:AA2')->setCellValue('Z2', '12');
        $sheet2->setCellValue("Z3", "IN OT");
        $sheet2->setCellValue("AA3", "OUT OT");
        $sheet2->mergeCells('AB2:AC2')->setCellValue('AB2', '13');
        $sheet2->setCellValue("AB3", "IN OT");
        $sheet2->setCellValue("AC3", "OUT OT");
        $sheet2->mergeCells('AD2:AE2')->setCellValue('AD2', '14');
        $sheet2->setCellValue("AD3", "IN OT");
        $sheet2->setCellValue("AE3", "OUT OT");
        $sheet2->mergeCells('AF2:AG2')->setCellValue('AF2', '15');
        $sheet2->setCellValue("AF3", "IN OT");
        $sheet2->setCellValue("AG3", "OUT OT");
        $sheet2->mergeCells('AH2:AI2')->setCellValue('AH2', '16');
        $sheet2->setCellValue("AH3", "IN OT");
        $sheet2->setCellValue("AI3", "OUT OT");
        $sheet2->mergeCells('AJ2:AK2')->setCellValue('AJ2', '17');
        $sheet2->setCellValue("AJ3", "IN OT");
        $sheet2->setCellValue("AK3", "OUT OT");
        $sheet2->mergeCells('AL2:AM2')->setCellValue('AL2', '18');
        $sheet2->setCellValue("AL3", "IN OT");
        $sheet2->setCellValue("AM3", "OUT OT");
        $sheet2->mergeCells('AN2:AO2')->setCellValue('AN2', '19');
        $sheet2->setCellValue("AN3", "IN OT");
        $sheet2->setCellValue("AO3", "OUT OT");
        $sheet2->mergeCells('AP2:AQ2')->setCellValue('AP2', '20');
        $sheet2->setCellValue("AP3", "IN OT");
        $sheet2->setCellValue("AQ3", "OUT OT");
        $sheet2->mergeCells('AR2:AS2')->setCellValue('AR2', '21');
        $sheet2->setCellValue("AR3", "IN OT");
        $sheet2->setCellValue("AS3", "OUT OT");
        $sheet2->mergeCells('AT2:AU2')->setCellValue('AT2', '22');
        $sheet2->setCellValue("AT3", "IN OT");
        $sheet2->setCellValue("AU3", "OUT OT");
        $sheet2->mergeCells('AV2:AW2')->setCellValue('AV2', '23');
        $sheet2->setCellValue("AV3", "IN OT");
        $sheet2->setCellValue("AW3", "OUT OT");
        $sheet2->mergeCells('AX2:AY2')->setCellValue('AX2', '24');
        $sheet2->setCellValue("AX3", "IN OT");
        $sheet2->setCellValue("AY3", "OUT OT");
        $sheet2->mergeCells('AZ2:BA2')->setCellValue('AZ2', '25');
        $sheet2->setCellValue("AZ3", "IN OT");
        $sheet2->setCellValue("BA3", "OUT OT");
        $sheet2->mergeCells('BB2:BC2')->setCellValue('BB2', '26');
        $sheet2->setCellValue("BB3", "IN OT");
        $sheet2->setCellValue("BC3", "OUT OT");
        $sheet2->mergeCells('BD2:BE2')->setCellValue('BD2', '27');
        $sheet2->setCellValue("BD3", "IN OT");
        $sheet2->setCellValue("BE3", "OUT OT");
        $sheet2->mergeCells('BF2:BG2')->setCellValue('BF2', '28');
        $sheet2->setCellValue("BF3", "IN OT");
        $sheet2->setCellValue("BG3", "OUT OT");
        $sheet2->mergeCells('BH2:BI2')->setCellValue('BH2', '29');
        $sheet2->setCellValue("BH3", "IN OT");
        $sheet2->setCellValue("BI3", "OUT OT");
        $sheet2->mergeCells('BJ2:BK2')->setCellValue('BJ2', '30');
        $sheet2->setCellValue("BJ3", "IN OT");
        $sheet2->setCellValue("BK3", "OUT OT");
        $sheet2->mergeCells('BL2:BM2')->setCellValue('BL2', '31');
        $sheet2->setCellValue("BL3", "IN OT");
        $sheet2->setCellValue("BM3", "OUT OT");

        $st_ = 4;
        foreach ($anggota->result() as $agt_) {
            $sheet2->setCellValue('A' . $st_, $agt_->nama);
            $sheet2->setCellValue('B' . $st_, $agt_->npk);
            $sheet2->setCellValue('C' . $st_, $agt_->area_kerja);


            //get tanggal 1 absensi 
            $absensi_tgl1 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "01'  ");
            if ($absensi_tgl1->num_rows() > 0) {
                $tgl_1 = $absensi_tgl1->row();
                $sheet2->setCellValue('D' . $st_, $tgl_1->over_time_start);
                $sheet2->setCellValue('E' . $st_, $tgl_1->over_time_end);
            }

            //get tanggal 2 absensi 
            $absensi_tgl2 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "02'  ");
            if ($absensi_tgl2->num_rows() > 0) {
                $tgl_2 = $absensi_tgl2->row();
                $sheet2->setCellValue('F' . $st_, $tgl_2->over_time_start);
                $sheet2->setCellValue('G' . $st_, $tgl_2->over_time_end);
            }

            //get tanggal 3 absensi 
            $absensi_tgl3 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "03'  ");
            if ($absensi_tgl3->num_rows() > 0) {
                $tgl_3 = $absensi_tgl3->row();
                $sheet2->setCellValue('H' . $st_, $tgl_3->over_time_start);
                $sheet2->setCellValue('I' . $st_, $tgl_3->over_time_end);
            }

            //get tanggal 4 absensi 
            $absensi_tgl4 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "04'  ");
            if ($absensi_tgl4->num_rows() > 0) {
                $tgl_4 = $absensi_tgl4->row();
                $sheet2->setCellValue('J' . $st_, $tgl_4->over_time_start);
                $sheet2->setCellValue('K' . $st_, $tgl_4->over_time_end);
            }

            //get tanggal 5 absensi 
            $absensi_tgl5 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "05'  ");
            if ($absensi_tgl5->num_rows() > 0) {
                $tgl_5 = $absensi_tgl5->row();
                $sheet2->setCellValue('L' . $st_, $tgl_5->over_time_start);
                $sheet2->setCellValue('M' . $st_, $tgl_5->over_time_end);
            }


            //get tanggal 6 absensi 
            $absensi_tgl6 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "06'  ");
            if ($absensi_tgl6->num_rows() > 0) {
                $tgl_6 = $absensi_tgl6->row();
                $sheet2->setCellValue('N' . $st_, $tgl_6->over_time_start);
                $sheet2->setCellValue('O' . $st_, $tgl_6->over_time_end);
            }

            //get tanggal 7 absensi 
            $absensi_tgl7 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "07'  ");
            if ($absensi_tgl7->num_rows() > 0) {
                $tgl_7 = $absensi_tgl7->row();
                $sheet2->setCellValue('P' . $st_, $tgl_7->over_time_start);
                $sheet2->setCellValue('Q' . $st_, $tgl_7->over_time_end);
            }


            //get tanggal 8 absensi 
            $absensi_tgl8 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "08'  ");
            if ($absensi_tgl8->num_rows() > 0) {
                $tgl_8 = $absensi_tgl8->row();
                $sheet2->setCellValue('R' . $st_, $tgl_8->over_time_start);
                $sheet2->setCellValue('S' . $st_, $tgl_8->over_time_end);
            }


            //get tanggal 9 absensi 
            $absensi_tgl9 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "09'  ");
            if ($absensi_tgl9->num_rows() > 0) {
                $tgl_9 = $absensi_tgl9->row();
                $sheet2->setCellValue('T' . $st_, $tgl_9->over_time_start);
                $sheet2->setCellValue('U' . $st_, $tgl_9->over_time_end);
            }


            //get tanggal 10 absensi 
            $absensi_tgl10 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "10'  ");
            if ($absensi_tgl10->num_rows() > 0) {
                $tgl_10 = $absensi_tgl10->row();
                $sheet2->setCellValue('V' . $st_, $tgl_10->over_time_start);
                $sheet2->setCellValue('W' . $st_, $tgl_10->over_time_end);
            }

            //get tanggal 11 absensi 
            $absensi_tgl11 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "11'  ");
            if ($absensi_tgl11->num_rows() > 0) {
                $tgl_11 = $absensi_tgl11->row();
                $sheet2->setCellValue('X' . $st_, $tgl_11->over_time_start);
                $sheet2->setCellValue('Y' . $st_, $tgl_11->over_time_end);
            }

            //get tanggal 12 absensi 
            $absensi_tgl12 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "12'  ");
            if ($absensi_tgl12->num_rows() > 0) {
                $tgl_12 = $absensi_tgl12->row();
                $sheet2->setCellValue('Z' . $st_, $tgl_12->over_time_start);
                $sheet2->setCellValue('AA' . $st_, $tgl_12->over_time_end);
            }


            //get tanggal 13 absensi 
            $absensi_tgl13 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "13'  ");
            if ($absensi_tgl13->num_rows() > 0) {
                $tgl_13 = $absensi_tgl13->row();
                $sheet2->setCellValue('AB' . $st_, $tgl_13->over_time_start);
                $sheet2->setCellValue('AC' . $st_, $tgl_13->over_time_end);
            }


            //get tanggal 14 absensi 
            $absensi_tgl14 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "14'  ");
            if ($absensi_tgl14->num_rows() > 0) {
                $tgl_14 = $absensi_tgl14->row();
                $sheet2->setCellValue('AD' . $st_, $tgl_14->over_time_start);
                $sheet2->setCellValue('AE' . $st_, $tgl_14->over_time_end);
            }

            //get tanggal 15 absensi 
            $absensi_tgl15 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "15'  ");
            if ($absensi_tgl15->num_rows() > 0) {
                $tgl_15 = $absensi_tgl15->row();
                $sheet2->setCellValue('AF' . $st_, $tgl_15->over_time_start);
                $sheet2->setCellValue('AG' . $st_, $tgl_15->over_time_end);
            }

            //get tanggal 16 absensi 
            $absensi_tgl16 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "16'  ");
            if ($absensi_tgl16->num_rows() > 0) {
                $tgl_16 = $absensi_tgl16->row();
                $sheet2->setCellValue('AH' . $st_, $tgl_16->over_time_start);
                $sheet2->setCellValue('AI' . $st_, $tgl_16->over_time_end);
            }


            //get tanggal 17 absensi 
            $absensi_tgl17 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "17'  ");
            if ($absensi_tgl17->num_rows() > 0) {
                $tgl_17 = $absensi_tgl17->row();
                $sheet2->setCellValue('AJ' . $st_, $tgl_17->over_time_start);
                $sheet2->setCellValue('AK' . $st_, $tgl_17->over_time_end);
            }


            //get tanggal 18 absensi 
            $absensi_tgl18 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "18'  ");
            if ($absensi_tgl18->num_rows() > 0) {
                $tgl_18 = $absensi_tgl18->row();
                $sheet2->setCellValue('AL' . $st_, $tgl_18->over_time_start);
                $sheet2->setCellValue('AM' . $st_, $tgl_18->over_time_end);
            }


            //get tanggal 19 absensi 
            $absensi_tgl19 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "19'  ");
            if ($absensi_tgl19->num_rows() > 0) {
                $tgl_19 = $absensi_tgl19->row();
                $sheet2->setCellValue('AN' . $st_, $tgl_19->over_time_start);
                $sheet2->setCellValue('AO' . $st_, $tgl_19->over_time_end);
            }

            //get tanggal 20 absensi 
            $absensi_tgl20 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "20'  ");
            if ($absensi_tgl20->num_rows() > 0) {
                $tgl_20 = $absensi_tgl20->row();
                $sheet2->setCellValue('AP' . $st_, $tgl_20->over_time_start);
                $sheet2->setCellValue('AQ' . $st_, $tgl_20->over_time_end);
            }

            //get tanggal 21 absensi 
            $absensi_tgl21 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "21'  ");
            if ($absensi_tgl21->num_rows() > 0) {
                $tgl_21 = $absensi_tgl21->row();
                $sheet2->setCellValue('AR' . $st_, $tgl_21->over_time_start);
                $sheet2->setCellValue('AS' . $st_, $tgl_21->over_time_end);
            }

            //get tanggal 22 absensi 
            $absensi_tgl22 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "22'  ");
            if ($absensi_tgl22->num_rows() > 0) {
                $tgl_22 = $absensi_tgl22->row();
                $sheet2->setCellValue('AT' . $st_, $tgl_22->over_time_start);
                $sheet2->setCellValue('AU' . $st_, $tgl_22->over_time_end);
            }


            //get tanggal 23 absensi 
            $absensi_tgl23 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "23'  ");
            if ($absensi_tgl23->num_rows() > 0) {
                $tgl_23 = $absensi_tgl23->row();
                $sheet2->setCellValue('AV' . $st_, $tgl_23->over_time_start);
                $sheet2->setCellValue('AW' . $st_, $tgl_23->over_time_end);
            }

            //get tanggal 24 absensi 
            $absensi_tgl24 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "24'  ");
            if ($absensi_tgl24->num_rows() > 0) {
                $tgl_24 = $absensi_tgl24->row();
                $sheet2->setCellValue('AX' . $st_, $tgl_24->over_time_start);
                $sheet2->setCellValue('AY' . $st_, $tgl_24->over_time_end);
            }

            //get tanggal 25 absensi 
            $absensi_tgl25 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "25'  ");
            if ($absensi_tgl25->num_rows() > 0) {
                $tgl_25 = $absensi_tgl25->row();
                $sheet2->setCellValue('AZ' . $st_, $tgl_25->over_time_start);
                $sheet2->setCellValue('BA' . $st_, $tgl_25->over_time_end);
            }


            //get tanggal 26 absensi 
            $absensi_tgl26 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "26'  ");
            if ($absensi_tgl26->num_rows() > 0) {
                $tgl_26 = $absensi_tgl26->row();
                $sheet2->setCellValue('BB' . $st_, $tgl_26->over_time_start);
                $sheet2->setCellValue('BC' . $st_, $tgl_26->over_time_end);
            }


            //get tanggal 27 absensi 
            $absensi_tgl27 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "27'  ");
            if ($absensi_tgl27->num_rows() > 0) {
                $tgl_27 = $absensi_tgl27->row();
                $sheet2->setCellValue('BD' . $st_, $tgl_27->over_time_start);
                $sheet2->setCellValue('BE' . $st_, $tgl_27->over_time_end);
            }


            //get tanggal 28 absensi 
            $absensi_tgl28 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "28'  ");
            if ($absensi_tgl28->num_rows() > 0) {
                $tgl_28 = $absensi_tgl28->row();
                $sheet2->setCellValue('BF' . $st_, $tgl_28->over_time_start);
                $sheet2->setCellValue('BG' . $st_, $tgl_28->over_time_end);
            }

            //get tanggal 29 absensi 
            $absensi_tgl29 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "29'  ");
            if ($absensi_tgl29->num_rows() > 0) {
                $tgl_29 = $absensi_tgl29->row();
                $sheet2->setCellValue('BH' . $st_, $tgl_29->over_time_start);
                $sheet2->setCellValue('BI' . $st_, $tgl_29->over_time_end);
            }

            //get tanggal 30 absensi 
            $absensi_tgl30 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "30'  ");
            if ($absensi_tgl30->num_rows() > 0) {
                $tgl_30 = $absensi_tgl30->row();
                $sheet2->setCellValue('BJ' . $st_, $tgl_30->over_time_start);
                $sheet2->setCellValue('BK' . $st_, $tgl_30->over_time_end);
            }

            //get tanggal 31 absensi 
            $absensi_tgl31 =  $this->db->query("SELECT * FROM  $tabel WHERE  npk = '" . $agt_->npk . "'  AND in_date = '" . $tahun . '-' . $bulan . '-' . "31'  ");
            if ($absensi_tgl31->num_rows() > 0) {
                $tgl_31 = $absensi_tgl31->row();
                $sheet2->setCellValue('BL' . $st_, $tgl_31->over_time_start);
                $sheet2->setCellValue('BM' . $st_, $tgl_31->over_time_end);
            }

            $st_++;
        }

        $sheet2->freezePane('C4');
        $sheet2->getStyle('A1:BM' . $st - 1)->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
