<?php 
/**
 * 
 */
 class Help_model extends CI_model
 {
 	
 	public function sc_user_guide($value='')
 	{
 		$this->db->select('id,url_pdf,status_user_guide');
 		$this->db->from('tb_user-guide');
 		$this->db->where('status',1);
 		$query=$this->db->get();
 		return $query->result();
 	}
 	public function select_user_guide($id='')
 	{
 		$this->db->select('url_pdf');
 		$this->db->from('tb_user-guide');
 		$this->db->where('id',$id);
 		$this->db->where('status',1);
 		$query=$this->db->get();
 		return $query->result();
 	}

 } ?>