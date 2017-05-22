<?php 
/**
 * 
 */
class Webservice extends MX_Controller
{

	public function __construct()
	{
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

	//GET PAKET SISWA
	public function siswaoffline($idto){
		$data = $this->Webservice_model->get_siswa_on_tryout($idto);
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
		if ($this->input->post()) {
			$post = $this->input->post();
			$hasil_login = $this->Webservice_model->check_user_admin_offline($post['username'], md5($post['password']));
			// $hasil_login = $this->Webservice_model->check_user_admin_offline('user_admin', '401e9969e47a57558eb6638bc0544e3e');

			if ($hasil_login) {
				$row = $hasil_login[0];
				$verifikasiCode = md5($row->regTime);
				$data_login = array(
					'id' => $row->id,
					'USERNAME' => $row->namaPengguna,
					'HAKAKSES' => 'adminOffline',
					'AKTIVASI' => $row->aktivasi,
					'eMail' => $row->eMail,
					'verifikasiCode' => $verifikasiCode,
					'loggedin' => TRUE,
					'status' => 'berhasil'
					);
			}else{
				$data_login = ['status'=>"Gagal"];
			}

			echo json_encode($data_login);
		}

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
}
?>