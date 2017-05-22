<?php 

class Ortuback_model extends CI_Model{

	/*Mengambil report berdasarkan nilai*/
	function get_report_nilai($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'nilai'");
		$this->db->order_by("l.id", 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan absen*/
	function get_report_absen($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'absen'");
		$this->db->order_by("l.id", 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan umum*/
	function get_report_umum($id_ortu){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna", $id_ortu);
		$this->db->where("l.jenis = 'umum'");
		$this->db->order_by("l.id", 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil semua report*/
	function get_report_all($data,$id){
		$this->db->select('o.namaOrangTua, l.jenis, l.isi');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s ',' o.siswaID = s.id');
		$this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
		$this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
		$this->db->where("peng.namaPengguna",$id );
		$this->db->order_by("l.id", 'desc');

		if ($data['jenis']!="all") {
			$this->db->where('l.jenis', $data['jenis']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}	

	/*Mengambil report berdasarkan nilai*/
	function get_nama($id_ortu){
		$this->db->select('s.id, s.namaDepan, s.namaBelakang, o.namaOrangTua');
		$this->db->from('tb_orang_tua o');
		$this->db->join('tb_siswa s', 'o.siswaID=s.id');
		$this->db->where("o.penggunaID", $id_ortu);

		$query = $this->db->get();
		return $query->result_array();
	}	

	 public function namasiswa($id) {
        $query = "SELECT * FROM `tb_orang_tua` ortu 
				JOIN tb_siswa sis ON ortu.siswaID = sis.id 
				JOIN `tb_pengguna` peng ON peng.id = sis.penggunaID 
				WHERE `peng`.`namaPengguna`= '$id'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_Ortu($ortuID='')
	{
		$this->db->select('*');
		$this->db->from('tb_orang_tua');
		$this->db->where('penggunaID',$ortuID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_count($pengguna='')
	{
		$this->db->select('count(*) as numrows');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.read_status_ortu',0);
		$this->db->where('o.penggunaID',$pengguna);

		$query = $this->db->get();
		return $query->result_array()[0]['numrows'];
	}

	public function get_daftar_pesan($pengguna='')
	{
		$this->db->select('*');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.read_status_ortu',0);
		$this->db->where('o.penggunaID',$pengguna);
		$this->db->limit(3);
		$this->db->order_by('l.id', 'desc');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_pesan_by_id($id='')
	{
		$this->db->select('*');
		$this->db->from('tb_laporan_ortu l');
		$this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
		$this->db->where('l.UUID',$id);

		$query = $this->db->get();
		return $query->result_array();
	}

	// update status read ortu jadi 1
	public function update_read($UUID)
	{
		$this->db->set('read_status_ortu',1);
		$this->db->where('UUID', $UUID);
		$this->db->update('tb_laporan_ortu');
	}

	
}

?>