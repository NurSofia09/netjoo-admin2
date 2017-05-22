<?php

class Mortu extends CI_Model {
    #Start function pengaturan profile siswa#
    //front


     public function get_siswa($id) {
        $query = "SELECT * FROM `tb_orang_tua` ortu 
                JOIN tb_siswa sis ON ortu.siswaID = sis.id
                WHERE ortu.penggunaID = $id";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    

}

?>