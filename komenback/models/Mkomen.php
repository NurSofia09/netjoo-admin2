<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
class Mkomen extends CI_Model

{



	function __construct() {
		parent::__construct();
		$this->load->database();

	}

	//fungsi untuk menampilkan komen yang ada di halaman seevideo
	public function get_komen_byvideo( $idvideo ) {
		$this->db->select( 'namaPengguna`,komen.date_created,`isiKomen`,avatar, komen.id as komenID, avatar, hakAkses,siswa.photo as siswa_photo, guru.photo as guru_photo' );
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_guru guru','guru.penggunaID=pengguna.id','left');
		$this->db->join('tb_siswa siswa','siswa.penggunaID=pengguna.id','left');
		$this->db->where( 'video.id', $idvideo );
		$this->db->where( 'komen.status', 1 );

		$query = $this->db->get();
		return $query->result();
	}

		public function get_komenGuru_byvideo( $idvideo ) {
		$this->db->select( 'namaPengguna`,komen.date_created,`isiKomen`,avatar, komen.id as komenID, avatar, hakAkses,guru.photo' );
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_guru guru','guru.penggunaID=pengguna.id');
		$this->db->where( 'video.id', $idvideo );
		$this->db->where( 'komen.status', 1 );

		$query = $this->db->get();
		return $query->result();
	}

		public function get_komenSiswa_byvideo( $idvideo ) {
		$this->db->select( 'namaPengguna`,komen.date_created,`isiKomen`,avatar, komen.id as komenID, avatar, hakAkses,siswa.photo' );
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_siswa siswa','siswa.penggunaID=pengguna.id');
		$this->db->where( 'video.id', $idvideo );
		$this->db->where( 'komen.status', 1 );

		$query = $this->db->get();
		return $query->result();
	}

		//fungsi untuk menampilkan semua komen
	public function get_all_komen() {
		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID');
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		// $this->db->join('tb_guru guru', 'pengguna.id = guru.penggunaID');
		$this->db->where( 'komen.status', 1 );


		$query = $this->db->get();
		return $query->result();
	}
	// get data komen by profesi guru
	public function get_komen_by_profesi($id_guru) {
		$this->db->select('mapelID');
		$this->db->from('tb_mm-gurumapel')->where('guruID',$id_guru);
		$where_clause = $this->db->get_compiled_select();

		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID,pengguna.namaPengguna,komen.UUID,siswa.photo as siswa_photo,tp.mataPelajaranID');
		$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_siswa siswa','siswa.penggunaID=pengguna.id');
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
		// $this->db->where_in('tp.mataPelajaranID', $subQuery);
		$this->db->where("`tp`.`mataPelajaranID` IN ($where_clause)", NULL, FALSE);
		$this->db->where( 'komen.status', 1 );
		$query = $this->db->get();
		return $query->result();
	}

	public function get_komen_by_profesi_notread($id_guru) {
		$this->db->select('mapelID');
		$this->db->from('tb_mm-gurumapel')->where('guruID',$id_guru);
		$where_clause = $this->db->get_compiled_select();

		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID,pengguna.namaPengguna,komen.UUID,siswa.photo as siswa_photo,tp.mataPelajaranID');
		$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_siswa siswa','siswa.penggunaID=pengguna.id');
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
		// $this->db->where_in('tp.mataPelajaranID', $subQuery);
		$this->db->where("`tp`.`mataPelajaranID` IN ($where_clause)", NULL, FALSE);
		$this->db->where( 'komen.status', 1 );
		$this->db->where( 'komen.read_status', 0 );
		$query = $this->db->get();
		return $query->result_array();
	}


		//fungsi untuk ambil komen
	public function get_komen_by_idkomen( $idkomen ) {
		$this->db->select( 'isiKomen, videoID');
		$this->db->from( 'tb_komen komen' );
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->where( 'komen.id', $idkomen);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_komen_by_UUID($UUID)
	{
		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID,pengguna.namaPengguna,tp.mataPelajaranID');
		$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');

		$this->db->where( 'komen.UUID', $UUID );
		$query = $this->db->get();
		return $query->result_array();
	}

	// get komen guru by UUID
	public function get_komenGuru_by_UUID($UUID)
	{
		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID,pengguna.namaPengguna,guru.photo,tp.mataPelajaranID');
		$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_guru guru','guru.penggunaID=pengguna.id');
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');

		$this->db->where( 'komen.UUID', $UUID );
		$query = $this->db->get();
		return $query->result_array();
	}
	// get komen siswa by UUID
	public function get_komenSiswa_by_UUID($UUID)
	{
		$this->db->order_by('komen.id','desc');
		$this->db->select( 'komen.id as komenID, isiKomen, komen.date_created, video.id as videoID,
							video.judulVideo, video.id as videoID, pengguna.id as penggunaID,pengguna.namaPengguna,siswa.photo,tp.mataPelajaranID');
		$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_pengguna pengguna','pengguna.id=komen.userID');
		$this->db->join('tb_siswa siswa','siswa.penggunaID=pengguna.id');
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');

		$this->db->where( 'komen.UUID', $UUID );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function ch_stat_read($idvideo='')
	{
		$this->db->set('read_status',1);
		$this->db->where('videoID',$idvideo );
        $this->db->update('tb_komen');
	}

	   //  public function ch_soal($data) {
    //     $this->db->set($data['dataSoal']);
    //     $this->db->where('UUID', $data['UUID']);
    //     $this->db->update('tb_banksoal');
    // }
	// get data  jumlah komen yg belum di baca
    public function get_count_komen_guru($id_guru='')
    {
    			$this->db->select('mapelID');
		$this->db->from('tb_mm-gurumapel')->where('guruID',$id_guru);
		$where_clause = $this->db->get_compiled_select();
    	$this->db->select('komen.id');
    	$this->db->from( 'tb_komen komen');
		$this->db->join( 'tb_video video', 'komen.videoID=video.id' );
		$this->db->join('tb_subbab sub','sub.id=video.subBabID');
		$this->db->join('tb_bab bab','bab.id=sub.babID');
		$this->db->join('tb_tingkat-pelajaran tp','tp.id=bab.tingkatPelajaranID');
		$this->db->where("`tp`.`mataPelajaranID` IN ($where_clause)", NULL, FALSE);
		

		$this->db->where( 'komen.status', 1 );
		$this->db->where( 'komen.read_status', 0 );
		$query = $this->db->get();
		return $query->num_rows();
    }

}

?>