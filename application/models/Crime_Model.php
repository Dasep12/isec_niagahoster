<?php


class Crime_Model extends CI_Model
{

    // data crime per kategori kasus selaama satu tahun
    private function crimePerJenisKasus($kat, $date, $kota)
    {
        if ($kota == 'Jakarta Utara') {
            $query = $this->db->query("SELECT COUNT(kategori)AS total  FROM 
            tb_crime 
            WHERE kategori = '" . $kat . "' AND  DATE_FORMAT(tanggal , '%Y-%m') = '" . $date . "'
            AND kota = '" . $kota . "' AND (kec='Penjaringan' or  kec = 'Koja' or kec = 'tanjung priok' or kec='pademangan' or kec ='cilincing' or kec = 'kelapa gading')
            GROUP BY kategori
            ");
        } else {
            $query = $this->db->query("SELECT COUNT(kategori)AS total  FROM 
            tb_crime 
            WHERE kategori = '" . $kat . "' AND  DATE_FORMAT(tanggal , '%Y-%m') = '" . $date . "'
            AND kota = '" . $kota . "' 
            GROUP BY kategori
            ");
        }
        // AND (kec='Teluk Jambe Barat' or  kec = 'Teluk Jambe Timur' or kec = 'Klari' or kec='Ciampel' or kec ='Majalaya' or kec = 'Karawang Barat' or kec='Karawang Timur' )
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->total;
        } else {
            return 0;
        }
    }
    public function crimePerJenisKasusSetahun($kat, $kota)
    {
        $data_item = array();
        for ($i = 1; $i <= 12; $i++) {
            $p = $i <= 9 ? '0' . $i :  $i;
            $date = date('Y-') . $p;
            $data_item[] = array(
                'total' => $this->crimePerJenisKasus($kat, $date, $kota)
            );
        }
        return implode(', ', array_map(function ($entry) {
            return ($entry[key($entry)]);
        }, $data_item));
    }
    // 
    // data crime per area kecamatan selama setahun 
    private function crimeKecamatan($area, $date, $kota)
    {

        $query = $this->db->query("
        SELECT COUNT(kec) as total FROM tb_crime WHERE kota ='" . $kota . "' AND kec='" . $area . "' AND DATE_FORMAT(tanggal,'%Y-%m') = '" . $date . "'
        AND (kategori = 'perjudian' OR kategori = 'narkoba' OR kategori= 'penggelapan' OR kategori = 'pencurian' OR kategori='kekerasan' )
        ");

        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->total;
        } else {
            return 0;
        }
    }
    public function crimePerKecamatanSetahun($area, $kota)
    {
        $data_item = array();
        for ($i = 1; $i <= 12; $i++) {
            $p = $i <= 9 ? '0' . $i :  $i;
            $date = date('Y-') . $p;
            $data_item[] = array(
                'total' => $this->crimeKecamatan($area, $date, $kota)
            );
        }
        return implode(', ', array_map(function ($entry) {
            return ($entry[key($entry)]);
        }, $data_item));
    }
    // 

    // total data crime selama setahun per area
    public function countCrimeAreaSetahun($kota)
    {
        $data_item = array();
        for ($i = 1; $i <= 12; $i++) {
            $p = $i <= 9 ? '0' . $i :  $i;
            $date = date('Y-') . $p;

            if ($kota == 'Jakarta Utara') {
                $query = $this->db->query("
                SELECT COUNT(kec) as total FROM tb_crime WHERE kota ='" . $kota . "' AND DATE_FORMAT(tanggal,'%Y-%m') = '" . $date . "'
                AND (kategori = 'perjudian' OR kategori = 'narkoba' OR kategori= 'penggelapan' OR kategori = 'pencurian' OR kategori='kekerasan') AND (kec='Penjaringan' or  kec = 'Koja' or kec = 'tanjung priok' or kec='pademangan' or kec ='cilincing' or kec = 'kelapa gading')
                ");
            } else {
                $query = $this->db->query("
                SELECT COUNT(kec) as total FROM tb_crime WHERE kota ='" . $kota . "' AND DATE_FORMAT(tanggal,'%Y-%m') = '" . $date . "'
                AND (kategori = 'perjudian' OR kategori = 'narkoba' OR kategori= 'penggelapan' OR kategori = 'pencurian' OR kategori='kekerasan') AND (kec='Teluk Jambe Barat' or  kec = 'Teluk Jambe Timur' or kec = 'Klari' or kec='Ciampel' or kec ='Majalaya' or kec = 'Karawang Barat' or kec='Karawang Timur')
                ");
            }
            if ($query->num_rows() > 0) {
                $d = $query->row();
                $data_item[] = array(
                    'total' => $d->total
                );
            } else {
                $data_item[] = array(
                    'total' => 0
                );
            }
        }
        return implode(', ', array_map(function ($entry) {
            return ($entry[key($entry)]);
        }, $data_item));
    }

    // upload data crime
    public function upload_crime($filename)
    {
        $this->load->library('upload');
        $config['upload_path']        = './assets/crime/';
        $config['allowed_types']      = 'xlsx';
        $config['max_size']           = '15048';
        $config['overwrite']          = true;
        $config['file_name']          = $filename;

        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            //jik berhasil
            $return = array('result' => 'success', 'file'    => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            $return = array('result' => 'gagal', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function mulitple_upload($table, $var)
    {
        return $this->db->insert_batch($table, $var);
    }
    // 


    // data crime per kategori filtering bulan
    public function modelCrimeKategoriPerbulan($kec, $kat, $bulan, $kota)
    {
        $date = date('Y-') . $bulan;
        $query = $this->db->query("SELECT COUNT(kategori) AS total FROM tb_crime WHERE 
        kota = '" . $kota . "' 
        AND kec='" . $kec . "' 
        AND kategori = '" . $kat . "'
        AND DATE_FORMAT(tanggal,'%Y-%m') = '" . $date . "' ");

        if ($query->num_rows() > 0) {
            $res = $query->row();
            return $res->total;
        } else {
            return 0;
        }
    }
    // 


    // total crime per bulan di map
    public function totalCrimePerKecamatan($kec, $bulan)
    {
        $date = date('Y-') . $bulan;
        $query = $this->db->query("SELECT COUNT(kec) as total FROM tb_crime WHERE kec='" . $kec . "' AND DATE_FORMAT(tanggal,'%Y-%m') = '" . $date . "'
        AND (kategori = 'perjudian' OR kategori = 'narkoba' OR kategori= 'penggelapan' OR kategori = 'pencurian' OR kategori='kekerasan')
        ")->row();
        return $query->total;
    }
    // 
}
