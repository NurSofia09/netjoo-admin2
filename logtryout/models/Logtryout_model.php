<?php
class Logtryout_model extends CI_Model {

	public function get_log_tryout($data,$records_per_page,$page,$keySearch){
		$this->db->select('l.id, siswa_id ,s.`namaDepan`, s.`namaBelakang`, waktu_mulai, waktu_selesai, status_pengerjaan, p.`nm_paket`, t.`nm_tryout`,p.`durasi`,u.namaPengguna');

		$this->db->join('tb_mm-tryoutpaket mt','mt.id = l.mm_tryout_paket_id');
		$this->db->join('tb_paket p','p.id_paket=mt.id_paket');
		$this->db->join('tb_tryout t','t.id_tryout = mt.id_tryout');
		$this->db->join('tb_siswa s','l.siswa_id = s.id');
		$this->db->join('tb_pengguna u','s.penggunaID = u.id');

		$this->db->join('tb_cabang c', 'c.id = s.cabangID');

		if ($keySearch != '' && $keySearch !=' ' ) {
			$this->db->like('u.namaPengguna',$keySearch);
			$this->db->or_like('p.nm_paket',$keySearch);
			$this->db->or_like('s.namaDepan',$keySearch);
			$this->db->or_like('u.namaPengguna',$keySearch);
			$this->db->or_like('s.namaBelakang',$keySearch);
			$this->db->or_like('waktu_mulai',$keySearch);
		}

		// kalo filternya ada yang di pilih
		if ($data['cabang']!="all") {
			$this->db->where('c.id',$data['cabang']);
		}
		if ($data['tryout']!="all") {
			$this->db->where('t.`id_tryout`',$data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('p.id_paket',$data['paket']);
		}
		$query = $this->db->get('tb_log_pengerjaan_to l',$records_per_page,$page);
		return $query->result_array();
	}



	public function jumlah_log_tryout($data)
	{
		$this->db->from('tb_log_pengerjaan_to l');

		$this->db->join('tb_mm-tryoutpaket mt','mt.id = l.mm_tryout_paket_id');
		$this->db->join('tb_paket p','p.id_paket=mt.id_paket');
		$this->db->join('tb_tryout t','t.id_tryout = mt.id_tryout');
		$this->db->join('tb_siswa s','l.siswa_id = s.id');
		$this->db->join('tb_pengguna u','s.penggunaID = u.id');

		$this->db->join('tb_cabang c', 'c.id = s.cabangID');

		// kalo filternya ada yang di pilih
		if ($data['cabang']!="all") {
			$this->db->where('c.id',$data['cabang']);
		}
		if ($data['tryout']!="all") {
			$this->db->where('t.`id_tryout`',$data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('p.id_paket',$data['paket']);
		}
		
		
		
		$query=$this->db->get();
		return  $query->num_rows();
	}

}
?>