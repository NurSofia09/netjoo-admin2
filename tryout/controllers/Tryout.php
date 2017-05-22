<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tryout extends MX_Controller {

    public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
        
        $this->load->library('parser');
        $this->load->model('Mtryout');
        $this->load->model('siswa/msiswa');


        $this->load->model('tesonline/Mtesonline');
        $this->load->model( 'ortuback/Ortuback_model' );
        parent::__construct();
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
        }

    }

    public function ajax_get_paket($id_tryout) {
        $data = $this->Mtryout->get_paket_by_id_to($id_tryout);

        $output = array('data' => $data);
        echo json_encode($output);
    }

    //# fungsi indeks, mampilin to yang dikasih hak akses.
    public function index() {
        $this->session->unset_userdata('id_tryout');
        $data = array(
            'judul_halaman' => 'Neon - Tryout',
            'judul_header' => 'Daftar Tryout',
            'judul_tingkat' => '',
            );

        $konten = 'modules/tryout/views/v-daftar-to.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/templating/views/t-f-pagetitle.php',
            APPPATH . $konten,
            APPPATH . 'modules/testimoni/views/v-footer.php',
            
            );
        if ($this->session->userdata('HAKAKSES')=='ortu') {
                //untuk mengambil id siswa jika ortu yang login 
            $datas['id_siswa'] = $this->Mtryout->get_id_siswa_by_ortu();
            // ini buat ambil pesan ortu
            $id_pengguna= $this->session->userdata['id'];
            $data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);
            $data['count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);
        }else{
        $datas['id_siswa'] = $this->Mtryout->get_id_siswa();
    }
        $data['tryout'] = $this->Mtryout->get_tryout_akses($datas);
        $this->parser->parse('templating/index', $data);
    }

    public function create_seassoin_idto($id_to) {
        $this->session->set_userdata('id_tryout', $id_to);
        redirect("tryout/daftarpaket");
    }

    public function daftarpaket() {
        $id_to = $this->session->userdata('id_tryout');
        $datas['id_tryout'] = $id_to;
        $datas['id_pengguna'] = $this->session->userdata('id');
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            //untuk mengambil id siswa jika ortu yang login 
            $datas['id_siswa'] = $this->Mtryout->get_id_siswa_by_ortu();

        }else{
            $datas['id_siswa'] = $this->msiswa->get_siswaid();
        }

        $data['nama_to'] = $this->Mtryout->get_tryout_by_id($id_to)[0]['nm_tryout'];
        $data_to = $this->Mtryout->get_tryout_by_id($id_to)[0];
        
        $date = new DateTime(date("Y-m-d H:i:s"));
        
        // concat tanggal mlai dan tanggai akhir
        $mulai = date("Y-m-d H:i:s ", strtotime($data_to['tgl_mulai']." ".$data_to['wkt_mulai']));
        $akhir = date("Y-m-d H:i:s ", strtotime($data_to['tgl_berhenti']." ".$data_to['wkt_berakhir']));

        //buat date
        $date_mulai =  new DateTime($mulai);
        $date_berhenti =  new DateTime($akhir);


        // kalo tanggal mulainya lebih dari hari ini dan kurang dari sama dengan tanggal berhenti
        if (($date>= $date_mulai) && ($date <= $date_berhenti)) {
            //TO BISA DI AKSES
            $status_to = 'doing';
        }else{
            //TO TIDAK BISA DI AKSES
            if ($date>=$date_berhenti) {
                // SELESAI
                $status_to = 'done';             
            }else{
                // BELUM DIMULAI
                $status_to = 'yet';             
            }
        }

        if (isset($id_to)) {
            $data = array(
                'judul_halaman' => 'Neon - Daftar Paket',
                'judul_header' => 'Tryout : ' . $data['nama_to'],
                'judul_tingkat' => '',
                'nama_to' => $data_to['nm_tryout'],
                );

            // FILES
            $konten = 'modules/tryout/views/v-daftar-paket.php';
            $data['files'] = array(
                APPPATH . 'modules/homepage/views/v-header-login.php',
                APPPATH . 'modules/templating/views/t-f-pagetitle.php',
                APPPATH . $konten,
                APPPATH . 'modules/testimoni/views/v-footer.php',
                );
            // DAFTAR PAKET
            $data['paket_dikerjakan'] = $this->Mtryout->get_paket_reported($datas);
            $data['paket'] = $this->Mtryout->get_paket_undo($datas);
            $data['status_to'] = $status_to;
             // ini buat pesan ortu
            $id_pengguna= $this->session->userdata['id'];
            $data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);
            $data['count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);


            $this->parser->parse('templating/index', $data);
            //unset session
            $this->session->unset_userdata('id_paketpembahasan');
            $this->session->unset_userdata('id_tryoutpembahasan');
            $this->session->unset_userdata('id_mm-tryoutpaketpembahasan');
        } else {
            //kalo gak ada session
            redirect('tryout');
        }
        // var_dump($data['paket_dikerjakan']);*/
    }

//# fungsi indeks
    function buatto() {
        $data = array("id_paket" => $this->input->post('id_paket'),
            "id_tryout" => $this->input->post('id_tryout'),
            "id_mm-tryoutpaket" => $this->input->post('id_mm_tryoutpaket'),
            );
        // set user data
        $this->session->set_userdata('id_paket', $data['id_paket']);
        $this->session->set_userdata('id_tryout', $data['id_tryout']);
        $this->session->set_userdata('id_mm-tryoutpaket', $data['id_mm-tryoutpaket']);

        // insert ke log tryout
        $insert = array("siswa_id" => $this->msiswa->get_siswaid(),
            "mm_tryout_paket_id" => $this->session->userdata('id_mm-tryoutpaket'),
            );

        $this->Mtryout->insert_log_tryout($insert);
    }

    function buatpembahasan() {
        $data = array("id_paket" => $this->input->post('id_paket'),
            "id_tryout" => $this->input->post('id_tryout'),
            "id_mm-tryoutpaket" => $this->input->post('id_mm_tryoutpaket'),
            );
        $this->session->set_userdata('id_paketpembahasan', $data['id_paket']);
        $this->session->set_userdata('id_tryoutpembahasan', $data['id_tryout']);
        $this->session->set_userdata('id_mm-tryoutpaketpembahasan', $data['id_mm-tryoutpaket']);
    }


    function test2() {
        if (!empty($this->session->userdata['id_mm-tryoutpaket'])) {
            $id = $this->session->userdata['id_mm-tryoutpaket'];
            $data['topaket'] = $this->Mtryout->datatopaket($id);

            $id_paket = $this->Mtryout->datapaket($id)[0]->id_paket;

            $data['paket'] = $this->Mtryout->durasipaket($id_paket);

            $this->load->view('templating/t-headerto');
            $query = $this->load->Mtryout->get_soal($id_paket);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];

            $this->load->view('v-test-mathjax.php', $data);
        } else {
            $this->errorTest();
        }
    }
// ================ mulai test lama ======================
    public function mulaitest() { 
        if (!empty($this->session->userdata['id_mm-tryoutpaket'])) { 
            $id = $this->session->userdata['id_mm-tryoutpaket']; 
            $data['topaket'] = $this->Mtryout->datatopaket($id); 

            $id_paket = $this->Mtryout->datapaket($id)[0]->id_paket; 
            $random = $this->Mtryout->dataPaketRandom($id_paket)[0]->random; 

            $data['paket'] = $this->Mtryout->durasipaket($id_paket); 

            $this->load->view('templating/t-headerto'); 
            if ($random == 0) { 
                $query = $this->load->Mtryout->get_soalnorandom($id_paket); 
            }else{ 
                $query = $this->load->Mtryout->get_soal($id_paket); 
            } 
            $data['soal'] = $query['soal']; 
            $data['pil'] = $query['pil']; 

            $this->load->view('vHalamanTo-bu.php', $data); 
            $this->load->view('templating/t-footerto', $data); 
        } else { 
            $this->errorTest(); 
        } 
    }
    public function mulaipembahasan() {
        if (!empty($this->session->userdata['id_mm-tryoutpaketpembahasan'])) {
            $id = $this->session->userdata['id_mm-tryoutpaketpembahasan'];
            $data['topaket'] = $this->Mtryout->datatopaket($id);

            $id_paket = $this->Mtryout->datapaket($id)[0]->id_paket;

            $this->load->view('templating/t-headerto');
            $query = $this->load->Mtryout->get_pembahasan($id_paket);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];

            $this->load->view('v-pembahasanto.php', $data);
            $this->load->view('footerpembahasan', $data);
        } else {
            $this->errorTest();
        }
    }

    public function pembahasan(){

        $this->load->view('templating/t-headerto');
        $query = $this->load->Mtryout->get_pembahasan(94);
        $data['soal'] = $query['soal'];
        $data['pil'] = $query['pil'];

        $this->load->view('v-pembahasanto.php', $data);
        $this->load->view('footerpembahasan', $data);
    // } else {
    //     $this->errorTest();
    // }
    }


    public function errorTest() {
        $this->load->view('templating/t-headerto');
        $this->load->view('v-error-test.php');
    }

    public function cekJawaban() {
        if ($this->input->post()) {
            $data = $this->input->post('pil');
            
            $id = $this->session->userdata['id_mm-tryoutpaket'];
            $id_paket = $this->Mtryout->datapaket($id)[0]->id_paket;

            $result = $this->Mtryout->jawabansoal($id_paket);

            $benar = 0;
            $salah = 0;
            $kosong = 0;
            $koreksi = array();
            $idSalah = array();
            for ($i = 0; $i < sizeOf($result); $i++) {
                $id = $result[$i]['soalid'];

                if (!isset($data[$id])) {
                    $kosong++;
                    $koreksi[] = $result[$i]['soalid'];
                    $idSalah[] = $i;
                } else if ($data[$id][0] == $result[$i]['jawaban']) {
                    $benar++;
                } else {
                    $salah++;
                    $koreksi[] = $result[$i]['soalid'];
                    $idSalah[] = $i;
                }
            }

            // data buat di insert ke laporan tryout paket
            $hasil['id_pengguna'] = $this->session->userdata['id'];
            $hasil['siswaID'] = $this->msiswa->get_siswaid();
            $hasil['id_mm-tryout-paket'] = $this->session->userdata['id_mm-tryoutpaket'];
            
            $hasil['jmlh_kosong'] = $kosong;
            $hasil['jmlh_benar'] = $benar;
            $hasil['jmlh_salah'] = $salah;
            $hasil['total_nilai'] = $benar;
            $hasil['poin'] = $benar;
            $hasil['status_pengerjaan'] = 1;

            // insert ke repory paket
            $result = $this->load->Mtryout->inputreport($hasil);
            
            // update tb log tryout
            $waktu = new DateTime("now");
            $data['update'] = ['waktu_selesai'=>date($waktu->format("Y-m-d H:i:s")),
            'status_pengerjaan'=>1];
            $data['where'] = ['siswa_id'=>$hasil['siswaID'],
            'mm_tryout_paket_id'=>$hasil['id_mm-tryout-paket']];
            $this->Mtryout->update_log_tryout($data);
            // update tb log tryout

            // unset session userdata
            $this->session->unset_userdata('id_mm-tryoutpaket');
            // direct ke daftar
            redirect(base_url('index.php/tryout/daftarpaket'));
        }else{
            redirect(base_url('index.php/tryout/daftarpaket'));
        }

    }

    //end fungsi ilham

    public function pembahasanto() {
        if (!empty($this->session->userdata['id_pembahasan'])) {
            $id = $this->session->userdata['id_pembahasan'];
            $this->load->view('templating/t-headersoal');

            $query = $this->load->mtesonline->get_soal($id);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];

            $this->load->view('vPembahasan.php', $data);
            $this->load->view('footerpembahasan.php');
        } else {
            $this->errorTest();
        }
    }

    public function report_to(){
        $list = $this->Mtryout->get_laporan_to();
        $array = [];
        foreach ($list as $item ) {

            $tempt = ['label'=>$item['nm_tryout'],'y'=> (int)number_format($item['nilai'],1)];
            $array[] = $tempt;
        }
      echo json_encode($array);

    }
}
?>