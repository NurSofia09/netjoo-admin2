<?php

/**
 *
 */
class Siswa extends MX_Controller {

    function get_status_login(){
        $log_in = $this->session->userdata('loggedin');
        return $log_in;        
    }

    public function __construct() {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->model('register/mregister');
        $this->load->model('cabang/mcabang');
        $this->load->model('tryout/mtryout');
        $this->load->model('learningline/learning_model');
        $this->load->model('konsultasi/mkonsultasi');
        
        $this->load->helper('session');
        $this->load->library('parser');
        $this->load->library('pagination');
    }

    

    public function profilesetting() {
        if ($this->get_status_login()) {
            $data = array(
                'judul_halaman' => 'Neon - Pengaturan Akun',
                'judul_header' =>'Pengaturan Akun',
                'judul_header2' =>'Pengaturan Akun'
                );

            $data['files'] = array( 
                APPPATH.'modules/homepage/views/v-header-login.php',
                APPPATH.'modules/siswa/views/headersiswa.php',
                APPPATH.'modules/siswa/views/vPengaturanProfile.php',
                APPPATH.'modules/testimoni/views/v-footer.php',
                );

            $data['siswa'] = $this->msiswa->get_datsiswa();
            $this->parser->parse( 'templating/index', $data );
        }else{
            redirect('login');
        }
    }

<<<<<<< HEAD
    public function index() {        
        if ($this->get_status_login()) {
            $data['siswa'] = $this->msiswa->get_datsiswa()[0];
            if ($data['siswa']['biografi']=="") {
                $bio = "ini masih malu-malu nyeritain tentang dirinya";
            }else{
                $bio = $data['siswa']['biografi'];
            }
            $data = array(
                'judul_halaman' => 'Neon - Dashboard Siswa',
                'judul_header' =>'Dashboard Siswa',
                'judul_header2' =>'Dashboard Siswa',
                'namaDepan' => $data['siswa']['namaDepan'],
                'namaBelakang' => $data['siswa']['namaBelakang'],
                'alamat' => $data['siswa']['alamat'],
                'noKontak' => $data['siswa']['noKontak'],
                'biografi' => $bio,
                'namaSekolah' => $data['siswa']['namaSekolah'],
                'alamatSekolah'  =>$data['siswa']['alamatSekolah'],
                'photo'=>base_url().'assets/image/photo/siswa/'.$data['siswa']['photo'],
                'sisa'=>$this->session->userdata('sisa'),
                'jumlah_paket' =>$this->mtryout->get_jumlah_report_paket(),
                'jumlah_latihan' =>count($this->mtryout->get_report_latihan()),
                'jumlah_line'=>count($this->learning_model->get_line_log_step_line_by_user())
                );

            $data['files'] = array( 
                APPPATH.'modules/siswa/views/t-profile-siswa.php',
                );

            $this->parser->parse( 'templating/index-d-siswa', $data );
        }else{
            redirect('login');
        }        
    }
=======
    $data['files'] = array( 
        APPPATH.'modules/siswa/views/t-profile-siswa.php',
        );

    $this->parser->parse( 'templating/index-d-siswa', $data );
}
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e

    //menampilkan halaman pengaturan profile
    public function PengaturanProfile() {
        if ($this->get_status_login()) {
         $data['tb_siswa'] = $this->msiswa->get_datsiswa();
         $this->load->view('templating/t-header');
         $this->load->view('templating/t-navbarUser');
         $this->load->view('vPengaturanProfile', $data);
         $this->load->view('templating/t-footer');
     }else{
        redirect('login');
    }   

}

public function ubahprofilesiswa() {
    if ($this->get_status_login()) {
        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //syarat pengisian form perubahan profile
        $this->form_validation->set_rules('namadepan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        
        //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('is_unique', '*Nama Pengguna sudah terpakai');
        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');
        $this->form_validation->set_message('min_length', '*Nama Pengguna minimal 5 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');

        if ($this->form_validation->run() == FALSE) {
            $this->profilesetting();
        } else {
            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));
            $biografi = htmlspecialchars($this->input->post('biografi'));
            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));
            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));

            $data_post = array(
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
                'biografi' => $biografi,
                'namaSekolah' => $namaSekolah,
                'alamatSekolah' => $alamatSekolah,
                );

            $this->session->set_flashdata('updsiswa', 'Data profilmu telah berubah');
            $this->msiswa->update_siswa($data_post);
            redirect(site_url('siswa/profilesetting'));
        }
    }else{
        redirect('login');
    }   

}

public function ubahemailsiswa() {
    if ($this->get_status_login()) {
          //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //syarat pengisian form perubahan nama pengguna dan email

        $this->form_validation->set_rules('email', 'email', 'required|is_unique[tb_pengguna.eMail]');

        //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('is_unique', '*Email sudah terpakai');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');


        if ($this->form_validation->run() == FALSE) {
         $this->profilesetting();
     } else {
        $email = htmlspecialchars($this->input->post('email'));

<<<<<<< HEAD
        $data_post = array(
            'eMail' => $email,
            );
        $this->session->set_flashdata('updsiswa', 'Emailmu telah berhasil dirubah');
        $this->msiswa->update_email($data_post);
    }
=======
 } else {
    $email = htmlspecialchars($this->input->post('email'));

    $data_post = array(
        'eMail' => $email,
        );
    $this->session->set_flashdata('updsiswa', 'Emailmu telah berhasil dirubah');
    $this->msiswa->update_email($data_post);
 redirect(site_url('siswa/profilesetting'));
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e

}else{
    redirect('login');
} 
}


public function ubahkatasandi() {
    if ($this->get_status_login()) {
    //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    //syarat pengisian form perubahan pasword
        $this->form_validation->set_rules('sandilama', 'Kata Sandi Lama', 'required');
        $this->form_validation->set_rules('newpass', 'Kata Sandi Baru', 'required|matches[verifypass]');
        $this->form_validation->set_rules('verifypass', 'Password Confirmation', 'required');

    //pesan error atau pesan kesalahan pengisian form
        $this->form_validation->set_message('required', '*tidak boleh kosong!');
        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');


<<<<<<< HEAD
        if ($this->form_validation->run() == FALSE) {
            $this->profilesetting();
        } else {
            $kataSandi = htmlspecialchars(md5($this->input->post('newpass')));
            $inputSandi = htmlspecialchars(md5($this->input->post('sandilama')));
            $data_post = array('kataSandi' => $kataSandi,);
            $data['pengguna'] = $this->msiswa->get_password()[0];
            $kataSandi = $data['pengguna']['kataSandi'];

            if ($kataSandi == $inputSandi) {
                $this->session->set_flashdata('updsiswa', 'Passwordmu telah berubah');
                $this->msiswa->update_katasandi($data_post);
            } else {
                $this->session->set_flashdata('updsiswa', 'Password gagal  dirubah, password lama salah');
                redirect(site_url('siswa/profilesetting'));
            }
        }
    }else{
        redirect('login');
    } 

=======
    if ($this->form_validation->run() == FALSE) {
            // $data['siswa'] = $this->msiswa->get_datsiswa();
            // $this->load->view('templating/t-header');
            // $this->load->view('templating/t-navbarUser');
            // $this->load->view('vPengaturanProfile', $data);
            // $this->load->view('templating/t-footer');
        $this->profilesetting();
    } else {
        $kataSandi = htmlspecialchars(md5($this->input->post('newpass')));
        $inputSandi = htmlspecialchars(md5($this->input->post('sandilama')));
        $data_post = array('kataSandi' => $kataSandi,);
        $data['pengguna'] = $this->msiswa->get_password()[0];
        $kataSandi = $data['pengguna']['kataSandi'];
            // var_dump($kataSandi);
        if ($kataSandi == $inputSandi) {
            $this->session->set_flashdata('updsiswa', 'Passwordmu telah berubah');
            $this->msiswa->update_katasandi($data_post);

        } else {
            $this->session->set_flashdata('updsiswa', 'Password gagal  dirubah, password lama salah');
            
        }
        redirect(site_url('siswa/profilesetting'));
    }
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e
}

public function upload($oldphoto) {
    if ($this->get_status_login()) {

        unlink(FCPATH . "./assets/image/photo/siswa/" . $oldphoto);
        $config['upload_path'] = './assets/image/photo/siswa';
        $config['allowed_types'] = 'jpeg|gif|jpg|png|mkv';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            $data['error'] = array('error' => $this->upload->display_errors());
            $this->profilesetting();
        } else {
            $file_data = $this->upload->data();
            $photo = $file_data['file_name'];
            $this->session->set_flashdata('updsiswa', 'Foto profilmu telah berubah');
            $this->msiswa->update_photo($photo);
        }

<<<<<<< HEAD
    }else{
        redirect('login');
=======
            // $this->load->view('beranda/main_view',$error);,
    } else {
        $file_data = $this->upload->data();
        $photo = $file_data['file_name'];
        $this->session->set_flashdata('updsiswa', 'Foto profilmu telah berubah');
        $this->msiswa->update_photo($photo);
         redirect(site_url('siswa/profilesetting'));
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e
    }

}

    ##menampilkan daftar siswa ajax

public function ajax_daftar_siswa() {
    $list = $this->msiswa->get_all_siswa();

    $data = array();
    $no = 0;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ($list as $list_siswa) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $list_siswa['idsiswa'];
        $row[] = $list_siswa['namaDepan'] . " " . $list_siswa['namaBelakang'];
        $row[] = $list_siswa['namaPengguna'];

        $row[] = $list_siswa['namaSekolah'];
        $row[] = '<a href=""  title="Mail To">' . $list_siswa['eMail'] . '</a> <i class="ico-mail-send"></i>';
        $row[] = '<a href="' . base_url('index.php/siswa/reportSiswa/' . $list_siswa['penggunaID']) . '" "> Lihat detail</a></i>';

        $row[] = '<a class="btn btn-sm btn-warning"  title="Edit" href="' . base_url('index.php/siswa/updateSiswa/' . $list_siswa['idsiswa'] . '/' . $list_siswa['penggunaID']) . '" "><i class="ico-edit"></i></a> 

        <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa(' . "" . $list_siswa['idsiswa'] . "," . $list_siswa['penggunaID'] . ')"><i class="ico-remove"></i></a>';

        $data[] = $row;
    }

    $output = array(
        "data" => $data,
        );
    echo json_encode($output);
}

    ##menampilkan siswa

public function daftar() {
    if ($this->get_status_login()) {
        $data['judul_halaman'] = "Pengelolaan Data Siswa";
        $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-daftar-siswa.php',
            );

        $this->parser->parse('admin/v-index-admin', $data);
    }else{
        redirect('login');
    }
}

public function daftarsiswa() {
    if ($this->get_status_login()) {
        $data['judul_halaman'] = "Pengelolaan Data Siswa";
        $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-form-siswa.php',
            );

        $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
        $data['cabang'] = $this->mcabang->get_all_cabang();

        $this->parser->parse('admin/v-index-admin', $data);
    }else{
        redirect('login');
    }
}

//function untuk menyimpan data pendaftaran user siswa ke database
public function savesiswa(){
    if ($this->get_status_login()){     
    //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    //syarat pengisian form regitrasi siswa
        $this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'trim|required|min_length[5]|max_length[12]|is_unique[tb_pengguna.namaPengguna]');
        $this->form_validation->set_rules('namadepan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');
        $this->form_validation->set_rules('katasandi', 'Kata Sandi', 'required|matches[passconf]|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_pengguna.email]');

    //pesan error atau pesan kesalahan pengisian form registrasi siswa
        $this->form_validation->set_message('is_unique', '*Nama Pengguna atau email sudah terpakai');
        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');
        $this->form_validation->set_message('min_length', '*Inputan minimal 6 karakter!');
        $this->form_validation->set_message('required', '*tidak boleh kosong!');
        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');
        $this->form_validation->set_message('valid_email', '*silahkan masukan alamat email anda dengan benar');

    //pengecekan pengisian form regitrasi siswa
        if ($this->form_validation->run() == FALSE) {
        //jika tidak memenuhi syarat akan menampilkan pesan error/kesalahan di halaman regitrasi siswa
            $this->daftarsiswa();
        } else {
        //data siswa
            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));


            $tingkatID = htmlspecialchars($this->input->post('tingkatID'));
            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));
            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));
            $cabangID = htmlspecialchars($this->input->post('cabang'));
            $noIndukNeutron = htmlspecialchars($this->input->post('noinduk'));

        //data akun
            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));
            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));
            $email = htmlspecialchars($this->input->post('email'));
            $hakAkses = 'siswa';

        //data array akun
            $data_akun = array(
                'namaPengguna' => $namaPengguna,
                'kataSandi' => $kataSandi,
                'eMail' => $email,
                'hakAkses' => $hakAkses,
                );


        //melempar data guru ke function insert_pengguna di kelas model
            $data['mregister'] = $this->mregister->insert_pengguna($data_akun);
        //untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel siswa
            $data['tb_pengguna'] = $this->mregister->get_idPengguna($namaPengguna)[0];

            $penggunaID = $data['tb_pengguna']['id'];

        //session buat id
            $id_arr = array('id' => $penggunaID);

        //data array siswa
            $data_siswa = array(
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
                'namaSekolah' => $namaSekolah,
                'alamatSekolah' => $alamatSekolah,
                'penggunaID' => $penggunaID,
                'tingkatID' => $tingkatID,
                'cabangID' => $cabangID,
                'noIndukNeutron' => $noIndukNeutron
                );

        //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->mregister->insert_siswabyadmin($data_siswa, $email, $namaPengguna);
            redirect(base_url('index.php/siswa/daftarsiswa'));
        }

    }else{
        redirect('login');
    }
}

public function deleteSiswa() {
    if ($this->get_status_login()){     

        $idsiswa = $this->input->post('idsiswa');
        $idpengguna = $this->input->post('idpengguna');
        $this->msiswa->hapus_siswa($idsiswa, $idpengguna);

    }else{
        redirect('login');
    }
}

    //tgl 30 Oktober
function updateSiswa($idsiswa, $idpengguna) {
<<<<<<< HEAD
    if ($this->get_status_login()){     
        if ($idsiswa == null || $idpengguna == 0) {
            echo 'kosong';
        } else {
         $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
         $data['cabang'] = $this->mcabang->get_all_cabang();
         $idsiswa = $idsiswa;
         $idpengguna = $idpengguna;

         $data['siswa'] = $this->msiswa->get_siswa_byid($idsiswa, $idpengguna);

         $data['judul_halaman'] = "Rubah Data Siswa";
         $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-update-siswa.php',
            );

         $this->parser->parse('admin/v-index-admin', $data);
     }
 }else{
    redirect('login');
}
=======
    if ($idsiswa == null || $idpengguna == 0) {
        echo 'kosong';
    } else {
     $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
     $data['cabang'] = $this->mcabang->get_all_cabang();
     $idsiswa = $idsiswa;
     $idpengguna = $idpengguna;
     $data['siswa'] = $this->msiswa->get_siswa_byid($idsiswa, $idpengguna);
     $data['judul_halaman'] = "Rubah Data Siswa";
     $data['files'] = array(
        APPPATH . 'modules/siswa/views/v-update-siswa.php',
        );
            // jika admin
     $this->parser->parse('admin/v-index-admin', $data);
 }
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e
}

//tgl 30 Oktober
function reportSiswa($idpengguna) {
    if ($this->get_status_login()){     
        if ($idpengguna == 0) {
        } else {
            $idpengguna = $idpengguna;
            $data['reportla'] = $this->msiswa->get_reportlatihan_siswa($idpengguna);
            $data['reportto'] = $this->msiswa->get_reporttryout_siswa($idpengguna);

            $data['judul_halaman'] = "Report Siswa";
            $data['files'] = array(
                APPPATH . 'modules/siswa/views/v-report-siswa.php',
                );
           // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        }
    }else{
        redirect('login');
    }    
}

    //tgl 30 Oktober
function reportto() {
    if ($this->get_status_login()){     
      $idto = $this->uri->segment(3);
      if (empty($idto)) {
        redirect('admin');
    } else {
        $idpengguna =  $this->uri->segment(4);
        $data['reportpaket'] = $this->msiswa->get_reportpaket_to($idpengguna,$idto);
        $data['ratarata'] = $this->msiswa->ratarata_to($idpengguna,$idto);

        $data['judul_halaman'] = "Report Siswa";
        $data['files'] = array(
            APPPATH . 'modules/siswa/views/v-report-paket.php',
            );
        // jika admin
        $this->parser->parse('admin/v-index-admin', $data);
    }

}else{
    redirect('login');
}
}

    ##menampilkan daftar siswa ajax

public function ajax_daftar_latihan() {
    if ($this->get_status_login()){     
        $list = $this->msiswa->get_all_siswa();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_siswa['idsiswa'];
            $row[] = $list_siswa['namaDepan'] . " " . $list_siswa['namaBelakang'];
            $row[] = $list_siswa['namaPengguna'];

            $row[] = $list_siswa['namaSekolah'];
            $row[] = '<a href=""  title="Mail To">' . $list_siswa['eMail'] . '</a> <i class="ico-mail-send"></i>';
            $row[] = '<a href="' . base_url('index.php/siswa/reportSiswa/' . $list_siswa['penggunaID']) . '" "> Lihat detail</a></i>';

            $row[] = '<a class="btn btn-sm btn-warning"  title="Edit" href="' . base_url('index.php/siswa/updateSiswa/' . $list_siswa['idsiswa'] . '/' . $list_siswa['penggunaID']) . '" "><i class="ico-edit"></i></a> 

            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa(' . "" . $list_siswa['idsiswa'] . "," . $list_siswa['penggunaID'] . ')"><i class="ico-remove"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
            );
        echo json_encode($output);
    }else{
        redirect('login');
    }

    
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
public function tampSiswa($list)
{
    $data['judul_halaman'] = "Pengelolaan Data Siswa";
    $data['files'] = array(
        APPPATH . 'modules/siswa/views/v-list-siswa.php',
        );
    $data['siswa'] = array();
    $no = 0;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ($list as $list_siswa) {
        $no++;
        $data['siswa'][] = array(
          'no'=> $no,
          'nama'=> $list_siswa['namaDepan'] . " " . $list_siswa['namaBelakang'],
          'namaPengguna'=> $list_siswa['namaPengguna'],

          'namaSekolah'=> $list_siswa['namaSekolah'],
          'eMail'=>  $list_siswa['eMail'] ,
          'cabang'=> $list_siswa['namaCabang'],
          'report'=>'<a href="' . base_url('index.php/siswa/reportSiswa/' . $list_siswa['penggunaID']) . '" "> Lihat detail</a></i>',
          'aksi'=>'<a class="btn btn-sm btn-warning"  title="Edit" href="' . base_url('index.php/siswa/updateSiswa/' . $list_siswa['idsiswa'] . '/' . $list_siswa['penggunaID']) . '" "><i class="ico-edit"></i></a> 

          <a class="btn btn-sm btn-danger"  title="Reset Pasword" title="Hapus" onclick="resetPassword(' . "" . $list_siswa['penggunaID'] . ')"><i class="ico-key"></i></a>
          <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa(' . "" . $list_siswa['idsiswa'] . "," . $list_siswa['penggunaID'] . ')"><i class="ico-remove"></i></a>'
          ,
          // 'penggunaID'=> $list_siswa['penggunaID']

          );
    }
          #START cek hakakses#
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
        #END Cek USer#

}

  //search autocomplete soal berdasarkan judul soal
public function autocompleteSiswa()
{
 $keyword = $_GET['term'];

     // cari di database
 $data = $this->msiswa->get_cari_siswa($keyword); 
    // format keluaran di dalam array
 $arr = array();
 foreach($data as $row)
 {
     $arr[] = array(
        'value' =>$row['namaDepan'].$row['namaBelakang']." (".$row['namaPengguna']." )",
        'url'=>base_url('siswa/reportSiswa')."/".$row['penggunaID'],
        );
 }
        // minimal PHP 5.2
 echo json_encode($arr);
}

function ajax_report_tryout(){
    $datas = $this->mtryout->get_report_paket();
    // var_dump($datas);

    $list = array();
    $no = 0;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ($datas as $list_item) {
        $no++;
        $row = array();
        $sumBenar=$list_item ['jmlh_benar'];
        $sumSalah=$list_item ['jmlh_salah'];
        $sumKosong=$list_item ['jmlh_kosong'];
            //hitung jumlah soal
        $jumlahSoal=$sumBenar+$sumSalah+$sumKosong;

        $nilai=0;
            // cek jika pembagi 0
        if ($jumlahSoal != 0) {
                //hitung nilai
            $nilai=$sumBenar/$jumlahSoal*100;
        }
        $row[] = $no;
        $row[] = $list_item['nm_paket'];
        $row[] = $list_item['jumlah_soal'];
        $row[] = $list_item['jmlh_benar'];
        $row[] = $list_item['jmlh_salah'];
        $row[] = $list_item['jmlh_kosong'];
        $row[] = $jumlahSoal;
        $row[] = $list_item['tgl_pengerjaan'];

        $array = array("id_tryout"=>$list_item['id_tryout'],
            "id_mm_tryout_paket"=>$list_item['id_mm-tryout-paket'],
            "id_paket"=>$list_item['id_mm-tryout-paket']);

        $row[] ='<a class="btn btn-sm btn-success  modal-on'.$list_item['id_paket'].'" 
        data-todo='.htmlspecialchars(json_encode($array)).' 

        title="Lihat Pembahasan" onclick="pembahasanto('."'".$list_item['id_paket']."'".')"><i class="ico-book"></i></a>';

        $list[] = $row;   

    }

    $output = array(
        "data" => $list,
        );
    echo json_encode($output);

}

function ajax_get_report_latihan(){
    $datas = $this->mtryout->get_report_latihan();
    // print_r($datas);

    $list = array();
    $no = 0;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ($datas as $list_item) {
        $no++;
        $row = array();

        $row[] = $no;
        $row[] = $list_item['nm_latihan'];
        $row[] = $list_item['jumlahSoal'];
        $row[] = $list_item['jmlh_benar'];
        $row[] = $list_item['jmlh_salah'];
        $row[] = $list_item['jmlh_kosong'];
        $row[] = $list_item['skore'];
        $row[] = $list_item['tgl_pengerjaan'];


        $list[] = $row;   

    }

    $output = array(
        "data" => $list,
        );
    echo json_encode($output);

}

// edit data siswa by admin
public function editSiswa()
{
    //data siswa
<<<<<<< HEAD
    $namaDepan = htmlspecialchars($this->input->post('namadepan'));
    $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
    $alamat = htmlspecialchars($this->input->post('alamat'));
    $noKontak = htmlspecialchars($this->input->post('nokontak'));

=======
        $namaDepan = htmlspecialchars($this->input->post('namadepan'));
        $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $noKontak = htmlspecialchars($this->input->post('nokontak'));
        $idsiswa=htmlspecialchars($this->input->post('idsiswa'));
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e

    $tingkatID = htmlspecialchars($this->input->post('tingkatID'));
    $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));
    $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));
    $cabangID = htmlspecialchars($this->input->post('cabang'));
    $noIndukNeutron = htmlspecialchars($this->input->post('noinduk'));

    //data array siswa
<<<<<<< HEAD
    $data_post = array(
        'namaDepan' => $namaDepan,
        'namaBelakang' => $namaBelakang,
        'alamat' => $alamat,
        'noKontak' => $noKontak,
        'namaSekolah' => $namaSekolah,
        'alamatSekolah' => $alamatSekolah,
        'tingkatID' => $tingkatID,
        'cabangID' => $cabangID,
        'noIndukNeutron' => $noIndukNeutron
        );
    $this->msiswa->update_siswa($data_post);

=======
        $data = array(
            'namaDepan' => $namaDepan,
            'namaBelakang' => $namaBelakang,
            'alamat' => $alamat,
            'noKontak' => $noKontak,
            'namaSekolah' => $namaSekolah,
            'alamatSekolah' => $alamatSekolah,
            'tingkatID' => $tingkatID,
            'cabangID' => $cabangID,
            'noIndukNeutron' => $noIndukNeutron
            );
         $this->msiswa->update_siswa1($data,$idsiswa);

         redirect(site_url('siswa/listSiswa'));
         
>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e
}

function ajax_daftar_konsultasi(){
    $datas = $this->mkonsultasi->get_konsultasi_by_siswa();

    $list = array();
    $no = 0;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ($datas as $list_item) {
        $no++;
        $row = array();

        $row[] = $no;
        $row[] = $list_item['judulPertanyaan'];
        $row[] = $list_item['isiPertanyaan'];
        $row[] = $list_item['date_created'];
        
        $row[] ='<a class="btn btn-sm btn-success latihan-'.$list_item['id'].'"  
        title="Lihat Konsultasi" 
        href='.base_url()."konsultasi/singlekonsultasi/".$list_item['id'].'
        "><i class="ico-search"></i></a>';


        $list[] = $row;   

    }

    $output = array(
        "data" => $list,
        );
    echo json_encode($output);

}

<<<<<<< HEAD
function async_persentase_learning(){
    $datas = $this->msiswa->persentasi();

    $list = array();
    $no = 0;

    $baseurl = base_url();
    foreach ($datas as $list_item) {
        $no++;
        $row = array();

        $row[] = $no;
        $row[] = $list_item['namaTopik'];
        $step = $list_item['stepDone']*10;
        $row[] = "<div class='progress' title='Progress :". $step. "%'>
        <div class='progress-bar progress-bar-success' style='width: ". $step."%'>
            <span class='sr-only'>10% Complete (success)</span>
        </div>
    </div>";

    $list[] = $row;   

}

$output = array(
    "data" => $list,
    );
echo json_encode($output);
}

function test(){
    var_dump($this->session->userdata());
}
=======
//reset pasword
public function resetPassword()
{
    $mydate=getdate(date("U"));
// echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
    $idpengguna = $this->input->post('idpengguna');
    $namaPengguna = $this->msiswa->get_namaPengguna($idpengguna)[0]['namaPengguna'];
    $katasandi =md5($namaPengguna.$mydate["mday"]);
    $data = array('kataSandi' => $katasandi);
    $this->msiswa->update_katasandi2($data,$idpengguna);
}

>>>>>>> 4e7c433a4c4d680d84ea7d5aba555cdeb1687e8e
}
?>
