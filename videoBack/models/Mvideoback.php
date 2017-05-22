<?php 

/**
* 
*/
class Mvideoback extends CI_Model
{
	
	public function insertVideo($data_video)
	{		
		$this->db->insert('tb_video', $data_video);
		
	}

	// untuk mengambil get value tingkatan seperti sd, smo dll u/
	public function scTingkat()
	{
		$this->db->where('status','1');
		$this->db->select('id,aliasTingkat')->from('tb_tingkat');
		$query = $this->db->get();
		return $query->result_array();
	}

	//mengambil value pelajaran berdasarkan id tingkatan
	public function scPelajaran($tingkatID)
	{
		$this->db->where('tingkatID', $tingkatID);
		$this->db->where('status','1');
		$this->db->select('id, keterangan')->from('tb_tingkat-pelajaran');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get value bab pelajaran berdasarkan id tingkat pelajaran
	public function scBab($tpelajaranID)
	{
		$this->db->where('tingkatPelajaranID', $tpelajaranID);
		$this->db->where('status','1');
		$this->db->select('id, keterangan, judulBab')->from('tb_bab');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get value subbab berdasarkan bab
	public function scSubbab($babID)
	{
		$this->db->where('babID', $babID);
		$this->db->where('status','1');
		$this->db->select('id, judulSubBab')->from('tb_subbab');
		$query = $this->db->get();
		return $query->result_array();
	}

	//get ID Guru
	// public function getIDguru($penggunaID)
	// {
	// 	$this->db->where('penggunaID',$penggunaID);
	// 	$this->db->select('id')->from('tb_guru');
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	//query haspus video
	public function del_video($videoID)
	{
		$this->db->where('id',$videoID);
		$this->db->delete('tb_video');
	}

	public function get_video_by_UUID($UUID)
	{	
		$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->where('UUID',$UUID);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function ch_video($data)
	{	
		$this->db->set($data['video']);
		$this->db->where('UUID',$data['UUID']);
		$this->db->update('tb_video');
		
	}

        public function scTingkatvideo()
	{
		$this->db->select('id,aliasTingkat');
                $this->db->from('tb_tingkat');
                // $this->db->where('status',1);
                $this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_video_by_sub()
	{
				$this->db->select('*');
		$this->db->from('tb_video');
		$this->db->where('UUID',$UUID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_nama_sub($subbab)
	{
		$this->db->select('judulSubBab');
		$this->db->from('tb_subbab');
		$this->db->where('id',$subbab);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_bab($bab)
	{
		$this->db->select('judulBab');
		$this->db->from('tb_bab');
		$this->db->where('id',$bab);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_mapel($mapel)
	{
		$this->db->select('keterangan');
		$this->db->from('tb_tingkat-pelajaran');
		$this->db->where('id',$mapel);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_nama_tingkat($tingkat)
	{
		$this->db->select('aliasTingkat');
		$this->db->from('tb_tingkat');
		$this->db->where('id',$tingkat);
		$query = $this->db->get();

		$result = $query->result_array();

		if($query->num_rows() == 1) {

			return $result[0];

		}

		return $result;
	}

	public function get_info_video($subBabID)
    {
        $this->db->select('tkt.id as id_tingkat ,aliasTingkat,tp.id as id_mp,tp.keterangan as mp,bab.id as id_bab, judulBab, subbab.id as id_subbab ,judulSubBab,');
         $this->db->from('tb_tingkat tkt' );
         $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->where('subbab.id',$subBabID);
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    //jumlah semua video dengan status 1
    public function jumlah_video(){
        $this->db->where('status','1');
        return $this->db->get('tb_video')->num_rows();
    }

        // data paginataion all video
    function data_video($number,$offset){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.thumbnail,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }

    public function get_carivideo($data)
    {
        $this->db->select('id,judulVideo,UUID');
        $this->db->from('tb_video');
        $this->db->like('judulVideo',$data);
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function jumlah_carivideo($data)
    {
    	$this->db->where('status','1');
    	$this->db->like('judulVideo',$data);
        return $this->db->get('tb_video')->num_rows();
    }
    //get data hasil pencarian by nama
     function data_video_cari($number,$offset,$keyword){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->like('video.judulVideo',$keyword);
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }
    // get data video by tingkat
    function data_video_tingkat($number,$offset,$tingkatID){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.thumbnail,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->where('tp.tingkatID',$tingkatID);
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }

    // count video by tingkat
    public function jumlah_video_tingkat($tingkatID)
    {
    	$this->db->where('video.status','1');
    	$this->db->where('tp.tingkatID',$tingkatID);
    	$this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        return $this->db->get('tb_tingkat tkt')->num_rows();
    }

    // get data video by mapel
    function data_video_mp($number,$offset,$mpID){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.thumbnail,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->where('tp.id',$mpID);
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }

    // count video by mapel
    public function jumlah_video_mp($mpID)
    {
    	$this->db->where('video.status','1');
    	$this->db->where('tp.id',$mpID);
    	$this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        return $this->db->get('tb_tingkat tkt')->num_rows();
    }

     // get data video by bab
    function data_video_bab($number,$offset,$babID){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.thumbnail,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->where('bab.id',$babID);
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }

    // count video by bab
    public function jumlah_video_bab($babID)
    {
    	$this->db->where('video.status','1');
    	$this->db->where('bab.id',$babID);
    	$this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        return $this->db->get('tb_tingkat tkt')->num_rows();
    }
         // get data video by subbab
    function data_video_subbab($number,$offset,$subBabID){
        $this->db->select('video.id,video.judulVideo,video.namaFile,video.thumbnail,video.deskripsi,video.link,video.published,video.date_created,video.UUID,tp.keterangan as mapel, bab.judulBab, subbab.judulSubBab');
        $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        $this->db->where('subbab.id',$subBabID);
        $this->db->where('video.status','1');
         $this->db->order_by('video.date_created', 'desc');
        return $query = $this->db->get('tb_tingkat tkt',$number,$offset)->result_array();       
    }

    // count video by subbab
    public function jumlah_video_subbab($subBabID)
    {
    	$this->db->where('video.status','1');
    	$this->db->where('subbab.id',$subBabID);
    	$this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
        $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
        $this->db->join('tb_video video', 'subbab.id = video.subBabID');
        return $this->db->get('tb_tingkat tkt')->num_rows();
    }

    // get thumbnail
    public function get_onethumbnail($UUID)
    {
    	$this->db->select('thumbnail');
    	$this->db->from('tb_video');
    	$this->db->where('UUID',$UUID);
    	$query = $this->db->get();
    	return $query->result_array();
    }
}
?>