<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admincabang_model extends CI_model {
	 //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $column_search = array('id_report','p.namaPengguna',
		'c.namaCabang',
		's.namaBelakang',
		's.namaDepan',
		'jmlh_benar',
		'jmlh_kosong',
		'jmlh_salah',
		'total_nilai',
		'poin',
		'nm_paket',
		'pk.tgl_pengerjaan');

	var $order = array('id_report' => 'desc','c.namaCabang');

	//get report all
	function get_report_paket($data,$records_per_page='',$page=''){
		$this->db->order_by('tgl_pengerjaan','desc');
	
		if ($data['cabang']!="all") {
			$this->db->where('id_cabang', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('id_paket', $data['paket']);
		}

		// $this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');
		$query = $this->db->get('view_laporan_paket_TO',$records_per_page,$page);
		return $query->result_array();
	}

		//cari report all
	function cari_report_paket($data,$records_per_page='',$page='',$keySearch=''){
		$this->db->order_by('tgl_pengerjaan','asc');

		$this->db->like('namaPengguna',$keySearch);
		$this->db->or_like('nm_paket',$keySearch);
		$this->db->or_like('namaDepan',$keySearch);
		$this->db->or_like('namaPengguna',$keySearch);
		$this->db->or_like('namaBelakang',$keySearch);
		$this->db->or_like('nama_lengkap',$keySearch);
		$this->db->or_like('tgl_pengerjaan',$keySearch);
	
		if ($data['cabang']!="all") {
			$this->db->where('id_cabang', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('id_paket', $data['paket']);
		}
			
		// $this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');
		$query = $this->db->get('view_laporan_paket_TO',$records_per_page,$page);
		return $query->result_array();
	}

	function get_report_paket_pdf($data){
		$this->db->order_by('namaDepan','asc');
	
		if ($data['cabang']!="all") {
			$this->db->where('id_cabang', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('id_paket', $data['paket']);
		}

		// $this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');
		$query = $this->db->get('view_laporan_paket_TO');
		return $query->result_array();
	}

		//jumlah report all
	function jumlah_report_paket($data){
		if ($data['cabang']!="all") {
			$this->db->where('id_cabang', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('id_paket', $data['paket']);
		}

		// $this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');
		$query = $this->db->get('view_laporan_paket_TO');
		return $query->num_rows();
	}

	function jumlah_cari_report_paket($data,$keySearch){
		if ($data['cabang']!="all") {
			$this->db->where('id_cabang', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('id_paket', $data['paket']);
		}
				$this->db->like('namaPengguna',$keySearch);
		$this->db->or_like('nm_paket',$keySearch);
		$this->db->or_like('namaDepan',$keySearch);
		$this->db->or_like('namaPengguna',$keySearch);
		$this->db->or_like('namaBelakang',$keySearch);
		$this->db->or_like('nama_lengkap',$keySearch);
		$this->db->or_like('tgl_pengerjaan',$keySearch);

		// $this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');
		$query = $this->db->get('view_laporan_paket_TO');
		return $query->num_rows();
	}

	//get paket berdasarkan id to
	function get_paket($id_to){
		$query = " SELECT nm_paket, p.id_paket FROM
		(
		SELECT id_paket FROM `tb_mm-tryoutpaket`
		WHERE id_tryout = $id_to
		) mmp JOIN `tb_paket` p ON p.`id_paket` = mmp.id_paket";

		$result = $this->db->query($query);
		return $result->result_array();
	}

// jumlah siswa yang terdaftar to
	function get_registered_siswa_to($data){
		if($data['cabang']==='all'){
			$query = "SELECT  COUNT(DISTINCT(ht.id_siswa)) AS jumlah_siswa 
			FROM `tb_hakakses-to` ht
			WHERE `id_tryout` = ".$data['id_tryout'];
		}else{
			$query = "SELECT  COUNT(DISTINCT(ht.id_siswa)) AS jumlah_siswa 
			FROM `tb_hakakses-to` ht
			JOIN `tb_siswa` s ON ht.`id_siswa` = s.`id`
			WHERE `id_tryout` = ".$data['id_tryout']."
			AND s.`cabangID` = ".$data['cabang']."
			";
		}
		$result = $this->db->query($query);
		return $result->result_array();
	}

	// jumlah siswa yang sudah ikut berpartisipasi di to tertentu
	function get_participants_siswa_to($data){
		if($data['cabang']==='all'){		
			$query = "SELECT COUNT(DISTINCT(siswaID)) AS jumlah_siswa FROM `tb_report-paket` rp
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			WHERE tp.`id_tryout` = ".$data['id_tryout'];
		}else{
			$query = "SELECT COUNT(DISTINCT(siswaID)) AS jumlah_siswa FROM `tb_report-paket` rp
			JOIN tb_siswa s ON s.`id` = rp.`siswaID`
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			WHERE tp.`id_tryout` = ".$data['id_tryout']."
			AND s.`cabangID` = ".$data['cabang'];
		}
		
		$result = $this->db->query($query);
		return $result->result_array();
	}

	// jumlah paket yang ada di to tertentu
	function get_paket_by_id_to($data){
		if ($data['cabang']==='all') {
			$query = "SELECT COUNT(DISTINCT(p.id_paket)) as jumlah_paket FROM `tb_paket` p
			JOIN `tb_mm-tryoutpaket` tp ON p.id_paket = tp.id_paket
			WHERE tp.id_tryout = ".$data['id_tryout'];
		} else {
			$query = "SELECT COUNT(DISTINCT(p.id_paket)) AS jumlah_paket FROM `tb_paket` p
			JOIN `tb_mm-tryoutpaket` tp ON p.id_paket = tp.id_paket
			JOIN `tb_hakakses-to` t ON t.`id_tryout` = tp.`id_tryout`
			JOIN `tb_siswa` s ON s.`id` = t.`id_siswa`
			
			WHERE tp.id_tryout = ".$data['id_tryout'].
			" AND `cabangID` =".$data['cabang'];	
		}
		
		

		$result = $this->db->query($query);
		return $result->result_array();
	}

	// jumlah paket iyang sudah di kerjakan oleh siswa berdasarkan tryout tertentu
	function get_paket_done($data){
		if ($data['cabang']==='all') {
			$query = "SELECT COUNT(siswaID) AS jumlah_paket FROM `tb_report-paket` rp
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			WHERE tp.`id_tryout` = ".$data['id_tryout'];
		} else {
			$query = "SELECT COUNT(siswaID) AS jumlah_paket FROM `tb_report-paket` rp
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			JOIN `tb_siswa` s ON s.`id` = rp.`siswaID`
			WHERE tp.`id_tryout` = ".$data['id_tryout']."
			AND cabangID =".$data['cabang'];
		}		
		$result = $this->db->query($query);
		return $result->result_array();
	}

	// jumlah paket soal yang dikerjakan tetapi gagal
	function paket_gagal($data){
		if ($data['cabang']==='all') {
			$query = "SELECT COUNT(id_report) as jumlah_report FROM `tb_report-paket` rp
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			WHERE tp.`id_tryout` =  ".$data['id_tryout'].
			" AND jmlh_benar+jmlh_salah+jmlh_kosong  = jmlh_kosong";
		} else {
			$query  = "SELECT COUNT(id_report) AS jumlah_report FROM `tb_report-paket` rp
			JOIN `tb_mm-tryoutpaket` tp ON rp.`id_mm-tryout-paket` = tp.id
			JOIN tb_siswa s ON s.`id` = rp.`siswaID`
			WHERE tp.`id_tryout` =  ".$data['id_tryout']."
			AND jmlh_benar+jmlh_salah+jmlh_kosong  = jmlh_kosong
			AND cabangID = ".$data['id_tryout'];
		}
		
		

		$result = $this->db->query($query);
		return $result->result_array();
	}
	// hapus report laporan //
	public function delete_report($data){
		$this->db->where('id_report',$data['id_report']);
		$this->db->delete('tb_report-paket');
	}
	// hapus report laporan //








	function get_datatables($data, $request,$repost_post)
	{
		$this->get_report_paket_ss($data, $request,$repost_post);
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	//get report all
	function get_report_paket_ss($data, $request,$repost_post){	
		$this->db->order_by('s.namaDepan','asc');
		$this->db->select('id_report,p.namaPengguna,
			c.namaCabang,
			s.namaBelakang,
			s.namaDepan,
			jmlh_benar,
			jmlh_kosong,
			jmlh_salah,
			total_nilai,
			poin,
			nm_paket,
			pk.tgl_pengerjaan');

		$this->db->from('tb_report-paket pk');

		$this->db->join('tb_siswa s' , 'pk.siswaID=s.id');
		$this->db->join('tb_pengguna p' , 'p.id = pk.id_pengguna');
		$this->db->join('tb_mm-tryoutpaket mmto' , 'mmto.id = pk.id_mm-tryout-paket');
		$this->db->join('tb_paket pkt' , 'pkt.id_paket = mmto.id_paket');
		$this->db->join('tb_cabang c' , 'c.id = s.cabangID');

		if ($data['cabang']!="all") {
			$this->db->where('c.id', $data['cabang']);
		}

		if ($data['tryout']!="all") {
			$this->db->where('mmto.id_tryout', $data['tryout']);
		}
		if ($data['paket']!="all") {
			$this->db->where('mmto.id_paket', $data['paket']);
		}	
		$this->db->where('pk.`tgl_pengerjaan >=','2017-04-20');

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
				}
				$i++;
			}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function count_filtered($data, $request,$repost_post){
		$this->get_report_paket_ss($data, $request,$repost_post);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->db->from('tb_report-paket');
		return $this->db->count_all_results();
	}

}