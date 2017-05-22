<?php 	
class Bug extends MX_Controller {


	function __construct(){
		$this->load->model('mbug');
		$this->load->library('parser');
	}

	function ajax_add_bug(){
		$data = array(
			'isiError' => $this->input->post('isi'),
			'halaman' => $this->input->post('alamat'),
			'penggunaID' => $this->session->userdata('id')
			);
		$this->mbug->insert_bug($data);

	}

	function index(){
		$data['judul_halaman'] = "Dashboard Admin : Laporan Bug";
		$data['files'] = array(
			APPPATH.'modules/bug/views/v-container.php',
			);
		$hakAkses = $this->session->userdata['HAKAKSES'];

		if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}

	function ajax_data_bugs(){
		$list = $this->mbug->get_all_bugs();
            // var_dump($list);


	// 	$data = array();

		foreach ( $list as $bug_item ) {
			$row = array();
			$row[] = $bug_item->id;
			$row[] = $bug_item->isiError;
			$row[] = $bug_item->date_created;
			$row[] = $bug_item->halaman;
			$row[] = $bug_item->namaPengguna;
      		if ($bug_item->status==0) {
      			$row[] = "Belum Ditanggapi";
      		}else{
      			$row[] = "Selesai Ditanggai";
      		}
			$row[] = $bug_item->aksi;
			$row[] = "
			<a class='btn btn-primary' onclick='respon(".$bug_item->id.")'><i class='icon ico-pencil' title='Respon'></i></a> 
			<a class='btn btn-danger' onclick='drop(".$bug_item->id.")'><i class='icon ico-remove3' title='Hapus'></i></a>
			";



			$data[] = $row;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	function tindakan_laporan(){
		$id = $this->input->post('idKomen');
  		$tindakan = $this->input->post('isTindakan');

  		$datas = array('id'=>$id,
  						'aksi'=>$tindakan,
  						'status'=>1
  			);

  		$this->mbug->update_bug($datas);
	}

	function delete($idlapor){
		$this->mbug->drop($idlapor);
	}
}
?>