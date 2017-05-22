<?php 

class Learning_model extends CI_Model{

	//fungsi ambil semua topik
	public function get_semua_topik(){
		$this->db->select('t.id,t.statusLearning, tn.`namaTingkat`, b.`judulBab`, t.`namaTopik`, m.`namaMataPelajaran`,');
		
		$this->db->from('`tb_line_topik` t');
		$this->db->where('t.status',1);
		
		$this->db->join('`tb_bab` b',' t.`babID` = b.`id` ');
		$this->db->join('`tb_tingkat-pelajaran` tp ',' b.`tingkatPelajaranID` = tp.`id`');
		$this->db->join('`tb_tingkat` tn',' tn.`id` = tp.`tingkatID`');
		$this->db->join('tb_mata-pelajaran` m',' m.`id` = tp.`mataPelajaranID`');
		$this->db->order_by('t.urutan asc');
		$query = $this->db->get();
		return $query->result_array();
	}

		//fungsi ambil topik by id bab
	public function get_topik_by_babid($data){
		$this->db->select('t.urutan,t.id,t.statusLearning, tn.`namaTingkat`, b.`judulBab`, t.`namaTopik`, m.`namaMataPelajaran`,');
		
		$this->db->from('`tb_line_topik` t');
		$this->db->where('t.status',1);
		
		$this->db->join('`tb_bab` b',' t.`babID` = b.`id` ');
		$this->db->join('`tb_tingkat-pelajaran` tp ',' b.`tingkatPelajaranID` = tp.`id`');
		$this->db->join('`tb_tingkat` tn',' tn.`id` = tp.`tingkatID`');
		$this->db->join('tb_mata-pelajaran` m',' m.`id` = tp.`mataPelajaranID`');
		$this->db->where('b.id',$data);
		$this->db->order_by('t.urutan asc');

		$query = $this->db->get();
		return $query->result_array();
	}

	// fungi ambil semua step berdasarkan id topik tertentu
	public function get_step_by_id_topik($data){
		$this->db->select('*');
		$this->db->from('`tb_line_topik` tp');
		$this->db->join('`tb_line_step` ls','tp.`id`=ls.`topikID`');
		$this->db->where('tp.id',$data);
		$this->db->where('ls.status',1);
		$this->db->order_by('ls.urutan','asc');


		$query = $this->db->get();
		return $query->result_array();
	}

	// ambil semua bab
	public function get_bab_for_topik(){
		$this->db->select('b.id, namaTingkat, namaMataPelajaran,judulBab,statusLearningLine');
		
		$this->db->from('`tb_bab` b');
		$this->db->where('b.status',1);
		$this->db->join('`tb_tingkat-pelajaran` tp ',' b.`tingkatPelajaranID` = tp.`id`');
		$this->db->join('`tb_tingkat` tn',' tn.`id` = tp.`tingkatID`');
		$this->db->join('tb_mata-pelajaran` m',' m.`id` = tp.`mataPelajaranID`');
		$this->db->order_by('namaTingkat');
		$query = $this->db->get();
		return $query->result_array();
	}
	//ambil topik  berdasarkkan id topik
	function get_topik_byid($data){
		$query = "
		SELECT 
		tingkat.id tingkatID,topik.id AS TopikID,bab.id as babID,tingpel.id as tingpelID, mapel.id as mapelID, namaTopik, statusLearning,topik.urutan,
		deskripsi,`namaTingkat`, `namaMataPelajaran`, `judulBab`
		FROM
		(SELECT  *  FROM  `tb_line_topik` WHERE  id =  $data ) AS topik
		JOIN `tb_bab` AS bab ON
		topik.babID = bab.id
		JOIN `tb_tingkat-pelajaran` tingpel ON
		bab.tingkatPelajaranID = tingpel.id
		JOIN `tb_mata-pelajaran` mapel ON
		mapel.id = tingpel.mataPelajaranID
		JOIN `tb_tingkat` tingkat ON
		tingkat.id = tingpel.tingkatID
		";

		$result = $this->db->query($query);
		if ($result->result_array()==array()) {
			return false;
		} else {
			return $result->result_array()[0];
		}
		

	}
	// update line topik aktiv
	function updateaktiv($data){
		$this->db->where('id', $data);
		$this->db->set('statusLearning', 1);
		$this->db->update('tb_line_topik');
	}
	// update line topik aktiv


	// update line topik passive
	function updatepasive($data){
		$this->db->where('id', $data);
		$this->db->set('statusLearning', 0);
		$this->db->update('tb_line_topik');
	}
	// update line topik passive

	#insert line topik
	function insert_line_topik($data){
		$this->db->insert( 'tb_line_topik', $data );
	}

	# drop topik
	function drop_topik($data){
		$this->db->where('id', $data['id']);
		$this->db->set('status', 0);
		$this->db->update('tb_line_topik');
	}
	#dropstep
	function drop_step($data){
		$this->db->where('id', $data['id']);
		$this->db->set('status', 0);
		$this->db->update('tb_line_step');
	}

	// update line bab aktiv
	function updateaktiv_bab($data){
		$this->db->where('id', $data);
		$this->db->set('statusLearningLine', 1);
		$this->db->update('tb_bab');
	// update line topik aktiv
	}

	// update line bab passive
	function updatepasive_bab($data){
		$this->db->where('id', $data);
		$this->db->set('statusLearningLine', 0);
		$this->db->update('tb_bab');
	// update line topik aktiv
	}

	/*GET META DATA UNTUK STEP*/
	function get_meta_data_step($data){
		$this->db->select('*');
		$this->db->from('`tb_line_topik` tp');
		$this->db->where('id', $data);

		$query = $this->db->get();
		return $query->result_array();
	}
	/*GET META DATA UNTUK STEP*/

	/*GET META DATA UNTUK update STEP*/
	function meta_step_update($data){
		$query = "SELECT jenisStep, step.id, namaTopik, step.urutan, namaStep, bab.id as babid, materiID, latihanID, videoID FROM  (SELECT * FROM  `tb_line_step` WHERE id =  $data ) AS step
		JOIN `tb_line_topik` topik ON topik.id = step.topikID
		JOIN `tb_bab` AS bab ON
		topik.babID = bab.id
		";
		$result = $this->db->query($query);
		if ($result->result_array()==array()) {
			return false;
		} else {
			return $result->result_array();
		}
	}
	/*GET META DATA UNTUK STEP*/


	/*insert DATA UNTUK STEP*/
	function insert_line_step($data){
		$this->db->insert( 'tb_line_step', $data );
	}
	/*insert DATA UNTUK STEP*/
	// -------------------------------------------------------------------
	function update_learning_step($data){
		$this->db->where('id', $data['id']);
		$this->db->set($data);
		$this->db->update('tb_line_step');
	}

	/*GET META DATA UNTUK STEP*/
	function get_materi_babID($data){
		$this->db->select('m.id, judulMateri, isiMateri');
		$this->db->from('tb_line_materi m');
		$this->db->JOIN('tb_subbab s','s.id = m.subBabID'); 
		$this->db->JOIN('tb_bab b','b.id = s.babID'); 
		$this->db->where('b.id', $data);

		$query = $this->db->get();
		return $query->result_array();
	}
	/*GET META DATA UNTUK STEP*/

	/*GET META DATA UNTUK STEP*/
	function get_materi_babID_edit($data){
		$this->db->select('m.id, judulMateri, isiMateri');
		$this->db->from('tb_line_materi m');
		$this->db->JOIN('tb_subbab s','s.id = m.subBabID'); 
		$this->db->JOIN('tb_bab b','b.id = s.babID'); 
		$this->db->where('b.id', $data);

		$query = $this->db->get();
		return $query->result_array();
	}
	/*GET META DATA UNTUK STEP*/



	// ------------------------------------TOPIK
	function update_topik($data){
		$this->db->where('id', $data['id']);
		$this->db->set($data);
		$this->db->update('tb_line_topik');
	}


 //============ Get step yang bertopik dan ber uuid tertentu ===============
	function get_step_urutan_idtopik($idtopik, $urutan){
		$this->db->order_by('urutan','asc');
		$this->db->where('topikID', $idtopik);
		$this->db->where('urutan >=', $urutan);
		$this->db->select('*');
		$this->db->from('tb_line_step');

		$result = $this->db->get();
		if ($result->result_array()==array()) {
			return false;
		} else {
			return true;
		}

	}

 //============ Get step yang berurutan lebih dari urutan yang diinsert ===============
	function get_step_urutan($idtopik, $urutan){
		$this->db->where('topikID', $idtopik);
		$this->db->where('urutan >=', $urutan);
		$this->db->select('*');
		$this->db->from('tb_line_step');

		$result = $this->db->get();
		if ($result->result_array()==array()) {
			return false;
		} else {
			return $result->result_array();
		}

	}

	function get_step_sama_urutan($idtopik, $urutan){
		$this->db->where('topikID', $idtopik);
		$this->db->where('urutan =', $urutan);
		$this->db->select('*');
		$this->db->from('tb_line_step');

		$result = $this->db->get();
		if ($result->result_array()==array()) {
			return false;
		} else {
			return $result->result_array();
		}

	}

	//========== update batch  ==================
	//function untuk update pilihan jawaban text.
	public function update_step_urutan($data) {
		$this->db->where('id',$data['id']);
		$this->db->set($data);
		$this->db->update('tb_line_step');
	}

	# fungsi mengambil line log berdasarkan pengguna id.
	public function get_line_log_step_line_by_user(){
		$id = $this->session->userdata('id');
		$query = "SELECT * FROM (
		SELECT * FROM tb_line_log l WHERE l.`penggunaID` = $id ) hasil
		JOIN `tb_line_step` s ON s.`id` = hasil.stepID
		JOIN `tb_line_topik` t ON t.`id` = s.`topikID`
		ORDER BY s.`topikID` 
		";
		$result = $this->db->query($query);
		if ($result->result_array()==array()) {
			return $result->result_array();
		} else {
			return $result->result_array();
		}
	}
}
?>