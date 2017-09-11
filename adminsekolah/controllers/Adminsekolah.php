<?php 
/**
* 
*/
class Adminsekolah extends MX_Controller
{
	
	function __construct()
	{
		$this->load->helper('session');
        $this->load->library('parser');
        $this->load->model('register/mregister');
        $this->load->model('Madminsekolah');
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
	public function formAdminsekolah()
	{
		  if ($this->cekSession()) {
           $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
            $data['judul_halaman'] = "Register Admin Sekolah";
            $data['files'] = array(
                APPPATH . 'modules/adminsekolah/views/v-form-adminsekolah.php',
            );
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        }
	}

	//add pengawas
	public function saveAdminsekolah()
	{

        		// load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

		//syarat pengisian form regitrasi guru
        $this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'trim|required|min_length[6]|max_length[12]|is_unique[tb_pengguna.namaPengguna]');
        // $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
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
            $this->formAdminsekolah();
        } else {
            //data pengawass
            $nama = htmlspecialchars($this->input->post('nama'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            // $noKontak = htmlspecialchars($this->input->post('nokontak'));

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

            $sekolah = htmlspecialchars($this->input->post('sekolah'));
            //melempar data guru ke function insert_pengguna di kelas model
            $data['mregister'] = $this->mregister->insert_pengguna($data_akun);
            //untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel pengawas
            $data['tb_pengguna'] = $this->mregister->get_idPengguna($namaPengguna)[0];
            $penggunaID = $data['tb_pengguna']['id'];

            //data array guru
            $data_pengawas = array(
                'sekolahID' => $sekolah,
               	'penggunaID' => $penggunaID,
               	'uuid' => uniqid(),
            );

            //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->Madminsekolah->insert_pengawas($data_pengawas);
            redirect(base_url('adminsekolah/listAdminsekolah'));
        }
	}

	public function listAdminsekolah($value='')
	{
	    $data['judul_halaman'] = "Daftar Admin Sekolah";
	    $data['files'] = array(
	        APPPATH . 'modules/adminsekolah/views/v-daftar-adminsekolah.php',
	        );
	    $this->parser->parse('admin/v-index-admin',$data);

	}
	public function ajax_listadminsekolah()
	{
        $list = $this->load->Madminsekolah->get_allPengawas();
        $data = array();
        $baseurl = base_url();
        $no=1;
        foreach ( $list as $list_adminsekolah) {
            
            $row = array();
            $row[] = $no;
            $row[] = $list_adminsekolah['namaPengguna'];
            $row[] = $list_adminsekolah['namaSekolah'];
            $row[] = $list_adminsekolah['email'];

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropAdminsekolah('."'".$list_adminsekolah['uuid']."'".')"><i class="ico-remove"></i></a>
             <a class="btn btn-sm btn-danger"  title="Reset Password" onclick="resetPassword('."'".$list_adminsekolah['penggunaID']."'".')"><i class="ico-key"></i></a>
            <a href="ubahadminsekolah/'.$list_adminsekolah["uuid"].'" class="btn btn-sm btn-warning"  title="Ubah" ><i class="ico-file"></i></a>';

            $data[] = $row;
            $no++;

        }
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
	}

	public function ubahadminsekolah($uuid)
	{
		$data['oldData']=$this->Madminsekolah->get_adminsekolah_by_uuid($uuid);
		
		if ($this->cekSession()) {
           $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
            $data['judul_halaman'] = "Ubah Pengawas";
            $data['files'] = array(
                APPPATH . 'modules/adminsekolah/views/v-ubah-pengawas.php',
            );
            // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        }
	}

	public function editAdminsekolah($value='')
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
            $sekolah = htmlspecialchars($this->input->post('sekolah'));
            // var_dump($uuid);
            // $email = htmlspecialchars($this->input->post('email'));
            //data array akun

            //melempar data guru ke function insert_pengguna di kelas model
            // $data['mregister'] = $this->Mpengawas->ubah_email($email,$uuid);
            //untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel pengawas

            //data array guru
            $data_adminsekolah = array(
                'sekolahID' => $sekolah,

            );

            //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->Madminsekolah->ubah_adminsekolah($data_adminsekolah,$uuid);
            redirect(base_url('adminsekolah/listAdminsekolah'));
        // }
	}

	public function deleteAdminsekolah()
	{
          if ($this->input->post()) {
            $post = $this->input->post();
             $this->Madminsekolah->del_adminsekolah($post['uuid']);
        }
	}

    public function resetPassword()
    {
      if ($this->input->post()) {
            $post = $this->input->post();
            $nama = $this->Madminsekolah->get_namaPengguna($post['penggunaID']);
            $kataSandi = md5($nama );
            $this->Madminsekolah->reset_password($kataSandi,$post['penggunaID']);
        }
    }

    public function getsekolah() {
  $data = $this->output
  ->set_content_type( "application/json" )
  ->set_output( json_encode( $this->Madminsekolah->scsekolah() ) ) ;
}

function ambil_data(){
      //fungsi ambil data unruk dropdown
        $modul=$this->input->post('modul');
        $id=$this->input->post('id');

        if($modul=="getbab"){
        echo $this->Modelbank->getbab($id);
    }
    }



}
 ?>