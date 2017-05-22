<?php



defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );


class Welcome extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model( 'matapelajaran/mmatapelajaran' );
        $this->load->model( 'tingkat/MTingkat' );
        $this->load->model( 'video/mvideos' );
        $this->load->model( 'siswa/msiswa' );
        $this->load->model( 'ortu/mOrtu' );
        $this->load->model( 'ortuback/Ortuback_model' );
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        $this->load->library( 'parser' );
        if ($this->session->userdata('loggedin')==true) {
            if ($this->session->userdata('HAKAKSES')=='siswa'){
               // redirect('welcome');
            }else if($this->session->userdata('HAKAKSES')=='guru'){
               redirect('guru/dashboard');
           }else{
           }

       }

   }



   public function index() {
    
    $data = array(
        'judul_halaman' => 'Neon - Welcome',
        'judul_header' =>'Video',
        'judul_header2' =>'Video Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/v-header-login.php',
        APPPATH.'modules/welcome/views/v-container-graph.php',
        APPPATH.'modules/testimoni/views/v-footer.php',
        );

    if ($this->session->userdata('HAKAKSES')=='ortu') {
        $id_pengguna= $this->session->userdata['id'];
        $namaDepan=$this->mOrtu->get_siswa($id_pengguna)[0]['namaDepan'];
        $namaBelakang=$this->mOrtu->get_siswa($id_pengguna)[0]['namaBelakang'];
        $data['siswa'] =$namaDepan.' '. $namaBelakang ;
        // ini buat ortu
        $data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);
        $data['count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);

    }


    $data['video'] = $this->mvideos->get_video_limit();
    $data['topik'] = $this->msiswa->persentasi_limit(3);
    $data['latihan'] = $this->msiswa->get_limit_persentase_latihan(3);
    $data['pesan'] = $this->msiswa->get_pesan();

    $this->parser->parse( 'templating/index', $data );


}


public function faq(){
 $data = array(
    'judul_halaman' => 'Neon - FAQ',
    'judul_header' =>'FAQ HASIL DETECTION',
    'judul_header2' =>'Video Belajar'
    );

 $data['files'] = array( 
    APPPATH.'modules/homepage/views/v-header-login.php',
    APPPATH.'modules/welcome/views/v-faq.php',
    APPPATH.'modules/testimoni/views/v-footer.php',
    );
 $this->parser->parse( 'templating/index', $data );
}

## get data latihan persentase buat di datatable.
public function get_data_latihan(){
    $list = $this->msiswa->get_limit_persentase_latihan(10);
    $data = array();
    $n=1;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ( $list as $item ) {
        $row = array();

        $row[] = $n;
        $row[] = $item['judulBab'];
        $row[] = $item['total_soal'];
        $row[] = $item['total_benar'];
        $row[] = $item['total_salah'];
        $row[] = $item['total_kosong'];
        $row[] = (int)$item['total_benar'] / (int)$item['total_soal'] * 100;
        $persentasi = (int)$item['total_benar'] / (int)$item['total_soal'] * 100;   
        $row[] = "<span class='skill-bar' title=".$persentasi."> <span class='bar'><span class='bg-color-4 skill-bar-progress' processed='true' style='width: ".$persentasi."%;'></span></span></span>";
        $persentasi;





        $data[] = $row;
        $n++;

    }

    $output = array(
        "data"=>$data,
        );
    echo json_encode( $output );

}
## learning line persentase datatable.
public function get_data_learning_line(){
    $list = $this->msiswa->persentasi_limit(10);
    $data = array();
    $n=1;
        //mengambil nilai list
    $baseurl = base_url();
    foreach ( $list as $item ) {
        $row = array();

        $row[] = $n;
        $row[] = $item['namaTopik'];
        $row[] = $item['stepDone'];
        $row[] = $item['jumlah_step'];
        $persentasi = (int)$item['stepDone'] / (int)$item['jumlah_step'] * 100;   
        $row[] = (int)$persentasi;
        $title = (int)$persentasi."%"; 
        $row[] = "<span class='skill-bar' title=".$title."> <span class='bar'><span class='bg-color-4 skill-bar-progress' processed='true' style='width: ".$persentasi."%;'></span></span></span>";


        $data[] = $row;
        $n++;

    }

    $output = array(
        "data"=>$data,
        );
    echo json_encode( $output );




}

}
