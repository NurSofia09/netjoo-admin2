<?php 
/**
* 
*/
class Mpengawas extends CI_Model
{
	
	public function insert_pengawas($data_pengawas) {

        $this->db->insert('tb_pengawas', $data_pengawas);   
    }

    public function get_allPengawas()
    {
    	$this->db->select('pengawas.id as idPengawas,nama,alamat,noKontak,namaPengguna,email,uuid,penggunaID');
    	$this->db->from('tb_pengawas pengawas');
    	$this->db->join('tb_pengguna pengguna','pengguna.id=pengawas.penggunaID');
    	$this->db->where('pengawas.status',1);
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function get_pengawas_by_uuid($uuid='')
    {
    	$this->db->select('pengawas.id as idPengawas,nama,alamat,noKontak,namaPengguna,email,uuid,penggunaID');
    	$this->db->from('tb_pengawas pengawas');
    	$this->db->join('tb_pengguna pengguna','pengguna.id=pengawas.penggunaID');
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

    public function ubah_pengawas($data_pengawas,$uuid)
    {
    	$this->db->where('uuid', $uuid);

        $this->db->set( $data_pengawas);

        $this->db->update('tb_pengawas');
    }

    public function del_pengawas($uuid)
    {
    	$this->db->where('uuid', $uuid);

        $this->db->set('status',0);

        $this->db->update('tb_pengawas');
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
    
}
 ?>