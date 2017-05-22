<?php 
/**
* 
*/
class Pengawas extends MX_Controller
{
	
	function __construct()
	{
		$this->load->helper('session');
        $this->load->library('parser');
        $this->load->model('register/mregister');
        $this->load->model('Mpengawas');
                $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();

	}

	 function cekSession() {
        $status = false;
        $hakAkses = $this->session->userdata['HAKAKSES'];
        if ($hakAkses == 'admin') {
            $status = true;
        } elseif ($hakAkses == 'guru') {
            // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        } else {
            redirect(site_url('login'));
        }
        return $status;
    }

	//form pengawas
	public function formPengawas()
	{
		  if ($this->cekSession()) {
           $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
            $data['judul_halaman'] = "Register Pengawas";
            $data['files'] = array(
                APPPATH . 'modules/pengawas/views/v-form-pengawas.php',
            );
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        }
	}

	//add pengawas
	public function savePengawas()
	{

        		// load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

		//syarat pengisian form regitrasi guru
        $this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'trim|required|min_length[6]|max_length[12]|is_unique[tb_pengguna.namaPengguna]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        $this->form_validation->set_rules('katasandi', 'Kata Sandi', 'required|min_length[6]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_pengguna.email]');

		 //pesan error atau pesan kesalahan pengisian form registrasi guru
        $this->form_validation->set_message('namapengguna', 'is_unique', '*Nama Pengguna sudah terpakai');
        $this->form_validation->set_message('is_unique', 'email', '*Email sudah terpakai');
        $this->form_validation->set_message('is_unique', '*Nama Pengguna sudah terpakai');
        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');
        $this->form_validation->set_message('min_length', '*Inputan minimal 6 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');
        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');


        if ($this->form_validation->run() == FALSE) {
            $this->formPengawas();
        } else {
            //data pengawass
            $nama = htmlspecialchars($this->input->post('nama'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));

            //data untuk akun
            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));
            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));
            $email = htmlspecialchars($this->input->post('email'));
            $hakAkses = 'pengawas';

            //data array akun
            $data_akun = array(
                'namaPengguna' => $namaPengguna,
                'kataSandi' => $kataSandi,
                'eMail' => $email,
                'hakAkses' => $hakAkses,
            );


            //melempar data guru ke function insert_pengguna di kelas model
            $data['mregister'] = $this->mregister->insert_pengguna($data_akun);
            //untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel pengawas
            $data['tb_pengguna'] = $this->mregister->get_idPengguna($namaPengguna)[0];
            $penggunaID = $data['tb_pengguna']['id'];

            //data array guru
            $data_pengawas = array(
                'nama' => $nama,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
               	'penggunaID' => $penggunaID,
               	'uuid' => uniqid(),
            );

            //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->Mpengawas->insert_pengawas($data_pengawas);
            redirect(base_url('pengawas/listPengawas'));
        }
	}

	public function listPengawas($value='')
	{
	    $data['judul_halaman'] = "Daftar Pengawas";
	    $data['files'] = array(
	        APPPATH . 'modules/pengawas/views/v-daftar-pengawas.php',
	        );
	    $this->parser->parse('admin/v-index-admin',$data);

	}
	public function ajax_listPengawas()
	{
        $list = $this->load->Mpengawas->get_allPengawas();
        $data = array();
        $baseurl = base_url();
        $no=1;
        foreach ( $list as $list_pengawas) {
            
            $row = array();
            $row[] = $no;
            $row[] = $list_pengawas['namaPengguna'];
            $row[] = $list_pengawas['nama'];
            $row[] = $list_pengawas['alamat'];
            $row[] = $list_pengawas['noKontak'];
            $row[] = $list_pengawas['email'];

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropPengawas('."'".$list_pengawas['uuid']."'".')"><i class="ico-remove"></i></a>
             <a class="btn btn-sm btn-danger"  title="Reset Password" onclick="resetPassword('."'".$list_pengawas['penggunaID']."'".')"><i class="ico-key"></i></a>
            <a href="pengawas/ubahPengawas/'.$list_pengawas["uuid"].'" class="btn btn-sm btn-warning"  title="Ubah" ><i class="ico-file"></i></a>';

            $data[] = $row;
            $no++;

        }
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
	}

	public function ubahPengawas($uuid)
	{
		$data['oldData']=$this->Mpengawas->get_pengawas_by_uuid($uuid);
		
		if ($this->cekSession()) {
           $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
            $data['judul_halaman'] = "Ubah Pengawas";
            $data['files'] = array(
                APPPATH . 'modules/pengawas/views/v-ubah-pengawas.php',
            );
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        }
	}

	public function editPengawas($value='')
	{
		   		// load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

		//syarat pengisian form ubah pengawas
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_pengguna.email]');

		 //pesan error atau pesan kesalahan pengisian form ubah pengawas
        $this->form_validation->set_message('is_unique', 'email', '*Email sudah terpakai');
        $this->form_validation->set_message('min_length', '*Inputan minimal 6 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');


        // if ($this->form_validation->run() == FALSE) {
        //     $this->formPengawas();
        // } else {
            //data pengawass
            $nama = htmlspecialchars($this->input->post('nama'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));
            $uuid = htmlspecialchars($this->input->post('uuid'));
            // $email = htmlspecialchars($this->input->post('email'));
            //data array akun

            //melempar data guru ke function insert_pengguna di kelas model
            // $data['mregister'] = $this->Mpengawas->ubah_email($email,$uuid);
            //untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel pengawas

            //data array guru
            $data_pengawas = array(
                'nama' => $nama,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
            );

            //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->Mpengawas->ubah_pengawas($data_pengawas,$uuid);
            redirect(base_url('pengawas/listPengawas'));
        // }
	}

	public function deletePengawas()
	{
          if ($this->input->post()) {
            $post = $this->input->post();
             $this->Mpengawas->del_pengawas($post['uuid']);
        }
	}

    public function resetPassword()
    {
      if ($this->input->post()) {
            $post = $this->input->post();
            $nama = $this->Mpengawas->get_namaPengguna($post['penggunaID']);
            $kataSandi = md5($nama );
            $this->Mpengawas->reset_password($kataSandi,$post['penggunaID']);
        }
    }


}
 ?>