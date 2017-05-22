<?php

class Mpesan extends CI_Model {
    #Start function pengaturan profile siswa#

    public function tampil_pesan() {
        $this->db->select('*');
        $this->db->from('tb_pesan');
        $this->db->where('status',1);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    function hapus_pesan($idpesan) {
        $this->db->set('status', 0);
        $this->db->where('id_pesan', $idpesan);
        $this->db->update('tb_pesan');
    }

}

?>