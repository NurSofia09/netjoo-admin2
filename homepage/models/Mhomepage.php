<?php

/**
 * 
 */
class Mhomepage extends CI_Model {
    # Start Function untuk form soal#	

    public function insert_pesan($data) {
        $this->db->insert('tb_pesan', $data);
    }

    public function insert_subs($data) {
        $this->db->insert('tb_subscribe', $data);
    }

    function gettestimoni() {
        $this->db->select("*");
        $this->db->from("tb_testimoni as testi");
        $this->db->join("tb_siswa as siswa","siswa.penggunaID = testi.id_user");
        $this->db->where("testi.status", 1);
        $this->db->where("testi.publish", 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function mail_exists($key)
    {
        $this->db->select("*");
        $this->db->where($key);
        $this->db->from('tb_subscribe');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}

?>