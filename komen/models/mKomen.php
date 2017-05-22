<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**

 *

 */

class Mkomen extends CI_Model

{



	function __construct() {

		parent::__construct();

		$this->load->database();

	}





	//fungsi untuk menampilkan komen yang ada di halaman seevideo
	public function get_komen_byvideo( $idvideo ) {
		$this->db->select( 'komen.id as komenID, namaPengguna`,komen.date_created,`isiKomen`,avatar' );
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->where( 'video.id', $idvideo );
		$this->db->where( 'komen.status', 1 );

		$query = $this->db->get();
		return $query->result();
	}

}

?>

