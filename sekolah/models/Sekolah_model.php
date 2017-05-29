<?php 
/**
* 
*/
class Sekolah_model extends CI_Model
{
	
	public function insert_pengawas($data_pengawas) {

        $this->db->insert('tb_pengawas', $data_pengawas);   
    }

    public function get_allPengawas()
    {
    	$this->db->select('s.id as id_sekolah,namaSekolah,alamat,noKontak,namaPengguna,email,uuid,penggunaID');
    	$this->db->from('tb_sekolah s');
    	$this->db->join('tb_pengguna pengguna','pengguna.id=s.penggunaID');
    	$this->db->where('s.status',1);
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


    public function get_all_provinsi(){
        $this->db->select('*');
        $this->db->from('tb_provinsi');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kotakabupaten_byprovinceid($province_id){
        $this->db->select('*');
        $this->db->from('tb_kabupaten_kota');
        $this->db->where('province_id', $province_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kecamatan_bykotakabupatenid($kotakabupaten_id){
        $this->db->select('*');
        $this->db->from('tb_kecamatan');
        $this->db->where('regency_id', $kotakabupaten_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_sekolah($data) {
        $this->db->insert('tb_sekolah', $data);   
    }

    public function get_all_sekolah(){
        $this->db->select('sekolah.id as sekolahID, namaSekolah, alamat, phone, k.`name` AS namaKecamatan, kab.`name` AS namaKota, p.`name` AS namaProvinsi');
        $this->db->from('(SELECT * FROM tb_sekolah) AS sekolah');
        $this->db->join('tb_kecamatan k',' k.id = sekolah.kecamatanID');
        $this->db->join('`tb_kabupaten_kota` kab',' kab.id = k.`regency_id`');
        $this->db->join('`tb_provinsi` p',' kab.`province_id` = p.id');

        $query = $this->db->get();
        return $query->result_array();
    }
    
    function delete_sekolah($id_siswa){
        $this->db->delete('tb_sekolah', array('id' => $id_siswa));
    }
}
?>