<?php 
/**
 * 
 */
 class Mmentorback extends CI_Model
 {
 	
 	function get_siswa($records_per_page='',$page='',$cabang,$status_mentor,$keySearch='',$id_guru='')
 	{
 		$this->db->group_by("namaDepan","asc");
 		$this->db->select("s.id as id_siswa,s.namaDepan, s.namaBelakang,p.namaPengguna,c.namaCabang,GROUP_CONCAT(distinct(g.namaBelakang)) as nm_mentor");
 		$this->db->join("tb_pengguna p","s.penggunaID=p.id");
 		$this->db->join("tb_cabang c","s.cabangID=c.id");
 		if ($status_mentor==0) {
 			$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id", 'left outer');
 			$this->db->join("tb_guru g","g.id=mentor.guruID", 'left outer');
 		} else if($status_mentor==1) {
 			$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id");
 			$this->db->join("tb_guru g","g.id=mentor.guruID");
 		} else{
 			$this->db->where('mentor.siswaID is null');
 			 	$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id", 'left outer');
 				$this->db->join("tb_guru g","g.id=mentor.guruID", 'left outer');
 		}
 		
 		if ($id_guru!="all") {
 			$this->db->where("mentor.guruID",$id_guru);
 		} 
 		

 		if ($cabang!="all") {
			$this->db->where('c.id', $cabang);
		}

		if ($keySearch!=''&&$keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);
		} 
		

 		$this->db->where("p.status",1);
 		$query=$this->db->get("tb_siswa s",$records_per_page,$page);
 		return $query->result();
 	}
 	// get data guru mentor
 	function get_mentor($records_per_page='',$page='',$mapel,$status_mentor,$keySearch,$id_guru)
 	{
 		$this->db->group_by("p.namaPengguna");
 		$this->db->select("g.id as id_guru,g.namaDepan, g.namaBelakang,p.namaPengguna,GROUP_CONCAT(distinct(mp.aliasMataPelajaran)) as mapel,mentor.id as mentorID,count(distinct(mentor.id)) as sum_siswa");
 		$this->db->join("tb_pengguna p","g.penggunaID=p.id");
 		$this->db->join("tb_mm-gurumapel mg","mg.guruID=g.id", 'left outer');
 		if ($status_mentor==0) {
 			 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id", 'left outer');
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id",'left outer');
 		} else if($status_mentor==1) {
 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id");
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id");
 		} else{
 			$this->db->where('mentor.guruID is null');
 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id", 'left outer');
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id",'left outer');
 		}
 		
 		if ($mapel!="all") {
 			$this->db->where("mg.mapelID",$mapel);
 		} 
 		
 				if ($keySearch!=''&&$keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("g.namaDepan",$keySearch);
			$this->db->or_like("g.namaBelakang",$keySearch);
		} 
 		$this->db->where("p.status",1);
 		$query=$this->db->get("tb_guru g",$records_per_page,$page);
 		return $query->result();
 	}
 	// insert mentoring
 	function in_mentoring($datMentoring='')
 	{
 		$this->db->insert_batch('tb_mm_mentor_siswa', $datMentoring);
 	}

 	public function del_mentor_siswa($id_siswa)
 	{
 		$this->db->where('siswaID', $id_siswa);
		$this->db->delete('tb_mm_mentor_siswa');
 	}

 	 	public function del_siswa_mentor($id_guru)
 	{
 		$this->db->where('guruID', $id_guru);
		$this->db->delete('tb_mm_mentor_siswa');
 	}

 	// get jumlah siswa
 	public function jumlah_siswa($cabang,$status_mentor,$keySearch,$id_guru)
 	{
 		$this->db->group_by("p.namaPengguna");
 		$this->db->select("s.id as id_siswa,GROUP_CONCAT(distinct(g.namaBelakang)) as nm_mentor");
 		$this->db->join("tb_pengguna p","s.penggunaID=p.id");
 		$this->db->join("tb_cabang c","s.cabangID=c.id");
 		if ($status_mentor==0) {
 			$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id", 'left outer');
 			$this->db->join("tb_guru g","g.id=mentor.guruID", 'left outer');
 		} else if($status_mentor==1) {
 			$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id");
 			$this->db->join("tb_guru g","g.id=mentor.guruID");
 		} else{
 			$this->db->where('mentor.siswaID is null');
 			 	$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id", 'left outer');
 				$this->db->join("tb_guru g","g.id=mentor.guruID", 'left outer');
 		}
 		
 		if ($id_guru!="all") {
 			$this->db->where("mentor.guruID",$id_guru);
 		} 
 				if ($keySearch!=''&&$keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);
		} 

 		if ($cabang!="all") {
			$this->db->where('c.id', $cabang);
		}
 		$this->db->where("p.status",1);
 		$query=$this->db->get("tb_siswa s");
 		return $query->num_rows();
 	}

 	public function get_siswa_mentor_by_idguru($id_guru='')
 	{
 		$this->db->select("s.namaDepan,s.namaBelakang,c.namaCabang");
 		$this->db->from("tb_siswa s");
 		$this->db->join("tb_cabang c","c.id=s.cabangID");
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.siswaID=s.id");
 		$this->db->where("mentor.guruID",$id_guru);
 		$query = $this->db->get();
 		return $query->result();
 	}

 	//get matapelajaran
 	public function get_mapel()
 	{
 		$this->db->select("mp.id as mapelID, mp.aliasMataPelajaran");
 		$this->db->from("tb_mata-pelajaran mp");
 		$this->db->where('status',1);
 		$query=$this->db->get();
 		return $query->result();

 	}

 	 	// get jumlah siswa
 	public function jumlah_mentor($mapel,$status_mentor,$keySearch)
 	{
 		$this->db->group_by("p.namaPengguna");
 		$this->db->join("tb_pengguna p","g.penggunaID=p.id");
 		$this->db->join("tb_mm-gurumapel mg","mg.guruID=g.id", 'left outer');
 		if ($status_mentor==0) {
 			 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id", 'left outer');
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id",'left outer');
 		} else if($status_mentor==1) {
 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id");
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id");
 		} else{
 			$this->db->where('mentor.guruID is null');
 		$this->db->join("tb_mata-pelajaran mp","mg.mapelID=mp.id", 'left outer');
 		$this->db->join("tb_mm_mentor_siswa mentor","mentor.guruID=g.id",'left outer');
 		}
 		
 		if ($mapel!="all") {
 			$this->db->where("mg.mapelID",$mapel);
 		} 
 		
 		 				if ($keySearch!=''&&$keySearch!=' ') {
			$this->db->like("p.namaPengguna",$keySearch);
			$this->db->or_like("s.namaDepan",$keySearch);
			$this->db->or_like("s.namaBelakang",$keySearch);
		} 

 		$this->db->where("p.status",1);
 		$query=$this->db->get("tb_guru g");
 		return $query->num_rows();
 	}

 	public function del_batch_siswa($id_guru,$id_siswa)
 	{
 		// for ($i=0; $i <count($id_siswa) ; $i++) { 
 			$this->db->where("guruID",$id_guru);
 			$this->db->where_in("siswaID",$id_siswa);
 		  $this->db->delete("tb_mm_mentor_siswa");
 		 // echo $id_siswa[$i]."<br>======<br>";
 		// }
 		
 	}
 } ?>