<?php 
/**
 * 
 */
 class Mkonsulback extends CI_Model
 {
 	private $table = "tb_k_pertanyaan";

 	 function __construct() {
        parent::__construct();
        $this->load->helper('session');
    }
 	// get hitung jumlah jawaban guru
 	// 
 	// get general data guru by pengguna ID
 	public function get_datguru($penggunaID)
 	{
 		$this->db->select('namaDepan,namaBelakang,photo');
 		$this->db->from('tb_pengguna user');
 		$this->db->join('tb_guru guru','user.id=guru.penggunaID');
 		$this->db->where('guru.penggunaID',$penggunaID);
 		$query = $this->db->get();
		$result = $query->result_array();
 		return $result[0];
 	}

 	// get jumlah jawaban atau respone guru terhadap konsultasi
 	public function get_count_jawab($penggunaID)
 	{
 		$this->db->select('id');
		$this->db->from('tb_k_jawab');
		$this->db->where('penggunaID',$penggunaID);
		$query = $this->db->get();
		return $query->num_rows();
 	}
 	// get data guru untuk akumulasi poin, love, dan jumlah respone/jawaban
 	public function get_aq_konsul()
 	{
 		$this->db->select('penggunaID,namaDepan,namaBelakang,guru.id as id_guru,mp.aliasMataPelajaran as mapel');
 		$this->db->from('tb_pengguna user');
 		$this->db->join('tb_guru guru','user.id=guru.penggunaID');
 		$this->db->join('tb_mata-pelajaran mp','mp.id=guru.mataPelajaranID');
 		$query = $this->db->get();
        return $query->result_array();

 	}
 	public function get_respone_by_guru($penggunaID)
 	{
 		$this->db->select('jawab.id as jawabID,jawab.date_created as tgl, isiJawaban, isiPertanyaan,judulPertanyaan ');
 		$this->db->from('tb_k_jawab jawab');
 		$this->db->join('tb_k_pertanyaan ask','jawab.pertanyaanID=ask.id');
 		$this->db->where('jawab.penggunaID',$penggunaID);
 		$query = $this->db->get();
        return $query->result_array();
 	}
 	//get jumlah love untuk guru
 	public function get_count_love($penggunaID)
 	{
 		$this->db->select('id');
		$this->db->from('tb_k_love');
		$this->db->where('penggunaID',$penggunaID);
		$query = $this->db->get();
		return $query->num_rows();
 	}

 	// get data komen siswa ke guru
 	public function get_komen_love($penggunaID)
 	{
 		$this->db->select('namaDepan,namaBelakang,love.komentar, love.date_created as tgl');
 		$this->db->from('tb_siswa siswa');
 		$this->db->join('tb_k_love love','siswa.id=love.siswaID');
 		$this->db->join('tb_pengguna pengguna','pengguna.id=love.penggunaID');
 		$this->db->where('love.penggunaID',$penggunaID);
 		$query = $this->db->get();
        return $query->result_array();
 	}

 	public function get_id_siswa() {
        $this->db->select('siswa.id');
        $this->db->from('tb_siswa siswa');
        $this->db->join('tb_pengguna pengguna', 'siswa.penggunaID = pengguna.id');

        $this->db->where('pengguna.id', '49');

        $query = $this->db->get();
        return $query->result()[0]->id;
    }

    	//ambil pertanyaan yang dimiliki oleh id tertentu.
	function get_my_questions($mataPelajaranID){
		$this->db->limit(10);
		// $this->db->offset($this->uri->segment(3));
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
				`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
				`isiPertanyaan`, `pertanyaan`.`date_created`, 
				`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`mataPelajaranID`',$mataPelajaranID)->order_by('`pertanyaan`.`id`','desc');
		 $query = $this->db->get();
		 		if ($query->result_array()==array()) {
			return false;
		} else {
			return $query->result_array();
		}

  //     
	}

	// ajax pagination
	public function all($limit)
	{
		$this->db->limit($limit);
		// $this->db->offset($this->uri->segment(4));
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
				`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
				`isiPertanyaan`, `pertanyaan`.`date_created`, 
				`bab`.`judulBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_bab` `bab`','`pertanyaan`.`babID` = `bab`.`id`');

		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->order_by('`pertanyaan`.`id`','desc');
		 $query = $this->db->get();
		return $query->result_array();
	}

	// load more soal
	public function more_all_soal($getLastContentId)
	{
		$limit=1;
		$this->db->limit($limit);
		// $this->db->offset($this->uri->segment(4));
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
				`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
				`isiPertanyaan`, `pertanyaan`.`date_created`, 
				`subbab`.`judulSubBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_subbab` `subbab`','`pertanyaan`.`subBabID` = `subbab`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`pertanyaan`.`id` < ',$getLastContentId);
		$this->db->order_by('`pertanyaan`.`id`','desc');
		 $query = $this->db->get();
		return $query->result_array();
	}

		// load more soal berdasarkan keahlian guru
	public function more_guru_soal($data)
	{
		$limit=1;
		$this->db->limit($limit);
		// $this->db->offset($this->uri->segment(4));
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
				`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
				`isiPertanyaan`, `pertanyaan`.`date_created`, 
				`subbab`.`judulSubBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_subbab` `subbab`','`pertanyaan`.`subBabID` = `subbab`.`id`');
		$this->db->join('`tb_bab` `bab`','`subbab`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`mataPelajaranID`',$data['mataPelajaranID']);
			$this->db->where('`pertanyaan`.`id` < ',$data['getLastContentId']);
		$this->db->order_by('`pertanyaan`.`id`','desc');

		 $query = $this->db->get();
		return $query->result_array();
	}

	public function count_my_questions ($mataPelajaranID)
	{
		$this->db->select('`pertanyaan`.`id` AS `pertanyaanID`, `photo`, 
				`namaDepan`, `namaBelakang`, `judulPertanyaan`, 
				`isiPertanyaan`, `pertanyaan`.`date_created`, 
				`subbab`.`judulSubBab`,(SELECT COUNT(id) FROM `tb_k_jawab`  WHERE pertanyaanID = pertanyaan.id) AS jumlah');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_subbab` `subbab`','`pertanyaan`.`subBabID` = `subbab`.`id`');
		$this->db->join('`tb_bab` `bab`','`subbab`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`mataPelajaranID`',$mataPelajaranID)->order_by('`pertanyaan`.`date_created`','desc');
		$query = $this->db->get();   
		return $query->num_rows();
	}

	public function count()
	{
		return $this->db->count_all_results($this->table);		
	}

	public function count_konsulAll($last_askID)
	{
		$this->db->select('id');
		$this->db->from('tb_k_pertanyaan');
		$this->db->where('id <',$last_askID);
		$query = $this->db->get();
		return $query->num_rows();
	}

		public function count_konsulMapel($last_askIDMp,$mataPelajaranID)
	{
		$this->db->select('pertanyaan.id');
		$this->db->FROM('`tb_k_pertanyaan` `pertanyaan`');
		$this->db->join('`tb_subbab` `subbab`','`pertanyaan`.`subBabID` = `subbab`.`id`');
		$this->db->join('`tb_bab` `bab`','`subbab`.`babID` = `bab`.`id`');
		$this->db->join('`tb_tingkat-pelajaran` `tp`','`bab`.`tingkatPelajaranID` = `tp`.`id`');
		$this->db->join('`tb_siswa` `siswa`','`pertanyaan`.`siswaID` = `siswa`.`id`');
		$this->db->where('`tp`.`mataPelajaranID`',$mataPelajaranID);
		$this->db->where('pertanyaan.id <',$last_askIDMp);
		$query = $this->db->get();   
		return $query->num_rows();
	}

 } ?>