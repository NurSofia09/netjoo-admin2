<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanortu extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Laporanortu_model');
		$this->load->model('cabang/mcabang');
		$this->load->model('admincabang/admincabang_model');
		$this->load->model('tingkat/Mtingkat');
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
		if ($this->hakakses=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		}else{
			echo "forbidden access";    		
		}
	}
	// LOAD PARSER SESUAI HAK AKSES

	public function index()
	{
		$data['judul_halaman'] = "Laporan Orang Tua";
		
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-daftar-laporan.php',
				);
			$this->loadparser($data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
		
	}

	//laporan ortu ajax
	public function laporanortu_ajax($cabang="all",$tingkat="all",$kelas="all",$jenis="all"){
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();

		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$datas = ['cabang'=>$cabang,'tingkat'=>$tingkat,'kelas'=>$kelas,'jenis'=>$jenis];

		$all_report = $this->Laporanortu_model->get_report_ortu_all($datas);

		$data = array();
		$n=1;
		foreach ( $all_report as $item ) {
		
			$row = array();
			$row[] = $n;
			$row[] = $item ['namaOrangTua'];
			$row[] = $item ['namaDepan']." ".$item ['namaBelakang'];
			$row[] = $item ['namaPengguna'];
			$row[] = $item ['isi'];
			// $row[] = "<textarea name='isi' class='pesan' style='width:300px; height:200px;'></textarea>";
			// $row[] = '<a href="' . base_url('index.php/siswa/reportSiswa/' .$item['siswaID'] .'/'. $item['penggunaID']) . '""> Lihat detail</a></i>';
			// $row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
			// <input type='checkbox' name="."report".$n." id="."soal".$item['id_ortu']." value=".$item['id_ortu'].">
			// <label for="."soal".$item['id_ortu'].">&nbsp;&nbsp;</label></span>";
			
			$data[] = $row;
			$n++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	// function get kelas
	public function get_kelas( $tingkat ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Laporanortu_model->get_kelas( $tingkat ) ) );
	}

	// FUNGSI INSERT LAPORAN
	function kirim_laporan(){
		if ($this->input->post()) {
			$post = $this->input->post();

			$jumlah_laporan = $post['jumlah_ortu'];
			$id=$post['id_ortu'];
			$jenis=$post['jenis_lapor'];
			$isi=$post['isi'];
			$UUID=uniqid();

			for ($i=0; $i < $jumlah_laporan; $i++) { 
				//masukan ke array data laporannya
				$token_update = array("id_ortu"=>$id[$i],
										"jenis"=>$jenis,
										"isi"=>$post['isi'][$i],
										"UUID"=>$UUID
					);
				
				// insert laporan
				$this->Laporanortu_model->insert_laporan($token_update);
			}

			// //get data komen by UUID
          $datArr=$this->Laporanortu_model->get_laporan_by_id($UUID);

          $dataLaporan['id_ortu']=$datArr[0]['id_ortu'];
          $dataLaporan['siswaID']=$datArr[0]['siswaID'];
          $dataLaporan['jenis_lapor']=$datArr[0]['jenis'];
          $dataLaporan['isi']=$datArr[0]['isi'];
          $dataLaporan['namaPengguna']=$datArr[0]['namaPengguna'];
          $dataLaporan['UUID']=$datArr[0]['UUID'];
          $idortu= $datArr[0]['id_ortu'];
          $dataKomen['new_count_pesan'] = $this->db->where("read_status_ortu = 0 and id_ortu =$idortu" )->count_all_results('tb_laporan_ortu');
          $dataLaporan['success']=true;

          echo json_encode($dataLaporan);

		}
	}

	// fungsi add laporan
	public function addlaporan()
	{
		$data['judul_halaman'] = "Laporan Orang Tua";
		
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/laporanortu/views/v-add-laporan.php',
				);
			$this->loadparser($data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
		
	}

	//laporan ortu ajax
	public function addlaporanortu_ajax($cabang="all",$tingkat="all",$kelas="all"){
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();

		# get tingkat
		$data['tingkat'] = $this->Laporanortu_model->get_all_tingkat();

		$datas = ['cabang'=>$cabang,'tingkat'=>$tingkat,'kelas'=>$kelas];

		$all_report = $this->Laporanortu_model->get_report_ortu($datas);

		$data = array();
		$n=1;
		foreach ( $all_report as $item ) {
		
			$row = array();
			$row[] = $n;
			$row[] = $item ['namaOrangTua'];
			$row[] = $item ['namaDepan']." ".$item ['namaBelakang'];
			$row[] = $item ['namaPengguna'];
			$row[] = "<textarea name='isi' class='pesan' style='width:300px; height:200px;'></textarea>";
			$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
			<input type='checkbox' name="."report".$n." id="."soal".$item['id_ortu']." value=".$item['id_ortu'].">
			<label for="."soal".$item['id_ortu'].">&nbsp;&nbsp;</label></span>";
			
			$data[] = $row;
			$n++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	// function get kelas
	public function set_cabang( $tingkat ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Laporanortu_model->get_nc( $tingkat ) ) );
	}


}

?>