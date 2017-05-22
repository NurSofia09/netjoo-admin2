<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Learningline extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('learning_model');
		$this->load->model('matapelajaran/mmatapelajaran');
		$this->load->model('video/mvideos');
		$this->load->model('materi/mmateri');
		$this->load->model('latihan/mlatihan');
		$this->load->model('video/mvideos');
		$this->load->model('komenback/mkomen');
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
		} else if($this->hakakses=='guru'){
			// notification
	        $data['datKomen']=$this->datKomen();
	        $id_guru = $this->session->userdata['id_guru'];
	        // get jumlah komen yg belum di baca
	        $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
	        //
			$this->parser->parse('templating/index-b-guru', $data);
		}
	}
	// LOAD PARSER SESUAI HAK AKSES


	// FUNGSI INDEX
	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Learning Line"
			);

		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-container-daftar-bab.php',
			APPPATH . 'modules/learningline/views/script_learning-daftar-bab.js',
			);

		$this->loadparser($data);
	}
	// FUNGSI INDEX
	
	// DAFTAR TOPIK
	//AMBIL TOPIK BY BABID
	function topik($byid){
		$metadata = $this->mmatapelajaran->get_bab_by_id($byid)[0];
		// var_dump($metadata);
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Topik",
			'tingkat' =>$metadata['namaTingkat'],
			'mapel'=>$metadata['namaMataPelajaran'],
			'bab'=>$metadata['judulBab'],
			);

		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-daftar-topik-single.php',
			APPPATH . 'modules/learningline/views/script_learning-single-topik.js',
			);

		$this->loadparser($data);
	}
	// DAFTAR TOPIK

	// DAFTAR STEP
	//AMBIL STEP BY BABID
	function step($topikID){
		$metadata = $this->learning_model->get_topik_byid($topikID);
		// $metadata = $this->learning_model->get_step_by_id_topik($topikID)[0];
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Step",
			'namaTopik' => $metadata['namaTopik'],
			'id'=>$metadata['TopikID'],
			'babID'=>$metadata['babID'],
			'tingkat' =>$metadata['namaTingkat'],
			'mapel'=>$metadata['namaMataPelajaran'],
			'bab'=>$metadata['judulBab'],
			);

		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-daftar-step-single.php',
			APPPATH . 'modules/learningline/views/script_learning-single-step.js',
			);

		$this->loadparser($data);
	}
	// DAFTAR STEP


	//FUNGSI TAMBAHKAN LINE STEP
	public function formstep($data){
		$metadata = $this->learning_model->get_topik_byid($data);
		// var_dump($metadata);
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Add Learning Line Step untuk ".$metadata['namaTopik'],
			'namaTopik' => $metadata['namaTopik'],
			'id'=>$metadata['TopikID'],
			'babID'=>$metadata['babID'],
			'tingkat' =>$metadata['namaTingkat'],
			'mapel'=>$metadata['namaMataPelajaran'],
			'bab'=>$metadata['judulBab'],
			);
		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-form-step.php',
			APPPATH . 'modules/learningline/views/script_learning-form-step.js',
			);

		$this->loadparser($data);
	}
	//FUNGSI TAMBAHKAN LINE STEP

	//FUNGSI MENAMBAHKAN TOPIK
	public function formtopik($data){
		$bab_meta = $this->mmatapelajaran->get_bab_by_id($data)[0];
		$data = array(
			'judul_halaman' => 'Dashboard '.ucfirst($this->hakakses)." - Add Learning Line Topik Untuk ".$bab_meta['judulBab'],
			'tingkat' =>$bab_meta['namaTingkat'],
			'mapel'=>$bab_meta['namaMataPelajaran'],
			'bab'=>$bab_meta['judulBab'],
			'id'=>$bab_meta['id']
			);

		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-form-topik.php',
			APPPATH . 'modules/learningline/views/script_learning-form-topik.js',
			);

		$this->loadparser($data);
	}
	//FUNGSI MENAMBAHKAN TOPIK

		//FUNGSI MENGEDIT TOPIK
	public function edit_topik($data){
		$metatopik = $this->learning_model->get_topik_byid($data);

		if ($metatopik==false) {
			echo "Forbiden acces";
		} else {
			// var_dump($metatopik);
			$data = array(
				'judul_halaman' => 'Dashboard '.ucfirst($this->hakakses)." - Update Learning Line Topik Berjudul ".$metatopik['namaTopik'],
				'judul'=>$metatopik['namaTopik'],
				'statusLearning'=>$metatopik['statusLearning'],
				'urutan'=>$metatopik['urutan'],
				'deskripsi'=>$metatopik['deskripsi'],
				'tingkat'=>$metatopik['namaTingkat'],
				'mapel'=>$metatopik['namaMataPelajaran'],
				'bab'=>$metatopik['judulBab'],
				'topikID'=>$metatopik['TopikID'],
				'babID'=>$metatopik['babID'],
				'tingpelID'=>$metatopik['tingpelID'],
				'mapelID'=>$metatopik['mapelID'],
				'tingkatID'=>$metatopik['tingkatID']
				);

			$data['files'] = array(
				APPPATH . 'modules/learningline/views/v-form-edit-topik.php',
				APPPATH . 'modules/learningline/views/script_learning-edit-topik.js',
				);

			$this->loadparser($data);
		}
		
		// 
	}
	//FUNGSI MENGEDIT TOPIK

	//FUNGSI MENGEDIT STEP
	public function edit_step($data){
		$metadata = $this->learning_model->meta_step_update($data)[0];
		if ($metadata['jenisStep']==1) {
			$id = $metadata['videoID'];
		} else if($metadata['jenisStep']==2){
			$id = $metadata['materiID'];
		}else{
			$id = $metadata['latihanID'];
		}
		
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Edit Learning Line Step untuk ".$metadata['namaTopik'],
			'namaTopik' => $metadata['namaTopik'],
			'id'=>$metadata['id'],
			'babid'=>$metadata['babid'],
			'urutan'=>$metadata['urutan'],
			'namastep'=>$metadata['namaStep'],
			'id_relasi'=>$metadata['jenisStep'],
			'relasi_step'=>$id
			);
		$data['files'] = array(
			APPPATH . 'modules/learningline/views/v-form-edit-step.php',
			APPPATH . 'modules/learningline/views/script_learning-edit-step.js',
			);

		$this->loadparser($data);
	}
	//FUNGSI MENGEDIT STEP



	## --------------------------AJAX PROCESSING-------------------------- ##
	// GET LIST TOPIK
	public function ajax_get_list_topik($babid){
		$list = $this->learning_model->get_topik_by_babid($babid);
		$data = array();

		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['namaTopik'];
			$row[] = $list_item['urutan'];
			if ($list_item['statusLearning']==1) {
				$row[] = "<input type='checkbox' 
				class='switchery' checked onclick='updatestatus(".$list_item['id'].",".$list_item['statusLearning'].")'>";
			} else {
				$row[] = "<input type='checkbox' 
				class='switchery' unchecked onclick='updatestatus(".$list_item['id'].",".$list_item['statusLearning'].")'>";
			}			
			
			

			$row[] = '<a class="btn btn-sm btn-warning"  
			title="Edit" 
			href="'.base_url().'learningline/edit_topik/'.$list_item['id'].'"><i class="ico-edit"></i></a>
			<a class="btn btn-sm btn-success topik-'.$list_item['id'].'"  title="Detail" 
			data-todo='."'".json_encode($list_item)."'".' onclick="detail_topik('."'".$list_item['id']."'".')"><i class="ico-file-plus2"></i></a>
			<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_topik('."'".$list_item['id']."'".')"><i class="ico-remove"></i></a>';

			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}
	// GET LIST TOPIK

	// GET LIST STEP BERDASARKAN ID TOPIK
	public function ajax_list_get_step($id_topik){
		$list = $this->learning_model->get_step_by_id_topik($id_topik);
		$data = array();
		
		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['id'];
			$row[] = $list_item['urutan'];

			$row[] = $list_item['namaStep'];
			if ($list_item['jenisStep']==1) {
				$row[] = "Video";
				$row[] = '<a class="btn btn-sm btn-warning"  
				title="Edit" 
				href="'.base_url().'learningline/edit_step/'.$list_item['id'].'"><i class="ico-edit"></i></a>
				<a class="btn btn-sm btn-success detail-'.$list_item['id'].'"  title="Play" data-todo='."'".json_encode($list_item)."'".' onclick="play('."'".$list_item['id']."'".')"><i class="ico-play"></i></a>
				<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_step('."'".$list_item['id']."'".')"><i class="ico-remove"></i></a>';
			} else if ($list_item['jenisStep']==2) {
				$row[] = "Materi";
				$row[] = '<a class="btn btn-sm btn-warning"  
				title="Edit" 
				href="'.base_url().'learningline/edit_step/'.$list_item['id'].'"><i class="ico-edit"></i></a>
				<a class="btn btn-sm btn-success detail-'.$list_item['id'].'"  title="Prevew Materi" data-todo='."'".json_encode($list_item)."'".' onclick="materi_detail('."'".$list_item['id']."'".')"><i class="ico-eye-open"></i></a>
				<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_step('."'".$list_item['id']."'".')"><i class="ico-remove"></i></a>';
			}else{
				$row[] = "Latihan";
				$row[] = '<a class="btn btn-sm btn-warning"  
				title="Edit" 
				href="'.base_url().'learningline/edit_step/'.$list_item['id'].'"><i class="ico-edit"></i></a>
				<a class="btn btn-sm btn-success detail-'.$list_item['id'].'"  title="Daftar latihan" data-todo='."'".json_encode($list_item)."'".' onclick="latihan_detail('."'".$list_item['id']."'".')"><i class="ico-th-list"></i></a>
				<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_step('."'".$list_item['id']."'".')"><i class="ico-remove"></i></a>';
			}
			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );	
	}
	// GET LIST STEP BERDASARKAN ID TOPIK

		// GET LIST STEP BERDASARKAN ID TOPIK
	public function ajax_get_list_bab(){
		$list = $this->learning_model->get_bab_for_topik();
		$data = array();

		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['id'];			
			$row[] = $list_item['namaTingkat'];
			$row[] = $list_item['namaMataPelajaran'];
			$row[] = $list_item['judulBab'];
			if ($list_item['statusLearningLine']==1) {
				$row[] = "<input type='checkbox' 
				class='switchery' checked onclick='update_learning_bab(".$list_item['id'].",".$list_item['statusLearningLine'].")'>";
			} else {
				$row[] = "<input type='checkbox' 
				class='switchery' unchecked onclick='update_learning_bab(".$list_item['id'].",".$list_item['statusLearningLine'].")'>";
			}
			
			
			$row[] = '
			<a class="btn btn-sm btn-success bab-'.$list_item['id'].'" title="Detail" 
			data-todo='."'".json_encode($list_item)."'".'
			onclick="detail_bab('."'".$list_item['id']."'".') "><i class="ico-file-plus2"></i></a>';

			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );	
	}
	// GET LIST STEP BERDASARKAN ID TOPIK

	function ajax_get_video($babid){
		$list = $this->mvideos->get_all_video_by_bab($babid);
		$data = array();

		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['videoID'];			
			$row[] = $list_item['judulSubBab'];

			$row[] = $list_item['judulVideo'].' <a class="video-'.$list_item['videoID'].'" title="Preview" 
			data-todo='."'".json_encode($list_item)."'".'
			onclick="play('."'".$list_item['videoID']."'".') "><i class="ico-play"></i></a>';
			
			$row[] = "<input type='radio' name='video' value=".$list_item['videoID']." ' class='switchery' unchecked'>";

			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );	

	}

	function ajax_get_video_edit($babid, $videoID){
		$list = $this->mvideos->get_all_video_by_bab($babid);
		$data = array();

		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['videoID'];	

			$row[] = $list_item['judulSubBab'];

			$row[] = $list_item['judulVideo'].' <a class="video-'.$list_item['videoID'].'" title="Preview" 
			data-todo='."'".json_encode($list_item)."'".'
			onclick="play('."'".$list_item['videoID']."'".') "><i class="ico-play"></i></a>';
			$status_check = ($list_item['videoID']==$videoID) ? "checked" : "unchecked" ;
			$row[] = "<input type='radio' ".$status_check." name='video' value=".$list_item['videoID'].">";



			

			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );	

	}

	function ajax_get_materi($data){
		$list = $this->learning_model->get_materi_babID($data);
		$data = array();

		$baseurl = base_url();
		foreach ( $list as $list_item ) {
			// $no++;
			$row = array();
			$row[] = $list_item['id'];			
			$row[] = $list_item['judulMateri'];
			$row[] = '<a class="btn btn-sm btn-primary btn-outline detail-'.$list_item['id'].'"  title="Lihat"
			data-id='."'".json_encode($list_item)."'".'
			onclick="detail('."'".$list_item['id']."'".')"
			>
			<i class=" ico-eye "></i>
		</a> ';

		$row[] = "<input type='radio' name='materi' value=".$list_item['id']." ' class='switchery' unchecked'>";

		$data[] = $row;

	}

	$output = array(
		"data"=>$data,
		);

	echo json_encode( $output );	

}


function ajax_get_materi_edit($topikid, $materiID){
	$list = $this->learning_model->get_materi_babID_edit($topikid);
	$data = array();

	$baseurl = base_url();
	foreach ( $list as $list_item ) {
			// $no++;
		$row = array();

		$row[] = $list_item['id'];			
		$row[] = $list_item['judulMateri'];
		$row[] = '<a class="btn btn-sm btn-primary btn-outline detail-'.$list_item['id'].'" title="Lihat" data-id='."'".json_encode($list_item)."'".' onclick="detail('."'".$list_item['id']."'".')"><i class=" ico-eye "></i></a> ';
		$status_check = ($list_item['id']==$materiID) ? "checked" : "unchecked" ;
		$row[] = "<input type='radio' ".$status_check." name='materi' value=".$list_item['id'].">";
		// $row[] = "<input type='radio' name='imgsel' value='' checked=true";

		$data[] = $row;

	}

	$output = array(
		"data"=>$data,
		);

	echo json_encode( $output );	

}

	## --------------------------AJAX PROCESSING-------------------------- ##



	## --------------------------CRUD PROCESSING-------------------------- ##
function updateaktiv($data){
	$this->learning_model->updateaktiv($data);
}

function updatepasive($data){
	$this->learning_model->updatepasive($data);
}

	// TB-TOPIK //
function ajax_insert_line_topik(){
			// $data = $this->input->post();
	$data = array(
		'babID'=>$this->input->post('babID'),
		'statusLearning'=>$this->input->post('statusLearning'),
		'deskripsi'=>$this->input->post('deskripsi'),
		'namaTopik'=>$this->input->post('namaTopik'),
		'status'=>1,
		'urutan'=>$this->input->post('urutan'),
		'UUID'=>uniqid(),
		);
	$this->learning_model->insert_line_topik ($data);
}


// update
function ajax_update_line_topik(){
	$data = array(
		'statusLearning'=>$this->input->post('statusLearning'),
		'deskripsi'=>$this->input->post('deskripsi'),
		'namaTopik'=>$this->input->post('namaTopik'),
		'status'=>1,
		'urutan'=>$this->input->post('urutan'),
		'id'=>$this->input->post('topikID'),
		);

	// var_dump($data['topikID']);
	$this->learning_model->update_topik($data);
}
	// TB-TOPIK //

	// TB-STEP //
function ajax_insert_line_step(){
	$uuid = uniqid();
	
	if($this->input->post('latihanID')){
		$data = array(
			'namaStep'=>$this->input->post('namastep'),
			'jenisStep'=>$this->input->post('select_jenis'),
			'videoID'=>$this->input->post('videoID'),
			'MateriID'=>$this->input->post('materiID'),
			'latihanID'=>$this->session->userdata('id_latihan'),
			'status'=>1,
			'urutan'=>$this->input->post('urutan'),
			'topikID'=>$this->input->post('topikID'),
			'jumlah_benar'=>$this->input->post('jumlah_benar'),
			'jumlah_soal_sedang'=>$this->input->post('jumlah_soal_sedang'),
			'jumlah_soal_mudah'=>$this->input->post('jumlah_soal_mudah'),
			'jumlah_soal_sulit'=>$this->input->post('jumlah_soal_sulit'),
			'depend_status'=>$this->input->post('status_depedensi'),
			'UUID'=>$uuid
			);
	}else{ 
		$data = array(
			'namaStep'=>$this->input->post('namastep'),
			'jenisStep'=>$this->input->post('select_jenis'),
			'videoID'=>$this->input->post('videoID'),
			'MateriID'=>$this->input->post('materiID'),
			'status'=>1,
			'urutan'=>$this->input->post('urutan'),
			'topikID'=>$this->input->post('topikID'),
			'depend_status'=>$this->input->post('status_depedensi'),
			'UUID'=>$uuid
			);
	}
	// 1. Cek dulu yang diinsert ada yang sama atau tidak?
	$step_urutan_sama = $this->learning_model->get_step_sama_urutan($data['topikID'], $data['urutan']);
	if ($step_urutan_sama) {
		// kalo ada yang sama
		$list_step = $this->learning_model->get_step_urutan_idtopik($data['topikID'], $data['urutan']);
		$data_urutan_update = array();
		if ($list_step) {
		//ambil urutan yang lebih sama dengan urutan		
			$urutanngaco  = $this->learning_model->get_step_urutan($data['topikID'], $data['urutan']);
		//cacah di buat array baru, urutan valuenya +1
			foreach ($urutanngaco as $value) {
				$a = array('urutan'=>$value['urutan']+1);
				$b = array('id'=>$value['id']);
				$result = array_merge($a, $b);
			//update batch
				$this->learning_model->update_step_urutan($result);
			}
		} 
		$this->learning_model->insert_line_step($data);
	} else {
		//kalo gak ada yang sama
		$this->learning_model->insert_line_step($data);
	}
}

function ajax_update_learning_step(){
	$data = array(
		'namaStep'=>$this->input->post('namastep'),
		'jenisStep'=>$this->input->post('select_jenis'),
		'videoID'=>$this->input->post('videoID'),
		'MateriID'=>$this->input->post('materiID'),
		'latihanID'=>$this->input->post('namaTopik'),
		'status'=>1,
		'urutan'=>$this->input->post('urutan'),
		'id'=>$this->input->post('id'),
		);
	$this->learning_model->update_learning_step($data);


}
	// TB-STEP //

function drop_topik(){
	$data = array(
		'id'=>$this->input->post('id')
		);
	$this->learning_model->drop_topik($data);
}

function drop_step(){
	$data = array(
		'id'=>$this->input->post('id')
		);
	$this->learning_model->drop_step($data);
}


	## --------------------------RUBAH STATUS LEARNING LINE AT BAB PROCESSING-------------------------- ##

function updateaktiv_bab($data){
	$this->learning_model->updateaktiv_bab($data);
}

function updatepasive_bab($data){
	$this->learning_model->updatepasive_bab($data);
}
	## --------------------------RUBAH STATUS LEARNING LINE AT BAB PROCESSING-------------------------- ##


	## --------------------------CRUD PROCESSING-------------------------- ##


# detail pada saat di klik ##
function ajax_detail_materi($id){
	$list = $this->mmateri->get_single_materi_byid($id)[0];

	$output = array(
		"data"=>$list,
		);

	echo json_encode( $output );	
}
function ajax_detail_latihan($id){
	$list = $soal=$this->mlatihan->get_soal_by_id_latihan($id);
	$data = array();
		//mengambil nilai list
	$baseurl = base_url();
	foreach ( $list as $list_soal ) {
		$n='1';
		$row = array();

		$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
		<input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
		<label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
	</span>";
	$row[] = $list_soal['judul_soal'];
	$row[] = $list_soal['sumber'];

	$row[] = $list_soal['soal'];

	if ($list_soal['kesulitan']=='0') {
		$row[] = "Mudah";
	} else if($list_soal['kesulitan']=='1'){
		$row[] = "Sedang";
	}else{
		$row[] = "Sulit";
	}
	$row[]='<a class="btn btn-success soal-'.$list_soal['id_soal'].'" title="lihat soal" onclick=detail_soal('.$list_soal['id_soal'].') data-todo='."'".json_encode($list_soal)."'".'> <i class="ico ico-eye"></i></a>';
	$data[] = $row;
	$n++;
}

$output = array(
	"data"=>$data,
	);
echo json_encode( $output );
}

# detail video pada saat di klik
function ajax_detail_video($id_video){
	$list = $this->mvideos->get_single_video($id_video)[0];

	$output = array(
		"data"=>$list,
		);

	echo json_encode( $output );

}
# detail pada saat di klik 

# get line log berdasrkan pengguna.
function get_line_log(){
	$list = $this->learning_model->get_line_log_step_line_by_user();

	$data = array();
	$no = 0;
        //mengambil nilai list
	$baseurl = base_url();
	foreach ($list as $list_log) {
		$no++;
		$row = array();
		$row[] = $no;
		$row[] = $list_log['namaTopik'];
		
		if ($list_log['jenisStep']==1) {
			$row[] = "Video";
			$row[] = "Sudah Di tonton";
			$row[] = "-";

		}elseif ($list_log['jenisStep']==2) {
			$row[] = "Materi";
			$row[] = "Sudah Dibaca";
			$row[] = "-";

		}else{
			$row[] = "Latihan";
			$row[] = "Lulus";
			$row[] = $list_log['jumlah_soal'];
		}
		$row[] = $list_log['namaStep'];

	

		// $row[] = '<a class="btn btn-sm btn-warning"  title="Edit" href="' . base_url('index.php/siswa/updateSiswa/' . $list_log['id'] . '/' . $list_log['id']) . '" "><i class="ico-edit"></i></a> 

		// <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa(' . "" . $list_log['id'] . "," . $list_log['id'] . ')"><i class="ico-remove"></i></a>';

		$data[] = $row;
	}

	$output = array(
		"data" => $data,
		);
	echo json_encode($output);
}
# get line log berdasrkan pengguna.
// get data komen not read
  public function datKomen()
  {
      $hakAkses = $this->session->userdata['HAKAKSES'];
      if ($hakAkses == 'admin') {
          $listKomen = $this->mkomen->get_all_komen();
      }else{
        $id_guru = $this->session->userdata['id_guru'];
         $listKomen = $this->mkomen->get_komen_by_profesi_notread($id_guru);
      }

      return $listKomen;
  }

}
