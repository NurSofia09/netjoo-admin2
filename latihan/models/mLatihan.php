<?php
class Mlatihan extends CI_Model
{
	//random buat subbab
	public function get_random_for_latihan( $param ) {
		$this->db->where( 'id_subbab', $param['id_subab'] );
		$this->db->where('status','1');
		$this->db->where('publish','1');
		// $this->db->where( 'kesulitan', $param['kesulitan'] );
		$this->db->order_by( 'rand()' );
		$this->db->limit( $param['jumlah_soal'] );
		$this->db->select( '*' );
		$this->db->from( 'tb_banksoal' );
		$query = $this->db->get();
		return $query->result_array();
	}

	//random buat bab
	public function get_random_for_latihan_bab( $param ) {
		$this->db->where( 'bab.id', $param['id_bab'] );
		$this->db->where('status','1');
		$this->db->where('publish','1');
		// $this->db->where( 'kesulitan', $param['kesulitan'] );
		$this->db->order_by( 'rand()' );
		$this->db->limit( $param['jumlah_soal'] );
		$this->db->select( '*' );
		$this->db->from( 'tb_banksoal b' );
		$this->db->join('tb_subbab sub',
			'b.id_subbab = sub.id');

		$this->db->join('tb_bab bab',
			'bab.id = sub.babID');


		$query = $this->db->get();
		return $query->result_array();
	}






	public function get_piljawaban( $data ) {
		$this->db->order_by( 'rand()' );
		$n='1';
		foreach ( $data as $row ) {
			$id_soal=$row['id_soal'];
			if ( $n=='1' ) {
				$this->db->where( 'id_soal', $id_soal );
			} else {
				$this->db->or_where( 'id_soal', $id_soal );
			}
			$n++;
		}
		$this->db->select( '*' );
		$this->db->from( 'tb_piljawaban' );
		$query = $this->db->get();
		return $query->result_array();

	}



	public function ajax_add_paket_soal() {
		$data = array(
			'nm_paket' => $this->input->post( 'nama_paket' ) ,
			'jumlah_soal' => $this->input->post( 'jumlah_soal' ),
			'deskripsi' =>$this->input->post( 'deskripsi' ),
			'durasi' =>$this->input->post( 'durasi' )
			);
		$this->MPaketsoal->insertpaketsoal( $data );
	}



	public function insert( $data ) {
		$this->db->insert( 'tb_latihan', $data );
	}

	public function get_latihan_by_uuid($uuid){
		$this->db->where( 'uuid_latihan', $uuid );		
		$this->db->select('id_latihan');
		$this->db->from( 'tb_latihan' );
		$query = $this->db->get();
		return $query->result_array();
	}



	public function insert_tb_mm_sol_lat( $data ) {
		$this->db->insert( 'tb_mm_sol_lat', $data );

	}

	 //get daftar latihan by created by

	public function get_report($createdby){
		$this->db->select('*');
		$this->db->from('tb_latihan latihan');
		$this->db->join('tb_report-latihan report',
			'latihan.id_latihan=report.id_latihan');
		$this->db->where('create_by', $createdby);
		$this->db->order_by('tgl_pengerjaan', 'asc');
		$query = $this->db->get();
		return $query->result_array();

	}



	public function get_latihan($createdby){
		$this->db->select('*');
		$this->db->from('tb_latihan latihan');
		$this->db->where('create_by', $createdby);
		$this->db->where('status_pengerjaan', '1');

		$query = $this->db->get();
		return $query->result_array();

	}



    //get hasil latihan
	public function get_report_latihan($idlatihan){
		$this->db->select("*");
		$this->db->from('tb_report-latihan');
		$this->db->where('id_latihan',$idlatihan);
		$query = $this->db->get();
		return $query->result_array();

	}
	//get nama latihan by bab
	public function get_nama_bab($babid){
		$this->db->select('judulBab');
		$this->db->from('tb_bab');
		$this->db->where('id',$babid);
		$query = $this->db->get();
		return $query->result_array();
	}
	//random buat bab
	public function get_soal_bybab( $param ) {
		$this->db->where( 'bab.id', $param );

		$this->db->from( 'tb_banksoal b' );
		$this->db->join('tb_subbab sub',
			'b.id_subbab = sub.id');

		$this->db->join('tb_bab bab',
			'bab.id = sub.babID');


		$query = $this->db->get();
		return $query->result_array();
	}

	function get_soal_by_id_latihan($id_latihan){
		$this->db->select('*');
		$this->db->from('tb_mm_sol_lat as sollat');
		$this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
		$this->db->where('sollat.id_latihan', $id_latihan);
		$query = $this->db->get();
		return $query->result_array();
	}

	function repot_latihan_filter($id){
		$username = $this->db->escape_str($this->session->userdata('USERNAME'));
		if($id==""){
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
			$query = "SELECT hasil.id_latihan,hasil.nm_latihan,skore FROM 
			(SELECT * FROM `tb_latihan` l
			WHERE l.`create_by` = '".$username."') hasil
			JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
			JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
			JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
			JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
			JOIN `tb_bab` bab ON bab.`id` = s.`babID`
			GROUP BY hasil.`id_latihan`
			";
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
		}else{
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
			$query = "SELECT hasil.id_latihan,hasil.nm_latihan,skore FROM 
			(SELECT * FROM `tb_latihan` l
			WHERE l.`create_by` = '".$username."') hasil
			JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
			JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
			JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
			JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
			JOIN `tb_bab` bab ON bab.`id` = s.`babID`
			WHERE bab.`id` = '".$id."'
			GROUP BY hasil.`id_latihan`
			";
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
		}

		$result = $this->db->query($query);
		return $result->result_array();   
	}

	// get bab yang pernah dia latihan.
	function get_bab_latihan(){
		$username = $this->db->escape_str($this->session->userdata('USERNAME'));
		## TANPA ORDER ##
		$query = "SELECT bab.`id`,bab.`judulBab` FROM 
		(SELECT * FROM `tb_latihan` l
		WHERE l.`create_by`= '".$username."') hasil
		JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
		JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
		JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
		JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
		JOIN `tb_bab` bab ON bab.`id` = s.`babID`
		GROUP BY bab.id";
		## ORDER BAB ##	


		$result = $this->db->query($query);
		return $result->result_array();   

	}


}

?>

