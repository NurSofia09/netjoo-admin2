<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admincabang extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('admincabang_model');
		$this->load->model('cabang/mcabang');
		$this->load->model('toback/mtoback');
		$this->load->model('logtryout/logtryout_model');
	}



	public function index() {
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();

		$data['judul_halaman'] = "Dashboard Admin Cabang";
		$data['files'] = array(
			APPPATH . 'modules/admin/views/v-container.php',
			);
		
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}

	// untuk infograph
	public function infograph() {
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();

/*
		$idto=132;
		// untuk graph 1 : partisipasi
		$jumlah_siswa_terdaftar = $this->admincabang_model->get_registered_siswa_to($idto)[0]['jumlahSiswa'];
		$jumlah_siswa_partisipasi = $this->admincabang_model->get_participants_siswa_to($idto)[0]['jumlahSiswa'];


		echo "Terdaftar $jumlah_siswa_terdaftar <br>";
		echo "Berpartiipasi $jumlah_siswa_partisipasi<br><hr>";

		// untuk graph 2 : to selesai
		//siswa yang berhasil menyelesaikan to
		//siswa yang berpartisipasi

		// untuk graph 3 : paket selesai
		$jumlah_paket = $this->admincabang_model->get_paket_by_id_to($idto)[0]['jumlahPaket']*$jumlah_siswa_terdaftar;		
		$jumlah_paket_dikerjakan = $this->admincabang_model->get_paket_by_id_to($idto)[0]['jumlahPaket'] * $jumlah_siswa_partisipasi;
		echo "Terdaftar paket $jumlah_paket <br>";
		echo "Dikerjakan paket $jumlah_paket_dikerjakan";

		*/
		
		$data['judul_halaman'] = "Dashboard Admin Cabang - infograph Tryout";
		$data['files'] = array(
			APPPATH . 'modules/admincabang/views/v-daftar-grafik.php',
			);
		$data['to'] = $this->mtoback->get_To();

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}

	//laporan to ajax
	public function laporanto($cabang="all",$tryout="all",$paket="all",$records_per_page=10,$page=0){
		//data post
		$records_per_page=$this->input->post('records_per_page');
		$page=$this->input->post('page');
		$cabang=$this->input->post('cabang');
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		//data post
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();


		if ($keySearch != '' && $keySearch !=' ' ) {
			$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
			$all_report = $this->admincabang_model->cari_report_paket($datas,$records_per_page,$page,$keySearch);
		} else {
			$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
			$all_report = $this->admincabang_model->get_report_paket($datas,$records_per_page,$page);
		}
		

		$data = array();
		$tb_paket=null;
		$no=$page+1;
		foreach ( $all_report as $item ) {
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
			$nama=$item ['namaDepan']." ".$item ['namaBelakang'];
			$nilai=0;
			// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				$nilai=$sumBenar/$jumlahSoal*100;
			}
			$tb_paket.=	'<tr>
							<td>'.$no.'</td>	
							<td>'.$item ['namaPengguna'].'</td>
							<td>'.$item ['nm_paket'].'</td>
							<td>'.$item ['namaCabang'].'</td>
							<td>'.$nama.'</td>
							<td>'.$jumlahSoal.'</td>							
							<td>'.$sumBenar.'</td>
							<td>'.$sumSalah.'</td>
							<td>'.$sumKosong.'</td>
							<td>'.number_format($nilai,2).'</td>
							<td>'.$item['tgl_pengerjaan'].'</td>
						</tr>';

						$no++;
		}

	
		echo json_encode( $tb_paket );
	}
	public function pagination_daftar_paket($cabang="all",$tryout="all",$paket="all",$records_per_page=100,$page=0,$keySearch='')
	{
		//data post
		// $records_per_page=$this->input->post('records_per_page');
		// $page=$this->input->post('page');
		//data post
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();
		$cabang=$this->input->post('cabang');
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		if ($keySearch != '' && $keySearch !=' ' ) {
			$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
			$jumlah_data = $this->admincabang_model->jumlah_cari_report_paket($datas,$keySearch);
		} else {
			$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
			$jumlah_data = $this->admincabang_model->jumlah_report_paket($datas);
		}
		

		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';

    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);

    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		    	 	$pagination.='<li ><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		    	 	$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" >'.$pagePagination.'</a></li>';
    	 	}

    	 	$pagePagination++;
    	 }

    	if ($pagePagination>7) {
    	 	  $pagination.='<li class="" id="page-next">
		      								<a href="javascript:void(0)" onclick="nextPage()" aria-label="Next">
		        								<span aria-hidden="true">&raquo;</span>
		      								</a>
		    								</li>';
    	 }

    	 if ($pagePagination<3) {
    	 		$pagination='';
    	 }
    	 

		echo json_encode($pagination);
	}
	// // laporan paket
	// public function laporanpaket(){
	// 	$data['judul_halaman'] = "Laporan Paket TO";
	// 	$data['files'] = array(
	// 		APPPATH . 'modules/admincabang/views/v-daftar-paket.php',
	// 		);
	// 	# get cabang
	// 	$data['cabang'] = $this->mcabang->get_all_cabang();
	// 	# get to
	// 	$data['to'] = $this->mtoback->get_To();
	// 	$hakAkses = $this->session->userdata['HAKAKSES'];
	// 	if ($hakAkses == 'admin_cabang') {
	// 		$this->parser->parse('v-index-admincabang', $data);
	// 	} elseif ($hakAkses == 'admin') {
	// 		$data['files'] = array(
	// 			APPPATH . 'modules/admincabang/views/v-daftar-paket-admin.php',
	// 			);
	// 		$this->parser->parse('admin/v-index-admin', $data);
	// 	} elseif ($hakAkses == 'guru') {
	// 		redirect(site_url('guru/dashboard/'));
	// 	} elseif ($hakAkses == 'siswa') {
	// 		redirect(site_url('welcome'));
	// 	} else {
	// 		redirect(site_url('login'));
	// 	}
	// }

    // function get paket
	public function get_paket( $to_id ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->admincabang_model->get_paket( $to_id ) ) );
	}

	public function laporanPDF($cabang="all",$tryout="all",$paket="all")
	{
		$this->load->library('Pdf');
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$all_report = $this->admincabang_model->get_report_paket_pdf($datas);		
		$data['all_report'] = array();
		$no=0;
		$sumNilai=0;
		$maxNilai=0;
		$minNilai=100;
		foreach ( $all_report as $item ) {
			$no++;
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
						// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				$nilai=$sumBenar/$jumlahSoal*100;
			}
			
			$paket=$item ['nm_paket'];
			$cabang=$item ['namaCabang'];
			$data['all_report'][]=array(
				'no'=>$no,
				'jumlah_soal'=>$jumlahSoal,
				'nama'=>$item ['namaDepan']." ".$item ['namaBelakang'],
				'jmlh_benar'=>$item ['jmlh_benar'],
				'jmlh_salah'=>$item ['jmlh_salah'],
				'jmlh_kosong'=>$item ['jmlh_kosong'],
				'jumlah_soal'=>$jumlahSoal,
				'nilai'=>number_format($nilai,2),
				'tgl_pengerjaan'=>$item ['tgl_pengerjaan']
				);
			//sum Nilai
			$sumNilai += $nilai;

			//set Max nilai
			if ($maxNilai<$nilai) {
				$maxNilai=$nilai;
			}
			//set Min nilai
			if($minNilai>$nilai){
				$minNilai=$nilai;
			}

		}
		//hitung rata2 nilai
		$avg=$sumNilai/$no;
		//format rata2 max 2 digit di belakang koma
		$formattedAvg = number_format($avg,2);
		$data['avg']=$formattedAvg;
		$data['jumlahSiswa']=$no;
		$data['maxNilai']=number_format($maxNilai,2);
		$data['minNilai']=number_format($minNilai,2);
		$data['paket'] = $paket;
		$data['cabang'] =$cabang;
		if ($cabang !="all" && $tryout !="all" && $paket !="all") {
			$this->parser->parse('v-laporanPDF-to.php',$data);
		}else{
			redirect(site_url('admincabang/laporanpaket'));
		}
		
	}

	public function testPDF($cabang="all",$tryout="all",$paket="all")
	{
		$this->load->library('Pdf');

		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];

		$all_report = $this->admincabang_model->get_report_paket($datas);

		$datArr = array();

		foreach ( $all_report as $item ) {
			$row = array();
			$row[] = $item ['id_report'];
			$row[] = $item ['namaPengguna'];
			$row[] = $item ['nm_paket'];
			$row[] = $item ['namaCabang'];
			
			
			$datArr[] = $row;
		}

		$data['all_report']=$datArr;
		$this->parser->parse('v-laporanPDF-to.php',$data);
	}

	function drop_report(){
		if ($this->input->post()) {
			$data = $this->input->post();
			$this->admincabang_model->delete_report($data);
		}
	}





## SERVER SIDE ##
//laporan to ajax
	public function laporanto_ss($cabang="all",$tryout="all",$paket="all"){
		// parameter dari datable
		$draw=$_REQUEST['draw'];
		$length=$_REQUEST['length'];
		$start=$_REQUEST['start'];
		$search=$_REQUEST['search']["value"];
		// parameter dari datable

		// data untuk filterasasi.
		$datas = ['draw'=>$draw,
		'length'=>$length,
		'start'=>$start,
		'search'=>$search,
		'cabang'=>$cabang,
		'tryout'=>$tryout,
		'paket'=>$paket];

		// parameter
		$all_report = $this->admincabang_model->get_report_paket_ss($datas);

		$data = array();
		foreach ( $all_report as $item ) {
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
			
			$nilai=0;
			// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				$nilai=$sumBenar/$jumlahSoal*100;
			}
			$row = array();
			$row[] = $item ['id_report'];
			$row[] = $item ['namaPengguna'];
			$row[] = $item ['nm_paket'];
			$row[] = $item ['namaCabang'];
			$row[] = $item ['namaDepan']." ".$item ['namaBelakang'];
			$row[] = $jumlahSoal;
			$row[] = $item ['jmlh_benar'];
			$row[] = $item ['jmlh_salah'];
			$row[] = $item ['jmlh_kosong'];
			$row[] = number_format($nilai,2);			
			$row[] = $item['tgl_pengerjaan'];

			if ($item['jmlh_benar']==0 && $item['jmlh_salah']==0) {
				$row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_report('."'".$item['id_report']."'".')"><i class="ico-remove"></i></a>';
			}else{
				$row[] = "-";	

			}	
			
			$data[] = $row;
		}

		$output = array(
			"data"=>$data,
			
			);

		echo json_encode( $output );
	}





//laporan to ajax
	public function get_laporan($cabang="all",$tryout="all",$paket="all"){
		
		
		// parameter pencarian
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$request_data= $_REQUEST;
		$repost_post= $_POST;

		$all_report = $this->admincabang_model->get_datatables($datas, $request_data,$repost_post);
		// print_r($all_report);

		$total_data = count($all_report);
		$total_filtered_data = $total_data;
		$data = array();

		foreach ( $all_report as $item ) {
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
			
			$nilai=0;
			// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				$nilai=$sumBenar/$jumlahSoal*100;
			}
			$row = array();
			$row[] = $item ['id_report'];
			$row[] = $item ['namaPengguna'];
			$row[] = $item ['nm_paket'];
			$row[] = $item ['namaCabang'];
			$row[] = $item ['namaDepan']." ".$item ['namaBelakang'];
			$row[] = $jumlahSoal;
			$row[] = $item ['jmlh_benar'];
			$row[] = $item ['jmlh_salah'];
			$row[] = $item ['jmlh_kosong'];
			$row[] = number_format($nilai,2);			
			$row[] = $item['tgl_pengerjaan'];

			if ($item['jmlh_benar']==0 && $item['jmlh_salah']==0) {
				$row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_report('."'".$item['id_report']."'".')"><i class="ico-remove"></i></a>';
			}else{
				$row[] = "-";	

			}	
			
			$data[] = $row;
		}

		$count = $this->admincabang_model->count_filtered($datas, $request_data,$repost_post);
		// var_dump($this->admincabang_model->$count_all());
		// $count_all = $this->admincabang_model->$count_all();


		$output = array(
			"data"=>$data,
			"draw"            => intval($repost_post['draw']),
            "recordsTotal"    => 10,  // total number of records
            "recordsFiltered" => $count, // total number of records after searching, if there is no searching then totalFiltered = totalData
            );

		echo json_encode( $output );
	}

	// laporan paket
	public function laporanpaket(){
		// kalo ada yang di post dari modal filter.
		if ($this->input->post()) {
			$data['post'] = $this->input->post();
		} 

		$data['judul_halaman'] = "Laporan Paket TO";
		$data['files'] = array(
			APPPATH . 'modules/admincabang/views/v-daftar-paket.php',
			);
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/admincabang/views/v-daftar-paket-admin.php',
				);
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}

	public function laporan(){
		$this->laporan_all_to();
	}

	public function laporan_paket_filter($cabang="all",$tryout="all",$paket="all"){
		$data['judul_halaman'] = "Laporan Paket TO Filter";
		$data['files'] = array(
			APPPATH . 'modules/admincabang/views/v-daftar-paket-filter.php',
			);
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin_cabang') {
			$this->parser->parse('v-index-admincabang', $data);
		} elseif ($hakAkses == 'admin') {
			$data['files'] = array(
				APPPATH . 'modules/admincabang/views/v-daftar-paket-admin.php',
				);
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}



	// LAPORAN PENGERJAAN TO //
	function pengerjaan(){
		# get cabang
		$data['cabang'] = $this->mcabang->get_all_cabang();
		# get to
		$data['to'] = $this->mtoback->get_To();

		$data['judul_halaman'] = "Pengerjaan Tryout";
		$data['files'] = array(
			APPPATH . 'modules/logtryout/views/v-daftar-tryout-log.php',
			);

		$this->parser->parse('v-index-admincabang', $data);

	}
	// LAPORAN PENGERJAAN TO //



	// grafik siswa terdaftar dan mengerjakan
	public function get_siswa_regist_parti($id_tryout,$cabangID='all'){
		$data['param'] = ['id_tryout'=>$id_tryout,'cabang'=>$cabangID];
		// mencari jumlah siswa yang terdaftar
		$datas['daftar'] = $this->admincabang_model->get_registered_siswa_to($data['param'])[0]['jumlah_siswa'];	
		// mencari jumlah siswa yang berpartisipasi
		$datas['ikutan'] = $this->admincabang_model->get_participants_siswa_to($data['param'])[0]['jumlah_siswa'];
		// ditampilkan untuk di grafik
		$jumlah = $datas['daftar']-$datas['ikutan'] / 100;

		$ikutan = (int)$datas['ikutan'] / $datas['daftar'] * 100;
		$tidak_ikutan_pers = (int)100-(int)$ikutan;
		$tidak_ikutan = ($datas['daftar']-$datas['ikutan']);
		
		$array[] = ['label'=>"Partisipasi : ".(int)$ikutan."%",  "y"=>(int)$datas['ikutan']];
		$array[] = ['label'=>"No-Partisipasi : ".$tidak_ikutan_pers."%",  "y"=>(int)$tidak_ikutan];
		$array[] = ['label'=>"Terdaftar : ".$datas['daftar'],  "y"=>(int)$datas['daftar']];
		// echo "<br>";
		echo json_encode($array	);
	}

		// grafik siswa terdaftar dan mengerjakan
	public function get_paket_registrasi($id_tryout,$cabangID='all'){
		$data['param'] = ['id_tryout'=>$id_tryout,'cabang'=>$cabangID];
		// mencari jumlah siswa yang terdaftar
		$datas['daftar'] = $this->admincabang_model->get_registered_siswa_to($data['param'])[0]['jumlah_siswa'];	
		// mencari jumlah siswa yang berpartisipasi
		$datas['ikutan'] = $this->admincabang_model->get_participants_siswa_to($data['param'])[0]['jumlah_siswa'];
		
		// jumlah paket di to tertentu
		$datas['paket'] = $this->admincabang_model->get_paket_by_id_to($data['param'])[0]['jumlah_paket'];
		// jumlah paket yang harus dikerjakan
		$datas['jumlah_paket'] = $datas['daftar'] *  $datas['paket'];


		// jumlah paket yang sudah dikerjakan
		$datas['jumlah_paket_selesai'] = $this->admincabang_model->get_paket_done($data['param'])[0]['jumlah_paket'];
		// jumlah paket yang gagal
		$datas['jumlah_paket_gagal'] =  $this->admincabang_model->paket_gagal($data['param'])[0]['jumlah_report'];
		

		$array[] = ['label'=>"Semua Paket Soal ".$datas['jumlah_paket'],  "y"=>(int)$datas['jumlah_paket']];
		$array[] = ['label'=>"Paket Soal Dikerjakan ".$datas['jumlah_paket_selesai'],  "y"=>(int)$datas['jumlah_paket_selesai'] ];
		$array[] = ['label'=>"Paket Soal Gagal Dikerjakan ".$datas['jumlah_paket_gagal'],  "y"=>(int)$datas['jumlah_paket_gagal']];

		echo json_encode($array);
	}
}
?>