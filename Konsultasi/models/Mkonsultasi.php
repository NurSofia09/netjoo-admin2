 <?php 
/**
* 
*/
class Mkonsultasi extends CI_Model
{
	
	function __construct(){
	}

	//ambil semua pertnyaan
	function get_all_questions($perpage,$page,$key=""){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,mp.namaMataPelajaran,
			(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah, pertanyaan.mentorID,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->order_by('`pertanyaan`.`id`','desc');
		
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);

		return $query->result_array();

	}


	function get_all_questions_search($perpage,$page,$key){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,mp.namaMataPelajaran,
			(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah, pertanyaan.mentorID,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');

		$this->db->order_by('`pertanyaan`.`id`','desc');
		
		$this->db->where("judulPertanyaan LIKE '%$key%' OR
			bab.judulBab LIKE '%$key%'
			")->order_by('`pertanyaan.date_created`','asc');
		/*
		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$mataPelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$mataPelajaran);
			$this->db->where("bab.judulBab",$bab);
		}*/
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);

		return $query->result_array();

	}



//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions_filter($id_siswa,$page,$perpage,$bab,$mataPelajaran){
		$m = str_replace('_', ' ', $mataPelajaran);
		$b = str_replace('_', ' ', $bab);

		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, mp.namaMataPelajaran,
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		
		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$m);
		}else{
			$this->db->where("mp.namaMataPelajaran",$m);
			$this->db->where("bab.judulBab",$b);
		}

		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}

	//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions_number_filter($id_siswa,$bab, $mataPelajaran,$perpage,$page){
		$m = str_replace('_', ' ', $mataPelajaran);
		$b = str_replace('_', ' ', $bab);
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, mp.namaMataPelajaran,
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		
		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$m);
		}else{
			$this->db->where("mp.namaMataPelajaran",$m);
			$this->db->where("bab.judulBab",$b);
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');

		return $query->num_rows();		
	}

	// ambil jumlah semua pertanyaan
	function get_all_questions_number_filter($bab, $matapelajaran=''){
		$this->db->select('`pertanyaan`.`id`,judulPertanyaan,bab.judulBab');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');

		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
			$this->db->where("bab.judulBab",$bab);
		}
		$this->db->order_by('`pertanyaan.date_created`','asc');
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');
		return $query->num_rows();				
	}

		// ambil jumlah semua pertanyaan
	function get_all_questions_filter($bab, $matapelajaran='',$perpage,$page){
		$bab = str_replace('_', ' ', $bab);
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,
			(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah, pertanyaan.mentorID,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru,mp.namaMataPelajaran'
			);

		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');



		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
			$this->db->where("bab.judulBab",$bab);
		}
		
		$this->db->order_by('`pertanyaan.date_created`','asc');
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);
		return $query->result_array();				
	}

	// ambil jumlah semua pertanyaan
	function get_all_questions_number($key=""){
		$this->db->select('`pertanyaan`.`id`,judulPertanyaan,bab.judulBab');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		// $this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');
		return $query->num_rows();				
	}

	//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions($id_siswa,$perpage,$page,$key=""){
		// var_dump("judulPertanyaan LIKE '%$key%'");
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, mp.namaMataPelajaran,
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}

		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}

	//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions_number($id_siswa,$key=""){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');

		return $query->num_rows();		
	}

	//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions_search($id_siswa,$key=""){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		// $this->db->join('`tb_tingkat` `t`','t.id = tp.tingkatID');

		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`siswa`.`id`', $id_siswa )->order_by('`pertanyaan`.`id`','desc');
		
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');

		return $query->result_array();		
	}

	//ambil pertanyaan yang memiliki level sama
	function get_my_question_level($id_tingkat,$perpage,$page,$key=""){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,mp.namaMataPelajaran,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_tingkat` `t`','t.id = tp.tingkatID');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`t`.`id`', $id_tingkat)->order_by('`pertanyaan`.`id`','desc');

		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}

	function get_my_question_level_number($id_tingkat,$key=""){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`tingkatID`', $id_tingkat)->order_by('`pertanyaan`.`id`','desc');

		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`pertanyaan.date_created`','asc');
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');

		
		return $query->num_rows();

	}

		//ambil pertanyaan yang memiliki level sama
	function get_my_question_level_filter($id_tingkat,$perpage,$page,$bab,$matapelajaran){
		$m = str_replace('_', ' ', $matapelajaran);
		$b = str_replace('_', ' ', $bab);


		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, mp.namaMataPelajaran,
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,mp.namaMataPelajaran,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');

		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`tingkatID`', $id_tingkat)->order_by('`pertanyaan`.`id`','desc');

		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$m);
		}else{
			$this->db->where("mp.namaMataPelajaran",$m);
			$this->db->where("bab.judulBab",$b);
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`',$perpage,$page);
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

	}

	function get_my_question_level_number_filter($id_tingkat,$bab,$matapelajaran){
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, mp.namaMataPelajaran,
			`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
			`isiPertanyaan`, `pertanyaan`.`date_created`, 
			`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah,
			(SELECT CONCAT(`namaDepan`," ",`namaBelakang`) from tb_guru where id = pertanyaan.mentorID) as namaGuru');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');

		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`siswa`.`tingkatID`', $id_tingkat)->order_by('`pertanyaan`.`id`','desc');

		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
			$this->db->where("bab.judulBab",$bab);
		}
		$query = $this->db->get('`tb_k_pertanyaan` `pertanyaan`');

		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->num_rows();
		}

	}

	function get_question_m($id_siswa,$perpage,$page,$key=""){
		$this->db->select("p.id AS pertanyaanID, photo, 
			namaDepan, namaBelakang, judulPertanyaan, 
			isiPertanyaan, p.date_created, 
			bab.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = p.id) AS jumlah,
			p.mentorID,(SELECT CONCAT(namaDepan,' ',namaBelakang) from tb_guru where id = p.mentorID) as namaGuru,mp.namaMataPelajaran
			");


		$this->db->join('`tb_bab` `bab`','`p`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');

		$this->db->join('`tb_siswa` s',' s.`id` = p.`siswaID`');


		$this->db->where('p.mentorID IN 
			(SELECT DISTINCT(mentorID) FROM `tb_k_pertanyaan` 
			WHERE siswaID='.$id_siswa.' AND mentorID IS NOT NULL
			)');


		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`p.date_created`','asc');
		}

		$query = $this->db->get('`tb_k_pertanyaan` `p`',$perpage,$page);
		return $query->result_array();

	}

	function get_question_mentor_number($id_siswa,$key=''){
		$this->db->select("p.id AS pertanyaanID, photo, 
			namaDepan, namaBelakang, judulPertanyaan, 
			isiPertanyaan, p.date_created, 
			bab.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = p.id) AS jumlah,
			p.mentorID,(SELECT CONCAT(namaDepan,' ',namaBelakang) from tb_guru where id = p.mentorID) as namaGuru
			");
		if ($key==!"") {
			$this->db->where("judulPertanyaan LIKE '%$key%' OR
				bab.judulBab LIKE '%$key%'
				")->order_by('`p.date_created`','asc');
		}
		$this->db->join('`tb_bab` `bab`','`p`.`babID` = `bab`.`id`');
		$this->db->join('`tb_siswa` s',' s.`id` = p.`siswaID`');
		$this->db->where('p.mentorID IN 
			(SELECT DISTINCT(mentorID) FROM `tb_k_pertanyaan` 
			WHERE siswaID='.$id_siswa.' AND mentorID IS NOT NULL
			)');
		$query = $this->db->get('`tb_k_pertanyaan` `p`');
		return $query->num_rows();
	}

	function get_question_m_filter($bab,$mataPelajaran,$id_siswa,$perpage,$page){
		$this->db->select("p.id AS pertanyaanID, photo, 
			namaDepan, namaBelakang, judulPertanyaan, 
			isiPertanyaan, p.date_created, 
			bab.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = p.id) AS jumlah,
			p.mentorID,(SELECT CONCAT(namaDepan,' ',namaBelakang) from tb_guru where id = p.mentorID) as namaGuru,mp.namaMataPelajaran
			");


		$this->db->join('`tb_bab` `bab`','`p`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');
		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$mataPelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$mataPelajaran);
			$this->db->where("bab.judulBab",$bab);
		}
		$this->db->join('`tb_siswa` s',' s.`id` = p.`siswaID`');


		$this->db->where('p.mentorID IN 
			(SELECT DISTINCT(mentorID) FROM `tb_k_pertanyaan` 
			WHERE siswaID='.$id_siswa.' AND mentorID IS NOT NULL
			)');
		$query = $this->db->get('`tb_k_pertanyaan` `p`',$perpage,$page);
		return $query->result_array();

	}

	function get_question_mentor_number_filter($id_siswa,$bab, $matapelajaran){
		$this->db->select("p.id AS pertanyaanID, photo, 
			namaDepan, namaBelakang, judulPertanyaan, 
			isiPertanyaan, p.date_created, 
			bab.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = p.id) AS jumlah,
			p.mentorID,(SELECT CONCAT(namaDepan,' ',namaBelakang) from tb_guru where id = p.mentorID) as namaGuru
			");
		if ($bab=='all') {
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
		}else{
			$this->db->where("mp.namaMataPelajaran",$matapelajaran);
			$this->db->where("bab.judulBab",$bab);
		}
		$this->db->join('`tb_bab` `bab`','`p`.`babID` = `bab`.`id`');
		$this->db->join('`tb_siswa` s',' s.`id` = p.`siswaID`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('tb_mata-pelajaran mp', 'mp.id = tp.mataPelajaranID');
		$this->db->where('p.mentorID IN 
			(SELECT DISTINCT(mentorID) FROM `tb_k_pertanyaan` 
			WHERE siswaID='.$id_siswa.' AND mentorID IS NOT NULL
			)');
		$query = $this->db->get('`tb_k_pertanyaan` `p`');
		return $query->num_rows();
	}

	// ambil meta data from konsultasi
	function get_pertanyaan($id_pertanyaan){
		$this->db->select('*, pertanyaan.date_created as tgl_dibuat');
		$this->db->from('tb_k_pertanyaan pertanyaan');
		$this->db->join('tb_siswa siswa','pertanyaan.siswaID = siswa.id');
		$this->db->join('tb_bab bab','pertanyaan.babID = bab.id');
		
		$this->db->join('tb_tingkat tingkat','siswa.tingkatID = tingkat.id');
		$this->db->join('tb_pengguna pengguna','pengguna.id = siswa.penggunaID');

		$this->db->where('pertanyaan.id',$id_pertanyaan);

		$query = $this->db->get();   
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}
	//ambil jumlah postingan dalam pertanyaan tertentu.
	function get_jumlah_postingan($pertanyaanID){
		$this->db->select('id');
		$this->db->from('tb_k_jawab jawab');
		$this->db->where('jawab.pertanyaanID',$pertanyaanID);
		$query = $this->db->get();   
		return $query->num_rows();
	}

	//ambil postingan dalam pertanyaan tertentu.
	function get_postingan($pertanyaanID){
		$this->db->select('*,jawab.id as jawabID,siswa.photo siswa_photo,guru.photo guru_photo');
		$this->db->from('tb_k_jawab jawab');
		$this->db->where('jawab.pertanyaanID',$pertanyaanID);
		$this->db->join('tb_pengguna pengguna','pengguna.id = jawab.penggunaID');
		$this->db->join('tb_siswa siswa','pengguna.id = siswa.penggunaID','left');
		$this->db->join('tb_guru guru','pengguna.id = guru.penggunaID','left');

		$this->db->order_by('jawab.date_created','asc');

		$query = $this->db->get();   
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	//ambil postingan dalam pertanyaan tertentu pagination
	function get_postingan_pagination($pertanyaanID,$number,$offset){
		$this->db->select('*,jawab.id as jawabID,siswa.photo siswa_photo,guru.photo guru_photo');
		// $this->db->from('tb_k_jawab jawab');
		$this->db->where('jawab.pertanyaanID',$pertanyaanID);
		$this->db->join('tb_pengguna pengguna','pengguna.id = jawab.penggunaID');
		$this->db->join('tb_siswa siswa','pengguna.id = siswa.penggunaID','left');
		$this->db->join('tb_guru guru','pengguna.id = guru.penggunaID','left');
		$this->db->order_by('jawab.date_created','asc');
		return $query = $this->db->get('tb_k_jawab jawab',$number,$offset)->result_array();   
	}

	//ambil postingan dalam pertanyaan tertentu pagination

		//ambil jumlah postingan dalam pertanyaan tertentu pagination
	function get_postingan_pagination_number($pertanyaanID){
		$this->db->select('id');
		$this->db->from('tb_k_jawab jawab');
		$this->db->where('jawab.pertanyaanID',$pertanyaanID);

		$this->db->order_by('jawab.date_created','asc');

		$query = $this->db->get();   
		return  $query->num_rows();
	}
	//ambil jumlah postingan dalam pertanyaan tertentu pagination

	//ambil penggunaID by id_jawab
	function get_penggunaID($id_jawab){
		$this->db->select('penggunaID');
		$this->db->from('tb_k_jawab jawab');
		$this->db->where('jawab.id',$id_jawab);
		
		$query = $this->db->get();   
		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array()[0]['penggunaID'];

		}}

	//ambil penggunaID by id_jawab
		function get_date($id_jawab){
			$this->db->select('date_created');
			$this->db->from('tb_k_jawab jawab');
			$this->db->where('jawab.id',$id_jawab);

			$query = $this->db->get();   
			if ($query->result_array()==array()) {
				return false;
			} else {
				return $query->result_array()[0]['date_created'];

			}}


			function search_by($id_siswa, $param){
				$sub = "SELECT `pertanyaan`.`id` AS `pertanyaanID`, `photo`, `namaDepan`,
				`namaBelakang`, `judulPertanyaan`, `isiPertanyaan`, `pertanyaan`.`date_created`, 
				`subbab`.`judulSubBab`,(SELECT COUNT(id) FROM `tb_k_jawab` 
				WHERE pertanyaanID = pertanyaan.id) AS jumlah 
				FROM `tb_k_pertanyaan` `pertanyaan` JOIN `tb_subbab` `subbab` ON `pertanyaan`.`subBabID` = `subbab`.`id` 
				JOIN `tb_siswa` `siswa` ON `pertanyaan`.`siswaID` = `siswa`.`id` 
				WHERE `siswa`.`id` = $id_siswa
				AND `judulPertanyaan` LIKE '$param%'

				ORDER BY `pertanyaan`.`date_created` ASC

				LIMIT 5";

				$result = $this->db->query($sub);

				$result->result_array();

				if ($result->result_array()==array()) {
					return false;
				} else {
					return $result->result_array();
				}		
			}

			function check_postingan($data){
				$this->db->select('siswaID, jawabID');
				$this->db->from('tb_k_love');
				// var_dump($data);
				$this->db->where('siswaID',$data['siswaID']);
				$this->db->where('jawabID',$data['jawabID']);
				$query = $this->db->get();
				
				if ($query->result_array()==array()) {
					return 0;
				} else {
					return 1;

				}
			}

			function cari_pertanyaan($name){
				$this->db->like('judulPertanyaan', $name, 'both');
				return $this->db->get('tb_k_pertanyaan')->result();
			}
// =========## cruud ##==============
			public function insert_konstulasi( $data ) {
				$this->db->insert( 'tb_k_pertanyaan', $data );

			}

// insert jawaban
			public function insert_jawaban($data){
				$this->db->insert( 'tb_k_jawab', $data );

			}

//insert point
			public function insert_point($data){
				$this->db->insert( 'tb_k_love', $data );
			}

			public function get_konsultasi_by_siswa(){
				$sub = "SELECT * FROM 
				(SELECT id FROM tb_siswa s WHERE s.penggunaID = '1589' ) 
				siswa JOIN `tb_k_pertanyaan` p ON siswa.id = p.siswaID";

				$result = $this->db->query($sub);
				return $result->result_array();

			}

			public function in_upload_konsultasi($data){
				$this->db->insert('tb_upload_konsultasi', $data['data_upload_konsultasi']);
			}

			public function show_image(){
				$id = $this->session->userdata('id');

				$this->db->select('*');
				$this->db->from('tb_upload_konsultasi');
				$this->db->where('penggunaID',$id);
				$query = $this->db->get();   
				return $query->result_array();
			}

			#get edit jawaban#
			function get_edit_jawaban($data){
				$this->db->select('*');
				$this->db->from('tb_k_jawab');
				$this->db->where('penggunaID',$data['id_pengguna']);
				$this->db->where('id',$data['id_jawaban']);
				$query = $this->db->get();

				if ($query->result_array()) {
					return $query->result_array();
				}else{
					return false;
				}
			}
			#get edit jawaban#

			function edit_jawaban($data){
				$this->db->set('isiJawaban',htmlspecialchars_decode($data['isiJawaban']));
				$this->db->where('id', $data['id']);
				$this->db->update('tb_k_jawab');
			}


			// get single jawaban
			function show_post($id_jawaban){
				$this->db->select('*,jawab.id as jawabID,siswa.photo siswa_photo,guru.photo guru_photo');
				$this->db->from('tb_k_jawab jawab');
				$this->db->join('tb_k_pertanyaan pertanyaan','jawab.pertanyaanID = pertanyaan.id');
				$this->db->join('tb_pengguna pengguna','pengguna.id = jawab.penggunaID');
				$this->db->join('tb_siswa siswa','pengguna.id = siswa.penggunaID','left');
				$this->db->join('tb_guru guru','pengguna.id = guru.penggunaID','left');

				$this->db->order_by('jawab.date_created','asc');

				$this->db->where('jawab.id',$id_jawaban);
				$query = $this->db->get();

				if ($query->result_array()) {
					return $query->result_array();
				}else{
					return false;
				}
			}
			// get single jawaban
			function get_id_mentor(){
				$this->db->select('mentorID');
				$this->db->from('tb_siswa siswa');
				$this->db->join('tb_pengguna pengguna', 'siswa.penggunaID = pengguna.id');

				$this->db->where('pengguna.id', $this->session->id);

				$query = $this->db->get();

				return $query->result()[0]->mentorID;
			}

			function get_mentor($data){
				$this->db->select("g.`namaDepan`, g.`namaBelakang`, g.`id` AS guruID");
				$this->db->from("(SELECT * FROM tb_bab b
					WHERE b.id = ".$data['bab'].") AS bab");
				$this->db->join('`tb_tingkat-pelajaran` tingpel', 'tingpel.`id` = bab.tingkatPelajaranID');
				$this->db->join('`tb_mata-pelajaran` mapel', 'mapel.`id` = `tingpel`.`mataPelajaranID`');
				$this->db->join('`tb_mm-gurumapel` gurmap', '`gurmap`.`mapelID` = mapel.`id`');
				$this->db->join('`tb_guru` g ', 'g.`id` = gurmap.`guruID`');
				$this->db->join('`tb_mm_mentor_siswa` mentor' , 'mentor.`guruID` = g.id');
				$this->db->where("mentor.siswaID = ".$data['id_siswa']);
				$this->db->group_by('guruID');
				
				$query = $this->db->get();

				if(empty($query->result())){
					return false;
				}else{
					return $query->result_array()[0];					
				}

			}

			function get_meta_data_tingkat($data){
				$this->db->select('*')->from('tb_tingkat t');
				$this->db->where("t.id = ".$data);
				$query = $this->db->get();

				if(empty($query->result())){
					return false;
				}else{
					return $query->result_array()[0];					
				}

			}


			# pertanyaan sesuai profesi #
			function get_pertanyaan_seprofesi($id_guru,$bab,$mataPelajaran,$perpage,$page){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('tingpel.mataPelajaranID IN (SELECT mapelID FROM `tb_mm-gurumapel` WHERE guruID = '.$id_guru.')');
				if ($mataPelajaran!='all') {
					$m = str_replace('_', ' ', $mataPelajaran);
					$b = str_replace('_', ' ', $bab);

					if ($bab=='all') {
						$this->db->where("m.namaMataPelajaran",$m);
					}else{
						$this->db->where("m.namaMataPelajaran",$m);
						$this->db->where("b.judulBab",$b);
					}
				}
				
				$query = $this->db->get('`tb_k_pertanyaan` `k`',$perpage,$page);

				return $query->result_array();					
			}

			function get_pertanyaan_seprofesi_number($id_guru,$bab,$mataPelajaran){
				$this->db->select('k.id AS pertanyaanID');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('tingpel.mataPelajaranID IN (SELECT mapelID FROM `tb_mm-gurumapel` WHERE guruID = '.$id_guru.')');
				if ($mataPelajaran!='all') {
					$m = str_replace('_', ' ', $mataPelajaran);
					$b = str_replace('_', ' ', $bab);
					if ($bab=='all') {
						$this->db->where("m.namaMataPelajaran",$m);
					}else{
						$this->db->where("m.namaMataPelajaran",$m);
						$this->db->where("b.judulBab",$b);
					}
				}
				$query = $this->db->get('`tb_k_pertanyaan` `k`');

				return $query->num_rows();					
			}


			# pertanyaan sesuai profesi #
			function get_pertanyaan_seprofesi_search($key,$id_guru,$perpage,$page){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('tingpel.mataPelajaranID IN (SELECT mapelID FROM `tb_mm-gurumapel` WHERE guruID = '.$id_guru.')');

				if ($key==!"") {
					$this->db->where("judulPertanyaan LIKE '%$key%' OR
						b.judulBab LIKE '%$key%'
						")->order_by('`k.date_created`','asc');
				}

				$query = $this->db->get('`tb_k_pertanyaan` `k`',$perpage,$page);

				return $query->result_array();					
			}

			function get_pertanyaan_seprofesi_number_search($id_guru,$key){
				$this->db->select('k.id AS pertanyaanID');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('tingpel.mataPelajaranID IN (SELECT mapelID FROM `tb_mm-gurumapel` WHERE guruID = '.$id_guru.')');

				if ($key==!"") {
					$this->db->where("judulPertanyaan LIKE '%$key%' OR
						b.judulBab LIKE '%$key%'
						")->order_by('`k.date_created`','asc');
				}

				$query = $this->db->get('`tb_k_pertanyaan` `k`');

				return $query->num_rows();					
			}
			# pertanyaan sesuai profesi #

			function get_pertanyaan_punya_mentor($id_guru,$bab,$mataPelajaran,$perpage,$page){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('k.mentorID',$id_guru);
				if ($mataPelajaran!='all') {
					$m = str_replace('_', ' ', $mataPelajaran);
					$b = str_replace('_', ' ', $bab);
					if ($bab=='all') {
						$this->db->where("m.namaMataPelajaran",$m);
					}else{
						$this->db->where("m.namaMataPelajaran",$m);
						$this->db->where("b.judulBab",$b);
					}
				}
				
				$query = $this->db->get('`tb_k_pertanyaan` `k`',$perpage,$page);

				return $query->result_array();					
			}

			function get_pertanyaan_punya_mentor_number($id_guru,$bab,$mataPelajaran){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('k.mentorID',$id_guru);

				if ($mataPelajaran!='all'){
					$m = str_replace('_', ' ', $mataPelajaran);
					$b = str_replace('_', ' ', $bab);
					if ($bab=='all') {
						$this->db->where("m.namaMataPelajaran",$m);
					}else{
						$this->db->where("m.namaMataPelajaran",$m);
						$this->db->where("b.judulBab",$b);
					}
				}
				
				$query = $this->db->get('`tb_k_pertanyaan` `k`');
				return $query->num_rows();					
			}

			function get_pertanyaan_punya_mentor_search($id_guru,$key,$perpage,$page){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('k.mentorID',$id_guru);
				if ($key==!"") {
					$this->db->where("judulPertanyaan LIKE '%$key%' OR
						b.judulBab LIKE '%$key%'
						")->order_by('`k.date_created`','asc');
				}
				
				$query = $this->db->get('`tb_k_pertanyaan` `k`',$perpage,$page);

				return $query->result_array();					
			}

			function get_pertanyaan_punya_mentor_number_search($id_guru,$key){
				$this->db->select('k.id AS pertanyaanID, photo, 
					namaDepan, namaBelakang, judulPertanyaan, 
					isiPertanyaan, k.date_created, m.namaMataPelajaran,
					b.judulBab,(SELECT COUNT(id) FROM tb_k_jawab  WHERE pertanyaanID = k.id) AS jumlah,
					(SELECT CONCAT(namaDepan," ",namaBelakang) FROM tb_guru WHERE id = k.mentorID) AS namaGuru');

				$this->db->join('tb_bab b', 'b.id = k.babID');
				$this->db->join('`tb_tingkat-pelajaran tingpel', 'tingpel.id = b.tingkatPelajaranID');
				$this->db->join('tb_tingkat t ', 't.id=tingpel.tingkatID');
				$this->db->join('`tb_mata-pelajaran` m', 'm.id=tingpel.mataPelajaranID');
				$this->db->join('`tb_siswa` s', 's.`id` = k.`siswaID`');
				$this->db->where('k.mentorID',$id_guru);

				if ($key==!"") {
					$this->db->where("judulPertanyaan LIKE '%$key%' OR
						b.judulBab LIKE '%$key%'
						")->order_by('`k.date_created`','asc');
				}
				
				$query = $this->db->get('`tb_k_pertanyaan` `k`');
				return $query->num_rows();					
			}

			function get_pertanyaan_by_uid($uid){
				$this->db->select(' m.`id` AS mapelID, m.`namaMataPelajaran`,p.id, p.judulPertanyaan, p.isiPertanyaan,
					CONCAT(`namaDepan`," ",`namaBelakang`) AS nama_lengkap,
					s.`photo`,p.date_created,statusRespon,p.mentorID');
				$this->db->join("tb_siswa s","s.`id` = p.siswaID");
				$this->db->join("`tb_bab` b "," b.`id` = p.babID");
				$this->db->join("`tb_tingkat-pelajaran` tp ","tp.id = b.`tingkatPelajaranID`");
				$this->db->join("`tb_mata-pelajaran` m "," m.`id` = tp.`mataPelajaranID`");

				$this->db->from("(SELECT * FROM `tb_k_pertanyaan` k WHERE k.uuid='".$uid."') AS p");
				$query = $this->db->get();   
				return $query->result_array();
			}

			function get_pertanyaan_blm_direspon(){
				$this->db->select('p.id, p.judulPertanyaan, p.isiPertanyaan,
					CONCAT(`namaDepan`," ",`namaBelakang`) AS nama_lengkap,
					s.`photo`,p.date_created,statusRespon,p.mentorID');
				$this->db->join("tb_siswa s","s.`id` = p.siswaID");
				$this->db->from("(SELECT * FROM `tb_k_pertanyaan` k WHERE k.mentorID=".$this->session->userdata('id_guru')." and k.statusRespon=0) AS p");
				$query = $this->db->get();   
				return $query->result_array();
			}

			function get_pertanyaan_number_mentor($data){
				$query = "SELECT COUNT(k.`id`) as jmlh FROM (SELECT * FROM `tb_mata-pelajaran` mp WHERE mp.id IN (".$data.")) AS m
				JOIN `tb_tingkat-pelajaran` t ON t.`mataPelajaranID` = m.`id`
				JOIN tb_bab b ON b.`tingkatPelajaranID` = t.`id`
				JOIN `tb_k_pertanyaan` k ON k.`babID` = b.`id`
				JOIN `tb_mata-pelajaran` mpl ON mpl.`id` = t.`mataPelajaranID`
				WHERE k.statusRespon = 0
				AND k.`mentorID` <>".$this->session->userdata('id_guru')." OR k.mentorID IS NULL";

				$result = $this->db->query($query);
				return $result->result_array()[0]['jmlh'];
			}

			function get_notif_pertanyaan_to_teacher($data){
				$query = "SELECT k.id, k.judulPertanyaan, k.isiPertanyaan, k.`id`, k.mentorID,CONCAT(`namaDepan`, ' ' , `namaBelakang`) AS nama_lengkap, 
				`s`.`photo`, `k`.`date_created`, `statusRespon`,mpl.id AS mapelID, mpl.namaMataPelajaran
				FROM (SELECT * FROM `tb_mata-pelajaran` mp WHERE mp.id IN (".$data.")) AS m
				JOIN `tb_tingkat-pelajaran` t ON t.`mataPelajaranID` = m.`id`
				JOIN tb_bab b ON b.`tingkatPelajaranID` = t.`id`
				JOIN `tb_k_pertanyaan` k ON k.`babID` = b.`id`
				JOIN `tb_mata-pelajaran` mpl ON mpl.`id` = t.`mataPelajaranID`
				JOIN tb_siswa s ON s.`id` = k.siswaID
				WHERE k.statusRespon = 0
				AND k.`mentorID`  <> ".$this->session->userdata('id_guru').
				" OR k.mentorID IS NULL";

				$result = $this->db->query($query);
				return $result->result_array();
			}

			
			function update_status_respon($data){
				$this->db->set('statusRespon',1);
				$this->db->where('id', $data['pertanyaanID']);
				$this->db->update('tb_k_pertanyaan');
			}

			function get_last_jawaban(){
				$this->db->select('*,jawab.id as jawabID,siswa.photo siswa_photo,guru.photo guru_photo');
				$this->db->from('tb_k_jawab');
				$this->db->where('jawab.penggunaID',$this->session->userdata('id'));
				$this->db->from('tb_k_jawab jawab');
				$this->db->join('tb_k_pertanyaan pertanyaan','jawab.pertanyaanID = pertanyaan.id');
				$this->db->join('tb_pengguna pengguna','pengguna.id = jawab.penggunaID');
				$this->db->join('tb_siswa siswa','pengguna.id = siswa.penggunaID','left');
				$this->db->join('tb_guru guru','pengguna.id = guru.penggunaID','left');

				$this->db->order_by('jawab.date_created','desc');

				$query = $this->db->get();   
				return $query->result_array()[0];
			}

		}

		?>