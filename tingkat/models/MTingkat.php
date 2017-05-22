<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
class MTingkat extends CI_Model {

	var $table = 'tb_tingkat';



	public function get_by_id($id){

		$this->db->from($this->table);

		$this->db->where('id_tingkat',$id);

		$query = $this->db->get();



		return $query->row();

	}



 

	public function gettingkat() {

		$this->db->select( '*' )->from( 'tb_tingkat' );
		
		$this->db->where( 'status', 1 );

		$query = $this->db->get();

		return $query->result_array();

	}

	



	public function getmapelbytingkatid($tingkatid) {

		$this->db->select('namaMataPelajaran,keterangan,tingkat.id AS tingkatID, mapel.id AS mapelID,tingpel.id as tingpelID')->from( 'tb_tingkat tingkat' );

	    $this->db->join( 'tb_tingkat-pelajaran tingpel', 'tingpel.tingkatID=tingkat.id' );

    	$this->db->join( 'tb_mata-pelajaran mapel', 'tingpel.mataPelajaranID=mapel.id' );

		$this->db->where( 'tingkat.status', 1 );

		$this->db->where( 'tingkat.id', $tingkatid );



		$query = $this->db->get();

		return $query->result_array();

	}

	public function getmapelipa() {

		$this->db->select('namaMataPelajaran,keterangan,tingkat.id AS tingkatID, mapel.id AS mapelID,tingpel.id as tingpelID')->from( 'tb_tingkat tingkat' );
	    $this->db->join( 'tb_tingkat-pelajaran tingpel', 'tingpel.tingkatID=tingkat.id' );
    	$this->db->join( 'tb_mata-pelajaran mapel', 'tingpel.mataPelajaranID=mapel.id' );
		$this->db->where( 'tingkat.status', 1 );
		$this->db->where( 'tingkat.id', '3' );
		$this->db->or_where( 'tingkat.id', '4' );
		$this->db->or_where( 'tingkat.id', '5' );




		$query = $this->db->get();

		return $query->result_array();

	}


	# get tingkat bedasarkan id siswa;
	function get_level_by_siswaID($id_siswa){
		$this->db->select( 'tingkatID' )->from( 'tb_siswa' );
		$this->db->where( 'status', 1 );
		$this->db->where( 'id', $id_siswa );

		$query = $this->db->get();
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}

		function get_level_by_siswaID_all($id_siswa){
		$this->db->select( 'tingkatID' )->from( 'tb_siswa' );
		$this->db->where( 'id', $id_siswa );

		$query = $this->db->get();
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}





}

?>