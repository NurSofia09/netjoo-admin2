<?php 
class Mmatapelajaran extends CI_Model
{
	
	function __construct(){
		$this->load->database();
	}

	public function get_pelajaran_sma(){
		$query = $this->db->get('view_pelajaran_sma');
		return $query->result();
	}

	public function get_pelajaran_sma_ips(){
		$query = $this->db->get('view_pelajaran_sma_ips');
		return $query->result();
	}

	public function get_pelajaran_smp(){
		$query = $this->db->get('view_pelajaran_smp');
		return $query->result();
	}

	public function get_pelajaran_sd(){
		$query = $this->db->get('view_pelajaran_sd');
		return $query->result();
	}

		public function get_pelajaran_sma_ipa(){
		$query = $this->db->get('view_pelajaran_sma');
		return $query->result();
	}

	public function gettingkat() {

		$this->db->select( '*' )->from( 'tb_tingkat' );
		
		$this->db->where( 'status', 1 );

		$query = $this->db->get();

		return $query->result_array();

	}
	


}
 ?>