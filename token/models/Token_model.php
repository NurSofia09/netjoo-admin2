<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Token_model extends CI_Model{

	function get_token2($data,$status){
		$this->db->order_by('tb_token.id');

		if ($data!="all") {
			$this->db->where('masaAktif',$data);
		}
		if ($status==1) {
			$this->db->where('siswaID is not null');
			$this->db->join('tb_siswa', 'tb_token.siswaID = tb_siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_siswa.penggunaID');
		}else{
			$this->db->where('siswaID is null');
			$this->db->join('tb_siswa', 'tb_token.siswaID = tb_siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_siswa.penggunaID','left outer');

		}
		$this->db->select( '*,tb_token.id as tokenid,tb_token.status as tokenStatus' )->from( 'tb_token' ); 

		$query = $this->db->get(); 
		return $query->result(); 
	}

	function insert_token($data){
		$this->db->insert( 'tb_token', $data );		
	}

	function get_jumlah_token_stok($param=""){
		$this->db->select( 'id' )->from( 'tb_token' ); 
		$this->db->where('siswaID is NULL');
		if ($param==30 || $param==100 || $param==365) {
			$this->db->where('masaAktif',$param);
		}
		$query = $this->db->get(); 
		return $query->num_rows(); 
	}

	//get mahasiswa yang belum memiliki voucher
	function get_siswa_unvoucher2(){
		$query = "SELECT s.`id`, s.`namaDepan`,s.`namaBelakang`,c.`namaCabang`,p.`namaPengguna` FROM tb_siswa s 
		LEFT JOIN `tb_cabang` c
		ON s.`cabangID` = c.id
		JOIN `tb_pengguna` p ON
		p.`id` = s.`penggunaID`
		WHERE s.id NOT IN
		(
			SELECT t.`siswaID` FROM `tb_token` t
			JOIN tb_siswa s ON s.`id` = t.`siswaID`
			) AND s.`status`=1";

		$result = $this->db->query($query);
		return $result->result_array();
		}

	// get token kosong yang mau di set ke mahasiswa
	function token_kosong($data){
		$this->db->select( 'id' )->from( 'tb_token' );
		$this->db->where('masaAktif',$data['jenis_token']);
		$this->db->where('siswaID',NULL);
		$this->db->limit($data['jumlah_token']);
		$this->db->order_by('id','desc');
		$query = $this->db->get(); 
		return $query->result();  	
	}
		// update token untuk mahasiswa
	function set_token_to_mahasiswa($param){
		$sekarang = date('Y-m-d h:m:s');
		$this->db->where('id', $param['id_token']);
		$this->db->set('siswaID', $param['siswaID']);
		$this->db->update('tb_token');
	}

		// get token untuk diset ke mahasiswa
	function get_token_to_set($data){
		$this->db->select('*')->from( 'tb_token' );
		$this->db->where('siswaID',$data['id_siswa']);
		$this->db->where('nomorToken',$data['kode_token']);
		$query = $this->db->get(); 
		return $query->result();  	
	}

		//update token untuk siswa
	function set_token_single($data){
		$this->db->where('nomorToken', $data['kode_token']);
		$this->db->where('siswaID', $data['id_siswa']);
		$this->db->set('tanggal_diaktifkan', date('Y-m-d h:m:s'));
		$this->db->set('status', 1);


		$this->db->update('tb_token');
	}

		//drop token
	function drop_token($data){
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_token');
	}

	function update_token($data){
		$this->db->where('id', $data['id']);
		$this->db->set('tanggal_diaktifkan', date('Y-m-d h:m:s'));
		$this->db->set('status', 1);
		$this->db->update('tb_token');
	}
	//jumlah semua token dengan status 1
	function jumlah_data_token($masaAktif,$status){
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		if ($status==1) {
			$this->db->where('siswaID is not null');
			$this->db->join('tb_siswa siswa', 'token.siswaID = siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = siswa.penggunaID');
		}else{
			$this->db->where('siswaID is null');
			$this->db->join('tb_siswa siswa', 'token.siswaID = siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = siswa.penggunaID','left outer');

		}
	    return $this->db->get('tb_token token')->num_rows();
	}



  // data paginataion all token
	function data_token($number,$offset,$masaAktif,$status){
	    $this->db->select('*,token.siswaID,masaAktif,nomorToken,token.id as tokenid,token.status as tokenStatus,token.tanggal_diaktifkan,siswa.namaDepan,siswa.namaBelakang,CONCAT((`siswa`.`namaDepan`)," ", (`siswa`.`namaBelakang`)) AS nama_lengkap');
	    if ($masaAktif!="all") {
				$this->db->where('masaAktif',$masaAktif);
			}
			if ($status==1) {
				$this->db->where('siswaID is not null');
				$this->db->join('tb_siswa siswa', 'token.siswaID = siswa.id', 'left outer');
				$this->db->join('tb_pengguna', 'tb_pengguna.id = siswa.penggunaID');
			}else{
				$this->db->where('siswaID is null');
				$this->db->join('tb_siswa siswa', 'token.siswaID = siswa.id', 'left outer');
				$this->db->join('tb_pengguna', 'tb_pengguna.id = siswa.penggunaID','left outer');

			}

			$this->db->order_by('token.id');
	    return $query = $this->db->get('tb_token token',$number,$offset)->result();       
	}
	  // data hasil cari paginataion all token
	function data_cari_pengguna_token($number,$offset,$masaAktif,$status,$keySearch){
	   	$this->db->select('*');
	   	if ($masaAktif!="all") {
				$this->db->where('masaAktif',$masaAktif);
			}
			$this->db->like('tokenid',$keySearch);
			$this->db->or_like('namaDepan',$keySearch);
			$this->db->or_like('namaBelakang',$keySearch);
			$this->db->or_like('nama_lengkap',$keySearch);
			$this->db->or_like('nomorToken',$keySearch);
			$this->db->or_like('namaPengguna',$keySearch);
	    return $query = $this->db->get('view_pengguna_token',$number,$offset)->result();      
	}
	
	function data_cari_token($number,$offset,$masaAktif,$status,$keySearch){
	   	$this->db->select('*');
	   	if ($masaAktif!="all") {
				$this->db->where('masaAktif',$masaAktif);
			}
			$this->db->like('tokenid',$keySearch);
			$this->db->or_like('nomorToken',$keySearch);
	    return $query = $this->db->get('view_token_belum_digunakan',$number,$offset)->result();      
	}
	public function sum_cari_pengguna_token($masaAktif,$status,$keySearch)
	{
			if ($masaAktif!="all") {
				$this->db->where('masaAktif',$masaAktif);
			}
			$this->db->like('tokenid',$keySearch);
			$this->db->or_like('namaDepan',$keySearch);
			$this->db->or_like('namaBelakang',$keySearch);
			$this->db->or_like('nama_lengkap',$keySearch);
			$this->db->or_like('nomorToken',$keySearch);
			$this->db->or_like('namaPengguna',$keySearch);
		return $this->db->get('view_pengguna_token')->num_rows();
	}

	public function sum_cari_data_token($masaAktif,$status,$keySearch)
	{
		$this->db->select('*');
	   	if ($masaAktif!="all") {
				$this->db->where('masaAktif',$masaAktif);
			}
			$this->db->like('tokenid',$keySearch);
			$this->db->or_like('nomorToken',$keySearch);
		return $this->db->get('view_token_belum_digunakan')->num_rows();
	}
	//get mahasiswa yang belum memiliki voucher
	function get_siswa_unvoucher($number,$offset,$keySearchSiswa){

		$this->db->select('*');
		if ($keySearchSiswa!='' && $keySearchSiswa!=' ') {
			 $this->db->like('namaDepan',$keySearchSiswa);
			 $this->db->or_like('namaBelakang',$keySearchSiswa);
			 $this->db->or_like('nama_lengkap',$keySearchSiswa);
			 $this->db->or_like('namaCabang',$keySearchSiswa);
			 $this->db->or_like('namaPengguna',$keySearchSiswa);
		}
		
 		return $query = $this->db->get('view_siswa_unvoucher',$number,$offset)->result_array(); 
	}
	function jumlah_siswa_unvoucher(){
 		return $this->db->get('view_siswa_unvoucher')->num_rows();
	}
	function jumlah_cari_siswa_unvoucher($keySearchSiswa){
			$this->db->like('namaDepan',$keySearchSiswa);
			$this->db->or_like('namaBelakang',$keySearchSiswa);
			$this->db->or_like('nama_lengkap',$keySearchSiswa);
			$this->db->or_like('namaCabang',$keySearchSiswa);
			$this->db->or_like('namaPengguna',$keySearchSiswa);
 		return $this->db->get('view_siswa_unvoucher')->num_rows();
	}


}
?>