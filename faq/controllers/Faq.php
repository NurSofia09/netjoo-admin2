<?php 
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
/**
* 
*/
class Faq extends MX_Controller
{
	
	public function __construct() {

		parent::__construct();

		$this->load->model( 'matapelajaran/mmatapelajaran' );

		$this->load->model( 'tingkat/MTingkat' );



		$this->load->library( 'parser' );

		if ($this->session->userdata('loggedin')==true) {

			if ($this->session->userdata('HAKAKSES')=='siswa'){

               // redirect('welcome');

			}else if($this->session->userdata('HAKAKSES')=='guru'){

				redirect('guru/dashboard');

			}else{



			}

		}
	}
		public function index()
		{
			$data = array(

            'judul_halaman' => 'Neon - FAQ',

            'judul_header' =>'FAQ HASIL DETECTION',

            'judul_header2' =>'FAQ'
        );

        $data['files'] = array( 

            APPPATH.'modules/homepage/views/v-header-login.php',

            APPPATH.'modules/faq/views/v-faq.php',

            // APPPATH.'modules/welcome/views/v-tampil-tes.php',

            APPPATH.'modules/testimoni/views/v-footer.php',

        );
        $this->parser->parse( 'templating/index', $data );
		}



	
}
?>