<?php 
/**
* 
*/
class Komenback extends MX_Controller
{
  
  function __construct(){
   $this->load->library('parser');
   $this->load->model('mkomen');
   $this->load->model('video/mvideos');
   $this->load->model('guru/mguru');
   $this->load->library('generateavatar');
       $this->load->library('sessionchecker');
         $this->sessionchecker->checkloggedin();

 }

 public function index() {
  
  $data['datKomen']=$this->datKomen();
  $data['judul_halaman'] = "Dashboard Admin";
  $data['files'] = array(
   APPPATH . 'modules/komenback/views/v-table-komen.php',
   );
  $hakAkses = $this->session->userdata['HAKAKSES'];

  if ($hakAkses == 'admin') {
            // jika admin
   $this->parser->parse('admin/v-index-admin', $data);
 } elseif ($hakAkses == 'guru') {
            // jika guru
   // redirect(site_url('guru/dashboard/'));
  $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
  $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
    $data['judul_halaman'] = "Dashboard Guru : Komen";
  $data['files'] = array(
   APPPATH . 'modules/komenback/views/v-table-komen.php',
   );
   $this->parser->parse('templating/index-b-guru', $data);

 } elseif ($hakAkses == 'siswa') {
   redirect(site_url('welcome'));
 } else {
            // jika siswa redirect ke homepage
   redirect(site_url('login'));
 }
}


function ajax_data_komen(){
  $hakAkses = $this->session->userdata['HAKAKSES'];
  if ($hakAkses == 'admin') {
      $list = $this->mkomen->get_all_komen();
  }else{
    $id_guru = $this->session->userdata['id_guru'];
     $list = $this->mkomen->get_komen_by_profesi($id_guru);
  }

  $data = array();
  $no=1;
  foreach ( $list as $komen_item ) {
    $row = array();
    $row[] = $no;
      // $row[] = htmlspecialchars(substr($komen_item->isiKomen, 0, 100));
    $row[] = htmlspecialchars($komen_item->isiKomen);
    $row[] = $komen_item->date_created;
    $row[] = $komen_item->judulVideo;
    $row[] = "
    <a class='btn btn-primary' onclick='respon(".$komen_item->komenID.")'><i class='icon ico-pencil' title='Respon'></i></a> 
    <a class='btn btn-danger' onclick='spam(".$komen_item->komenID.")'><i class='icon ico-remove3' title='Hapus'></i></a>
    <a class='btn btn-success' onclick='check(".$komen_item->videoID.")'><i class='ico-bubble-video-chat' title='Check Video'></i></a>
    ";
    $data[] = $row;
    $no++;
  }

  $output = array(
    "data"=>$data,
    );

  echo json_encode( $output );
}


public function addkomen() {
      //select dulu data dari komen berdasarkan komen
  $idKomen = $this->input->post('idKomen');
  $komenpost = $this->input->post('isiKomen');

  $komen = $this->mkomen->get_komen_by_idkomen($idKomen);
  if ($komen!=array()) {
   $isikomen = "<blockquote>".$komen[0]['isiKomen']."</blockquote>".$komenpost;
   $datas = array('isikomen'=>$isikomen,
    'videoID'=>$komen[0]['videoID'],
    'userID'=>$this->session->userdata('id'),
    'status'=>1
    );
   $this->mvideos->insertComment($datas);

 }else{
  echo "gagal";
}

}


  // LOAD PARSER SESUAI HAK AKSES
  public function loadparser($data){
     $data['datKomen']=$this->datKomen();
    $this->hakakses = $this->gethakakses();
    if ($this->hakakses=='admin') {
      $this->parser->parse('admin/v-index-admin', $data);
    } else if($this->hakakses=='guru'){
        $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
  $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
      $this->parser->parse('templating/index-b-guru', $data);
    }else{
      echo "forbidden access";        
    }
  }
  // LOAD PARSER SESUAI HAK AKSES


function seevideo($idvideo){

        //data untuk templating
  $this->mkomen->ch_stat_read($idvideo);
  $data['videosingle'] = $this->load->mvideos->get_single_video($idvideo);

  if ($data['videosingle'] == array()) {
    $data['title'] = "Video yang anda pilih tidak ada, mohon kirimi kami laporan";

  } else {
            //ambil id bab.
    $idbab = $this->load->mvideos->get_nama_sub_by_id_video($idvideo)['id'];
    $video_by_bab = $this->mvideos->get_all_video_by_bab($idbab);

            //ambil satu video bedasarkan idnya
    $namasub = $this->load->mvideos->get_nama_sub_by_id_video($idvideo)['judulSubBab'];
    $data['videosingle'] = $this->load->mvideos->get_single_video($idvideo);
    $onevideo = $data['videosingle'];

    if($onevideo[0]->namaFile==NULL){
      // $judul = $onevideo[0]->link;
      $judul = "<iframe width='100%' height='430' src='".$onevideo[0]->link."''></iframe>";
    }else{
      $link = base_url()."assets/video/".$onevideo[0]->namaFile;
      $judul = "<video id='my-video' class='video-js' controls preload='auto'
      poster='MY_VIDEO_POSTER.jpg' data-setup='{}'>
      <source src='".$link."'  style='width: 90%;height: 400px'  type='video/mp4'>
        <source src='".$link."' type='video/webm'>
          <p class='vjs-no-js'>
            To view this video please enable JavaScript, and consider upgrading to a web browser that
            <a href='http://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
          </p>
        </video>";
      }
      $penggunaID = $onevideo[0]->penggunaID;
      $penulis = $this->load->mguru->get_penulis($penggunaID);

      if ($penulis) {
       $namaDepan=$penulis[0]['namaDepan']; 
       $biografi=$penulis[0]['biografi'] ;
       $photo=base_url('assets/image/photo/guru/').$penulis[0]['photo'] ;
       $namaBelakang=$penulis[0]['namaBelakang'];
      } else{
        $nama="Admin"; 
       $biografi= "-";
       $photo= $this->generateavatar->generate_first_letter_avtar_url($nama);
      }
      
      
      $date = strtotime($onevideo[0]->date_created);
      $data = array(
        'videoID' =>$onevideo[0]->id,
        'judul_halaman' => 'Neon - Video : ' . $onevideo[0]->judulVideo,
        'judul_header' =>  $onevideo[0]->judulVideo,
        'judul_video' => $onevideo[0]->judulVideo,
        'deskripsi' => $onevideo[0]->deskripsi,
        'file' => $judul,
        'nama_penulis' =>$nama ,
        'biografi' => $biografi,
        'photo' => $photo,
        'nama_sub' => $namasub,
        'jumlah_comment'=>count($this->mkomen->get_komen_byvideo($idvideo)),
        'tanggal'=>date("d", $date),
        'bulan'=>date("M", $date),
        'avatar'=>$photo,
        );
      $subid = $onevideo[0]->subBabID;
            //ambil list semua video yang memiliki sub id yang sama
      $data['videobysub'] = $this->load->mvideos->get_video_by_sub($subid);
      $data['video_by_bab'] = $this->mvideos->get_all_video_by_bab($idbab);

     
       // $hakakses=$this->session->userdata['HAKAKSES'];
      // cek hakakases
      // if ($hakakses=='admin') {
         $comments = $this->mkomen->get_komen_byvideo($idvideo);
      // } else if($hakakses=='guru'){
      //    $comments = $this->mkomen->get_komenGuru_byvideo($idvideo);
      // }else{
      //    $comments = $this->mkomen->get_komenSiswa_byvideo($idvideo);
      // }
    // 

       $data['comments']=array();
      foreach ( $comments as $key ) {
        // generateavatar
        // $avatar=$key->photo;
        $namaPengguna=$key->namaPengguna;
        // if ($avatar !='' && $avatar !=' ' && $avatar !='default') {
            // cek hakakses
             $hakakses=$key->hakAkses;
             if ($hakakses=="guru") {
              $img=base_url('assets/image/photo/guru/'.$key->guru_photo);
             } else {
              $img=base_url('assets/image/photo/siswa/'.$key->siswa_photo);
             }
        // } else {
        //     $img=$this->generateavatar->generate_first_letter_avtar_url($namaPengguna);
        // }

         
        
         $data['comments'][]=array(
          'avatar'=> $img,
          'namaPengguna'=>$namaPengguna,
          'isiKomen'=>$key->isiKomen ,
          'date_created'=>$key->date_created,
          'komenID'=>$key->komenID,


          );
      }

      $data['files'] = array(
        APPPATH . 'modules/komenback/views/v-single-video-komen.php',
        );


     $this->loadparser($data);

    }
  }
//GET HAK AKSES
  function gethakakses(){
    return $this->session->userdata('HAKAKSES');
  }
  //GET HAK AKSES
  // get data komen not read
  public function datKomen()
  {
      $hakAkses = $this->session->userdata['HAKAKSES'];
      if ($hakAkses == 'admin') {
          $listKomen = $this->mkomen->get_all_komen();
      }else{
        $id_guru = $this->session->userdata['id_guru'];
         $listKomen = $this->mkomen->get_komen_by_profesi_notread($id_guru);
      }

      return $listKomen;
  }
}
?>