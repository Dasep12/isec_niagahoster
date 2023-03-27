<?php

class Berita extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
  
      $role = $this->session->userdata('role_id');
        
        if(empty($role)){
          $this->session->userdata("logout","Sesi Berakhir");
          redirect('Login');
        }elseif($role != 9 ){
            redirect("LogOut");
        }
        
    }

    function index()
    {
         $data = array(
            'Berita'     => $this->db->get('berita')->result(),
        );
        $this->load->view("web/header");
        $this->load->view("Superadmin/berita",$data);
        $this->load->view("web/fotter");
        
    }

    function Getberita()
    {
        $html = file_get_contents('https://news.kompas.com/search');

        preg_match_all(
            '/<div class="article__list__title">.*?<h3 class="article__title article__title--medium">(.*?)<\/h3>.*?<\/div>.*?<div class="article__list__info">.*?<div class="article__subtitle article__subtitle--inline ">(.*?)<\/div>.*?<div class="article__date">(.*?)<\/div>.*?<\/div>/s',
          //  '/<div class="article__list__info">.*?<div class="article__subtitle article__subtitle--inline ">(.*?)<\/div>.*?<div class="article__date">(.*?)<\/div>.*?<\/div>/s',        
            $html,
			$posts,
			PREG_SET_ORDER
		);
                
        foreach ($posts as $post) {
        $show = $post[1];
        $kategori = $post[2];
        $jamBerita = $post[3];

        $data[] = array(
            'headline'    => $show,
            'kategori'  => $kategori,
            'tanggalberita' => $jamBerita,
            'sumber'    => 'Kompas.com',
        );
        }

        $input = $this->db->insert_batch('berita', $data);
        if($input) {
                echo 'Sukses';
            }else{
                echo 'Gagal';
            }
    }
}
?>