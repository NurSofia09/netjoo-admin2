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
 		f_import_siswa();
 	}
 	//view halaman import siswa
 	public function f_import_siswa()
 	{	
		$data['judul_halaman'] = "Form Import Siswa";
		$data['files'] = array(
			APPPATH . 'modules/import_user/views/v-form_import_siswa.php',
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

 	 public function f_import_guru()
 	{	
		$data['judul_halaman'] = "Form Import Guru";
		$data['files'] = array(
			APPPATH . 'modules/import_user/views/v-form_import_guru.php',
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
 			$keterangan=$this->input->post("keterangan");
 			 $file_data = $this->upload->data();
 			 $url_file =$file_data['file_name'];
 			$nama_file=$_FILES[$dat_excel]['name'];
 			$uuid=uniqid();
 			$data["nama_file"]=$nama_file;
 			$data["url_file"]=$url_file;
 			$data["uuid"]=$uuid;
 			$data["keterangan"]=$keterangan;
 			$this->Import_user_model->in_file_excel($data);

 			$datExcel["nama_file"]=$nama_file;
 			$datExcel["url_file"]=$url_file;
 			$datExcel["uuid_excel"]=$uuid;
 			$datExcel["status_upload"]=true;
 		}

 		echo json_encode($datExcel);
 	}
public function set_siswa_batch()
 	{
 		$post=$this->input->post();
 		$datArr=$post["datImport"];
 		$uuid_excel=$post["uuid_excel"];
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		$dat_siswa=array();
 		foreach ($datArr as $key ) {
 			$parse_tgl=strtotime($key['tgl_lahir']);
 			$tgl=date("d",$parse_tgl);
 			$tgl_lahir=date("Y-m-d",$parse_tgl);
 			//data pengguna
 			$uuid=uniqid();
 			$kataSandi=$tgl_lahir;
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key["nisn"],
 				'kataSandi'=>md5($kataSandi),
 				// 'eMail'=> $key["eMail"],
 				'hakAkses'=>'siswa',
 				'uuid_user'=>$uuid,
 				'keterangan'=>"excel_".$uuid_excel);
 			$dat_siswa_excel[]=array(
 				'namaDepan'=>$key['nama'],
 				'tgl_lahir' => $tgl_lahir,
 				'alamat'=>$key['alamat'],
 				'namaSekolah'=>$key['namaSekolah'],
 				'alamatSekolah'=>$key['alamatSekolah'],
 				'noKontakSekolah'=>$key['noKontakSekolah'],
				'nisn'=>$key['nisn'],
				'tingkatID' => $key["tingkatID"],
 				);
 			$dat_sekolahID[]=array(
 				"sekolahID"=>$key["id_sekolah_pengawas"],
 				);
 			$uuid_arr[]=array(
 				'uuid_user'=>$uuid);
 		}
 		// simpan data pengguna
 		$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 		//get id pengguna yg baru di insert
 		 $dat_pengguna_ID=$this->Import_user_model->get_batch_penggunaID($uuid_arr);
 		 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 
 		 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 		 	//merge array dat_siswa_excel dengan array dat_pengguna_ID
 		 	$dat_siswa[]=array_merge_recursive($dat_siswa_excel[$i],$dat_pengguna_ID[$i]);
 		 	$dat_sekolah_pengguna[]=array_merge_recursive($dat_sekolahID[$i],$dat_pengguna_ID[$i]);
 		 }
 		
 		// simpan data Siswa
 		$this->Import_user_model->myinsert_batch($dat_siswa,"tb_siswa");
 		// simpan data sekolah pengguna
 		$this->Import_user_model->myinsert_batch($dat_sekolah_pengguna,"tb_sekolah_pengguna");
 		
 		 // var_dump($dat_pengguna);
 		 // var_dump($dat_pengguna_ID);
 		echo json_encode("Data siswa berhasil di tambahkan");
 	}

 	public function set_guru_batch()
 	{
 		$post=$this->input->post();
 		$datArr=$post["datImport"];
 		$uuid_excel=$post["uuid_excel"];
 		$dat_siswa=array();
 		$dat_pengguna=array();
 		$dat_siswa=array();
 		foreach ($datArr as $key ) {
 			$parse_tgl=strtotime($key['tgl_lahir']);
 			$tgl=date("d",$parse_tgl);
 			$tgl_lahir=date("Y-m-d",$parse_tgl);
 			$kataSandi=$key["no_karyawan"].$tgl;
 			//data pengguna
 			$uuid=uniqid();
 			$dat_pengguna[]=array(
 				'namaPengguna'=> $key['no_karyawan'],
 				'kataSandi'=>md5($kataSandi),
 				'eMail'=> $key["eMail"],
 				'hakAkses'=>'guru',
 				'uuid_user'=>$uuid,
 				'keterangan'=>"excel_".$uuid_excel);

 			$dat_guru_excel[]=array(
 				'namaDepan'=>$key['namaDepan'],
 				'namaBelakang'=>$key['namaBelakang'],
 				'alamat' => $key['alamat'],
 				'tgl_lahir' => $tgl_lahir,
 				'noKontak' => $key['noKontak'],
 				'biografi' => $key['biografi'],
 				
 				);
 			$uuid_arr[]=array(
 				'uuid_user'=>$uuid);
 		}
 		// simpan data pengguna
 		$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 		//get id pengguna yg baru di insert
 		 $dat_pengguna_ID=$this->Import_user_model->get_batch_penggunaID($uuid_arr);
 		 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 		 //merge array dat_siswa_excel dengan array dat_pengguna_ID
 		 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 		 	$dat_guru[]=array_merge_recursive($dat_guru_excel[$i],$dat_pengguna_ID[$i]);
 		 }

 		// simpan data Siswa
 		$this->Import_user_model->myinsert_batch($dat_guru,"tb_guru");
 		echo json_encode("Data guru berhasil di tambahkan");
 	}

 	public function unlink_xlsx()
 	{
 		$url_file=$this->input->post("url_file");
 		  unlink(FCPATH . "assets/excel/" . $url_file);
 		$config_del['mytable']="tb_bup_import_excel";
 		$config_del['key_condition']="url_file";
 		$config_del['val_condition']=$url_file;
 		$this->Import_user_model->del_one_record($config_del);
 	}

 	public function rollback_import()
 	{
 		$data['judul_halaman'] = "Rollback Import";
		$data['files'] = array(
			APPPATH . 'modules/import_user/views/v-rollback_import.php',
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

 	// validasi rollback
 	public function validasi_rollback()
 	{	
 		$date=date("d");
 		$post=$this->input->post();
 		$penggunaID=$this->session->userdata['id'];
 		$post_kodevalidasi=md5($post["kode_validasi"]).$date;
 		$kode_validasi=$this->Import_user_model->get_katasandi($penggunaID)[0]->kataSandi.$date;
 		if ($post_kodevalidasi==$kode_validasi) {
 			$count_row=$this->Import_user_model->count_row_pengguna($post);
 			if ($count_row==0) {
 				$dat_retrun["msg"]="false2";

 			} else {
	 			$dat_retrun["msg"]="true";
	 			$this->Import_user_model->del_import($post);
 			}
 		} else {
 			$dat_retrun["msg"]="false1";
 		}
 		echo json_encode($dat_retrun);
 	}

 	//view table excel backup
 	public function xlsx_backUp()
 	{
 		$data['judul_halaman'] = "Excel Backup";
		$data['files'] = array(
			APPPATH . 'modules/import_user/views/v-excel_bup.php',
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
 	

 	//ajax list excel backup
 	public function ajax_xlsx()
 	{
 		$no=1;
 		$arr_xlsx=$this->Import_user_model->select_excel_bup();
 		foreach ($arr_xlsx as $key ) {
 			$url_file=$key->url_file;
 			$nama_file=$key->nama_file;
 			$param_rolback="'".$key->uuid_xlsx."','". $url_file ."'";
 			$param_del="'".$key->id."','". $url_file ."','".$nama_file ."'";
 			$param_uuid="'".$key->uuid_xlsx."'";
 			$param_remove_token="'".$key->uuid_xlsx."','".$nama_file ."'";
 			$pengguna=$key->keterangan;
 			
 			$button_aksi='<div class="btn-group" style="margin-bottom:5px;">
 			<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">Aksi_<span class="caret"></span></button>
 			<ul class="dropdown-menu" role="menu">
 			<li><a href="javascript:void(0);" class="text-danger" onClick="rollback('.$param_rolback.')">Rollback</a></li>
 			<li><a href="javascript:void(0);" class="text-danger" onClick="del_excel('.$param_del.')">Delete Excel</a></li>
 			</ul>
 			</div>';  
 			$row=array();
 			$row[]=$no;
 			$row[]=$key->tgl_import;
 			$row[]= $nama_file;
 			$row[]= $url_file;
 			$row[]= $pengguna;
 			$row[]=$button_aksi;
 			$data[] = $row;
 			$no++;
 		}
 		  $output = array(      
       "data"=>$data,
      );
    echo json_encode( $output );
 	}

 	// rollback by file xlsx
 	public function rollback_xlsx()
 	{
 		$post=$this->input->post();
 		$uuid="excel_".$post["uuid"];
 		$post_kodevalidasi=md5($post["kodevalidasi"]);
 			$penggunaID=$this->session->userdata['id'];
 		$kode_validasi=$this->Import_user_model->get_katasandi($penggunaID)[0]->kataSandi;
 			if ($post_kodevalidasi==$kode_validasi) {
 			$count_row=$this->Import_user_model->count_row_pengguna_by_xlsx($uuid);
 			if ($count_row==0) {
 				$dat_retrun["msg"]="false2";

 			} else {
	 			$dat_retrun["msg"]="true";
	 		$this->Import_user_model->del_by_import_xlsx($uuid);
 			}
 		} else {
 			$dat_retrun["msg"]="false1";
 		}
 		echo json_encode($dat_retrun);
 	}

 	// del file backup excel 
 	public function del_bup_import_excel()
 	{
 		$post=$this->input->post();
 		$url_file=$post["url_file"];
 		$id=$post["id"];
 		$url_file=$this->input->post("url_file");
 		unlink(FCPATH . "assets/excel/" . $url_file);
 		$this->Import_user_model->del_excel($id);
 		$dat_retrun="berhasil";
 		echo json_encode($dat_retrun);
 	}

	// set token siswa import excel @bb
 	public function set_token_batch()
 	{
 		//tampung data post
 		$post=$this->input->post();
 		$masa_aktif=$post["masa_aktif"];
 		$uuid_excel="excel_".$post["uuid"];
 		// hitung jumlah siswa
 		$count_row=$this->Import_user_model->count_row_pengguna_by_xlsx($uuid_excel);
 		// cek  siswa
 		if ($count_row!=0) {
 			//hitung jumlah siswa token
 			$count_token=$this->Import_user_model->count_row_token_by_xlsx($uuid_excel);
 			//cek siswa token siswa
 			if ($count_token==0) {
				//jika ada siswa belum diberi token
	 			//get id siswa by uuid excel
	 			$my_select="s.id as siswaID";
		 		$arr_siswaID=$this->Import_user_model->get_siswa_by_excel($uuid_excel,$my_select);
		 		// buat token siswa
		 		foreach ($arr_siswaID as $key ) {
		 			$kode_voucher = strtoupper(uniqid());
		 			$arr_token[]= array('nomorToken' => $kode_voucher ,"masaAktif"=>$masa_aktif, "siswaID"=>$key->siswaID, "keterangan"=>$uuid_excel);
		 		}
		 		$my_table="tb_token";
		 		//simpan token
		 		$this->Import_user_model-> myinsert_batch($arr_token,$my_table);
		 		$return_msg="true";
 			} else {
 				//false jika siswa sudah diberi token
 				$return_msg="false2";
 			}
 			//end if cek siswa
 		} else {
 			//false1 == jika tidak ada siswa
 			$return_msg="false1";
 		}
 		echo json_encode($return_msg);
 	}


 	//generate pengguna ortu by siswa import excel
 	public function set_ortu_batch()
 	{
 		//tampung data post
 		$post=$this->input->post();
 		$uuid_excel="excel_".$post["uuid"];
 		// hitung jumlah siswa
 		$count_row=$this->Import_user_model->count_row_pengguna_by_xlsx($uuid_excel);
 		// cek siswa
 		if ($count_row!=0) {
 			// jika ada siswa
 			$count_ortu=$this->Import_user_model->count_row_ortu_by_xlsx($uuid_excel);
 			// cek ortu siswa
 			if ($count_ortu==0) {
				//jika ada siswa belum diberi ortu
				$my_select="s.id as siswaID,s.namaDepan,p.namaPengguna,p.kataSandi,p.keterangan";
				 		$arr_siswaID=$this->Import_user_model->get_siswa_by_excel($uuid_excel,$my_select);
				 		foreach ($arr_siswaID as $key ) {
				 			$uuid=uniqid();
				 			$dat_pengguna[]=array(
					 				'namaPengguna'=>"P-".$key->namaPengguna,
					 				'kataSandi'=>$key->kataSandi,
					 				'hakAkses'=>'ortu',
					 				'uuid_user'=>$uuid,
					 				'keterangan'=>$key->keterangan);
				 			//data sementara orang tua
				 			$tamp_ortu[]= array(
				 					'namaOrangTua' =>"Oirang Tua ".$key->namaDepan, 
				 					'siswaID'=>$key->siswaID);
				 			$uuid_arr[]=array('uuid_user'=>$uuid);
				 		}
				 	// simpan data pengguna
				 	$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 					//get id pengguna yg baru di insert
				 	$dat_pengguna_ID=$this->Import_user_model->get_batch_penggunaID($uuid_arr);
				 	$length_dat_pengguna_ID=count($dat_pengguna_ID);
 					//merge array tamp_data ortu dengan array dat_pengguna_ID
		 			for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
		 				$dat_ortu[]=array_merge_recursive($tamp_ortu[$i],$dat_pengguna_ID[$i]);
		 			}
		 			$this->Import_user_model->myinsert_batch($dat_ortu,"tb_orang_tua");
 		 		// var_dump($dat_siswa);
		 		$return_msg="true";
 			} else {
 				//false jika siswa sudah diberi token
 				$return_msg="false2";
 			}
 			//end if cek siswa
 		} else {
 			//false1 == jika tidak ada siswa
 			$return_msg="false1";
 		}
 		echo json_encode($return_msg);
 	}
// CABANG	NIS CBT/USER ID	NAMA	PASSWORD CBT	KELAS

//////////////////////////////////////////////////////
// FUNGSI DARURAT @Bebek
////////////////////////////////////////////	

public function f_import_magic()
 	{	
		$data['judul_halaman'] = "Form Import Magic";
		$data['files'] = array(
			APPPATH . 'modules/import_user/views/v-form_import_magic.php',
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

 	// public function set_magic_batch()
 	// {
 	// 	$post=$this->input->post();
 	// 	$datImport=$post["datImport"];
 	// 	$datArr=json_decode($datImport);
 	// 	$uuid_excel=$post["uuid_excel"];
 	// 	$dat_siswa=array();
 	// 	$dat_pengguna=array();
 	// 	$dat_siswa=array();
 	// 	foreach ($datArr as $key ) {
 	// 		$parse_tgl=strtotime($key->tgl_lahir);
 	// 		$tgl=date("d",$parse_tgl);
 	// 		$tgl_lahir=date("Y-m-d",$parse_tgl);
 	// 		$noIndukNeutron=$key->noIndukNeutron;
 	// 		$cabangID=substr($noIndukNeutron,3,3);
 	// 		$tingkatID=substr($noIndukNeutron,0,2);
 	// 		//data pengguna
 	// 		$uuid=uniqid();
 	// 		$kataSandi=$tgl_lahir;
 	// 		$dat_pengguna[]=array(
 	// 			'namaPengguna'=> $key->noIndukNeutron,
 	// 			'kataSandi'=>md5($kataSandi),
 	// 			'hakAkses'=>'siswa',
 	// 			'uuid_user'=>$uuid,
 	// 			'keterangan'=>"excel_".$uuid_excel);
 	// 		$dat_siswa_excel[]=array(
 	// 			'namaDepan'=>$key->nama,
 	// 			'tgl_lahir' => $tgl_lahir,
		// 		'noIndukNeutron'=>$noIndukNeutron,
		// 		'cabangID' => $cabangID,
		// 		'tingkatID' => $tingkatID,
		// 		'kurikulum_id'=>$key->kurikulum_id,
 	// 			);
 	// 		$uuid_arr[]=array(
 	// 			'uuid_user'=>$uuid);
 	// 	} 		
 	// 	// simpan data pengguna
 	// 	$this->Import_user_model->myinsert_batch($dat_pengguna,"tb_pengguna");
 	// 	//get id pengguna yg baru di insert
 	// 	 $dat_pengguna_ID=$this->Import_user_model->get_batch_penggunaID($uuid_arr);
 	// 	 $length_dat_pengguna_ID=count($dat_pengguna_ID);
 	// 	 //merge array dat_siswa_excel dengan array dat_pengguna_ID
 	// 	 for ($i=0; $i < $length_dat_pengguna_ID ; $i++) { 
 	// 	 	$dat_siswa[]=array_merge_recursive($dat_siswa_excel[$i],$dat_pengguna_ID[$i]);
 	// 	 }
 	// 	 var_dump($dat_siswa);
 	// 	// simpan data Siswa
 	// 	$this->Import_user_model->myinsert_batch($dat_siswa,"tb_siswa");
 	// 	echo json_encode("Data siswa berhasil di tambahkan");
 	// }
 	//hapus token siswa berdasarkan file excel @bb
 	public function del_token_by_excel()
 	{
 		//identitas excel di siswa
 		$uuid_excel="excel_".$this->input->post("uuid");
 		// if ($dat_retrun==true) {
 		// 	//pesan
 		// 	$dat_msg="Token siswa telah dihapus!";
 		// } else {
 		// 	//pesan
 		// 	$dat_msg="Token siswa gagal dihapus!";
 		// }
 		// hitung jumlah siswa
 		$count_row=$this->Import_user_model->count_row_pengguna_by_xlsx($uuid_excel);
 		// cek  siswa
 		if ($count_row!=0) {
 			//hitung jumlah siswa token
 			$count_token=$this->Import_user_model->count_row_token_by_xlsx($uuid_excel);
 			//cek siswa token siswa
 			if ($count_token!=0) {
				//jika ada siswa sudah diberi token
				//hapus token
	 			$return_msg=$this->Import_user_model->del_token_by_excel($uuid_excel);
 			} else {
 				//false jika siswa belum diberi token
 				$return_msg="false2";
 			}
 			//end if cek siswa
 		} else {
 			//false1 == jika tidak ada siswa
 			$return_msg="false1";
 		}
 		echo json_encode($return_msg);
 	}
 	
 	public function cek_siswa()
 	{	
 		$uuid_excel="excel_".$this->input->post('uuid');
 		$count_row=$this->Import_user_model->count_row_pengguna_by_xlsx($uuid_excel);
 		// cek siswa
 		if ($count_row!=0) {
 			// cek token siswa
 			 			//hitung jumlah siswa token
 			$count_token=$this->Import_user_model->count_row_token_by_xlsx($uuid_excel);
 			if ($count_token==0) {
 				$return_msg="false2";
 			}else{
 				$return_msg="true";
 			}
 		} else {
 			//false1 == jika tidak ada siswa
 			$return_msg="false";
 		}
 		echo json_encode($return_msg);
 	}
 	 public function pdf_token($uuid='')
 	{
 		$this->load->library('Pdf');
 		// $uuid_xlsx=$this->input->post("uuid");
 		$uuid_xlsx="excel_".$uuid;
 		//get data token siswa berdasarkan siswa import exxel
 		$data["data_token"]=$this->Import_user_model->get_token_xlsx($uuid_xlsx);
 		// var_dump($data);
 		
 		// echo json_encode("hai".$uuid_xlsx);
 		$this->parser->parse('token/v_token_pdf.php',$data);
 	}
//convert array to csv file
 	public function csv_file($uuid='')
 	{
 		$uuid_xlsx="excel_".$uuid;
 		$dat_siswa=$this->Import_user_model->get_token_xlsx($uuid_xlsx);
 		$dat_header= array(
 			array('Data Token Siswa'),
 			array(' ',' ',' ',' ',' ',' ' ),
 			array('cabang','No CBT','nama','tgl_lahir','tingkat','token' ),);
 		$tgl=date("d_m_y");
 		$fileName = '_permohonan_token_'.$tgl.'.csv';

		//Set the Content-Type and Content-Disposition headers.
 		header('Content-Type: application/excel');
 		header('Content-Disposition: attachment; filename="' . $fileName . '"');
 		$fp = fopen('php://output', 'w');
 		$dat_csv=array_merge($dat_header,$dat_siswa);
		//Loop through the array containing our CSV data.
 		foreach ($dat_csv as $row) {
    //fputcsv formats the array into a CSV format.
    //It then writes the result to our output stream.
 			fputcsv($fp, $row);
 		}

 		fclose($fp);
 	}


 } ?>