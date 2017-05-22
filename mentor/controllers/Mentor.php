<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends MX_Controller {

	function get_status_login(){
		$log_in = $this->session->userdata('loggedin');
		return $log_in;        
	}

	function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('siswa/msiswa');
		$this->load->helper('session');
		$this->load->library('pagination');

	}

	function index(){
		$data['judul_halaman'] = "Dashboard Admin - Mentor";

		$data['files'] = array(
			APPPATH . 'modules/admin/views/v-container.php',
			);
		$this->parser->parse('admin/v-index-admin', $data);
	}


    // create pagination siswa /*by MrBebek
	public function listSiswa()
	{
		if ($this->get_status_login()){     
       // code u/ pagination
			$this->load->database();
			$jumlah_data = $this->msiswa->jumlah_siswa();

			$config['base_url'] = base_url().'index.php/siswa/listSiswa/';
			$config['total_rows'] = $jumlah_data;
			$config['per_page'] = 10;

        // Start Customizing the “Digit” Link
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
        // end  Customizing the “Digit” Link

        // Start Customizing the “Current Page” Link
			$config['cur_tag_open'] = '<li><a><b>';
			$config['cur_tag_close'] = '</b></a></li>';
        // END Customizing the “Current Page” Link

        // Start Customizing the “Previous” Link
			$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
         // END Customizing the “Previous” Link

        // Start Customizing the “Next” Link
			$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
         // END Customizing the “Next” Link

        // Start Customizing the first_link Link
			$config['first_link'] = '<span aria-hidden="true">&larr; First</span>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
         // END Customizing the first_link Link

        // Start Customizing the last_link Link
			$config['last_link'] = '<span aria-hidden="true">Last &rarr;</span>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
         // END Customizing the last_link Link

			$from = $this->uri->segment(3);
			$this->pagination->initialize($config);     
			$list = $this->msiswa->data_siswa($config['per_page'],$from);

			$this->tampSiswa($list);
		}else{
			redirect('login');
		}

	}
    //untuk emanmpilkan  list siswa /*by MrBebek
	public function tampSiswa($list){
		if ($this->get_status_login()){     
			$data['judul_halaman'] = "Pengelolaan Data Siswa";
			$data['files'] = array(
				APPPATH . 'modules/mentor/views/v-list-siswa.php',
				);
			$data['siswa'] = array();
			$no = 0;
        //mengambil nilai list
			$baseurl = base_url();
			foreach ($list as $list_siswa) {
				$no++;
				$data['siswa'][] = array(
					'no'=> $no,
					'idsiswa'=> $list_siswa['idsiswa'],
					'nama'=> $list_siswa['namaDepan'] . " " . $list_siswa['namaBelakang'],
					'namaPengguna'=> $list_siswa['namaPengguna'],

					'namaSekolah'=> $list_siswa['namaSekolah'],
					'eMail'=>  $list_siswa['eMail'] ,
					'cabang'=> $list_siswa['namaCabang'],

					'report'=>'<a href="' . base_url('index.php/siswa/reportSiswa/' . $list_siswa['penggunaID']) . '" "> Lihat detail</a></i>',
					'aksi'=>'<a class="btn        btn-sm btn-warning"  title="Set Mentor" href="' . base_url('index.php/mentor/setmentor/' . $list_siswa['idsiswa']). '" "><i class="ico-user-plus3"></i></a>

					<a class="btn        btn-sm btn-success"  title="Lihat Mentor" href="' . base_url('index.php/mentor/setmentor/' . $list_siswa['idsiswa']). '" "><i class="ico-users2"></i></a>

					'

					);
			}
			$hakAkses=$this->session->userdata['HAKAKSES'];
			if ($hakAkses=='admin') {
				$this->parser->parse('admin/v-index-admin', $data);
			} elseif($hakAkses=='guru'){
             // jika guru
				$this->parser->parse('templating/index-b-guru', $data);
			}else{
            // jika siswa redirect ke welcome
				redirect(site_url('welcome'));
			}
		}else{
			redirect('login');
		}
	}

	function setmentor($id_siswa){
		if ($this->msiswa->get_siswa_by_id($id_siswa)==array()) {
			$data['judul_halaman'] = "Maaf Siswa Tidak Ditemukan";
		}else{
			$data['siswa'] = $this->msiswa->get_siswa_by_id($id_siswa)[0];
			$data['namaLengkap'] = $data['siswa']['namaDepan']." ".$data['siswa']['namaBelakang'];
			$data['judul_halaman'] = "Mentor Untuk : ".ucwords(strtolower($data['namaLengkap']));

		}
		$data['files'] = array(
			APPPATH . 'modules/mentor/views/v-set-mentor.php',
			);
		$this->parser->parse('admin/v-index-admin', $data);

	}
}