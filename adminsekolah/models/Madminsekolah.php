<?php 
/**
* 
*/
class Madminsekolah extends CI_Model
{
	
	public function insert_pengawas($data_pengawas) {

        $this->db->insert('tb_sekolah_pengguna', $data_pengawas);   
    }

    public function get_allPengawas()
    {
    	$this->db->select('`namaPengguna`, `email`, `uuid`, `penggunaID`, `sekolah`.`id`, `sekolah`.`namaSekolah`,`sekpeng`.`status`,`sekpeng`.`sekolahID`');
    	$this->db->from('`tb_sekolah` `sekolah`');
        $this->db->join('`tb_sekolah_pengguna` `sekpeng` ','`sekpeng`.`sekolahID` = `sekolah`.`id`');
    	$this->db->join('`tb_pengguna` `pengguna` ','`pengguna`.`id`=`sekpeng`.`penggunaID`');
        $this->db->where('sekpeng.status','1');
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function get_adminsekolah_by_uuid($uuid='')
    {
    	$this->db->select('`namaPengguna`, `email`, `uuid`, `penggunaID`, `sekolah`.`id` , `sekolah`.`namaSekolah`,`sekpeng`.`status`,`sekpeng`.`sekolahID`  as sekID');
    	$this->db->from('`tb_sekolah` `sekolah`');
        $this->db->join('`tb_sekolah_pengguna` `sekpeng` ','`sekpeng`.`sekolahID` = `sekolah`.`id`');
        $this->db->join('`tb_pengguna` `pengguna` ','`pengguna`.`id`=`sekpeng`.`penggunaID`');
    	$this->db->where('uuid',$uuid);
    	$query = $this->db->get();
    	return $query->result_array()[0];
    }

    public function ubah_email($email,$uuid)
    {
    	$this->db->where('uuid', $uuid);

        $this->db->set('eMail', $email);

        $this->db->update('tb_pengguna');
    }

    public function ubah_adminsekolah($data_adminsekolah,$uuid)
    {
    	$this->db->where('uuid', $uuid);

        $this->db->set($data_adminsekolah);

        $this->db->update('tb_sekolah_pengguna');
    }

    public function del_adminsekolah($uuid)
    {
    	$this->db->where('uuid', $uuid);

        $this->db->set('status',0);

        $this->db->update('tb_sekolah_pengguna');
    }

    public function get_namaPengguna($penggunaID)
    {
        echo $penggunaID;
        $this->db->where('id',$penggunaID);
        $this->db->select('namaPengguna');
        $this->db->from('tb_pengguna');
        $query = $this->db->get();
        return $query->result_array()[0]['namaPengguna'];

    }
    public function reset_password($kataSandi,$penggunaID)
    {
        $this->db->where('id', $penggunaID);
        $this->db->set('kataSandi',$kataSandi);
        $this->db->update('tb_pengguna');
    }
     public function scsekolah()
    {
        $this->db->select('id,namaSekolah');
                $this->db->from('tb_sekolah');
                // $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
 ?>