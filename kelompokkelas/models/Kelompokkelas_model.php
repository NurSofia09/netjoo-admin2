<?php 
class Kelompokkelas_model extends CI_Model
{

	function __construct(){
	}

	/*Mengambil semua cabang*/
	function get_kelompok_kelas_byid_cabang($data){
		$this->db->select('*');
		$this->db->from('tb_cabang cabang');
        $this->db->join('tb_kelompok_kelas kk','cabang.id=kk.cabangID');		
		$this->db->where('cabang.id', $data);

		$this->db->order_by('kk.id desc');
		$query = $this->db->get();
		return $query->result();
	}	

	function insert_kk($data){
		$this->db->insert('tb_kelompok_kelas', $data);		
	}

	function drop_cabang($data){
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_cabang');
	}
	function update_cabang($data){
	$this->db->where('id', $data['id']);
	$array_update = array("namaCabang"=>$data['namaCabang'],
					"alamat"=>$data['alamat'],
					"kodeCabang"=>$data['kodeCabang']);
	$this->db->set($array_update);
	$this->db->update('tb_cabang');
}
}
?>