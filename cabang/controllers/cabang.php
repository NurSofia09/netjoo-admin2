<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Cabang extends MX_Controller {
	private $hakakses;
	function __construct(){
		$this->load->library('parser');
		$this->load->model('mcabang');
		$this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
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

	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Cabang",
			);

		$data['files'] = array(
			APPPATH . 'modules/cabang/views/v-daftar-cabang.php',
			);
		// var_dump($data['dataToken']);
		$this->loadparser($data);
	}

	function ajax_data(){
		$list = $this->mcabang->get_all_cabang();
		$data = array();

		foreach ( $list as $cabang_item ) {
			$row = array();
			$row[] = $cabang_item->id;
			$row[] = $cabang_item->namaCabang;
			$row[] = $cabang_item->alamat;
			$row[] = $cabang_item->kodeCabang;



			$row[] =  ' <a class="btn btn-sm btn-default"  title="Tambah Kelas" onclick="add_kelas('."'".$cabang_item->id."'".')"><i class="ico-plus"></i></a> '.
			'<a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_cabang('."'".$cabang_item->id."'".')"><i class="ico-remove"></i></a>'.
			' <a class="btn btn-sm btn-info detail-'.$cabang_item->id.'"  title="Detail Cabang" data-id='."'".json_encode($cabang_item)."'".' onclick="detail_cabang('."'".$cabang_item->id."'".')" ><i class="ico-copy2"></i></a>'.
			' <a class="btn btn-sm btn-success"  title="Edit Cabang" onclick="edit_cabang('."'".$cabang_item->id."'".')"><i class="ico-pencil5"></i></a>';
			$data[] = $row;
		}

		$output = array(
			"data"=>$data,
			);
		echo json_encode( $output );
	}

	function insert_cabang_ajax(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$data = array("namaCabang"=>$post['kota'],"alamat"=>$post['alamat'],"kodeCabang"=>$post['kodecabang']);
			$this->mcabang->insert_cabang($data);
		}
	}

	function drop_cabang(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$this->mcabang->drop_cabang($post);
		}
	}

	function update_cabang_ajax(){
		if ($this->input->post()) {
		$post = $this->input->post();
		$data = array("id"=>$post['id'],
			"namaCabang"=>$post['kota'],
			"alamat"=>$post['alamat'],
			"kodeCabang"=>$post['kodecabang']);


		$this->mcabang->update_cabang($data);
		}
	}
}
?>