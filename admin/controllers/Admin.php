<?php

class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('video/mvideos');
        $this->load->model('matapelajaran/mmatapelajaran');
        $this->load->model('banksoal/mbanksoal');
        $this->load->model('Templating/mtemplating');
        $this->load->model('madmin');
        $this->load->library('parser');
            $this->load->library('sessionchecker');
         $this->sessionchecker->checkloggedin();
    }

    public function get_avatar_ajax(){
        $avatar = base_url()."assets/image/photo/admin/".$this->madmin->get_avatar_admin();
        echo "<img src=".$avatar." class='img-circle' alt='' />";
    }


    public function index() {
        $data['judul_halaman'] = "Dashboard Admin";

        $data['files'] = array(
            APPPATH . 'modules/admin/views/v-container.php',
            );

        $hakAkses = $this->session->userdata['HAKAKSES'];

        if ($hakAkses == 'admin') {
            // jika admin
            $this->parser->parse('v-index-admin', $data);
        } elseif ($hakAkses == 'guru') {
            // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            redirect(site_url('welcome'));
        } else {
            // jika siswa redirect ke homepage
            redirect(site_url('login'));
        }

    }



    function daftarvideo() {
        $data['videos'] = $this->mvideos->get_all_videos_admin();
        $this->load->view('templating/t-header');
        $this->load->view('v-left-bar-admin');
        $this->load->view('v-daftar-video', $data);
    }


    function loadcontainer() {
        return $this->load->view('v-container');
    }



    function daftarmatapelajaran() {
        $data['judul_halaman'] = "Dashboard Admin";
        $data['files'] = array(
            APPPATH . 'modules/admin/views/v-daftar-mapel.php',
            );
        $data['mapels'] = $this->mmatapelajaran->daftarMapel();

        $hakAkses = $this->session->userdata['HAKAKSES'];
        if ($hakAkses == 'admin') {
        // jika admin
            $this->parser->parse('v-index-admin', $data);
        } elseif ($hakAkses == 'guru') {
        // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke siswa
            redirect(site_url('welcome'));
        } else {
            //jika belum login
            redirect(site_url('login'));
        }

    }


    function tambahMP() {
        $data['namaMataPelajaran'] = htmlspecialchars($this->input->post('namaMP'));
        $data['aliasMataPelajaran'] = htmlspecialchars($this->input->post('aliasMP'));
        $this->mmatapelajaran->tambahMP($data);
        redirect(base_url('index.php/admin/daftarmatapelajaran'));
    }



    function hapusMP() {
        $id = $this->input->post('idMP');
        $this->mmatapelajaran->hapusMP($id);
        redirect(base_url('index.php/admin/daftarmatapelajaran'));
    }



    function rubahMP() {
        $id = $this->input->post('idMP');
        $data['namaMataPelajaran'] = htmlspecialchars($this->input->post('namaMP'));
        $data['aliasMataPelajaran'] = htmlspecialchars($this->input->post('aliasMP'));
        $this->mmatapelajaran->rubahMP($id, $data);
        redirect(base_url('index.php/admin/daftarmatapelajaran'));
    }



    function daftartingkatpelajaran() {
        $data['judul_halaman'] = "Tingkat Mata Pelajaran";

        $data['files'] = array(
            APPPATH . 'modules/admin/views/v-daftar-tingkat.php',
            );



        $data['mapels'] = $this->mmatapelajaran->daftarMapel();
        $data['mapelsd'] = $this->madmin->daftarMapelbyTingkat($tingkatID='1');
        $data['mapelsmp'] = $this->madmin->daftarMapelbyTingkat($tingkatI='2');
        $data['mapelsma'] = $this->madmin->daftarMapelbyTingkat($tingkatI='3');
        $data['mapelsmaipa'] = $this->madmin->daftarMapelbyTingkat($tingkatI='4');
        $data['mapelsmaips'] = $this->madmin->daftarMapelbyTingkat($tingkatI='5');

        $hakAkses = $this->session->userdata['HAKAKSES'];


        if ($hakAkses == 'admin') {
        // jika admin
            $this->parser->parse('v-index-admin', $data);
        } elseif ($hakAkses == 'guru') {
            // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke welcome
           redirect(site_url('welcome'));
       } else {
           redirect(site_url('login'));
       }
   }



   function tambahtingkatMP() {
    $data['tingkatID'] = htmlspecialchars($this->input->post('idTingkatMP'));
    $data['mataPelajaranID'] = htmlspecialchars($this->input->post('idMP'));
    $data['keterangan'] = htmlspecialchars($this->input->post('keterangan'));


    $this->mmatapelajaran->tambahtingkatMP($data);
    redirect(base_url('index.php/admin/daftartingkatpelajaran'));
}



function hapustingkatMP() {
    $id = $this->input->post('tingkatMP');
    $this->mmatapelajaran->hapustingkatMP($id);
    redirect(base_url('index.php/admin/daftartingkatpelajaran'));
}



function rubahtingkatMP() {
    $id = $this->input->post('idtingkatMP');
    $data['keterangan'] = htmlspecialchars($this->input->post('keterangan'));
    $data['tingkatID'] = htmlspecialchars($this->input->post('tingkatMP'));
    $data['mataPelajaranID'] = htmlspecialchars($this->input->post('idMP'));
    $this->mmatapelajaran->rubahtingkatMP($id, $data);

    redirect(base_url('index.php/admin/daftartingkatpelajaran'));
}



function daftarbab() {
    $data['judul_halaman'] = "BAB Mata Pelajaran";
    $data['files'] = array(
        APPPATH . 'modules/admin/views/v-bab.php',
        );

    $id = $this->uri->segment(4);
    $data['babs'] = $this->mmatapelajaran->daftarBab($id);
    $data['file'] = 'v-bab.php';

    $this->parser->parse('v-index-admin', $data);
}



function tambahbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));
    $data['judulBab'] = htmlspecialchars($this->input->post('judulBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('deskbab'));

    $this->mmatapelajaran->tambahbabMP($data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}



function rubahbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $id = htmlspecialchars($this->input->post('idrubah'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));
    $data['judulBab'] = htmlspecialchars($this->input->post('judulBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('deskbab'));



    $this->mmatapelajaran->rubahbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}



function hapusbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $id = htmlspecialchars($this->input->post('id'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));

    $this->mmatapelajaran->hapusbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}

function daftarsubbab() {
    $data['judul_halaman'] = "SUB BAB Mata Pelajaran";

    $data['files'] = array(
        APPPATH . 'modules/admin/views/v-subbab.php',
        );

    $id = $this->uri->segment(5);
    $data['babs'] = $this->mmatapelajaran->daftarsubBab($id);

    $this->parser->parse('v-index-admin', $data);

}

function tambahsubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $data['judulsubBab'] = htmlspecialchars($this->input->post('judulsubBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('desksubbab'));

    $this->mmatapelajaran->tambahsubbabMP($data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}



function rubahsubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $id = htmlspecialchars($this->input->post('idsubBab'));

    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $data['judulsubBab'] = htmlspecialchars($this->input->post('judulsubBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('desksubBab'));

    $this->mmatapelajaran->rubahsubbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}



function hapussubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $id = htmlspecialchars($this->input->post('idsubBab'));

    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $this->mmatapelajaran->hapussubbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}

}

?>