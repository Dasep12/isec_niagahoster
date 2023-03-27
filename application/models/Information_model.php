<?php

class Information_model extends CI_Model
{

    public function masterTotal()
    {
        $query = $this->db->query("
            SELECT COUNT(e.npk) as total FROM biodata b, employee e  WHERE 
            b.npk = e.npk AND (e.jabatan = 'DANRU' || e.jabatan = 'ANGGOTA' || e.jabatan = 'KORLAP' || e.jabatan = 'PKD'  )  
            AND
            e.status = 1 AND b.status = 1
        ");
        return $query;
    }

    public function golonganDarah(Type $var = null)
    {
        $query = $this->db->query("
            SELECT gol_darah , COUNT(gol_darah) AS total  FROM biodata b, employee e
            WHERE
            b.npk = e.npk AND (e.jabatan = 'DANRU' || e.jabatan = 'ANGGOTA' || e.jabatan = 'KORLAP' || e.jabatan = 'PKD'  )  
            AND gol_darah IS NOT NULL AND e.status = 1 AND b.status = 1
            GROUP BY gol_darah
        ");
        return $query;
    }


    public function umur()
    {
        $query = $this->db->query("
        SELECT
            CASE
                WHEN umur BETWEEN 18 AND 30 THEN '18 - 30'
                WHEN umur BETWEEN 31 AND 40 THEN '31 - 40'
                WHEN umur BETWEEN 41 AND 50 THEN '41 - 50'
                WHEN umur >= 50 THEN '> 50'
            END AS range_umur,
           COUNT(*) AS jumlah
        FROM (SELECT tanggal_lahir , TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) AS umur FROM biodata b  , employee e 
        WHERE b.status = 1  AND e.npk= b.npk AND e.status = 1 
        AND (tanggal_lahir != '0000-00-00' AND tanggal_lahir IS NOT NULL AND DATE_FORMAT(tanggal_lahir,'%Y') BETWEEN 1940 AND 2004 )
        AND (e.jabatan = 'ANGGOTA' OR e.jabatan = 'KORLAP' OR e.jabatan = 'DANRU' OR e.jabatan ='PKD')
        )  
        AS dummy_table
        GROUP BY range_umur
        ORDER BY range_umur");
        return $query;
    }

    public function tempatTinggal($prov)
    {
        $query = $this->db->query("
            SELECT kota_dom AS kecamatan , COUNT(kota_dom) AS total FROM biodata  b , employee e 
            WHERE 
            e.status = 1 AND b.status = 1 AND e.npk = b.npk 
            AND (e.jabatan = 'ANGGOTA' OR e.jabatan = 'KORLAP' OR e.jabatan = 'DANRU' OR e.jabatan ='PKD') AND
            provinsi_dom = '" . $prov . "' AND kec_dom IS NOT NULL AND kec_dom != ''
            GROUP BY kota_dom
        ");
        return $query;
    }

    public function tempatTinggalAll()
    {
        $query = $this->db->query("
            SELECT kota_dom AS kota , COUNT(kota_dom) AS total FROM biodata b, employee e 
            WHERE e.status = 1 AND b.status = 1 AND e.npk = b.npk 
            AND (e.jabatan = 'ANGGOTA' OR e.jabatan = 'KORLAP' OR e.jabatan = 'DANRU' OR e.jabatan ='PKD') AND kec_dom IS NOT NULL AND kec_dom != ''
            GROUP BY kota_dom
        ");
        
        return $query;
    }

    public function tempatAsal()
    {
        $query = $this->db->query("
            SELECT b.provinsi_ktp AS prov_name, COUNT(b.kota_ktp) AS total, 
                (select latitude from ref_provinsi where name like concat('%',b.provinsi_ktp,'%') limit 1) latitude,
                (select longitude from ref_provinsi where name like concat('%',b.provinsi_ktp,'%') limit 1) longitude
                FROM biodata b, employee e 
                WHERE e.status = 1 AND b.status = 1 AND e.npk = b.npk 
                    AND (e.jabatan = 'ANGGOTA' OR e.jabatan = 'KORLAP' OR e.jabatan = 'DANRU' OR e.jabatan ='PKD') 
                    AND b.provinsi_ktp IS NOT NULL AND b.provinsi_ktp != ''
            GROUP BY b.provinsi_ktp
        ");
        
        return $query;
    }

    public function agama()
    {
        $query = $this->db->query("
            SELECT a.name, a.icon, count(b.agama) total
                FROM ref_religion a
                LEFT JOIN biodata b ON a.id=b.agama
            GROUP BY a.id 
        ");
        
        return $query;
    }

    public function gender($gender)
    {
        $query = $this->db->query("
        SELECT COUNT(gender) AS gender FROM biodata b , employee e WHERE gender = '" . $gender . "' 
        AND (e.jabatan = 'ANGGOTA' OR e.jabatan = 'KORLAP' OR e.jabatan = 'DANRU' OR e.jabatan ='PKD') AND
        e.status = 1 AND b.status = 1 AND e.npk = b.npk ");

        if ($query->num_rows() > 0) {
            $p = $query->row();
            return $p->gender;
        } else {
            return 0;
        }
    }

    public function statusKta()
    {
        $query = $this->db->query("
            SELECT 
            (select count(1) from employee a where (a.jabatan='ANGGOTA' or a.jabatan='KORLAP' or a.jabatan='DANRU' or a.jabatan='PKD') 
                and a.status=1 and a.status_kta='AKTIF') status_aktif, 
            (select count(1) from employee a where (a.jabatan='ANGGOTA' or a.jabatan='KORLAP' or a.jabatan='DANRU' or a.jabatan='PKD') 
                and a.status=1 and a.status_kta='TIDAK AKTIF') status_tdk_aktif
        ");

        return $query;
    }

}
