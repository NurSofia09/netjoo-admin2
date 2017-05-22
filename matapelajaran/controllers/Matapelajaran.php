<?php
class Matapelajaran extends MX_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Mmatapelajaran');
	}

	public function index() {
		echo 'ini index';
	}

	public function daftarMapel() {
		echo 'daftar mata pelajaran';
	}

	public function get_bab_by_tingpel_id( $tingpelID ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Mmatapelajaran->sc_bab_by_tingpel_id( $tingpelID ) ) ) ;
	}

	public function get_bab_by_mapel_id( $mapel_id ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Mmatapelajaran->get_bab_by_mapel( $mapel_id ) ) ) ;
	}

}





?>

