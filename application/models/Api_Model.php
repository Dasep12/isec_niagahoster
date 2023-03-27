<?php


class Api_Model extends CI_Model
{

    public function getData($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function update($table, $data, $where)
    {
        $this->db->where($where);
        $query =  $this->db->update($table, $data);
        return $query;
    }
    
    
     public function getDataDiriAbsensi($id)
    {
        $query =  $this->db->query('SELECT b.npk , b.id_biodata ,  b.nama , e.wilayah , e.area_kerja , e.jabatan  FROM biodata b , employee e WHERE b.id_biodata = "'.$id.'" 
        AND e.id_employee = "'.$id.'" ');
        return $query;
    }
}
