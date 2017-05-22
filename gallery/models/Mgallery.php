<?php 
/**
 * 
 */
 class Mgallery extends CI_Model
 {
 	
 	public function in_gallery($data)
 	{

 		$this->db->insert('tb_gallery', $data['dataGallery']);
 	}

 	// get semua gallery
 	public function get_datImg()
 	{
 		$this->db->select('id,file_name,date_created,UUID');
 		$this->db->from('tb_gallery');
 		 $query = $this->db->get();
        return $query->result_array();

 	}

    // get hasil pencarian
    public function get_gallery($namafile)
    {
       $this->db->select('id,file_name,date_created,UUID');
        $this->db->from('tb_gallery');
        $this->db->like('file_name',$namafile);
         $query = $this->db->get();
        return $query->result_array();
    }

 	 	// get semua gallery
 	public function get_datImg_tingkat($tingkatID)
 	{
 		$this->db->select('gal.id,file_name,date_created,UUID');
 		$this->db->from('tb_gallery gal');
 		$this->db->join('tb_bab bab','bab.id=gal.babID');
 		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
 		$this->db->where('tp.tingkatID',$tingkatID);
 		 $query = $this->db->get();
        return $query->result_array();

 	}

 	 	// get semua gallery
 	public function get_datImg_mapel($mpID)
 	{
 		$this->db->select('gal.id,file_name,date_created,UUID');
 		$this->db->from('tb_gallery gal');
 		$this->db->join('tb_bab bab','bab.id=gal.babID');
 		$this->db->where('bab.tingkatPelajaranID',$mpID);
 		 $query = $this->db->get();
        return $query->result_array();

 	}

 	 	// get semua gallery
 	public function get_datImg_bab($babID)
 	{
 		$this->db->select('id,file_name,date_created,UUID');
 		$this->db->from('tb_gallery');
 		$this->db->where('babID',$babID);
 		 $query = $this->db->get();
        return $query->result_array();

 	}

 	public function del_gallery($UUID)
 	{
 			$this->db->where('UUID',$UUID);
		$this->db->delete('tb_gallery');
 	}

 	public function get_attribut($idBab)
 	{
 		$this->db->select('aliasTingkat,tp.keterangan as mp, judulBab');
         $this->db->from('tb_tingkat tkt' );
         $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
        $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');        
        $this->db->where('bab.id',$idBab);
        $query = $this->db->get();
        return $query->result_array()[0];
 	}


 	
 } ?>