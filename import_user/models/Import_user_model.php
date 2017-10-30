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
//get data batch
 public function get_batch_penggunaID($uuid)
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
 // select data excel
 public function select_excel_bup()
 {
 	$this->db->select("id,nama_file,tgl_import,url_file,uuid as uuid_xlsx,keterangan");
  	$this->db->from("tb_bup_import_excel");
  	$this->db->order_by("tgl_import","DESC");
  	$query=$this->db->get();
  	return $query->result();
 }
 // hapus pengguna by import excel
 public function del_by_import_xlsx($uuid_xlsx)
 {
 	$this->db->where("keterangan",$uuid_xlsx);
 	$this->db->delete("tb_pengguna");

 }
 	// hitung jumlah pengguna by import excel
  public function count_row_pengguna_by_xlsx($uuid)
 {
 	$this->db->where("keterangan",$uuid);
 	return $this->db->get("tb_pengguna")->num_rows();
 }
 public function count_row_ortu_by_xlsx($uuid='')
 {
 	 	$this->db->where("keterangan",$uuid);
 	 	$this->db->where("hakAkses","ortu");
 	return $this->db->get("tb_pengguna")->num_rows();
 }
 public function count_row_token_by_xlsx($uuid_excel)
 {
 	$this->db->where("p.keterangan",$uuid_excel);
 	$this->db->join("tb_siswa s","s.penggunaID=p.id");
 	$this->db->join("tb_token t","t.siswaID=s.id");
 	return $this->db->get("tb_pengguna p")->num_rows();
 }
//hapus data excel
 public function del_excel($id)
 {
 	$this->db->where("id",$id);
 	$this->db->delete("tb_bup_import_excel");
 }

 public function get_siswa_by_excel($uuid_excel,$my_select)
 {
 	$this->db->select($my_select);
 	$this->db->from("tb_pengguna p");
 	$this->db->join("tb_siswa s","s.penggunaID=p.id");
 	$this->db->where("p.keterangan",$uuid_excel);
 	$query=$this->db->get();
 	return $query->result();
 }
 //hapus data token
 public function del_token_by_excel($uuid_excel)
 {
 	$this->db->where( "keterangan", $uuid_excel );
	$this->db->delete('tb_token');
	if ($this->db->affected_rows()==0) {
		return "false";
	} else {
		return "true";
	}
 }

 // public function get_dat_Siswa($value='')
 // {
 // 	$this->db->select("s.id as siswaID");
 // 	$this->db->from();
 // 	$this->db->join();
 // }
// pengguna.namaPengguna
 public function get_token_xlsx($uuid_xlsx)
 {
 	$this->db->select("cabang.namaCabang,siswa.noIndukNeutron,siswa.namaDepan,siswa.tgl_lahir,tingkat.aliasTingkat,token.nomorToken");
 	$this->db->from("tb_pengguna pengguna");
 	$this->db->join("tb_siswa siswa","siswa.penggunaID=pengguna.id");
 	$this->db->join("tb_token token","token.siswaID=siswa.id");
 	$this->db->join("tb_cabang cabang","cabang.id=siswa.cabangID");
 	$this->db->join("tb_tingkat tingkat",'tingkat.id=siswa.tingkatID');
 	$this->db->order_by("cabang.namaCabang","asc");
 	$this->db->where("pengguna.keterangan",$uuid_xlsx);
 	// $this->db->limit(10);
 	$query=$this->db->get();
 	return $query->result_array();
 }
 } ?>