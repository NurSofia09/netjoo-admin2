<?php 
/**
 * 
 */
 class Mmateri extends CI_Model
 {
 	
 	public function in_materi($data)
 	{
 		$this->db->insert('tb_line_materi',$data);
 	}

 	// get data materi unutuk halaman list materi
 	public function get_all_materi()
 	{
 		$this->db->select('m.id as materiID,judulMateri,isiMateri,publish,m.date_created as tgl,judulSubBab,judulBab, tp.keterangan as mapel,aliasTingkat,UUID');
 		$this->db->from('tb_line_materi m');
 		$this->db->join('tb_subbab sub','m.subBabID=sub.id');
 		$this->db->join('tb_bab bab','sub.babID=bab.id');
 		$this->db->join('tb_tingkat-pelajaran tp','bab.tingkatPelajaranID=tp.id');
 		$this->db->join('tb_tingkat tkt','tp.tingkatID=tkt.id');
 		$this->db->where('m.status','1');
 		$query = $this->db->get();
        return $query->result_array();
 	}
 	// get materi berdasarkan UUID
    public function get_single_materi($UUID)
    {
        $this->db->select('id,UUID,judulMateri,isiMateri,publish,subBabID');
        $this->db->from('tb_line_materi');
        $this->db->where('UUID',$UUID);
        $query= $this->db->get();
        return $query->result_array()[0];
    }

    // get materi berdasarkan UUID
    public function get_single_materi_byid($id)
    {
        $this->db->select('id,judulMateri,isiMateri,publish,subBabID');
        $this->db->from('tb_line_materi');
        $this->db->where('id',$id);
        $query= $this->db->get();
        return $query->result();
    }


 	public function ch_materi($data)
 	{
 		$this->db->set($data['datMateri']);
 		$this->db->where('UUID',$data['UUID']);
 		$this->db->update('tb_line_materi');


 	}
 	public function drop_materi($UUID)
 	{
 		   $this->db->where('UUID', $UUID);
        $this->db->set('status', '0');
        $this->db->update('tb_line_materi');
 	}

 	// get info tingkat materi
    public function get_tingkat_info($subBabID)
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
 } ?>