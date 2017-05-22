<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ortuback extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Ortuback_model');
		$this->load->model('Laporanortu/Laporanortu_model');
		$this->load->model('admincabang/admincabang_model');
		$this->load->model('tingkat/Mtingkat');
		$this->load->model('siswa/msiswa');
		$this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();

		$this->hakakses = $this->gethakakses();
	}

	//GET HAK AKSES
	function gethakakses(){
		return $this->session->userdata('HAKAKSES');
	}
	//GET HAK AKSES

	// LOAD PARSER SESUAI HAK AKSES
	public function loadparser($data){
		$this->hakakses = $this->gethakakses();
		if ($this->hakakses=='ortu') {
			$this->parser->parse('templating/index', $data);
		}elseif ($this->hakakses=='siswa'){
			$this->parser->parse('templating/index', $data); 		
		}else {
			echo "forbidden access";   
		}
	}
	// LOAD PARSER SESUAI HAK AKSES

	//laporan ortu ajax
	public function index(){
		$id = $this->session->userdata('id'); 
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME');  
        } 
		$namadepan = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaDepan'];
		$namabelakang = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaBelakang'];
			
		$data['judul_halaman'] = "Laporan $namadepan $namabelakang";

		$hakAkses = $this->session->userdata['HAKAKSES'];
		$data = array(
        'judul_halaman' => 'Neon - Daftar Latihan',
        'judul_header' => 'History Pesan',
        'judul_tingkat' => '',
        );

		$data['files'] = array(
			APPPATH.'modules/homepage/views/v-header-login.php',
			APPPATH . 'modules/templating/views/t-f-pagetitle.php',
			APPPATH . 'modules/ortuback/views/v-daftar-report.php',
			APPPATH.'modules/testimoni/views/v-footer.php',
		);
		
		// get report berdasarkan nilai
		$report_nilai = $this->Ortuback_model->get_report_nilai($id_pengguna);

		// get report berdasarkan absen
		$report_absen = $this->Ortuback_model->get_report_absen($id_pengguna);

		// get report berdasarkan umum
		$report_umum = $this->Ortuback_model->get_report_umum($id_pengguna);

		$data['namaortu'] = $report_nilai[0]['namaOrangTua'];

		$n=1;

		// untuk nampung report nilai
		$data['nilai']=array(); 
		foreach ( $report_nilai as $item ) {
		
			$data['nilai'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report absen
		$data['absen']=array(); 
		foreach ( $report_absen as $item ) {
		
			$data['absen'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report umum
		$data['umum']=array(); 
		foreach ( $report_umum as $item ) {
		
			$data['umum'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id);
		$data['count_pesan'] = $this->Ortuback_model->get_count($id);

		$this->loadparser($data);

	}

	// FUNGSI UNTUK VIEW PESAN ORTU DAN SISWA
	public function pesan($UUID="")
	{
		$id = $this->session->userdata('id'); 
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');
            // update status read menjadi 1
			$this->Ortuback_model->update_read($UUID);  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME'); 
            // update status read menjadi 1
            $this->msiswa->update_read_siswa($UUID);
 
        } 
		$namadepan = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaDepan'];
		$namabelakang = $this->Ortuback_model->namasiswa($id_pengguna)[0]['namaBelakang'];
			
		$data['judul_halaman'] = "Laporan $namadepan $namabelakang";

		$hakAkses = $this->session->userdata['HAKAKSES'];
		$data = array(
        'judul_halaman' => 'Neon - Daftar Latihan',
        'judul_header' => 'History Pesan',
        'judul_tingkat' => '',
        );

		$data['files'] = array(
			APPPATH.'modules/homepage/views/v-header-login.php',
			APPPATH . 'modules/templating/views/t-f-pagetitle.php',
			APPPATH . 'modules/ortuback/views/v-daftar-report.php',
			APPPATH.'modules/testimoni/views/v-footer.php',
		);
		
		// get report berdasarkan nilai
		$report_nilai = $this->Ortuback_model->get_report_nilai($id_pengguna);

		// get report berdasarkan absen
		$report_absen = $this->Ortuback_model->get_report_absen($id_pengguna);

		// get report berdasarkan umum
		$report_umum = $this->Ortuback_model->get_report_umum($id_pengguna);

		$data['namaortu'] = $report_nilai[0]['namaOrangTua'];

		$n=1;

		// untuk nampung report nilai
		$data['nilai']=array(); 
		foreach ( $report_nilai as $item ) {
		
			$data['nilai'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report absen
		$data['absen']=array(); 
		foreach ( $report_absen as $item ) {
		
			$data['absen'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		// untuk nampung report umum
		$data['umum']=array(); 
		foreach ( $report_umum as $item ) {
		
			$data['umum'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'jenis'=>$item['jenis'],
                'isi'=>$item['isi'],
               );
		}

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id);
		$data['count_pesan'] = $this->Ortuback_model->get_count($id);

		$this->loadparser($data);
	}

	//laporan ortu ajax
	public function report_ajax($jenis="all"){

		$datas = ['jenis'=>$jenis];
		// kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
		if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME');  
        } 
		$all_report = $this->Ortuback_model->get_report_all($datas,$id_pengguna);

		$data = array();
		$n=1;
		foreach ( $all_report as $item ) {
		
			$row = array();
			$row[] = $n;
			$row[] = $item ['jenis'];
			$row[] = $item ['isi'];

			$data[] = $row;
			$n++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	public function ajax_ortuID()
{
  $guruID=$this->session->userdata['id'];
  $arrMapel=$this->Ortuback_model->get_Ortu($guruID);
  echo json_encode($arrMapel);
}

	// get jumlah pesan untuk pesan
	function jumlah_pesan($id){
		$data['new_count_pesan'] = $this->Ortuback_model->get_count($id);

	  echo json_encode($data['new_count_pesan']);
	}


	public function see_message($id)
	{
		$data['judul_halaman'] = "Pesan Orang Tua";

		$hakAkses = $this->session->userdata['HAKAKSES'];

		$id_pengguna= $this->session->userdata['id'];

		$data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);

			$data['files'] = array(
				APPPATH . 'modules/ortuback/views/v-single-pesan.php',
				);
			$all_report = $this->Ortuback_model->get_pesan_by_id($id);

			// update status read menjadi 1
			$this->Ortuback_model->update_read($id);

			$data['new_count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);

		$n=1;
		$data['pesan']=array(); 
		foreach ( $all_report as $item ) {
		
			$data['pesan'][]=array(
                'namaortu'=>$item['namaOrangTua'],
                'isi'=>$item['isi']
               );
		}

			$this->loadparser($data);
		
	}

}

?>