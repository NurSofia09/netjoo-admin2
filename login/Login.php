<?php

class Login extends MX_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model('Mlogin');
        $this->load->library('session');
        if ($this->session->userdata('loggedin')==true) {
            if ($this->session->userdata('HAKAKSES')=='siswa'){
               redirect('welcome');
            }else if($this->session->userdata('HAKAKSES')=='guru'){
               redirect('guru/dashboard');
            }else{

            }
    }
}

    public function index() {
        $data = array(
            'judul_halaman' => 'Login - Neon',
            'judul_header' => 'Welcome'
        );

        $data['files'] = array(
            APPPATH . 'modules/templating/views/v-navbarlogin.php',
            APPPATH . 'modules/login/views/vLogin.php',
            APPPATH . 'modules/homepage/views/v-footer.php',
        );
        
        $this->parser->parse('templating/index', $data);
    }

    //Fungsi untuk login, mengecek username dan password
    public function validasiLogin() {
        $username = htmlspecialchars($this->input->post('username'));
        $password = md5($this->input->post('password'));

        if ($result = $this->Mlogin->cekUser($username, $password)) {
            //variabelSession
            $sess_array = array();
            foreach ($result as $row) {

                $hakAkses = $row->hakAkses;
                //membuat session
                $verifikasiCode = md5($row->regTime);
                $sess_array = array(
                    'id' => $row->id,
                    'USERNAME' => $row->namaPengguna,
                    'HAKAKSES' => $row->hakAkses,
                    'AKTIVASI' => $row->aktivasi,
                    'eMail' => $row->eMail,
                    'verifikasiCode' => $verifikasiCode,
                    'loggedin' => TRUE,

                );
                $this->session->set_userdata($sess_array);
                // cometchat cookie
                setcookie("cc_userid", $row->id, time() + (86400 * 30), "/");

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
                } elseif ($hakAkses == 'user') {
//                   	redirect(site_url('welcome'));
                } else {
                    echo 'tidak ada hak akses';
                }
            }
            return TRUE;
        } else {
            $this->session->set_flashdata('notif', ' Username atau password salah');
            redirect(site_url('login'));
            return FALSE;
        }
    }



    public function konfirmasi() {
        $this->load->view('templating/t-header');
//        $this->load->view('templating/t-sessionKonfirm');
        $this->load->view('vKonfirmasi.php');
        $this->load->view('templating/t-footer');
    }

    public function facebookIdentity() {
        // Include the facebook api php libraries
        include_once APPPATH . "libraries/facebook-api-php-codexworld/facebook.php";

        // Facebook API Configuration
        $appId = '303600290003894';
        $appSecret = 'ac2f5e4c92821409ccc160928a5a70a6';
        $redirectUrl = base_url() . 'index.php/login';
        $fbPermissions = 'email';

        //Call Facebook API
        $facebook = new Facebook(array(
            'appId' => $appId,
            'secret' => $appSecret
        ));

        $fbuser = $facebook->getUser();
        if ($fbuser) {
            $userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];

            $userData['email'] = $userProfile['email'];
            $userData['aktivasi'] = '1';
            $userData['hakAkses'] = 'siswa';

            $siswaData['namaDepan'] = $userProfile['first_name'];
            $siswaData['namaBelakang'] = $userProfile['last_name'];
            $siswaData['photo'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $userID = $this->Mlogin->checkUserFb($userData, $siswaData);
            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
            } else {
                $data['userData'] = array();
            }
            $this->createSession($userData['email']);
        } else {
            $fbuser = '';
            $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri' => $redirectUrl, 'scope' => $fbPermissions));
        }
        $this->load->view('vLogin.php', $data);
    }

    public function createSession($userID) {
        if ($result = $this->Mlogin->cekUser3($userID)) {
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
//                    redirect(base_url('index.php/login/user'));
//                    echo 'admin';
//                    redirect(site_url('peserta-free'));
                } elseif ($hakAkses == 'guru') {
                    $guru = $this->Mlogin->cekGuru($this->session->userdata['id']);
                    foreach ($guru as $value) {
                        $this->session->set_userdata('id_guru', $value->id);
                    }
                    redirect(site_url('guru/dashboard/'));
                } elseif ($hakAkses == 'siswa') {
                    redirect(site_url('welcome'));
                } elseif ($hakAkses == 'user') {
//                   	redirect(site_url('welcome'));
                } else {
                    echo 'tidak ada hak akses';
                }
            }
            return TRUE;
        }
    }

}

?>