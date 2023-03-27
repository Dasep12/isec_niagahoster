<?php


class Super_model extends CI_Model
{
     //set nama tabel yang akan kita tampilkan datanya
    var $table = 'absensi';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array('npk', 'nama', 'area_kerja', 'wilayah',null);
    var $column_search = array('npk','nama', 'area_kerja', 'wilayah');
    // default order 
    var $order = array('nama' => 'asc');
    
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getProfiling($npk)
    {
        $query = $this->db->get_where('profiling', array('npk' => $npk));
        return $query;
    }

    private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // looping awal
		{
			if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{	
				if($i===0) // looping awal
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); 
			}
			$i++;
		}           
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
    
     public function ExportProfiling()
    {
        $this->db->select('*');
        $this->db->from('profiling');
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getDaftarAnggota($where)
    {
        $query = $this->db->query('SELECT nama ,  biodata.npk , employee.wilayah   FROM biodata JOIN  employee ON  biodata.npk = employee.npk where nama like "%' . $where . '%"
        order by nama ASC ');
        return $query->result_array();
    }

    public function getWilayahAnggota($npk)
    {
        $query = $this->db->query('SELECT employee.id_employee , employee.wilayah , employee.area_kerja   FROM biodata JOIN  employee ON  biodata.npk = employee.npk where employee.npk = "' . $npk . '" ');
        return $query->result();
    }

    //ambil data absensi anggota berdasarkan tanggal bulan dan npk
    public function getPresensi($npk, $bulan, $tabel)
    {
        $query = $this->db->query('SELECT * FROM ' . $tabel . ' WHERE npk = "' . $npk . '" AND in_date LIKE "%' . $bulan . '%"  ');
        return $query;
    }

    //update data presensi 
    public function updateAbsensi($where, $tabel, $data)
    {
        $this->db->where($where);
        $this->db->update($tabel, $data);
        return $this->db->affected_rows();
    }


    //hitung patroli tanggal kemarin 
    public function countPatroli($area, $tgl)
    {
        $query = $this->db->query('SELECT sum(`count`) AS total  FROM count_patroli WHERE area = "' . $area . '" AND tanggal = "' . $tgl . '" ');
        return $query->row();
    }

     //hitung status KTA 
	public function countStatusKTA($kta)
	{ 
		$query = $this->db->query("SELECT status_kta , COUNT(status_kta) AS total FROM employee  where status_kta =  '$kta' ");
		return $query->row();
	}
    
    //input presensi 
    public function input($tabel, $data)
    {
        $this->db->insert($tabel, $data);
        return $this->db->affected_rows();
    }


}
