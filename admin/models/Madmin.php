<?php
class Madmin extends CI_Model
{

	function get_avatar_admin(){
		$this->db->select('avatar');
		$this->db->from('tb_pengguna');
		$this->db->where('id', $this->session->userdata('id'));

		$query = $this->db->get();
        return $query->result_array()[0]['avatar'];
	}

	public function daftarMapelbyTingkat($tingkatID) {
     	$this->db->distinct();
        $this->db->select('tp.id, tp.tingkatID, tp.matapelajaranID, tp.keterangan,mp.namaMataPelajaran');
        $this->db->from('tb_tingkat-pelajaran tp');
        $this->db->join('tb_mata-pelajaran mp','mp.id = tp.mataPelajaranID');
        $this->db->where('tingkatID', $tingkatID);
        $this->db->where('mp.status', '1');
        $this->db->where('tp.status', '1');
        $query = $this->db->get();
        return $query->result();
    }

}

?>