<?php 
/**
 * 
 */
 class Import_user extends MX_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('Import_user_model');
		$this->load->library('sessionchecker');

 	}

 	public function index()
 	{
 		echo("okokkokoo");
 	}
 	//view halaman import siswa
 	public function f_import_siswa()
 	{	
		$data['judul_halaman'] = "Form Import Siswa";
		$data['files'] = array(
			APPPATH . 'modules/Import_user/views/v-form_Import_siswa.php',
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

 	public function get_cabang()
 	{
 		$arr_cabang=$this->Import_user_model->select_cabang();
 		echo json_encode($arr_cabang);

 	}
 	public function upload_xlsx()
 	{
 		$config['upload_path'] = './assets/excel';
 		$config['allowed_types'] = 'xlsx';
 		$config['max_size'] = 9000;
 		$dat_excel="dat_excel";
 		$config['encrypt_name'] = TRUE;
 		$new_name = time().$_FILES[$dat_excel]['name'];
 		$config['file_name'] = $new_name;

 		$this->load->library('upload', $config);
 		$this->upload->initialize($config);

  		// pengecekan upload
 		if (!$this->upload->do_upload($dat_excel)) {
			$nama_file="gagal";
 		} else {
 			 $file_data = $this->upload->data();
 			$nama_file=$file_data['file_name'];
 			$data["nama_file"]=$nama_file;
 			$data["url_file"]=$_FILES[$dat_excel]['name'];
 			$this->Import_user_model->in_file_excel($data);
 		}
 		// $datCabang=$this->
 		echo json_encode($nama_file);
 	}
 	public function set_siswa_batch()
 	{
 		$post=$this->input->post();
 		$datArr=$post["datImport"];
 		$cabangID=$post["cabangID"];
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		$fake_uuid=12;
 		$dat_siswa=array();
 		foreach ($datArr as $key ) {
 			$parse_tgl=strtotime($key['tgl_lahir']);
 			$tgl=date("d",$parse_tgl);
 			$tgl_lahir=date("Y-m-d",$parse_tgl);
 			//data pengguna
 			$uuid=uniqid();
 			$kataSandi=$key["noIndukNeutron"].$tgl;
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key["noIndukNeutron"],
 				'kataSandi'=>md5($kataSandi),
 				'eMail'=> $key["eMail"],
 				'hakAkses'=>'guru',
 				'uuid_user'=>$uuid);

 			$dat_siswa_excel[]=array(
 				'namaDepan'=>$key['namaDepan'],
 				'namaBelakang'=>$key['namaBelakang'],
 				'tgl_lahir' => $tgl_lahir,
 				'alamat'=>$key['alamat'],
 				'namaSekolah'=>$key['namaSekolah'],
 				'alamatSekolah'=>$key['alamatSekolah'],
 				'noKontakSekolah'=>$key['noKontakSekolah'],
				'noIndukNeutron'=>$key['noIndukNeutron'],
				'cabangID' => $cabangID,
				'tingkatID' => $key["tingkatID"],
 				);
 			$uuid_arr[]=array(
 				'uuid_user'=>$uuid);
 		}
 		// simpan data pengguna
 		$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 		//get id pengguna yg baru di insert
 		 $dat_pengguna_ID=$this->Import_user_model->myselect_batch($uuid_arr);
 		 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 		 //merge array dat_siswa_excel dengan array dat_pengguna_ID
 		 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 		 	$dat_siswa[]=array_merge_recursive($dat_siswa_excel[$i],$dat_pengguna_ID[$i]);
 		 }

 		// simpan data Siswa
 		$this->Import_user_model->myinsert_batch($dat_siswa,"tb_siswa");
 		echo json_encode("berhasil masuk ke controller");
 	}

 	public function set_pengguna_batch()
 	{
 		# code...
 	}
 	public function set_ortu_batch()
 	{
 		# code...
 	}
 } ?>