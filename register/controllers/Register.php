<?php



class Register extends MX_Controller {



//put your code here

    public function __construct() {

        parent::__construct();

        $this->load->library('parser');

        $this->load->model('mregister');
        $this->load->model('cabang/mcabang');


        $this->load->model('siswa/msiswa');

        $this->load->model('Templating/mtemplating');
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



// function untuk menampikan halam pertama saat registrasi

    public function index() {


        $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
        $data['cabang'] = $this->mcabang->get_all_cabang();

        $data = array(

            'judul_halaman' => 'Registrasi - Neon',

            'judul_header' => 'Welcome'

        );



        $data['files'] = array(

            APPPATH . 'modules/templating/views/v-navbarregister.php',

            APPPATH . 'modules/register/views/vRegisterSiswa.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );
    $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
        $data['cabang'] = $this->mcabang->get_all_cabang();


        $this->parser->parse('templating/index', $data);


    }



// function untuk menampilkan halaman untuk pendaftaran user siswa

    public function registersiswa() {

        $data['mataPelajaran'] = $this->mregister->get_matapelajaran();

        $data = array(

            'judul_halaman' => 'Registrasi - Neon',

            'judul_header' => 'Welcome'

        );



        $data['files'] = array(

            APPPATH . 'modules/templating/views/v-navbarregister.php',

            APPPATH . 'modules/register/views/vRegisterSiswa.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );



        $this->parser->parse('templating/index', $data);

    }



//function untuk menampilkan halaman pendaftaran Guru

    public function registerguru() {

        if ($this->cekSession()) {

            $data['mataPelajaran'] = $this->mregister->get_matapelajaran();

            $data['judul_halaman'] = "Register Guru";

            $data['files'] = array(

                APPPATH . 'modules/register/views/vRegisterGuru.php',

            );

            // jika admin

            $this->parser->parse('admin/v-index-admin', $data);

        }

    }



    public function verifikasiemail() {

        $this->load->view('vVerifikasi');

    }



//function untuk menyimpan data pendaftaran user siswa ke database

    public function savesiswa() {

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

            $this->index();

        } else {



//data siswa

            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));
            $noIndukNeutron = htmlspecialchars($this->input->post('noinduk'));
            $cabangID = htmlspecialchars($this->input->post('cabang'));


            if ($cabangID=="") {
                 $noIndukNeutron = NULL;
                 $cabangID = NULL;
            } 
            




            $tingkatID = htmlspecialchars($this->input->post('tingkatID'));

            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));

            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));



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

            $this->session->set_userdata($id_arr);



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
                'noIndukNeutron'=>$noIndukNeutron,
                'cabangID'=>$cabangID

            );

//data unutk session siswa

            $sess_array = array(

                'id' => $penggunaID,

                'USERNAME' => $namaPengguna,

                'HAKAKSES' => $hakAkses,

                'eMail' => $email,

                'tingkatID' => $tingkatID

            );

//melempar data guru ke function insert_guru di kelas model

            $data['mregister'] = $this->mregister->insert_siswa($data_siswa, $sess_array);

            redirect(site_url('register/verifikasi'));

        }

    }



    //function untuk menyimpan data pendaftaran user siswa ke database

    public function savesiswaadmin() {

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

            redirect(base_url('siswa/daftarsiswa'));

//            echo "berisik kamu";

        } else {



//data siswa

//            $namaDepan = htmlspecialchars($this->input->post('namadepan'));

//            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));

//            $alamat = htmlspecialchars($this->input->post('alamat'));

//            $noKontak = htmlspecialchars($this->input->post('nokontak'));

//

//

//            $tingkatID = htmlspecialchars($this->input->post('tingkatID'));

//            $namaSekolah = htmlspecialchars($this->input->post('namasekolah'));

//            $alamatSekolah = htmlspecialchars($this->input->post('alamatsekolah'));

//

////data akun

//            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));

//            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));

//            $email = htmlspecialchars($this->input->post('email'));

//            $hakAkses = 'siswa';

//

////data array akun

//            $data_akun = array(

//                'namaPengguna' => $namaPengguna,

//                'kataSandi' => $kataSandi,

//                'eMail' => $email,

//                'hakAkses' => $hakAkses,

//            );

//

//

////melempar data guru ke function insert_pengguna di kelas model

//            $data['mregister'] = $this->mregister->insert_pengguna($data_akun);

////untuk mengambil nilai id pengguna untuk di jadikan FK pada tabel siswa

//            $data['tb_pengguna'] = $this->mregister->get_idPengguna($namaPengguna)[0];

//

//            $penggunaID = $data['tb_pengguna']['id'];

//

////session buat id

//            $id_arr = array('id' => $penggunaID);

//            $this->session->set_userdata($id_arr);

//

////data array siswa

//            $data_siswa = array(

//                'namaDepan' => $namaDepan,

//                'namaBelakang' => $namaBelakang,

//                'alamat' => $alamat,

//                'noKontak' => $noKontak,

//                'namaSekolah' => $namaSekolah,

//                'alamatSekolah' => $alamatSekolah,

//                'penggunaID' => $penggunaID,

//                'tingkatID' => $tingkatID,

//            );

////data unutk session siswa

//            $sess_array = array(

//                'id' => $penggunaID,

//                'USERNAME' => $namaPengguna,

//                'HAKAKSES' => $hakAkses,

//                'eMail' => $email,

//                'tingkatID' => $tingkatID

//            );

////melempar data guru ke function insert_guru di kelas model

//            $data['mregister'] = $this->mregister->insert_siswa($data_siswa, $sess_array);

        }

    }



// function untuk menampung data dari form kemudian di lempar 

// ke function insert_guru dan insert_pengguna di kelas model Mregister

    public function saveguru() {

    // load library n helper

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');


        //syarat pengisian form regitrasi guru

        $this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'trim|required|min_length[6]|max_length[12]|is_unique[tb_pengguna.namaPengguna]');

        $this->form_validation->set_rules('namadepan', 'Nama Depan', 'required');

        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        $this->form_validation->set_rules('nokontak', 'No Kontak', 'required');

        $this->form_validation->set_rules('katasandi', 'Kata Sandi', 'required|min_length[6]|matches[passconf]');

        $this->form_validation->set_rules('mataPelajaran', 'mataPelajaran', 'required');

        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_pengguna.email]');


    // //pesan error atau pesan kesalahan pengisian form registrasi guru

        $this->form_validation->set_message('namapengguna', 'is_unique', '*Nama Pengguna sudah terpakai');

        $this->form_validation->set_message('is_unique', 'email', '*Email sudah terpakai');

        $this->form_validation->set_message('is_unique', '*Nama Pengguna sudah terpakai');

        $this->form_validation->set_message('max_length', '*Nama Pengguna maksimal 12 karakter!');

        $this->form_validation->set_message('min_length', '*Inputan minimal 6 karakter!');

        $this->form_validation->set_message('required', '*tidak boleh kosong!');

        $this->form_validation->set_message('matches', '*Kata Sandi tidak sama!');


        if ($this->form_validation->run() == FALSE) {

            $this->registerguru();

        } else {

            //data guru

            $namaDepan = htmlspecialchars($this->input->post('namadepan'));

            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));

            $mataPelajaranID = htmlspecialchars($this->input->post('mataPelajaran'));

            $alamat = htmlspecialchars($this->input->post('alamat'));

            $noKontak = htmlspecialchars($this->input->post('nokontak'));



            //data untuk akun

            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));

            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));

            $email = htmlspecialchars($this->input->post('email'));

            $hakAkses = 'guru';



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



            //data array guru

            $data_guru = array(

                'namaDepan' => $namaDepan,

                'namaBelakang' => $namaBelakang,

                'alamat' => $alamat,

                'noKontak' => $noKontak,

                'mataPelajaranID' => $mataPelajaranID,

                'penggunaID' => $penggunaID,

            );



            //melempar data guru ke function insert_guru di kelas model

            $data['mregister'] = $this->mregister->insert_guru($data_guru);

            redirect(base_url('guru/daftar'));

            

        }

    }



    public function verifikasi_email($address, $code) {

        $this->load->model('login/Mlogin');

        $code = trim($code);

        $this->mregister->verifikasi_email($address, $code);



        if ($result = $this->mregister->cekUser($address)) {

//variabelSession

            $sess_array = array();

            foreach ($result as $row) {



                $hakAkses = $row->hakAkses;

//membuat session

                $sess_array = array(

                    'id' => $row->id,

                    'USERNAME' => $row->namaPengguna,

                    'HAKAKSES' => $row->hakAkses,

                    'AKTIVASI' => $row->aktivasi

                );

                $this->session->set_userdata($sess_array);



                if ($hakAkses == 'admin') {

                    redirect(base_url('index.php/admin'));

                } elseif ($hakAkses == 'guru') {

                    $guru = $this->Mlogin->cekGuru($this->session->userdata['id']);

                    foreach ($guru as $value) {

                        $this->session->set_userdata('id_guru', $value->id);

                    }

                    redirect(site_url('guru/dashboard/'));

                } elseif ($hakAkses == 'siswa') {

                    redirect(site_url('welcome'));

                } else {

                    redirect(site_url(''));

                }

            }

            return TRUE;

        } else {

            redirect(site_url(''));

            return FALSE;

        }

    }



//halam untulk memnberitahu link aktivassi ke email atau untuk meresen email

    public function verifikasi() {

        //        $this->load->view('templating/t-header');

        //        $this->load->view('vVerifikasi.php');

        //        $this->load->view('templating/t-footer');



        $data = array(

            'judul_halaman' => 'Verifikasi Email - Neon',

            'judul_header' => 'Welcome'

        );



        $data['files'] = array(

            APPPATH . 'modules/templating/views/v-navbarregister.php',

            APPPATH . 'modules/register/views/vVerifikasi.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );



        $this->parser->parse('templating/index', $data);

    }



//function untuk mengirim urang aktivasi ke email

    public function resend_mail() {

        echo "masuk resen"; //for testing

        $this->mregister->send_verifikasi_email();

        redirect(site_url('register/verifikasi'));

    }



    //function untuk mengganti email aktivasi akun

    public function ch_mail_aktivasi() {

        //load library n helper

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        //set rule untuk inputan email agar email yg dinputkan uniq

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_pengguna.email]');

        //set pesan untuk inputan kesalahan email telah digunkan

        $this->form_validation->set_message('is_unique', '*Email sudah terpakai');





        if ($this->form_validation->run() == FALSE) {

//            $this->load->view('templating/t-header');

//            $this->load->view('vVerifikasi.php');

//            $this->load->view('templating/t-footer');

            $this->verifikasi();

        } else {

            $email = htmlspecialchars($this->input->post('email'));

            $this->mregister->update_email_ak($email);

            $this->mregister->send_verifikasi_email();

            redirect(site_url('register/verifikasi'));

        }

    }



    public function lupaPassword() {

        $data = array(

            'judul_halaman' => 'Lupa Password - Neon'

        );



        $data['files'] = array(

            APPPATH . 'modules/templating/views/v-navbarlogin.php',
            // APPPATH . 'modules/homepage/views/v-header.php',

            APPPATH . 'modules/register/views/vLupapassword.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );



        $this->parser->parse('templating/index', $data);

    }



    public function resetpassword() {

        if (!empty($this->session->userdata['reset_email']) && $this->session->userdata['reset_password'] == '1') {



            $data = array(

                'judul_halaman' => 'Reset Password - Neon'

            );



            $data['files'] = array(

                APPPATH . 'modules/templating/views/v-navbarlogin.php',
                // APPPATH . 'modules/homepage/views/v-header.php',

                APPPATH . 'modules/register/views/vResetPassword.php',

                APPPATH . 'modules/homepage/views/v-footer.php',

            );



            $this->parser->parse('templating/index', $data);

        } else {

            redirect(base_url('index.php/login'));

        }

    }



    //function untuk mengganti password akun

    public function ch_sent_reset() {

        //load library n helper

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');





        $email = htmlspecialchars($this->input->post('email'));



        if ($result = $this->mregister->cekUser($email)) {

            //variabelSession

            $this->mregister->send_reset_email($email);

            $this->session->set_flashdata('notif', ' Cek email mu, kode reset telah dikirim');

            redirect(base_url('index.php/register/lupapassword'));

            return TRUE;

        } else {

            $this->session->set_flashdata('notif', ' Akun dengan email yang dimasukan tidak ada');

            redirect(base_url('index.php/register/lupapassword'));

            return FALSE;

        }

    }



    public function verifikasiPassword($address, $code) {

        $this->mregister->verifikasi_password($address, $code);

    }



    public function resetdatapassword() {

        $newpassword = htmlspecialchars(md5($this->input->post('password')));

        $this->mregister->reset_katasandi($newpassword);

        $this->session->unset_userdata("reset_email");

        $this->session->unset_userdata('reset_password');

        $this->session->set_flashdata('notif', ' Kata sandi mu telah berhasil dirubah');

        redirect(base_url('index.php/login'));

    }

    public function test()
    {

            //data guru
            $namaDepan = htmlspecialchars($this->input->post('namadepan'));
            $namaBelakang = htmlspecialchars($this->input->post('namabelakang'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $noKontak = htmlspecialchars($this->input->post('nokontak'));

            //data untuk akun
            $namaPengguna = htmlspecialchars($this->input->post('namapengguna'));
            $kataSandi = htmlspecialchars(md5($this->input->post('katasandi')));
            $email = htmlspecialchars($this->input->post('email'));
            $hakAkses = 'guru';

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
            //data array guru
            $data_guru = array(
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'alamat' => $alamat,
                'noKontak' => $noKontak,
                'penggunaID' => $penggunaID,
            );
            //melempar data guru ke function insert_guru di kelas model
            $data['mregister'] = $this->mregister->insert_guru($data_guru);


            $guruID=$this->mregister->get_guruID_by_penggunaID($penggunaID);
            $sumMapel=htmlspecialchars($this->input->post('sumMapel'));

               for ($i=1; $i <= $sumMapel ; $i++) { 
                $datArr['mapelID']=$this->input->post('mapelIDke-'.$i);
                $datArr['guruID']=$guruID[0]['id'];
                $this->mregister->in_guruMapel($datArr);
            }

            redirect(base_url('guru/daftar'));
    }

}



?>