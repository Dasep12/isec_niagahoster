<?php

class PatrolModel extends CI_Model
{

    public function getMax($id)
    {
        $this->db->select_max('id');
        $this->db->where('area_kerja', $id);
        $res = $this->db->get('rapporten');
        return $res;
    }
}
