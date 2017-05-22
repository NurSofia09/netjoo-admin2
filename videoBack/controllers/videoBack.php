<?php

//============================================================+
// File name   : videoBack.php
// Begin       : -
// Last Update : 2017-04-13
//
// Description : controller model video back
//               
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               neonjogja.com

//============================================================+

/**
 * @author MrBebek
 * @since  2016-08-xx
 */
class Videoback extends MX_Controller {


  function __construct() {
    parent::__construct();
    $this->load->helper('session');
    $this->load->model('Mvideoback');
    $this->load->library('table');
    $this->load->model('video/mvideos');
    $this->load->model('guru/mguru');
    $this->load->model('templating/mtemplating');
    $this->load->library('parser');
    $this->load->library('pagination');
    $this->load->library('generateavatar');
    $this->load->model('komenback/mkomen');
        $this->load->library('sessionchecker');
         $this->sessionchecker->checkloggedin();

  }

    # Mengambil video berdasarkan id guru
  function get_video_manager() {
    $guru_id = $this->session->userdata['id_guru'];
    $data['videos_uploaded'] = $this->load->mvideos->get_video_by_teacher($guru_id);
        //untuk mengambil data guru
        //untuk menghitung berapa banyak video yang sudah diupload
    $data['jumlah_video'] = count($this->load->mvideos->get_video_by_teacher($guru_id));
    return $data;
  }
    ##

    # ajax mengambil video by id guru
  function ajax_get_video_by_id_guru(){
    $guru_id = $this->session->userdata['id_guru'];
    $data['videos_uploaded'] = $this->load->mvideos->get_all_video_by_teacher($guru_id);
       // var_dump($data['videos_uploaded']);
    $list = $data['videos_uploaded'];
    $data = array();

        //var_dump($list);
        //mengambil nilai list
    $baseurl = base_url();
    foreach ( $list as $list_video ) {
      $n='1';
      $row = array();

            // $row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
            //                     <input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
            //                     <label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
            //                 </span>";
      if ($list_video['published']=='1') {
        $publish='Publish';
      }else{
        $publish='No Publish';
      }
      $row[] = $list_video['videoID'];
      $row[] = $list_video['judulVideo'];
      $row[] = $list_video['namaFile'];
      $row[] = $list_video['matapelajaran'];
      $row[] = $list_video['judulBab'];
      $row[] = $list_video['judulSubBab'];
      $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
      $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
      $row[] =  $publish;
      $row[] = ' 
      <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
      data-id='."'".json_encode($list_video)."'".'
      onclick="detail('."'".$list_video['videoID']."'".')"
      >
      <i class=" ico-play3"></i>
      </a> 
      <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
      )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';

$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

public function index() {
  $this->load->view('templating/t-footer-back');
  $this->load->view('templating/t-header');
  $this->load->view('guru/v-left-bar');
  $this->load->view('v-upload-video-form');
}

#######menampilkan view form upload OLD FORM############################
// public function formupvideo() {
//     // notification
//   $data['datKomen']=$this->datKomen();
//   $id_guru = $this->session->userdata['id_guru'];
//   // get jumlah komen yg belum di baca
//   $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
//   //
//   $data['judul_halaman'] = "upload Video";
//   $data['files'] = array(
//     APPPATH . 'modules/videoback/views/v-upload-video-form.php',
//     );
//   $hakAkses=$this->session->userdata['HAKAKSES'];
//         // cek hakakses 
//   if ($hakAkses=='admin') {
//             // jika admin
//     $this->parser->parse('admin/v-index-admin', $data);
//   } elseif($hakAkses=='guru'){
//             // jika guru
//     $this->parser->parse('templating/index-b-guru', $data);
//   }elseif($hakAkses=='siswa'){
//             // jika siswa redirect ke welcome
//     redirect(site_url('welcome'));
//   }else{

//     redirect(site_url('login'));
//   }
// }
####################################################################################

public function formupvideo() {

  $data['judul_halaman'] = "upload Video";
  $data['files'] = array(
    APPPATH . 'modules/videoback/views/v-upload-video-form2.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
        // cek hakakses 
  if ($hakAkses=='admin') {
            // jika admin
    $this->parser->parse('admin/v-index-admin', $data);
  } elseif($hakAkses=='guru'){
    // jika guru
    // notification
    $data['datKomen']=$this->datKomen();
    $id_guru = $this->session->userdata['id_guru'];
    // get jumlah komen yg belum di baca
    $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
   //
    $this->parser->parse('templating/index-b-guru', $data);
  }elseif($hakAkses=='siswa'){
            // jika siswa redirect ke welcome
    redirect(site_url('welcome'));
  }else{

    redirect(site_url('login'));
  }
}

     //menampilkan view form upload
public function formUpdateVideo($UUID) {
 $data['video']=$this->Mvideoback->get_video_by_UUID($UUID)[0];
 $subBabID=$data['video']['subBabID'];
 $data['infovideo']=$this->Mvideoback->get_info_video($subBabID);
 $data['judul_halaman'] = "update Video";
 $data['files'] = array(
  APPPATH . 'modules/videoback/views/v-update-video-form.php',
  );

 $hakAkses=$this->session->userdata['HAKAKSES'];
  // cek hakakses 
 if ($hakAkses=='admin') {
  // jika admin
  $this->parser->parse('admin/v-index-admin', $data);
} elseif($hakAkses=='guru'){
  // jika guru
  // notification
  $data['datKomen']=$this->datKomen();
  $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
  $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
 //
  $this->parser->parse('templating/index-b-guru', $data);
}elseif($hakAkses=='siswa'){
  // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{
  redirect(site_url('login'));
}
// jika guru untul sentara yg guru bisa di tembak URL untuk testing
}

public function managervideo() {
  // notification
  $data['datKomen']=$this->datKomen();
  $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
  $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
  //
  // $data['paket_soal'] = $this->load->MPaketsoal->getpaketsoal();
  $data['judul_halaman'] = "My Video";
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-container-video.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
                    // jika admin
    $this->parser->parse('admin/v-index-admin', $data);
  } elseif($hakAkses=='guru'){
                    // jika guru
    $this->parser->parse('templating/index-b-guru', $data);
  }elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
    redirect(site_url('welcome'));
  }else{

    redirect(site_url('login'));
  }

}

public function upvideos($data) {
$video=$data['video'];

}

    // fungsi untuk upload video
public function upvideo($data) {

  $config['upload_path'] = './assets/video';
  $config['allowed_types'] = 'mp4';
  $config['max_size'] = 90000;
$video=$data['video'];
  $config['encrypt_name'] = TRUE;
  $new_name = time().$_FILES[$video]['name'];
  $config['file_name'] = $new_name;

  $this->load->library('upload', $config);
  $this->upload->initialize($config);
  
  // pengecekan upload
  if (!$this->upload->do_upload($video)) {
    // jika upload video gagal
    $error = array('error' => $this->upload->display_errors());

  } else {
    // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
    $file_data = $this->upload->data();
    $video = $file_data['file_name'];
    // $thumbnail=$data['thumbnail'];
    // $filethumbnail = $this->upThumbnail($thumbnail);
     $filethumbnail = "";
    $penggunaID = $this->session->userdata['id'];
    // $guruID = $data['tb_guru']['id'];
    $UUID=uniqid();
                //data yg akan di masukan ke tabel video
    $data_video = array(
      'judulVideo' => $data['judulVideo'] ,
      'namaFile' => $video,
      'thumbnail' => $filethumbnail,
      'deskripsi' => $data['deskripsi'],
      'published' => $data['published'],
      'penggunaID' => $penggunaID,
      'subBabID' => $data['subBabID'],
      'UUID' => $UUID,
      'jenis_video' => $data['jenis_video']
      );

    $this->Mvideoback->insertVideo($data_video);
    // redirect(site_url('videoback/daftarvideo'));
  }
}

public function upThumbnail($thumbnail)
{
    $configTmbl['upload_path'] = './assets/image/thumbnail/';
        $configTmbl['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $configTmbl['max_size'] = 100;
        $configTmbl['max_width'] = 1024;
        $configTmbl['max_height'] = 768;
        //random name
        $configTmbl['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["thumbnail"]['name'];
        $configTmbl['file_name'] = $new_name;
        $this->load->library('upload', $configTmbl);
        $gambar = $thumbnail;
        $this->upload->initialize($configTmbl);
        if ($this->upload->do_upload($gambar)) {
           $file_data = $this->upload->data();
           $file_name = $file_data['file_name'];
           return $file_name;
        }else{
          return null;
        }


}


public function cek_option_upload()
{
          //load library n helper
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');

        //set role
  $this->form_validation->set_rules('judulvideo', 'Judul Video', 'required');
  $this->form_validation->set_rules('subBab', 'Subbab', 'required');
         // $this->form_validation->set_rules('video', 'Video', 'required');

        //pesan error atau pesan kesalahan pengisian form upload video
  $this->form_validation->set_message('required', '*Data tidak boleh kosong!');

  //val file 
  $data['video'] = htmlspecialchars($this->input->post('video'));

   $data['tumbnail'] = htmlspecialchars($this->input->post('tumbnail'));
  //
  //value post
  $data['subBabID'] = htmlspecialchars($this->input->post('subBab'));
  $data['judulVideo'] = htmlspecialchars($this->input->post('judulvideo'));
  $data['deskripsi'] = htmlspecialchars($this->input->post('deskripsi'));
  $data['published'] = htmlspecialchars($this->input->post('publish'));
  $data['jenis_video'] = htmlspecialchars($this->input->post('jenis_video'));
  $link=$this->input->post('link_video');
  $option_up=htmlentities($this->input->post('option_up'));
  if ($this->form_validation->run() == FALSE) {
    $this-> formupvideo();
  }else{
   if ($option_up =='link') {
    $penggunaID = $this->session->userdata['id'];
    // $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
    // $guruID = $data['tb_guru']['id'];
    $UUID = uniqid();
    $linkembed=$this->get_linkembed($link);
    $data_video = array(
      'judulVideo' => $data['judulVideo'] ,
      'link' => $linkembed,
      'deskripsi' => $data['deskripsi'],
      'published' => $data['published'],
      'penggunaID' => $penggunaID,
      'subBabID' => $data['subBabID'],
      'UUID' => $UUID,
      'jenis_video' => $data['jenis_video']
      );
    var_dump($data_video);
    $this->Mvideoback->insertVideo($data_video);
  }else{
    $this->upvideo($data);
  }
}
} 

     // get id video youtube untuk di simpan ke db
public function get_linkembed($link)
{
  $mulai='0';
  $end='0';
  $linkembed=' ';
  $i=0;
        // echo strlen($nama);
  for ($x = 0; $x < strlen($link); $x++) {

    if ($link[$x] == '=' ) {
      $startID=$x+1;
      $linkembed='https://www.youtube.com/embed/'.substr($link, $startID,11);
      break;
    }else{
      $linkembed=$link;
    }

  }
  return $linkembed;
}

public function cek_option_update()
{
           //load library n helper
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');

        //set role
  $this->form_validation->set_rules('judulvideo', 'Judul Video', 'required');
  $this->form_validation->set_rules('subBab', 'Subbab', 'required');
         // $this->form_validation->set_rules('video', 'Video', 'required');

        //pesan error atau pesan kesalahan pengisian form upload video
  $this->form_validation->set_message('required', '*Data tidak boleh kosong!');
        //value post
  $data['judulVideo'] = htmlspecialchars($this->input->post('judulvideo'));
  $data['deskripsi'] = htmlspecialchars($this->input->post('deskripsi'));
  $data['subBabID'] = htmlspecialchars($this->input->post('subBab'));
  $data['published'] = htmlspecialchars($this->input->post('publish'));
  $data['UUID']=$this->input->post('UUID');
  $UUID=$data['UUID'];
  $link=$this->input->post('link_video');
  $option_up=htmlentities($this->input->post('option_up'));
  if ($this->form_validation->run() == FALSE) {
    $this-> formUpdateVideo($data['UUID']);
  }else{
   if ($option_up =='link') {
    $this->dropVideoServer($UUID);
    // $penggunaID = $this->session->userdata['id'];
    // $data['tb_guru'] = $this->Mvideoback->getIDguru($penggunaID)[0];
    // $guruID = $data['tb_guru']['id'];
    $linkembed=$this->get_linkembed($link);
    $data['video'] = array(
      'judulVideo' => $data['judulVideo'] ,
      'namaFile' => null,
      'link' => $linkembed,
      'deskripsi' => $data['deskripsi'],
      'published' => $data['published'],
      // 'guruID' => $guruID,
      'subBabID' => $data['subBabID'],
      );

    $this->Mvideoback->ch_video($data);
    redirect(site_url('videoback/daftarvideo'));
  }else{


    $this->updateVideo($data);
  }
}
}

     // fungsi untuk Update video server
public function updateVideo($data) {

  $config['upload_path'] = './assets/video';
  $config['allowed_types'] = 'mp4';
  $config['max_size'] = 90000;
  $this->load->library('upload', $config);
  $UUID=$data['UUID'];

             // pengecekan upload
  if ($this->upload->do_upload('video')) {
    $this->dropVideoServer($UUID);
                // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
    $file_data = $this->upload->data();
    $video = $file_data['file_name'];
    $UUID=$data['UUID'];
    $thumbnail = $this->chThumbnail($UUID);
                //data yg akan di masukan ke tabel video
    $data['video'] = array(
      'judulVideo' => $data['judulVideo'] ,
      'namaFile' => $video,
      'thumbnail' => $thumbnail,
      'link' => null,
      'deskripsi' => $data['deskripsi'],
      'published' => $data['published'],
      // 'guruID' => $guruID,
      'subBabID' => $data['subBabID'],
      );
  } else {
    $UUID=$data['UUID'];
     $thumbnail = $this->chThumbnail($UUID);
    $data['video'] = array(
      'judulVideo' => $data['judulVideo'] ,
      'thumbnail' => $thumbnail,
      'link' => null,
      'deskripsi' => $data['deskripsi'],
      'published' => $data['published'],
      // 'guruID' => $guruID,
      'subBabID' => $data['subBabID'],
      );
  }
  $this->Mvideoback->ch_video($data);
  redirect(site_url('videoback/daftarvideo'));
}
//  Thumbnail
public function chThumbnail($UUID)
{
    $oldthumbnail = $this->Mvideoback->get_onethumbnail($UUID)[0]['thumbnail'];
    $configChTmbl['upload_path'] = './assets/image/thumbnail/';
      $configChTmbl['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
      $configChTmbl['max_size'] = 100;
      $configChTmbl['max_width'] = 1024;
      $configChTmbl['max_height'] = 768;
      //random name
      $configChTmbl['encrypt_name'] = TRUE;
      $new_name = time().$_FILES["thumbnail"]['name'];
      $configChTmbl['file_name'] = $new_name;
      $this->load->library('upload', $configChTmbl);
      $gambar = "thumbnail";
      $this->upload->initialize($configChTmbl);
      if ($this->upload->do_upload($gambar)) {
         if ($oldthumbnail!='' && $oldthumbnail!=' ') {
                   unlink(FCPATH . "./assets/image/thumbnail/" . $oldthumbnail);
          }
         $file_data = $this->upload->data();
         $file_name = $file_data['file_name'];
         return $file_name;
      }else{
        return $oldthumbnail;
      }


}
    //hapus video di server
public function dropVideoServer($UUID)
{
  $video=$this->Mvideoback->get_video_by_UUID($UUID)[0];

  if ($video['namaFile']!=null) {
    unlink(FCPATH . "./assets/video/" . $video['namaFile']);
  }

}

    //hapus video di db
public function dropVideo($videoID)
{
  $this->Mvideoback->del_video($videoID);
}
    //hapus file video
public function del_file_video()
{
  if ($this->input->post()) {
    $videoID=$this->input->post('videoID');
    $oldVideo=$this->mvideos->get_nameFile($videoID)[0];
      $nameVideo=$oldVideo->namaFile;

      if ($nameVideo!=null) {
       unlink(FCPATH . "./assets/video/" . $nameVideo);
     }
     $this->dropVideo($videoID);
  }
  


}

    //Start function untuk dropdown dependent pada form upload video#

public function getPelajaran( $tingkatID ) {
  $data = $this->output
  ->set_content_type( "application/json" )
  ->set_output( json_encode( $this->Mvideoback->scPelajaran( $tingkatID ) ) ) ;
}


public function getBab( $tpelajaranID ) {
  $data = $this->output
  ->set_content_type( "application/json" )
  ->set_output( json_encode( $this->Mvideoback->scBab( $tpelajaranID ) ) ) ;
}

public function getSubbab( $babID ) {
  $data = $this->output
  ->set_content_type( "application/json" )
  ->set_output( json_encode( $this->Mvideoback->scSubbab( $babID ) ) );


}

public function getTingkat() {
  $data = $this->output
  ->set_content_type( "application/json" )
  ->set_output( json_encode( $this->Mvideoback->scTingkatvideo() ) ) ;
}




    //Start function untuk dropdown dependent pada form upload video#

    // fungsi untuk filter video
public function filter_video()
{
  $tingkat = $this->input->post('tingkat');
  $pelajaran = $this->input->post('mataPelajaran');
  $bab=$this->input->post('bab');
  $subbab=$this->input->post('subbab');

  if ($subbab != null) {
    // $this->video_by_subbab($subbab);
     $this->listvideoSubBab($subbab);
  } else if ($bab != null) {
    // $this->video_by_bab($bab);  (datatable)
     $this->listvideoBab($bab); 
  } else if ($pelajaran != null) {
    // $this->video_by_mapel($pelajaran); (datatable)
    $this->listvideoMp($pelajaran);
  } else if ($tingkat != null) {
    // $this->video_by_tingkat($tingkat); (datatable)
    $this->listvideoTingkat($tingkat);
  } else {
   $this->daftarvideo();
 }    
}
    //menampilkan video by subbab
public function video_by_subbab($subbab)
{
  $data['subBabID']=$subbab;
  $namasub=$this->Mvideoback->get_nama_sub($subbab);
  $data['nama']=$namasub['judulSubBab'];
  $data['judul_halaman'] = "Daftar Video";
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-subbab-video.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
   $data['files'] = array(
    APPPATH.'modules/templating/views/v-maintenance.php',
    );
                    // jika admin
   $this->parser->parse('admin/v-index-admin', $data);
 } elseif($hakAkses=='guru'){
                    // jika guru
  $this->parser->parse('templating/index-b-guru', $data);
}elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{

  redirect(site_url('login'));
}

}
    //menampilkan video by bab
public function video_by_bab($bab)
{
  $data['babID']=$bab;
  $namabab=$this->Mvideoback->get_nama_bab($bab);
  $data['nama']= $namabab['judulBab'];
  $data['judul_halaman'] = "Daftar Video ";
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-bab-video.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
   $data['files'] = array(
    APPPATH.'modules/templating/views/v-maintenance.php',
    );
                    // jika admin
   $this->parser->parse('admin/v-index-admin', $data);
 } elseif($hakAkses=='guru'){
                    // jika guru
  $this->parser->parse('templating/index-b-guru', $data);
}elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{

  redirect(site_url('login'));
}
}
    //menampilkan video by mata pelajaran
public function video_by_mapel($pelajaran)
{
  $data['mapelID']=$pelajaran;
  $mapel=$this->Mvideoback->get_nama_mapel($pelajaran);
  $data['nama']= $mapel['keterangan'];
  $data['judul_halaman'] = "Daftar Video ";
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-mapel-video.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
   $data['files'] = array(
    APPPATH.'modules/templating/views/v-maintenance.php',
    );
                    // jika admin
   $this->parser->parse('admin/v-index-admin', $data);
 } elseif($hakAkses=='guru'){
                    // jika guru
  $this->parser->parse('templating/index-b-guru', $data);
}elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{

  redirect(site_url('login'));
}
}
    //menampilkan video by tingkat
public function video_by_tingkat($tingkat)
{
  $data['tingkatID']=$tingkat;
  $tingkat=$this->Mvideoback->get_nama_tingkat($tingkat);
  $data['nama']= $tingkat['aliasTingkat'];
  $data['judul_halaman'] = "Daftar Video" ;
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-tingkat-video.php',
    );
  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
   $data['files'] = array(
    APPPATH.'modules/templating/views/v-maintenance.php',
    );
                    // jika admin
   $this->parser->parse('admin/v-index-admin', $data);
 } elseif($hakAkses=='guru'){
                    // jika guru
  $this->parser->parse('templating/index-b-guru', $data);
}elseif($hakAkses=='siswa'){
                    // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{

  redirect(site_url('login'));
}
}

    // daftar semua video
public function listvideo()
{
  $data['judul_halaman'] = "Daftar Video";
  $data['files'] = array(
    APPPATH.'modules/videoback/views/v-all-video.php',
    );

  $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
  if ($hakAkses=='admin') {
          //maintenance
   $data['files'] = array(
    APPPATH.'modules/videoback/views/v-all-video.php',
    );
    // jika admin
   $this->parser->parse('admin/v-index-admin', $data);

 } elseif($hakAkses=='guru'){
    // jika guru
   $this->parser->parse('templating/index-b-guru', $data);
 }elseif($hakAkses=='siswa'){
    // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}else{

  redirect(site_url('login'));
}

}

    // menampilkan data semua video
function ajax_get_all_video(){

  $data['videos_uploaded'] = $this->load->mvideos->get_all_video();
  $data['videos_uploaded_by_admin'] = $this->load->mvideos->get_video_by_admin();

  $datas = array_merge($data['videos_uploaded'],$data['videos_uploaded_by_admin']);

       // var_dump($data['videos_uploaded']);
  $list = $data['videos_uploaded'];
  $data = array();

        //var_dump($list);
        //mengambil nilai list
  $baseurl = base_url();
  foreach ( $datas as $list_video ) {
    $n='1';
    $row = array();
    if ($list_video['published']=='1') {
      $publish='Publish';
    }else{
      $publish='No Publish';
    }
    $row[] = $list_video['videoID'];
    $row[] = $list_video['judulVideo'];
    $row[] = $list_video['namaFile'];
    $row[] = $list_video['matapelajaran'];
    $row[] = $list_video['judulBab'];
    $row[] = $list_video['judulSubBab'];
    $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
    
    if ($list_video['guruID']=="") {
      $row[] = "Super Admin";
    }else{
      $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
    }
    $row[] =  $publish;
    $guru_id =null;
    if (isset( $this->session->userdata['id_guru'])) {
      $guru_id =$this->session->userdata['id_guru'] ;
    } 
    if ($guru_id == null) {
      $row[] = ' 
      <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
      data-id='."'".json_encode($list_video)."'".'
      onclick="detail('."'".$list_video['videoID']."'".')"
      >
      <i class=" ico-play3"></i>
      </a> 
      <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
      )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
} elseif ($guru_id == $list_video['guruID']) {
  $row[] = ' 
  <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
  data-id='."'".json_encode($list_video)."'".'
  onclick="detail('."'".$list_video['videoID']."'".')"
  >
  <i class=" ico-play3"></i>
  </a> 
  <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
  )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
}else{ 
 $row[] = '
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a>  ';
}



$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

    // menampilkan data by subbab video
function ajax_get_subbab_video($subbab){
  $data['videos_uploaded'] = $this->load->mvideos->get_subbab_video($subbab);
       // var_dump($data['videos_uploaded']);
  $list = $data['videos_uploaded'];
  $data = array();

  $baseurl = base_url();
  foreach ( $list as $list_video ) {
    $n='1';
    $row = array();
    if ($list_video['published']=='1') {
      $publish='Publish';
    }else{
      $publish='No Publish';
    }
    $row[] = $list_video['videoID'];
    $row[] = $list_video['judulVideo'];
    $row[] = $list_video['namaFile'];
    $row[] = $list_video['matapelajaran'];
    $row[] = $list_video['judulBab'];
    $row[] = $list_video['judulSubBab'];
    $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
    $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
    $row[] =  $publish;
    $guru_id =null;
    if (isset( $this->session->userdata['id_guru'])) {
      $guru_id =$this->session->userdata['id_guru'] ;

    }
    if ($guru_id == null) {
      $row[] = ' 
      <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
      data-id='."'".json_encode($list_video)."'".'
      onclick="detail('."'".$list_video['videoID']."'".')"
      >
      <i class=" ico-play3"></i>
      </a> 
      <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
      )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
} elseif ($guru_id == $list_video['guruID']) {
  $row[] = ' 
  <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
  data-id='."'".json_encode($list_video)."'".'
  onclick="detail('."'".$list_video['videoID']."'".')"
  >
  <i class=" ico-play3"></i>
  </a> 
  <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
  )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
}else{ 
 $row[] = '
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a>  ';
}



$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

    // menampilkan data by bab video
function ajax_get_bab_video($bab){
  $data['videos_uploaded'] = $this->load->mvideos->get_bab_video($bab);
       // var_dump($data['videos_uploaded']);
  $list = $data['videos_uploaded'];
  $data = array();

  $baseurl = base_url();
  foreach ( $list as $list_video ) {
    $n='1';
    $row = array();
    if ($list_video['published']=='1') {
      $publish='Publish';
    }else{
      $publish='No Publish';
    }
    $row[] = $list_video['videoID'];
    $row[] = $list_video['judulVideo'];
    $row[] = $list_video['namaFile'];
    $row[] = $list_video['matapelajaran'];
    $row[] = $list_video['judulBab'];
    $row[] = $list_video['judulSubBab'];
    $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
    $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
    $row[] =  $publish;
    $guru_id =null;
    if (isset( $this->session->userdata['id_guru'])) {
      $guru_id =$this->session->userdata['id_guru'] ;

    }
    if ($guru_id == null) {
     $row[] = ' 
     <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
     data-id='."'".json_encode($list_video)."'".'
     onclick="detail('."'".$list_video['videoID']."'".')"
     >
     <i class=" ico-play3"></i>
     </a> 
     <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
     )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
} elseif ($guru_id == $list_video['guruID']) {
  $row[] = ' 
  <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
  data-id='."'".json_encode($list_video)."'".'
  onclick="detail('."'".$list_video['videoID']."'".')"
  >
  <i class=" ico-play3"></i>
  </a> 
  <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
  )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
}else{ 
 $row[] = '
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a>  ';
}



$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

     // menampilkan data by bab mapel
function ajax_get_mapel_video($mapel){
  $data['videos_uploaded'] = $this->load->mvideos->get_mapel_video($mapel);
       // var_dump($data['videos_uploaded']);
  $list = $data['videos_uploaded'];
  $data = array();

  $baseurl = base_url();
  foreach ( $list as $list_video ) {
    $n='1';
    $row = array();
    if ($list_video['published']=='1') {
      $publish='Publish';
    }else{
      $publish='No Publish';
    }
    $row[] = $list_video['videoID'];
    $row[] = $list_video['judulVideo'];
    $row[] = $list_video['namaFile'];
    $row[] = $list_video['matapelajaran'];
    $row[] = $list_video['judulBab'];
    $row[] = $list_video['judulSubBab'];
    $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
    $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
    $row[] =  $publish;
    $guru_id =null;
    if (isset( $this->session->userdata['id_guru'])) {
      $guru_id =$this->session->userdata['id_guru'] ;

    }
    if ($guru_id == null) {
      $row[] = ' 
      <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
      data-id='."'".json_encode($list_video)."'".'
      onclick="detail('."'".$list_video['videoID']."'".')"
      >
      <i class=" ico-play3"></i>
      </a> 
      <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
      )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
} elseif ($guru_id == $list_video['guruID']) {
  $row[] = ' 
  <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
  data-id='."'".json_encode($list_video)."'".'
  onclick="detail('."'".$list_video['videoID']."'".')"
  >
  <i class=" ico-play3"></i>
  </a> 
  <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
  )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
}else{ 
 $row[] = '
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a>  ';
}



$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

         // menampilkan data by bab mapel
function ajax_get_tingkat_video($tingkat){
  $data['videos_uploaded'] = $this->load->mvideos->get_tingkat_video($tingkat);
       // var_dump($data['videos_uploaded']);
  $list = $data['videos_uploaded'];
  $data = array();

  $baseurl = base_url();
  foreach ( $list as $list_video ) {
    $n='1';
    $row = array();
    if ($list_video['published']=='1') {
      $publish='Publish';
    }else{
      $publish='No Publish';
    }
    $row[] = $list_video['videoID'];
    $row[] = $list_video['judulVideo'];
    $row[] = $list_video['namaFile'];
    $row[] = $list_video['matapelajaran'];
    $row[] = $list_video['judulBab'];
    $row[] = $list_video['judulSubBab'];
    $row[] = substr($list_video['deskripsi'], 0, 100)." <a href=''>Read More</a>";
    $row[] = $list_video['namaDepan']." ".$list_video['namaBelakang'];
    $row[] =  $publish;
    $guru_id =null;
    if (isset( $this->session->userdata['id_guru'])) {
      $guru_id =$this->session->userdata['id_guru'] ;

    }
    if ($guru_id == null) {
     $row[] = ' 
     <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
     data-id='."'".json_encode($list_video)."'".'
     onclick="detail('."'".$list_video['videoID']."'".')"
     >
     <i class=" ico-play3"></i>
     </a> 
     <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
     )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
} elseif ($guru_id == $list_video['guruID']) {
 $row[] = ' 
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a> 
 <a class="btn btn-sm btn-warning" href="videoback/formUpdateVideo/'.$list_video['UUID'].'"  title="Ubah Video"
 )"
>
<i class="ico-file5"></i>
</a> 
<a class="btn btn-sm btn-danger"  
title="Hapus" onclick="drop_video('."'".$list_video['videoID']."'".')">
<i class="ico-remove"></i></a> 
';
}else{ 
 $row[] = '
 <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
 data-id='."'".json_encode($list_video)."'".'
 onclick="detail('."'".$list_video['videoID']."'".')"
 >
 <i class=" ico-play3"></i>
 </a>  ';
}



$data[] = $row;
$n++;

}

$output = array(
  "data"=>$data,
  );
echo json_encode( $output );
}

//list daftar video tidak menggunkan datatable
public function daftarvideo()
{

       $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_video();
       
        $config['base_url'] = base_url().'index.php/videoback/daftarvideo/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;

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
        $list = $this->Mvideoback->data_video($config['per_page'],$from);

        // var_dump($list);
        $this->tampVideo($list);
}

public function tampVideo($list='')
{

    $data['judul_halaman'] = "List Video";
    $data['files'] = array(
            APPPATH . 'modules/Videoback/views/v-tamp-video.php',
            );
    $data['list']=array();
    foreach ($list as $key ) {
      $namaFile=$key['namaFile'];
      $thumbnail=$key['thumbnail'];
      $link=$key['link'];
      $publish=$key['published'];
      $video='<div style="width:250px ;height:110px; "><div class="ml10 mr10 "><h3>Tidak ada File video</div></h3></div>';
      $hapus='<a href="javascript:void(0);" class="btn btn-danger" title="Hapus" onclick="drop_video('.$key["id"].')"><i class="ico-remove"></i></a>';
      $ubah=' <a href="'.base_url().'videoback/formUpdateVideo/'.$key["UUID"].'" class="btn btn-warning" title="Ubah"><i class="ico-file5"></i></a>';
      $lihat='<a href="javascript:void(0);" class="btn btn-success detail-'.$key['id'].'" title="Lihat" data-id='."'".json_encode($key)."'".' onclick="detail('."'".$key['id']."'".')"><i class="ico-facetime-video" ></i></a>';
      // pengecekan file video atau link video
      if ($namaFile != '' && $namaFile != ' ' && $thumbnail !=' ' && $thumbnail !='' && $thumbnail !='default' ) {
        
        $video = '<img data-toggle="unveil" src="'.base_url().'assets/image/thumbnail/'.$thumbnail.'" data-src="'.base_url().'assets/image/thumbnail/'.$thumbnail.'" alt="Cover" width="250px" height="150px" style="background:#E6E2E2;"></img>';
      }elseif($namaFile != '' && $namaFile != ' '){
        
        $mapel=$key['mapel'];
        //generate avatar
        $thumbnail=$this->generateavatar->generate_first_letter_avtar_url($mapel);
        $video = '
        <div class="jumbotron jumbotron-bg7 nm"  data-stellar-background-ratio="0.4" style="width:100%; height:150px;">
        <div class="pattern pattern2 overlay overlay-primary"></div>
          <div class="container text-center" style="padding-top:8%;">
              <img class=" img-circle img-bordered" data-toggle="unveil" src="'. $thumbnail.'" data-src="" alt="Cover" style=" margin: 0 auto;" ></img>
            <p class=" semibold mb0 mt15">'.$mapel.'</p>
          </div>
        </div>';
      }
      elseif($link != '' && $link != ' '){
        $video = '<iframe  src="'.$link.'"  controls id="video-ply-link" width="100%"  style="max-width:400px; max-height:250px;">
        </iframe>';
      }
        $timestamp = strtotime($key['date_created']);
         $tgl=date("M-Y", $timestamp);
      $data['list'][]=array(
                'judulVideo'=>substr($key['judulVideo'],  0, 25),
                'video'=>$video,
                'deskripsi'=>$key['deskripsi'],
                'date_created'=>$tgl,
                'mapel'=>$key['mapel'],
                'bab'=>$key['judulBab'],
                'subbab'=>substr($key['judulSubBab'],  0, 25),
                'hapus'=>$hapus,
                'ubah'=>$ubah,
                'lihat'=>$lihat
                );
    }

    #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
                $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
          // jika guru
          // notification
          $data['datKomen']=$this->datKomen();
          $id_guru = $this->session->userdata['id_guru'];
           // get jumlah komen yg belum di baca
          $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
          //
          $this->parser->parse('templating/index-b-guru', $data);
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
}
// pencarian autocomplate
public function autocompletevideo()
{
  $keyword = $_GET['term'];
        // cari di database
     $data = $this->Mvideoback->get_carivideo($keyword);  
        // format keluaran di dalam array
     $arr = array();
     foreach($data as $row)
     {
      $arr[] = array(
          'value' =>$row['judulVideo'],
          // 'url'=>base_url('videoback/carivideo')."/".$row['judulVideo'],
      );
    }
    echo json_encode($arr);
}

public function carivideo()
{
  $keyword = $this->input->post('keyword');
  $data = $this->Mvideoback->get_carivideo($keyword); 

    $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_carivideo($keyword);
       
        $config['base_url'] = base_url().'index.php/videoback/daftarvideo/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 20;

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
        $list = $this->Mvideoback->data_video_cari($config['per_page'],$from,$keyword);

        $this->tampVideo($list);
}
// create pagination list video by tingkat
 public function listvideoTingkat($tingkatID="")
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_video_tingkat($tingkatID);
        
        $config['base_url'] = base_url().'index.php/videoback/listvideoTingkat/'.$tingkatID.'/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;

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
        
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);     
        $list = $this->Mvideoback->data_video_tingkat($config['per_page'],$from,$tingkatID);
        $this->tampVideo($list);
    }

    // create pagination list video by mapel
     public function listvideoMp($mpID='')
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_video_mp($mpID);
        
        $config['base_url'] = base_url().'index.php/videoback/listvideoMp/'.$mpID.'/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;

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
        
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);     
        $list = $this->Mvideoback->data_video_mp($config['per_page'],$from,$mpID);


        $this->tampVideo($list);
    }

     // create pagination list video by bab
     public function listvideoBab($babID='')
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_video_bab($babID);
        
        $config['base_url'] = base_url().'index.php/videoback/listvideoBab/'.$babID.'/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;

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
        
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);     
        $list = $this->Mvideoback->data_video_bab($config['per_page'],$from,$babID);


        $this->tampVideo($list);
    }

     // create pagination list video by bab
     public function listvideoSubBab($subBabID='')
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mvideoback->jumlah_video_subbab($subBabID);
        
        $config['base_url'] = base_url().'index.php/videoback/listvideoBab/'.$subBabID.'/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;

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
        
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);     
        $list = $this->Mvideoback->data_video_subbab($config['per_page'],$from,$subBabID);


        $this->tampVideo($list);
    }

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
