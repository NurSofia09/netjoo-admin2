<?php 
/**
 * 
 */
 class Help extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('help_model');
		// $this->sessionchecker->checkloggedin();
		if ($this->session->userdata('loggedin')==true) {
            if ($this->session->userdata('HAKAKSES')=='siswa'){
               // redirect('welcome');
            }else if($this->session->userdata('HAKAKSES')=='guru'){
               redirect('guru/dashboard');
           }else{
           }

       }

 	}

 	public function index($value='')
 	{
		$data['judul_halaman'] = "Help";
		$data['files'] = array(
			APPPATH.'modules/homepage/views/v-header-login.php',
        	APPPATH.'modules/help/views/v-user-guide-siswa.php',
        	// APPPATH.'modules/testimoni/views/v-footer.php',
			);
		$this->parser->parse( 'templating/index', $data );
		
		
 	}
 	
 } 
 ?>