<?php 
class Webservice_model extends CI_Model
{

//  GET SISWA YANG ADA DI SKOLAH TERTENTU.	
	function get_siswa_at_school($data){
		$query = "SELECT `id`, `namaDepan`, `namaBelakang`, `alamat`, `noKontak`, `penggunaID`, `photo`, `biografi`, `status` FROM tb_siswa s 
		WHERE sekolahID = ".$data;
$result = $this->db->query($query);
return $result->result_array();
}

//  GET PENGGUNA YANG AKAN TRYOUT
function get_pengguna_on_tryout($data){
	$query = "SELECT p.id,namaPengguna, kataSandi, eMail, regTime, aktivasi, avatar
	, `oauth_uid`, `oauth_uid`,hakAkses,p.status, last_akses
	FROM tb_pengguna p
	JOIN tb_siswa s ON s.`penggunaID` = p.`id`
	WHERE sekolahID = $data ";
	$result = $this->db->query($query);
	return $result->result_array();	
}

// GET HAK AKSES DI TRYOUT TERTENTU
function get_hak_akses_on_tryout($data){
	$this->db->select('*');
	$this->db->from('tb_hakakses-to ha');
	$this->db->where('id_tryout',$data);
	$query = $this->db->get();
	return $query->result_array();
}

// GET SOAL DI TO TERTENTU
function get_soal_on_tryout($data){
	$query = "SELECT p.id_soal,judul_soal, soal, jawaban, 
	kesulitan, sumber,audio,
	b.`create_by`, b.random, b.publish, b.UUID, b.status, gambar_soal, 
	pembahasan, gambar_pembahasan, video_pembahasan, status_pembahasan, link        
	FROM `tb_banksoal` b
	JOIN `tb_mm-paketbank` p ON b.`id_soal` = p.`id_soal`
	JOIN tb_paket pk ON pk.`id_paket` = p.`id_paket`
	JOIN `tb_mm-tryoutpaket` mmp ON mmp.`id_paket` = pk.`id_paket`
	JOIN `tb_tryout` t ON t.`id_tryout` = mmp.`id_tryout`
	WHERE t.`id_tryout` = $data";
	$result = $this->db->query($query);
	return $result->result_array();	
}

// GET RELASI MM PAKET
function get_mm_paket($data){
	$query = "SELECT mm.id,mm.`id_paket`,mm.id_soal
	FROM `tb_mm-paketbank` mm
	JOIN `tb_banksoal` b ON mm.`id_soal` = b.`id_soal`
	JOIN tb_paket p ON p.`id_paket` = mm.`id_paket`
	JOIN `tb_mm-tryoutpaket` mmp ON mmp.`id_paket` = p.`id_paket`
	JOIN `tb_tryout` t ON t.`id_tryout` = mmp.`id_tryout`
	WHERE t.`id_tryout` = $data";
	$result = $this->db->query($query);
	return $result->result_array();	
}


// GET PILIHAN JAWABAN YANG ADA DI TO TERTENTU
function get_pilihan_jawaban($data){
	$query = "SELECT pj.`id_pilihan`,pj.`pilihan`,pj.`jawaban`,pj.`id_soal`,pj.`gambar`
	FROM `tb_mm-paketbank` mm
	JOIN `tb_banksoal` b ON mm.`id_soal` = b.`id_soal`
	JOIN tb_paket p ON p.`id_paket` = mm.`id_paket`
	JOIN `tb_mm-tryoutpaket` mmp ON mmp.`id_paket` = p.`id_paket`
	JOIN `tb_tryout` t ON t.`id_tryout` = mmp.`id_tryout`
	JOIN `tb_piljawaban` pj ON pj.`id_soal` = b.`id_soal`
	WHERE t.`id_tryout` = $data";
	$result = $this->db->query($query);
	return $result->result_array();	
}

// GET PAKET BERDASARKAN ID TO
public function get_paket_by_toid($id) {
	$query = "SELECT p.token, p.id_paket,nm_paket,deskripsi,p.status,jumlah_soal,durasi,random FROM `tb_paket` p
	JOIN `tb_mm-tryoutpaket` mm
	ON p.`id_paket` = mm.`id_paket`
	JOIN `tb_tryout` t ON t.`id_tryout` = mm.`id_tryout`
	WHERE t.`id_tryout` = '$id' ";
	$result = $this->db->query($query);
	return $result->result_array();
}

// GET ADMIN OFFLINE
function check_user_admin_offline($username, $password){
	$this->db->select('pengguna.id as penggunaID, namaPengguna, hakAkses, s.id as sekolahID, aktivasi,regTime, pengguna.email');
	$this->db->from('tb_pengguna pengguna');
	$this->db->where('kataSandi', $password);
	$this->db->where('pengguna.status','1');
	$this->db->where('pengguna.hakAkses','pengawas');
	$this->db->join('tb_sekolah_pengguna sp', 'sp.penggunaID = pengguna.id');
	$this->db->join('tb_sekolah s', 's.id = sp.sekolahID');

	$this->db->where("(namaPengguna='$username' OR eMail='$username')", NULL, FALSE);
	$this->db->limit(1);

	$query = $this->db->get();
	if ($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }

// GET TO YANG HAK AKSESNYA ID PENGGUNA TERTENTU
    function get_all_to($penggunaID){
    	$query = "SELECT t.`id_tryout`,t.`nm_tryout`,t.`tgl_mulai`,t.`tgl_berhenti`,t.`publish`,t.`UUID`,t.`wkt_mulai`,t.`wkt_berakhir`,t.`penggunaID` FROM `tb_hakakses-pengawas` hp
    	JOIN `tb_tryout` t ON t.`id_tryout` = hp.`id_tryout`
    	JOIN tb_sekolah s ON s.`id` = hp.`id_pengawas`
    	JOIN tb_pengguna u ON u.`id` = s.`penggunaID`
    	WHERE s.`penggunaID`=$penggunaID ";

    	$result = $this->db->query($query);
    	return $result->result_array();
    }

// get pasangan tryout mm paket
    function get_mm_tryout_paket($data){
    	$query = "SELECT mm.id, mm.id_paket, mm.id_tryout FROM `tb_mm-tryoutpaket` mm
    	WHERE `id_tryout` = $data";

    	$result = $this->db->query($query);
    	return $result->result_array();
    }

// insert report paket
    function insert_report($data) {
    	$this->db->insert('tb_report-paket', $data);
    }
}
?>