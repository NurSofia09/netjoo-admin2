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

 public function del_one_record($config_del)
 {
 	$mytable=$config_del["mytable"];
 	$key_condition=$config_del['key_condition'];
 	$val_condition=$config_del['val_condition'];
	$this->db->where($key_condition, $val_condition);
	$this->db->delete($mytable); 
 }

 public function get_katasandi($penggunaID)
 {
 	$this->db->where("id",$penggunaID);
 	$this->db->select("kataSandi");
 	$this->db->from("tb_pengguna");
 	$query=$this->db->get();
 	return $query->result();
 }

 public function del_import($post)
 {
 	$hakakses=$post["hakakses"];
 	$this->db->where('regTime >=', $post["tanggal_mulai"]);
 	$this->db->where('regTime <=', $post["tanggal_akhir"]);
 	$this->db->where("hakAkses",$hakakses);
 	$this->db->delete("tb_pengguna");
 }

 public function del_join_import($post)
 {
	$this->db->select('penggunaID');
	$this->db->from('tb_pengguna p');
	$this->db->join('tb_siswa s',"s.penggunaID=p.id");
	// $this->db->where('p.regTime >=', $post["tanggal_mulai"]);
	// $this->db->where('p.regTime <=', $post["tanggal_akhir"]);
	$this->db->where('cabangID',$post["cabangID"]);
	$subQuery = $this->db->_compile_select();

	$this->db->_reset_select();
	// And now your main query
	 	// $this->db->where('tb_pengguna.regTime >=', $post["tanggal_mulai"]);
	 	// $this->db->where('tb_pengguna.regTime <=', $post["tanggal_akhir"]);
	$this->db->where_in("tb_pengguna.id",$subQuery);
	$this->db->delete("tb_pengguna");


 }

 public function count_row_pengguna($post)
 {
 	 	$this->db->where('regTime >=', $post["tanggal_mulai"]);
 	$this->db->where('regTime <=', $post["tanggal_akhir"]);
 	$this->db->where("hakAkses",$post["hakakses"]);
 	return $this->db->get("tb_pengguna")->num_rows();

 }

 public function select_excel_bup()
 {
 	$this->db->select("id,nama_file,tgl_import,url_file,uuid as uuid_xlsx,keterangan");
  	$this->db->from("tb_bup_import_excel");
  	$this->db->order_by("tgl_import","DESC");
  	$query=$this->db->get();
  	return $query->result();
 }

 public function del_by_import_xlsx($uuid_xlsx)
 {
 	$this->db->where("keterangan",$uuid_xlsx);
 	$this->db->delete("tb_pengguna");

 }

  public function count_row_pengguna_by_xlsx($uuid)
 {
 	$this->db->where("keterangan",$uuid);
 	return $this->db->get("tb_pengguna")->num_rows();
 }

 public function del_excel($id)
 {
 	$this->db->where("id",$id);
 	$this->db->delete("tb_bup_import_excel");
 }

 } ?>