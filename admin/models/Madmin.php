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


    # get report nilai oleh id pengguna tertentu
    function get_report_paket(){
        // $id = $this->session->userdata('id');
        
        $query = "SELECT * FROM `tb_report-paket` AS p
                    JOIN `tb_mm-tryoutpaket` mm ON mm.`id` = p.`id_mm-tryout-paket`
                    JOIN `tb_paket` pkt ON pkt.`id_paket` = mm.`id_paket`
                    JOIN tb_tryout t ON t.`id_tryout` = mm.`id_tryout`
                    JOIN `tb_siswa` sis ON sis.`id` = p.`siswaID`
                ";
        $result = $this->db->query($query);
        return $result->result_array();      
    }

    public function dropreport_t( $id ) {

        $this->db->where( 'id_report', $id );
        $this->db->delete('`tb_report-paket');

    }

}

?>