<?php

class Msubscribe extends CI_Model {
    #Start function pengaturan profile siswa#

    public function tampil_subs() {
        $this->db->select('*');
        $this->db->from('tb_subscribe');
        $this->db->where('status', 1);

        $query = $this->db->get();
        return $query->result_array();
    }

    function hapus_subs($idsubs) {
        $this->db->set('status', 0);
        $this->db->where('id', $idsubs);
        $this->db->update('tb_subscribe');
    }

    function addberita($data) {
        $this->db->insert('tb_berita', $data);
    }
    
    function get_emailsubs() {
        $this->db->select('email as emailsub');
        $this->db->from('tb_subscribe');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>