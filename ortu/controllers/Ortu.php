<?php

/**
 *
 */
class Ortu extends MX_Controller {

    function get_status_login(){
        $log_in = $this->session->userdata('loggedin');
        return $log_in;        
    }

    function get_hak_akses(){
        $hak_akses = $this->session->userdata('HAKAKSES');        
        return $hak_akses;        
    }



    public function __construct() {
        parent::__construct();
        $this->load->model('mOrtu');        
        $this->load->helper('session');
        $this->load->library('parser');
        $this->load->library('pagination');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
    }

    

 

    public function index() {    

       $data = array(
        'judul_halaman' => 'Neon - Welcome',
        'judul_header' =>'Video',
        'judul_header2' =>'Video Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/v-header-login.php',
        APPPATH.'modules/ortu/views/v-home-ortu.php',
        APPPATH.'modules/testimoni/views/v-footer.php',
        );
    $id_pengguna= $this->session->userdata['id'];
    $namaDepan=$this->mOrtu->get_siswa($id_pengguna)[0]['namaDepan'];
    $data['siswa'] =$namaDepan;

    $this->parser->parse( 'templating/index', $data );
    }

  
}
?>
