<?php
class Mbug extends CI_Model

{



# fungsi insert ke database bug
	function insert_bug($data){
		$this->db->insert('tb_laporan_bug', $data);
	}


	public function get_all_bugs() {
		$this->db->select( 'bug.id, isiError, bug.date_created, halaman, bug.status, aksi, pengguna.namaPengguna');
		$this->db->from( 'tb_laporan_bug bug' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=bug.penggunaID');

		$query = $this->db->get();
		return $query->result();
	}


	function update_bug($data){
		$datas = array('aksi' => $data['aksi'], 'status'=>1);
		$this->db->where( 'id', $data['id'] );
		$this->db->update( 'tb_laporan_bug', $datas );
	}

	function drop($idlapor){
		$this->db->where( 'id', $idlapor);
		$this->db->delete('tb_laporan_bug');
	}

}

?>