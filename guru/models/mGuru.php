<?php





class Mguru extends CI_Model

{

	#Start function pengaturan Profile untuk update ke db#

	public function update_guru( $data ) {

		$penggunaID=$this->session->userdata['id'] ;

		$this->db->where( 'penggunaID', $penggunaID );

		$this->db->update( 'tb_guru', $data );

		

	}



	public function update_email($data)

	{

		$id=$this->session->userdata['id'] ;

		$this->db->where('id',$id);

		$this->db->update('tb_pengguna',$data);

		redirect(site_url('guru/dashboard'));

		

	}



	public function update_katasandi($data)

	{

		$id=$this->session->userdata['id'] ;

		$this->db->where('id',$id);

		$this->db->update('tb_pengguna',$data);

		redirect(site_url('guru/dashboard'));



	}

	public function update_photo($photo)

	{

		$data = array(

			'photo' => $photo

			);

		$penggunaID=$this->session->userdata['id'] ;

		$this->db->where('penggunaID',$penggunaID);

		$this->db->update('tb_guru',$data);

		redirect(site_url('guru/dashboard'));

	}

	#END function pengaturan Profile untuk update ke db#



	public function get_single_guru( $data ) {

		$this->db->select( '*' );

		$this->db->from( 'tb_guru guru' );

		// $this->db->join( 'tb_mata-pelajaran pelajaran', 'guru.mataPelajaranID=pelajaran.id' );

		$this->db->where( 'guru.penggunaID', $data );

		$query = $this->db->get();

		return $query->result_array();

	}



	public function get_penulis( $penggunaID ) {

		$this->db->select( 'guru.namaDepan,guru.namaBelakang,guru.biografi,guru.photo' );

		$this->db->from( 'tb_guru guru' );

		$this->db->where( 'guru.penggunaID', $penggunaID );

		$query = $this->db->get();
return $query->result_array();
		

		

	}



	//function untuk mengambil data guru di gunakan untuk menset 

	//data guru ke form pengaturan profil/akun guru

	public function get_datguru( $penggunaID)
	{
		$this->db->select('id,namaDepan,namaBelakang,alamat,noKontak,biografi,photo');
		$this->db->from('tb_guru');
		$this->db->where('penggunaID',$penggunaID); 
		$query = $this->db->get();
		return $query->result_array();
	}



	#function untuk mengambil 4 rcord random dari table guru

	function get_guru_random(){

		$this->db->select('namaDepan,namaBelakang,alamat,noKontak,biografi,photo');

		$this->db->from('tb_guru');

		$this->db->order_by( 'rand()' );

		$this->db->limit(4);

		$query = $this->db->get();

		return $query->result_array();

	}

	##



	## function untuk get jumlah guru berapa

	function get_teachers_number(){

		$this->db->select('id');

		$this->db->from('tb_guru');

		$query = $this->db->get();

		return $query->num_rows();

	}



	## function get guru

	// function get_teacher_user(){

	// 	$this->db->select('*, guru.id as guruID,pengguna.id as penggunaID');

	// 	$this->db->from('tb_guru guru');

	// 	$this->db->join('tb_pengguna pengguna','guru.penggunaID = pengguna.id');

	// 	$this->db->order_by('regTime','desc');

	// 	$this->db->where('pengguna.status', 1);

	// 	$this->db->where('guru.status', 1);



	// 	$query = $this->db->get();

	// 	return $query->result_array();

	// }



	## function hapus guru

	function drop_guru($id,$idp){

		//update tabel guru statusnya jadi 0

		$this->db->set( 'status', 0 );

		$this->db->where( 'id', $id );

		$this->db->update( 'tb_guru' );

		// //update table pengguna statusnya jadi 0

		$this->db->set( 'status', 0 );

		$this->db->where( 'id', $idp );

		$this->db->update( 'tb_pengguna' );

	}

	function get_avatar(){
		$id_pengguna = $this->session->userdata('id');
		$this->db->select('photo');
		$this->db->from('tb_guru');
		$this->db->where('penggunaID',$id_pengguna);
		$query = $this->db->get();
		return $query->result_array()[0]['photo'];
	}

	public function get_m_keahlianGuru($guruID='')
	{
		$this->db->select('mp.aliasMataPelajaran,mp.id as mapelID');
		$this->db->from('tb_mm-gurumapel gm');
		$this->db->join('tb_mata-pelajaran mp','mp.id=gm.mapelID');
		$this->db->where('gm.guruID',$guruID);
		$query = $this->db->get();
		return $query->result_array();
	}
		function jumlah_guru(){
		    $this->db->where('status','1');
		    return $this->db->get('tb_guru')->num_rows();
		}

    // get data siswa per segment
	function data_guru($number,$offset){
	    $this->db->select('guru.namaDepan,guru.namaBelakang,guru.id as guruID,guru.alamat,guru.noKontak,guru.biografi,pengguna.id as penggunaID,pengguna.namaPengguna,pengguna.regTime,pengguna.eMail');
		$this->db->join('tb_pengguna pengguna','guru.penggunaID = pengguna.id');
		$this->db->order_by('regTime','desc');
		$this->db->where('pengguna.status', 1);
		$this->db->where('guru.status', 1);
	    return $query = $this->db->get('tb_guru guru',$number,$offset)->result_array();       
	}

	// ubah katasandi pengguna
	function ch_password($md5Sandi,$penggunaID)
	{
    $this->db->set('kataSandi', $md5Sandi);
    $this->db->where('id', $penggunaID);
    $this->db->update('tb_pengguna');
	}

		// ubah katasandi pengguna
	function ch_email($newEmail,$penggunaID)
	{
    $this->db->set('email', $newEmail);
    $this->db->where('id', $penggunaID);
    $this->db->update('tb_pengguna');
	}
	public function ch_guru($data='')
	{
		$guruID=$data['id'];
    $this->db->where('id',$guruID );
    $this->db->update('tb_guru',$data);
	}
	public function get_mapel_by_guruID($guruID='')
	{
		$this->db->select("mapel.aliasMataPelajaran,gm.mapelID");
		$this->db->from("tb_mata-pelajaran mapel");
		$this->db->join("tb_mm-gurumapel gm","gm.mapelID=mapel.id");
		$this->db->where("gm.guruID",$guruID);

		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_all_mapel()
	{
		$this->db->select('id,aliasMataPelajaran');
		$this->db->from('tb_mata-pelajaran');
		$this->db->where('status',1);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function del_guruMapel($guruID='')
	{
				$this->db->where('guruID',$guruID);
		$this->db->delete('tb_mm-gurumapel');
	}
	public function sum_cari_guru($key='')
	{
    $this->db->select('guru.id');
    $this->db->from('tb_guru guru');
    $this->db->join('tb_pengguna p','p.id=guru.penggunaID');
    $this->db->like('guru.namaDepan',$key);
    $this->db->or_like('guru.namaBelakang',$key);
    $this->db->or_like('p.namaPengguna',$key);
    $this->db->where('guru.status',1);
    return $this->db->get()->num_rows();
	}
	    // get data siswa per segment
	function data_guru_cari($number,$offset,$key=''){
	    $this->db->select('guru.namaDepan,guru.namaBelakang,guru.id as guruID,guru.alamat,guru.noKontak,guru.biografi,pengguna.id as penggunaID,pengguna.namaPengguna,pengguna.regTime,pengguna.eMail');
		$this->db->join('tb_pengguna pengguna','guru.penggunaID = pengguna.id');
		$this->db->order_by('regTime','desc');
		        $this->db->like('guru.namaDepan',$key);
    $this->db->or_like('guru.namaBelakang',$key);
    $this->db->or_like('pengguna.namaPengguna',$key);
		$this->db->where('pengguna.status', 1);
		$this->db->where('guru.status', 1);
	    return $query = $this->db->get('tb_guru guru',$number,$offset)->result_array();       
	}
}
?>