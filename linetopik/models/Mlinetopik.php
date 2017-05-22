<?php 
/**
 * 
 */
 class Mlinetopik extends CI_Model
 {

    //get maple line topik
 	public function get_mapel($tingkatID)
 	{
        $this->db->distinct('tp.keterangan');
 		$this->db->select('tp.keterangan as mapel, bab.judulBab, bab.id as babID');
 		$this->db->from('tb_tingkat-pelajaran tp');
 		$this->db->join('tb_bab bab','bab.tingkatPelajaranID = tp.id');
        $this->db->join('tb_line_topik topik','topik.babID=bab.id');
        $this->db->join('.tb_line_step step','step.topikId=topik.id');
 		$this->db->order_by('tp.keterangan');
 		$this->db->order_by('bab.judulBab');
        $this->db->where('topik.status',1);
 		$this->db->where('tingkatID',$tingkatID);
 		$query=$this->db->get();
 		return $query->result_array();
 	}
 	
 	public function get_line_topik($babID)
 	{
 		$this->db->select('namaTopik,step.UUID as stepUUID, namaStep, jenisStep, topik.deskripsi, bab.judulBab,tp.keterangan, tkt.aliasTingkat, step.latihanID,step.id as stepID, step.urutan');
 		$this->db->from('tb_line_topik topik');
 		$this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->join('tb_bab bab','bab.id=topik.babID');
 		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
 		$this->db->join('tb_tingkat tkt','tkt.id=tp.tingkatID');
 		$this->db->where('bab.id',$babID);
 		$this->db->order_by('topik.namaTopik');
 		$this->db->order_by('step.urutan', 'asc');
 		$query=$this->db->get();
 		return  $query->result_array();

 	}

 	public function get_datVideo($UUID)
 	{
 		$this->db->select('namaStep,namaTopik,judulVideo,namaFile,video.deskripsi as deskripsiVideo, link, video.date_created,topik.UUID');
 		$this->db->from('tb_line_topik topik');
 		$this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->join('tb_video video','step.videoID = video.id');
 		$this->db->where('step.UUID',$UUID);
 		$query=$this->db->get();
 		return $query->result_array()[0];
 	}

 	public function get_datMateri($UUID)
 	{
 		$this->db->select('namaStep,namaTopik,judulMateri,isiMateri,materi.date_created,topik.UUID');
 		$this->db->from('tb_line_topik topik');
 		$this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->join('tb_line_materi materi','materi.id=step.materiID');
 		$this->db->where('step.UUID',$UUID);
 		$query=$this->db->get();
 		return $query->result_array()[0];
 	}
 	// get step line berdasarkan UUID topik
 	public function get_topic_step($UUID)
 	{
 	
 		 $this->db->select('namaTopik,topik.babID,topik.UUID as topikUUID,step.UUID as stepUUID, namaStep, jenisStep, topik.deskripsi,step.urutan,step.id as stepID,step.latihanID,bab.judulBab,tp.keterangan, tkt.aliasTingkat');
        $this->db->from('tb_line_topik topik');
        $this->db->join('tb_line_step step','step.topikID=topik.id');
        $this->db->join('tb_bab bab','bab.id=topik.babID');
        $this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
        $this->db->join('tb_tingkat tkt','tkt.id=tp.tingkatID');
 		$this->db->where('topik.UUID',$UUID
 			);
        $this->db->order_by('topik.namaTopik');
 		$this->db->order_by('step.urutan', 'asc');
 		$query=$this->db->get();
 		return  $query->result_array();
 	}
 	// get step line berdasarkan UUID step dan info tingkat mp dan bab
 	public function get_topic_step2($UUID)
 	{
 		$UUIDTopik=$this->get_uuidTopik($UUID);
 		 $this->db->select('namaTopik,topik.babID,topik.UUID as topikUUID,step.UUID as stepUUID, namaStep, jenisStep, topik.deskripsi,step.urutan,step.id as stepID,step.latihanID,bab.judulBab,tp.keterangan, tkt.aliasTingkat');
 		$this->db->from('tb_line_topik topik');
 		$this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->join('tb_bab bab','bab.id=topik.babID');
 		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
 		$this->db->join('tb_tingkat tkt','tkt.id=tp.tingkatID');
 		$this->db->where('topik.UUID',$UUIDTopik
 			);
        $this->db->order_by('topik.namaTopik');
 		$this->db->order_by('step.urutan', 'asc');
 		$query=$this->db->get();
 		return  $query->result_array();
 	}

    public function get_cariTopik($kunciCari)
    {
        $this->db->select('namaTopik,topik.babID,topik.UUID as topikUUID,step.UUID as stepUUID, namaStep, jenisStep, topik.deskripsi,step.urutan,step.id as stepID,step.latihanID,bab.judulBab,tp.keterangan, tkt.aliasTingkat');
        $this->db->from('tb_line_topik topik');
        $this->db->join('tb_line_step step','step.topikID=topik.id');
        $this->db->join('tb_bab bab','bab.id=topik.babID');
        $this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
        $this->db->join('tb_tingkat tkt','tkt.id=tp.tingkatID');
        $this->db->like('topik.namaTopik',$kunciCari
            );
        $this->db->order_by('topik.namaTopik');
        $this->db->order_by('step.urutan', 'asc');
        $query=$this->db->get();
        return  $query->result_array();
    }

    // get UUID Topik by Step.UUID
	public function get_uuidTopik($UUID)
	{
		$this->db->select('topik.UUID');
 		$this->db->from('tb_line_topik topik');
 		$this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->where('step.UUID',$UUID);
 		$this->db->order_by('step.urutan', 'asc');
 		$query=$this->db->get();
 		return  $query->result_array()[0]['UUID'];
	}

	// get topik untuk side bar by babiD
 	public function get_topik($babID)
 	{
        $this->db->distinct('topik.namaTopik');
 		$this->db->select('topik.id,topik.UUID,topik.namaTopik');
 		$this->db->from('tb_line_topik topik');
        $this->db->join('tb_line_step step','step.topikID=topik.id');
 		$this->db->where('topik.babID',$babID);
 		$this->db->where('topik.status',1);
 		$this->db->where('topik.statusLearning',1);
 		$this->db->order_by('topik.namaTopik');
 		$query=$this->db->get();
 		return $query->result_array();
 	}
    // get topik untuk side bar by namatopik
    public function get_topik_bynama($kunciCari)
    {
        $this->db->select('id,UUID,namaTopik');
        $this->db->from('tb_line_topik');
        $this->db->like('namaTopik',$kunciCari);
        $this->db->where('status',1);
        $this->db->where('statusLearning',1);
        $this->db->order_by('namaTopik');
        $query=$this->db->get();
        return $query->result_array();
    }

 	//mengambil data step line quize 
 	public function get_datQuiz($latihanID)
 	{
 		$this->db->select('jumlah_benar');
 		$this->db->from('tb_line_step');
 		$this->db->where('latihanID',$latihanID);
 		$query=$this->db->get();
 		return $query->result_array()['0'];
 	}

 	// get data soal quiz
 	    public function get_soal($id_latihan) {
        $this->db->select('id_latihan as idlat, soal as soal, soal.id_soal as soalid, soal.judul_soal as judul, soal.gambar_soal as gambar, soal.jawaban as jaw,, soal.pembahasan, soal.gambar_pembahasan, soal.video_pembahasan, soal.status_pembahasan, soal.link');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $query = $this->db->get();
        $soal = $query->result_array();

        $this->db->select('*,id_latihan as idlat, soal as soal, pil.id_soal as pilid,soal.id_soal as soalid, pil.pilihan as pilpil, pil.jawaban as piljaw, pil.gambar as pilgam');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->join('tb_piljawaban as pil', 'soal.id_soal = pil.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $query = $this->db->get();
        $pil = $query->result_array();

        return array(
            'soal' => $soal,
            'pil' => $pil,
        );
    }


    // get id step line by UUID
    public function get_stepID($UUID)
    {
    	$this->db->select('id');
    	$this->db->from('tb_line_step');
    	$this->db->where('UUID',$UUID);
    	$query = $this->db->get();
    	return $query->result_array()[0]['id'];
    }
    //get step id and UUID
    public function get_stepID2($id_latihan)
    {
    	$this->db->select('id,UUID');
    	$this->db->from('tb_line_step');
    	$this->db->where('latihanID',$id_latihan);
    	$query = $this->db->get();
    	return $query->result_array()[0];
    }

  //   $query = $this->db->get();
		// if ($query->result_array()==array()) {
		// 	return false;
		// } else {
		// 	return $query->result_array();
		// }

    //untuk mengecek log 
    public function get_log($stepID)
    {
    	$this->db->select('id');
    	$this->db->from('tb_line_log');
    	$this->db->where('stepID',$stepID);
    	$query = $this->db->get();
    	if ($query->result_array()==array()) {
    		return false;
    	} else {
    		return true;
    	}
    	
    }

    //savelog step line siswa
    public function save_log($datLog)
    {
    	$this->db->insert('tb_line_log',$datLog);
    }

    //get UUID step by id latihan
    public function get_UUID($id_latihan)
    {
    	$this->db->select('UUID');
    	$this->db->from('tb_line_step');
    	$this->db->where('latihanID',$id_latihan);
    	$query=$this->db->get();
    	return $query->result_array()[0]['UUID'];
    }

    // utuk mendapatkan info step
   public function get_stepLog($UUID)
    {
    	$tampInfo=$this->get_uTopikId($UUID);
    	$tampurutan=$tampInfo['urutan'];
    	$topikId=$tampInfo['topikID'];
    	if ($tampurutan!=1) {
    		$urutan=$tampurutan-1;
    		
    		$this->db->select('log.id,step.urutan');
    		$this->db->from('tb_line_log log');
    		$this->db->join('tb_line_step step','step.id=log.stepID');
    		$this->db->where('step.urutan',$urutan);
    		$this->db->where('step.topikID',$topikId);
    		$query = $this->db->get();

    		if ($query->result_array()==array()) {
    			return false;
    		} else {
    			return true;
    		}
    	} else {
    		return true;
    	}
    	
    	
    } 

    //get urutan dan topik id
    public function get_uTopikId($UUID)
    {
    	$this->db->select('urutan,topikID');
    	$this->db->from('tb_line_step ');
    	$this->db->where('UUID',$UUID);
    	$query = $this->db->get();
    	return $query->result_array()[0];

    }

    //get soal untuk quiz
    public function get_soqlQuiz($data)
    {
        $id_latihan = $data['id_latihan'];
        $limitQuiz  = $data['limitQuiz'];
       $this->db->select('id_latihan as idlat, soal as soal, soal.id_soal as soalid, soal.judul_soal as judul, soal.gambar_soal as gambar, soal.jawaban as jaw,, soal.pembahasan, soal.gambar_pembahasan, soal.video_pembahasan, soal.status_pembahasan, soal.link,soal.audio');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $this->db->order_by( 'rand()' );
        $this->db->limit( $limitQuiz );
        $query = $this->db->get();
        $soal = $query->result_array();

        $this->db->select('*,id_latihan as idlat, soal as soal, pil.id_soal as pilid,soal.id_soal as soalid, pil.pilihan as pilpil, pil.jawaban as piljaw, pil.gambar as pilgam');
        $this->db->from('tb_mm_sol_lat as sollat');
        $this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
        $this->db->join('tb_piljawaban as pil', 'soal.id_soal = pil.id_soal');
        $this->db->where('sollat.id_latihan', $id_latihan);
        $query = $this->db->get();
        $pil = $query->result_array();

        return array(
            'soal' => $soal,
            'pil' => $pil,
        );
    }


    public function get_limitQuiz($UUID)
    {
        $this->db->select('jumlah_soal');
        $this->db->from('tb_line_step');
        $this->db->where('UUID',$UUID);
        $query = $this->db->get();
        return $query->result_array()[0]['jumlah_soal'];
    }

    //mencari topik line untuk autocomplate serach timeline
    public function get_cari_topik($keyword='')
    {
      $this->db->distinct('topik.namaTopik');
       $this->db->select('topik.namaTopik,topik.UUID');
       $this->db->from('tb_line_topik topik');
      $this->db->join('tb_bab bab','bab.id=topik.babID');
      $this->db->join('tb_line_step step','step.topikID=topik.id');
       $this->db->like('topik.namaTopik',$keyword);
       $this->db->where('topik.status',1);
       $query = $this->db->get();
       return $query->result_array();
    }





 } ?>