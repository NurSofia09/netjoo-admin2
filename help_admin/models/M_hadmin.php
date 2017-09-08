<?php 
/**
 * 
 */
 class M_hadmin extends CI_model
 {
 	
 	public function sc_user_guide_admin($value='')
 	{
 		$this->db->select('id,url_pdf,status_user_guide');
 		$this->db->from('tb_user-guide');
 		$this->db->where('status',1);
 		$this->db->where('status_user_guide',1);
 		$query=$this->db->get();
 		return $query->result();
 	}

 } 
 ?>