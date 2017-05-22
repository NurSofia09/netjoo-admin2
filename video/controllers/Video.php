<?php

class Video extends MX_Controller {

    private $pesan_error = "Oops..maaf sepertinya halaman masih kosong<br><br><br><br>";


    public function index(){
        $data = array(
            'judul_halaman' => 'Neon - Video',
            'judul_header' =>'Video',
            'judul_header2' =>'Video Belajar'
        );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/v-header-login.php',
            APPPATH.'modules/welcome/views/v-welcome.php',
            APPPATH.'modules/welcome/views/v-tampil-tes.php',
            APPPATH.'modules/testimoni/views/v-footer.php',
        );

        $data['tingkat'] = $this->load->MTingkat->gettingkat();

        $data['pelajaran_sma'] = $this->mmatapelajaran->daftarMapelSMA();
        $data['pelajaran_sma_ips'] = $this->mmatapelajaran->daftarMapelSMAIPS();
        $data['pelajaran_smp'] = $this->mmatapelajaran->daftarMapelSMP();
        $data['pelajaran_sd'] = $this->mmatapelajaran->daftarMapelSD();
        $data['pelajaran_sma_ipa'] = $this->mmatapelajaran->daftarMapelSMAIPA();

        $this->parser->parse( 'templating/index', $data );
    }
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Mvideos');
        $this->load->model('guru/mguru');
        $this->load->model('komenback/mkomen');
        $this->load->library('parser');
                $this->load->model( 'matapelajaran/mmatapelajaran' );
        $this->load->model( 'tingkat/MTingkat' );
         $this->load->library('generateavatar');
        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
    }
    // 
    }

    //########## FRONT END  ####################


    //halaman tampilkan sub bab dan see
    public function videosub($id_sub_bab) {
        //dapetin dulu idbabnya.
        $id_video = $this->Mvideos->get_video_single_bysub($id_sub_bab);

        if ($id_video) {
            $link = 'video/seevideo/' . $id_video;
            redirect(base_url($link));
        } else {
            echo "<h1>Error</h1>";
        }
    }

    //halaman tampilkan semua video dalam 1 subab
    public function videobysub($sub_bab_id) {
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
    }
        //tampilkan seluruh video yang diklik bab
        $data['judulbab'] = $this->load->Mvideos->get_video_by_sub($sub_bab_id);

        if ($data['judulbab'] == array()) {
            $judul_halaman = 'asdasd';

            $data['title'] = "Maaf sub-bab yang anda pilih, belum memiliki video! :( ";
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser', $data);
            $this->load->view('v-banner-videoBelajar');
            $this->load->view('templating/t-footer');
        } else {
            $judul_halaman = $this->load->Mvideos->get_video_by_sub($sub_bab_id)[0]->judulSubBab;
            $babId = $data['judulbab'][0]->babID;

            $data = array(
                'judul_halaman' => 'Neon - Sub : ' . $judul_halaman,
                'judul_header' => $judul_halaman
            );

            //get subab bab
            //$data['materisubab'] = $this->load->Mvideos->get_sub_by_babid( $babId );
            $data['semuavideo'] = $this->load->Mvideos->get_video_by_sub($sub_bab_id);
            $data['files'] = array(
                APPPATH . 'modules/homepage/views/v-header.php',         
                APPPATH . 'modules/templating/views/t-f-pagetitle.php',
                APPPATH . 'modules/video/views/v-container-all-videos.php',
                APPPATH . 'modules/templating/views/footer.php'
            );
            $this->parser->parse('templating/index', $data);
        }
    }

    //menampilkan materi dari suatu tingkat, IPA untuk SMA, IPS untuk SMA dst.
public function daftarvideo($tingpelID) {
if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
    }
// tampilkan ini matapelajaran apa dan untuk tingkat apa.
        $data['meta'] = $this->load->Mvideos->get_meta_data_tingkat($tingpelID);
        // print_r($data['meta']);

        //tampilkan bab dan subab video
        $data['title'] = "Pelajaran " . $data['meta']['namaMataPelajaran'] . " untuk " . $data['meta']['aliasTingkat'];
        //data untuk templating
        $data = array(
            'judul_halaman' => 'Neon - Video Pelajaran ' . $data['meta']['aliasMataPelajaran'],
            'judul_header' => $data['title'],
            'mapel' => $data['meta']['aliasMataPelajaran'], 'alias_tingkat' => $data['meta']['aliasTingkat'],
            'alias_pelajaran' => $data['meta']['aliasMataPelajaran']
        );
        //
        $data['bab_video'] = $this->load->Mvideos->get_video_as_bab($tingpelID);
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/templating/views/t-f-pagetitle.php',
            APPPATH . 'modules/video/views/f-daftar-video.php',
            APPPATH . 'modules/testimoni/views/v-footer.php'
        );
        // print_r($data);
        $this->parser->parse('templating/index', $data);
    }

    public function daftarallvideo($tingpelID) {
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
    }
        // tampilkan ini matapelajaran apa dan untuk tingkat apa.
        $data['meta'] = $this->load->Mvideos->get_meta_data_tingkat($tingpelID);
        // print_r($data['meta']);

        //tampilkan bab dan subab video
        $data['title'] =$data['meta']['namaMataPelajaran'] . " untuk " . $data['meta']['aliasTingkat'];
        //data untuk templating
        $data = array(
            'judul_halaman' => 'Neon - Video Pelajaran ' . $data['meta']['aliasMataPelajaran'],
            'judul_header' => $data['title'],
            'mapel' => $data['meta']['aliasMataPelajaran'], 'alias_tingkat' => $data['meta']['aliasTingkat'],
            'alias_pelajaran' => $data['meta']['aliasMataPelajaran']
        );

        //
        $data['bab_video'] = $this->load->Mvideos->get_video_as_sub($tingpelID);
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/templating/views/t-f-pagetitle.php',
            APPPATH . 'modules/video/views/f-daftar-video-bybab.php',
            APPPATH . 'modules/testimoni/views/v-footer.php'
            
        );



        $this->parser->parse('templating/index', $data);
    }

    public function seevideo($idvideo) {
       if ($this->session->userdata('HAKAKSES')=='ortu') {
            # langusung masuk
        }else{
        $this->sessionchecker->cek_token();
    }
        //data untuk templating
        $data['videosingle'] = $this->load->Mvideos->get_single_video($idvideo);
        $metaMapel = $this->Mvideos->get_meta_mapel($data['videosingle'][0]->subBabID);
        $judul_header = ($metaMapel['namaMataPelajaran']."->".$metaMapel['judulBab']);
        if ($data['videosingle'] == array()) {
            $data['title'] = "Video yang anda pilih tidak ada, mohon kirimi kami laporan";
        } else {
            //ambil id bab.
            $idbab = $this->load->Mvideos->get_nama_sub_by_id_video($idvideo)['babID'];
            $video_by_bab = $this->Mvideos->get_all_video_by_bab($idbab);

            //ambil satu video bedasarkan idnya
            $namasub = $this->load->Mvideos->get_nama_sub_by_id_video($idvideo)['judulSubBab'];
            $data['videosingle'] = $this->load->Mvideos->get_single_video($idvideo);
            $onevideo = $data['videosingle'];
            $penggunaID = $onevideo[0]->penggunaID;
            $penulis = $this->load->mguru->get_penulis($penggunaID);
            
            if ($penulis != array()) {
                $photo=base_url().'assets/image/photo/guru/'.$penulis[0]['photo'];

            }else{
                
                $photo= $this->generateavatar->generate_first_letter_avtar_url("Admin");
                $penulis = ['namaDepan'=>"Super",'namaBelakang'=>"Admin",'biografi'=>'Admin masih malu malu menceritakan dirinya'];
            }
            
            if($onevideo[0]->namaFile==NULL){
                $judul = $onevideo[0]->link;
            }else{
                $link = "assets/video/".$onevideo[0]->namaFile;
                $judul = base_url($link);
            }
            // if ($onevideo[0]->guruID!="") {
            //     $guruID = $onevideo[0]->guruID;
            //     $penulis = $this->load->mguru->get_penulis($guruID)[0];
            // }else{
            //     $penulis = ['namaDepan'=>"Super",'namaBelakang'=>"Admin",'biografi'=>'Admin masih malu malu menceritakan dirinya','photo'=>'default.png'];
            // }

        
            $data = array(
                'judul_halaman' => 'Neon - Video : ' . $onevideo[0]->judulVideo,
                'judul_header' => $judul_header,
                'judul_video' => $onevideo[0]->judulVideo,
                'deskripsi' => $onevideo[0]->deskripsi,
                'file' => $judul,
                'nama_penulis' => $penulis['namaDepan'] . " " . $penulis['namaBelakang'],
                'biografi' => $penulis['biografi'],
                'photo' => $photo,
                'nama_sub' => $namasub,
                'sub_id' => base_url()."video/timeline/".$onevideo[0]->subBabID,
                'videoID'=>$onevideo[0]->id
            );
            $subid = $onevideo[0]->subBabID;

            //ambil list semua video yang memiliki sub id yang sama
            $data['videobysub'] = $this->load->Mvideos->get_video_by_sub($subid);
            $data['video_by_bab'] = $this->Mvideos->get_all_video_by_bab($idbab);
            
            //ambil komen
            $data['comments'] = $this->mkomen->get_komen_byvideo($idvideo);
            $data['files'] = array(
                APPPATH . 'modules/homepage/views/v-header-login.php',
                APPPATH.'modules/templating/views/t-f-pagetitle.php',
                APPPATH . 'modules/video/views/f-single-video.php',
                APPPATH . 'modules/testimoni/views/v-footer.php'
            );
            $this->parser->parse('templating/index', $data);
        }
    }

        #ajax untuk menampilkan soal yang sudah di pub, belum terdaftar di paket dan statusnya 1
    function ajax_get_last_video() {
        $data=array();
        $list = $soal=$this->Mvideos->get_last_video();
        //mengambil nilai list
        $baseurl = base_url();
        foreach ( $list as $list_video ) {
            $n='1';
            $row = array();

            // $row[] = $list_video['id'];
            // $row[] = $list_video['judulVideo'];
            // $row[] = $list_video['date_created'];
            // $row[] = $list_video['deskripsi'];
            // $link = base_url('video/seevideo')."/".$list_video['id'];
            $row[] ="<article>
                    <img src='http://placehold.it/83x83' data-at2x='' alt>
                   <a onclick='kunjungivideo(".$list_video['id'].")'> 
                   <h3>".$list_video['judulVideo']."</h3></a>
                    <div class='course-date'>
                        <div>".$list_video['date_created']."</div>
                    </div>
                    <p>".$list_video['deskripsi']."</p>
                </article>";

            $data[] = $row;
            $n++;

        }

        $output = array(
            "data"=>$data,
        );
        // echo $link;
        echo json_encode( $output );
        
    }
    //########## FRONT END  ####################
    //----------# BACK END  #----------#

    public function uploadvideo() {
        $this->load->view('templating/t-header');
        $this->load->view('templating/t-navbar');
        $this->load->view('v-b-form-upload-video');
        $this->load->view('templating/t-footer');
    }

    public function dropvideo($idVideo) {
        $idGuru = $this->session->userdata['id_guru'];
        $this->load->Mvideos->deleteVideo($idVideo, $idGuru);
        $videoHapus = $this->load->Mvideos->get_single_video($idVideo)[0]->namaFile;
        unlink(FCPATH . "assets\uploaded\\" . $videoHapus);
        redirect(base_url('index.php/videoback/managervideo'));
    }

    public function comment() {
        $isiKomen = $this->input->post('comment');
        $idvideo = htmlspecialchars($this->input->post('idvideo'));
        $userID = $this->session->userdata['id'];

        $dataKomen = array(
            'isiKomen' => $isiKomen,
            'videoID' => $idvideo,
            'userID' => $userID,
        );
        $this->Mvideos->insertComment($dataKomen);
    }

    function timeline($sub_bab_id){
        $this->sessionchecker->cek_token();
                //tampilkan seluruh video yang diklik bab
        $data['judulbab'] = $this->load->Mvideos->get_video_by_sub($sub_bab_id);

        if ($data['judulbab'] == array()) {
            $judul_halaman = 'Timeline video';

            $data['title'] = "Maaf sub-bab yang anda pilih, belum memiliki video! :( ";
            $this->load->view('templating/t-header');
            $this->load->view('templating/t-navbarUser', $data);
            $this->load->view('v-banner-videoBelajar');
            $this->load->view('templating/t-footer');
        } else {
            $judul_halaman = $this->load->Mvideos->get_video_by_sub($sub_bab_id)[0]->judulSubBab;
            $babId = $data['judulbab'][0]->babID;

            $data = array(
                'judul_halaman' => 'Neon - Sub : ' . $judul_halaman,
                'judul_header' => $judul_halaman
            );

            //get subab bab
            //$data['materisubab'] = $this->load->Mvideos->get_sub_by_babid( $babId );
            $data['semuavideo'] = $this->load->Mvideos->get_video_by_sub($sub_bab_id);
            $data['files'] = array(
                APPPATH . 'modules/homepage/views/v-header.php',        
                APPPATH . 'modules/video/views/v-f-timeline-video.php',
                APPPATH . 'modules/testimoni/views/v-footer.php'
                
            );
            $this->parser->parse('templating/index', $data);
        }
    }
    //----------# BACK END  #----------#

    public function addkomen() {
        $dataKomen['isiKomen'] = $this->input->post('isiKomen');
        $dataKomen['videoID'] = $this->input->post('videoID');
        $dataKomen['userID'] = $this->session->userdata['id'];
        $UUID=uniqid();
        $dataKomen['UUID']=$UUID;
        $this->Mvideos->insertComment($dataKomen);

        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
           // jika admin
          //get data komen by UUID
          $datArr=$this->mkomen->get_komen_by_UUID($UUID);
        } elseif($hakAkses=='guru'){
         // jika guru
         //get data komen by UUID
          $datArr=$this->mkomen->get_komenGuru_by_UUID($UUID);
         }else{
            // jika siswa redirect ke welcome
          //get data komen by UUID
          $datArr=$this->mkomen->get_komenSiswa_by_UUID($UUID);
        }

        #cek Photo
        $photo=$datArr[0]['photo'];
        $namaPengguna = $datArr[0]['namaPengguna'];
        if ($photo!='' && $photo!=' ' && $photo!='default') {
          $dataKomen['photo']=base_url().'assets/image/photo/'.$hakAkses.'/'.$photo;
        } else {
           $photo= $this->generateavatar->generate_first_letter_avtar_url($namaPengguna);
           $dataKomen['photo']=$photo;
        }
        
        $dataKomen['namaPengguna']=$namaPengguna;
        $dataKomen['date_created']=$datArr[0]['date_created'];
        $dataKomen['videoID']=$datArr[0]['videoID'];
        $dataKomen['mapelID']=$datArr[0]['mataPelajaranID'];
        $dataKomen['new_count_komen'] = $this->db->where('read_status',0)->count_all_results('tb_komen');
          $dataKomen['success']=true;

        echo json_encode($dataKomen);
    }

}

?>
