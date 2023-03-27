<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportProfiling extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role_id');
    //   if(empty($role)){
    //     $this->session->userdata("logout","Sesi Berakhir");
    //     redirect('Login');
    //   }elseif($role != 9 ){
    //       redirect("LogOut");
    //   }    
  }

  function index()
  {     
        $filename = "Profiling" . date('Y-m-d');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'REPORT PROFILING');
        $sheet->setCellValue('A2', 'I - SECURITY');
        $sheet->setCellValue('A3', date('Y-m-d'));

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin'],
            ],
            'color' => [
                'argb' => ['#f7df07'],
            ],
        ];
        $styleValue = [
            
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin'],
            ],
            'color' => [
                'argb' => ['#f7df07'],
            ],
        ];
    
        $sheet->mergeCells('A6:A7');
        $sheet->mergeCells('B6:B7');
        $sheet->mergeCells('C6:C7');
        $sheet->mergeCells('D6:D7');
        $sheet->mergeCells('E6:E7');
        $sheet->mergeCells('F6:F7');
        $sheet->mergeCells('G6:G7');
        $sheet->mergeCells('H6:H7');
        $sheet->mergeCells('I6:I7');
        $sheet->mergeCells('J6:J7');
        $sheet->mergeCells('K6:K7');
        $sheet->mergeCells('L6:L7');
        $sheet->mergeCells('M6:M7');
        $sheet->mergeCells('N6:N7');
        $sheet->mergeCells('O6:O7');
        $sheet->mergeCells('V6:AB6');
        $sheet->mergeCells('AC6:AC7');
        $sheet->mergeCells('AD6:AD7');
        $sheet->mergeCells('AE6:AE7');
        $sheet->mergeCells('AF6:AF7');
        $sheet->mergeCells('AG6:AG7');
        $sheet->mergeCells('AH6:AH7');
        $sheet->getStyle('A6:AG7')->applyFromArray($styleArray);
        $sheet->getStyle('A8:AG391')->applyFromArray($styleValue);
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'AREA KERJA');
        $sheet->setCellValue('C6', 'WILAYAH');
        $sheet->setCellValue('D6', 'GOLONGAN DARAH');
        $sheet->setCellValue('E6', 'NPK');
        $sheet->setCellValue('F6', 'NAMA');
        $sheet->setCellValue('G6', 'NO KTP');
        $sheet->setCellValue('H6', 'NO KK');
        $sheet->setCellValue('I6', 'EMAIL');
        $sheet->setCellValue('J6', 'NO HANDPHONE');
        $sheet->setCellValue('K6', 'NO DARURAT');
        $sheet->setCellValue('L6', 'TINGGI BADAN');
        $sheet->setCellValue('M6', 'BERAT BADAN');
        $sheet->setCellValue('N6', 'NILAI IMT');
        $sheet->setCellValue('O6', 'KETERANG IMT');
        $sheet->setCellValue('P6', 'ALAMAT KTP');
        $sheet->setCellValue('Q6', 'ALAMAT DOMISILI');
        $sheet->setCellValue('R7', 'ALAMAT');
        $sheet->setCellValue('S7', 'RT');
        $sheet->setCellValue('T7', 'RW');
        $sheet->setCellValue('U7', 'KELURAHAN');
        $sheet->setCellValue('V7', 'KECAMATAN');
        $sheet->setCellValue('W7', 'KOTA/KABUPATEN');
        $sheet->setCellValue('X7', 'PROVINSI');
        $sheet->setCellValue('Y7', 'ALAMAT');
        $sheet->setCellValue('Z7', 'RT');
        $sheet->setCellValue('AA7', 'RW');
        $sheet->setCellValue('AB7', 'KELURAHAN');
        $sheet->setCellValue('AC7', 'KECAMATAN');
        $sheet->setCellValue('AD7', 'KOTA/KABUPATEN');
        $sheet->setCellValue('AE7', 'PROVINSI');
        $sheet->setCellValue('AF6', 'NO REG KTA');
        $sheet->setCellValue('AG6', 'EXPIRED KTA');
        $sheet->setCellValue('AH6', 'STATUS KTA');
        $sheet->setCellValue('AI6', 'FOTO PROFIL');


         $export = $this->Super_model->ExportProfiling();
		// echo '<pre>';
        // var_dump($export);
        
        	$no = 1;
			$x = 8;
			foreach($export as $row)
			{
				$sheet->setCellValue('A'.$x, $no++);
				$sheet->setCellValue('B'.$x, $row->area_kerja);
				$sheet->setCellValue('C'.$x, $row->wilayah);
				$sheet->setCellValue('D'.$x, $row->gol_darah);
				$sheet->setCellValue('E'.$x, $row->npk);
				$sheet->setCellValue('F'.$x, $row->nama);
				$sheet->setCellValue('G'.$x, $row->ktp);
				$sheet->setCellValue('H'.$x, $row->kk);
				$sheet->setCellValue('I'.$x, $row->email);
				$sheet->setCellValue('J'.$x, $row->no_hp);
				$sheet->setCellValue('K'.$x, $row->no_emergency);
				$sheet->setCellValue('L'.$x, $row->tinggi_badan);
				$sheet->setCellValue('M'.$x, $row->berat_badan);
				$sheet->setCellValue('N'.$x, $row->imt);
				$sheet->setCellValue('O'.$x, $row->keterangan);
				$sheet->setCellValue('P'.$x, $row->jl_ktp);
				$sheet->setCellValue('Q'.$x, $row->rt_ktp);
				$sheet->setCellValue('R'.$x, $row->rw_ktp);
				$sheet->setCellValue('S'.$x, $row->kel_ktp);
				$sheet->setCellValue('T'.$x, $row->kec_ktp);
				$sheet->setCellValue('U'.$x, $row->kota_ktp);
				$sheet->setCellValue('V'.$x, $row->provinsi_ktp);
				$sheet->setCellValue('W'.$x, $row->jl_dom);
				$sheet->setCellValue('X'.$x, $row->rt_dom);
				$sheet->setCellValue('Y'.$x, $row->rw_dom);
				$sheet->setCellValue('Z'.$x, $row->kel_dom);
				$sheet->setCellValue('AA'.$x, $row->kec_dom);
				$sheet->setCellValue('AB'.$x, $row->kota_dom);
				$sheet->setCellValue('AC'.$x, $row->provinsi_dom);
				$sheet->setCellValue('AD'.$x, $row->no_kta);
				$sheet->setCellValue('AE'.$x, $row->expired_kta);
				$sheet->setCellValue('AF'.$x, $row->status_kta);
				$sheet->setCellValue('AG'.$x, $row->foto);
				

				$x++;
			}

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
  }
    
    
    public function versi2(){

        $filename = "Profiling" . date('Y-m-d');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'REPORT PROFILING');
        $sheet->setCellValue('A2', 'I - SECURITY');
        $sheet->setCellValue('A3', date('Y-m-d'));



        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin'],
            ],
            'color' => [
                'argb' => ['#f7df07'],
            ],
        ];
        
        $styleArray2 = [
            'font' => [
                'bold' => false,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin'],
            ],
            'color' => [
                'argb' => ['#f7df07'],
            ],
        ];

        $styleValue = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin'],
            ],
            'color' => [
                'argb' => ['#f7df07'],
            ],
        ];

        $sheet->getColumnDimension('A')->setAutoSize(TRUE);
        $sheet->getColumnDimension('B')->setAutoSize(TRUE);
        $sheet->getColumnDimension('C')->setAutoSize(TRUE);
        $sheet->getStyle('A6:AI6')->applyFromArray($styleArray);
        // $sheet->getStyle('A8:AG391')->applyFromArray($styleValue);
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'AREA KERJA');
        $sheet->setCellValue('C6', 'WILAYAH');
        $sheet->setCellValue('D6', 'GOLONGAN DARAH');
        $sheet->setCellValue('E6', 'NPK');
        $sheet->setCellValue('F6', 'NAMA');
        $sheet->setCellValue('G6', 'TANGGAL LAHIR');
        $sheet->setCellValue('H6', 'NO KTP');
        $sheet->setCellValue('I6', 'NO KK');
        $sheet->setCellValue('J6', 'EMAIL');
        $sheet->setCellValue('K6', 'NO HANDPHONE');
        $sheet->setCellValue('L6', 'NO DARURAT');
        $sheet->setCellValue('M6', 'TINGGI BADAN');
        $sheet->setCellValue('N6', 'BERAT BADAN');
        $sheet->setCellValue('O6', 'NILAI IMT');
        $sheet->setCellValue('P6', 'KETERANG IMT');
        $sheet->setCellValue('Q6', 'ALAMAT KTP');
        $sheet->setCellValue('R6', 'ALAMAT DOMISILI');
        $sheet->setCellValue('S6', 'ALAMAT');
        $sheet->setCellValue('T6', 'RT');
        $sheet->setCellValue('U6', 'RW');
        $sheet->setCellValue('V6', 'KELURAHAN');
        $sheet->setCellValue('W6', 'KECAMATAN');
        $sheet->setCellValue('X6', 'KOTA/KABUPATEN');
        $sheet->setCellValue('Y6', 'PROVINSI');
        $sheet->setCellValue('Z6', 'ALAMAT');
        $sheet->setCellValue('AA6', 'RT');
        $sheet->setCellValue('AB6', 'RW');
        $sheet->setCellValue('AC6', 'KELURAHAN');
        $sheet->setCellValue('AD6', 'KECAMATAN');
        $sheet->setCellValue('AE6', 'KOTA/KABUPATEN');
        $sheet->setCellValue('AF6', 'PROVINSI');
        $sheet->setCellValue('AG6', 'NO REG KTA');
        $sheet->setCellValue('AH6', 'EXPIRED KTA');
        $sheet->setCellValue('AI6', 'JABATAN');


        $export = $this->db->query('SELECT b.nama,b.npk , b.`tanggal_lahir`  , e.`area_kerja` , e.`wilayah` , b.`gol_darah` , b.`ktp` , b.kk , b.`email` , b.`no_hp` ,
b.`no_emergency` , b.`tinggi_badan` , b.`berat_badan` , b.`imt` , b.`keterangan` , b.`jl_ktp` , b.`rt_ktp` , b.`rw_ktp`,
b.`kel_ktp` , b.`kec_ktp` , b.`kota_ktp` , b.`provinsi_ktp` , 
b.`rt_dom` , b.`rw_dom`   , b.`jl_dom` , b.`kel_dom` , b.`kec_dom` , b.`kota_dom` , b.`provinsi_dom` ,
e.`no_kta` , e.`expired_kta` , e.`jabatan` , e.`status_kta`  , br.`foto` 
   FROM `biodata` b ,`employee` e , `berkas` br
   WHERE b.`id_biodata` = e.`id_employee`  AND e.`id_employee` = br.`id_berkas`  AND
   (e.`jabatan` != "MANAGER" OR e.`jabatan` != "SUPERVISOR" OR e.`jabatan` != "PIC" ) AND b.`nama` != "SUPERADMIN" AND b.status = 1 and e.status = 1
   ORDER BY b.`nama` ASC');
        // echo '<pre>';
        // var_dump($export);



        $no = 1;
        $x = 7;
        foreach ($export->result() as $row) {

            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->area_kerja);
            $sheet->setCellValue('C' . $x, $row->wilayah);
            $sheet->setCellValue('D' . $x, $row->gol_darah);
            $sheet->setCellValue('E' . $x, $row->npk);
            $sheet->setCellValue('F' . $x, $row->nama);
            $sheet->setCellValue('G' . $x, $row->tanggal_lahir);
            $sheet->setCellValue('H' . $x, $row->ktp);
            $sheet->setCellValue('I' . $x, $row->kk);
            $sheet->setCellValue('J' . $x, $row->email);
            $sheet->setCellValue('K' . $x, $row->no_hp);
            $sheet->setCellValue('L' . $x, $row->no_emergency);
            $sheet->setCellValue('M' . $x, $row->tinggi_badan);
            $sheet->setCellValue('N' . $x, $row->berat_badan);
            $sheet->setCellValue('O' . $x, $row->imt);
            $sheet->setCellValue('P' . $x, $row->keterangan);
            $sheet->setCellValue('Q' . $x, $row->jl_ktp);
            $sheet->setCellValue('R' . $x, $row->jl_dom);
            $sheet->setCellValue('S' . $x, "");
            $sheet->setCellValue('T'. $x , $row->rt_ktp );
            $sheet->setCellValue('U'. $x , $row->rw_ktp);
            $sheet->setCellValue('V'. $x , $row->kel_ktp);
            $sheet->setCellValue('W'. $x , $row->kec_ktp);
            $sheet->setCellValue('X'. $x ,$row->kota_ktp);
            $sheet->setCellValue('Y'. $x ,$row->provinsi_ktp);
            $sheet->setCellValue('Z'.$x, '');
            $sheet->setCellValue('AA'. $x , $row->rt_dom);
            $sheet->setCellValue('AB'. $x , $row->rw_dom);
            $sheet->setCellValue('AC'. $x ,$row->kel_dom);
            $sheet->setCellValue('AD'. $x ,$row->kec_dom);
            $sheet->setCellValue('AE'. $x , $row->kota_dom);
            $sheet->setCellValue('AF'. $x , $row->provinsi_dom);
            $sheet->setCellValue('AG'. $x ,$row->no_kta);
            $sheet->setCellValue('AH'. $x , $row->expired_kta);
            $sheet->setCellValue('AI'. $x , $row->jabatan);

            $x++;
        }


        $sheet->getStyle('A7:AI'. $x)->applyFromArray($styleArray2);
        $sheet->freezePane('D8');
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}


?>