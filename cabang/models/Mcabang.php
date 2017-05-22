<?php 
class Mcabang extends CI_Model
{

	function __construct(){
	}

	/*Mengambil semua cabang*/
	function get_all_cabang(){
		$this->db->select('*');
		$this->db->from('tb_cabang cabang');
		$this->db->order_by('id desc');


		$query = $this->db->get();
		return $query->result();
	}	

	function insert_cabang($data){
		$this->db->insert('tb_cabang', $data);		
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