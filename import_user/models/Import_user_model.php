<?php 
/**
 * 
 */
 class Import_user_model extends CI_model
 {
 	
 // insert_batch siswa
 public function myinsert_batch($datArr,$my_table)
 {
 	  $this->db->insert_batch($my_table, $datArr);
 }

 public function myselect_batch($uuid)
 {
 	$this->db->select('id as penggunaID');
 	$this->db->from("tb_pengguna");
 	foreach ($uuid as $key) {
 		 	// $this->db->where();
 		$this->db->or_where("uuid_user",$key["uuid_user"]);
 	}

 	$query=$this->db->get();
 	return $query->result_array();
 }

 public function select_cabang()
 {
 	$this->db->select("id,namaCabang");
 	$this->db->from("tb_cabang");
 	$query=$this->db->get();
 	return $query->result();
 }

 public function in_file_excel($data)
 {
 	$this->db->insert("tb_bup_import_excel",$data);
 }
 } ?>