<?php 
class Webservice extends MX_Controller
{

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		$this->load->model('tryout/mtryout');
		$this->load->model('login/Mlogin');
		$this->load->model('Webservice_model');
	}

	//GET TRYOUT OFFLINE
	public function tryoutoffline(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$data = $this->mtryout->get_tryout_by_id($post['id_tryout']);
			echo json_encode($data);
		}
	}

	//GET PAKET OFFLINE
	public function paketoffline($id){
		$data = $this->Webservice_model->get_paket_by_toid($id);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET OFFLINE
	public function pembahasanoffline($id){
		$data = $this->Webservice_model->get_pembahasan_sekolah($id);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET SISWA
	public function siswaoffline($sekolahID){
		$data = $this->Webservice_model->get_siswa_at_school($sekolahID);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET PENGGUNA OFFLINE
	public function penggunaffline($idto){
		$data = $this->Webservice_model->get_pengguna_on_tryout($idto);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET HAK AKSES OFFLINE
	public function hakaksesoffline($idto){
		$data = $this->Webservice_model->get_hak_akses_on_tryout($idto);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET SOAL OFFLINE
	public function soaloffline($idto){
		$data = $this->Webservice_model->get_soal_on_tryout($idto);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET SOAL OFFLINE
	public function mm_soal_paket($idto){
		$data = $this->Webservice_model->get_mm_paket($idto);
		$datas = json_encode($data);
		echo $datas;
	}

	//GET PAKET PILIHAN JAWABAN OFFLINE
	public function pilihan_jawaban_offline($idto){
		$data = $this->Webservice_model->get_pilihan_jawaban($idto);
		$datas = json_encode($data);
		echo $datas;
	}


	// LOGIN KE CONTROLLER PUNYA ORANG.
	public function login(){
		// if ($this->input->post()) {
			$post = $this->input->post();
			// $hasil_login = $this->Webservice_model->check_user_admin_offline($post['username'], md5($post['password']));
			$hasil_login = $this->Webservice_model->check_user_admin_offline('adminOpik', 'a0066c4ed186b9ed329411f715f49443');
			

			if ($hasil_login) {
				$row = $hasil_login[0];
				$verifikasiCode = md5($row->regTime);
				$data_login = array(
					'id' => $row->penggunaID,
					'USERNAME' => $row->namaPengguna,
					'HAKAKSES' => 'adminOffline',
					'AKTIVASI' => $row->aktivasi,
					'eMail' => $row->email,
					'verifikasiCode' => $verifikasiCode,
					'loggedin' => TRUE,
					'status' => 'berhasil',
					'sekolahID'=>$row->sekolahID
					);
			}else{
				$data_login = ['status'=>"Gagal"];
			}

			echo json_encode($data_login);
		// }

	}

	// get semua to
	function get_all_to($penggunaID){
		$data = $this->Webservice_model->get_all_to($penggunaID);
		echo json_encode($data);
	}

	// get mm tryout paket
	function mm_tryout_paket($id){
		$data = $this->Webservice_model->get_mm_tryout_paket($id);
		echo json_encode($data);	
	}


	function accept_report_to(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$dat_Report=array(
				'siswaID'=>$post['siswaID'],
				'id_pengguna'=>$post['id_pengguna'],	
				'id_mm-tryout-paket'=>$post['id_mm-tryout-paket'],	
				'jmlh_kosong'=>$post['jmlh_kosong'],
				'jmlh_benar'=>$post['jmlh_benar'],
				'jmlh_salah'=>$post['jmlh_salah'],
				'total_nilai'=>$post['total_nilai'],
				'poin'=>$post['poin'],
				'tgl_pengerjaan'=>$post['tgl_pengerjaan'],
				'status_pengerjaan'=>$post['status_pengerjaan'],
				'rekap_hasil_koreksi'=>$post['rekap_hasil_koreksi']
			);
			// $data['report'] = $this->input->post();
			// insert ke tb
			$insert = $this->Webservice_model->insert_report($dat_Report);
			if ($insert) {
				echo json_encode(['status'=>$dat_Report]);
			
			} else {
				echo json_encode(['status'=>$dat_Report]);
			}
		}else{
			echo json_encode(['status'=>false]);
		}
	}

	function test(){
		$data = $this->Webservice_model->check_user_admin_offline("adminOpik", "a0066c4ed186b9ed329411f715f49443");
		print_r($data);
	}
}
?>