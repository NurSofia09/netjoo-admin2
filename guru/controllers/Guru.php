<?php

/**
 *
 */
class Guru extends MX_Controller {
  private $idGuru;

  public function __construct() {
    $this->load->helper( 'session' );
    parent::__construct();
    $this->load->model( 'mguru' );
    $this->load->model( 'video/mvideos' );
    $this->load->model( 'komenback/mkomen' );
    $this->load->model( 'konsultasi/mkonsultasi' );

    $this->load->model( 'register/mregister' );
    $this->load->model('templating/mtemplating');
    $this->load->model('siswa/msiswa');
    $this->load->library('parser');
    $this->load->library('pagination');
    $this->load->helper( array( 'form', 'url' ) );
    $this->load->library( 'form_validation' );
    $this->load->library('generateavatar');

  }

    //set get untuk session
    // public function setGuruId() {
    //     $this->idGuru = $this->session->userdata['id_guru'];
    // }

  public function getGuruId() {
    return $this->idGuru;
  }
    // function untuk menampikan halam pertama saat registrasi
  function index() {

  }

  public function checkJumlahPostingan() {

  }

  public function videobyteacher() {
        // $this->setGuruId();
    $penggunaID=$this->session->userdata['id'];
    $guru_id = $this->getGuruId();
    $data['videos_uploaded'] = $this->load->mvideos->get_video_by_teacher( $guru_id );
        //var_dump($data);
        //untuk mengambil data guru
    $data['data_guru'] = $this->load->mguru->get_single_guru( $penggunaID )[0];
    $namaDepan=$data['data_guru']['namaDepan'];
    $photo = $data['data_guru']['photo'];
    if ($photo=='' || $photo==' ' || $photo=='default.jpg') {
      $data['photo']= $this->generateavatar->generate_first_letter_avtar_url($namaDepan);
    } else {
      $data['photo']=base_url()."assets/image/photo/guru/".$photo;
    }

        //untuk menghitung berapa banyak video yang sudah diupload
    $data['jumlah_video'] = count( $this->load->mvideos->get_video_by_teacher( $guru_id ) );
       // var_dump($data);
    return $data;
  }
  function jumlah_komen(){
    $data['new_count_komen'] = $this->db->where('read_status',0)->count_all_results('tb_komen');
    $data['new_count_konsultasi'] = $this->db->where('statusRespon = 0 and mentorID='.$this->session->userdata('id_guru'))->count_all_results('tb_k_pertanyaan');
    $keahlian_detail=($this->mguru->get_m_keahlianGuru($this->session->userdata('id_guru')));
    $mapel_id ="";
    foreach ($keahlian_detail as $key) {
      $mapel_id =$mapel_id."".$key['mapelID'].",";
    }
    $data['keahlian_detail'] = $this->mkonsultasi->get_pertanyaan_number_mentor(substr_replace($mapel_id, "", -1));
  // print_r($data['keahlian_detail']);
    return ($data['new_count_komen'] + $data['new_count_konsultasi'] + $data['keahlian_detail']);
  }

  public function dashboard() {
    $data = $this->videobyteacher();
        #Sesudah Tempalting#
        //get data komen yg belum di baca
    $data['datKomen']=$this->datKomen();
    $data['konsultasi'] = $this->mkonsultasi->get_pertanyaan_blm_direspon();
    $data['judul_halaman'] = "Dashboard";
    $data['files'] = array(
      APPPATH . 'modules/guru/views/v-container-video.php',
      );
         #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
          // jika admin
      $this->parser->parse('admin/v-index-admin', $data);
    } elseif($hakAkses=='guru'){
          ##count komen
          //get id guru
      $id_guru = $this->session->userdata['id_guru'];
          // get jumlah komen yg belum di baca
      $data['count_konsultasi'] = count($data['konsultasi']);

      $data['count_komen']=$this->jumlah_komen();
          // print_r($data['count_komen']);
          ## count komen
      $data["keahlian"]=$this->get_keahlianGuru($id_guru,0);
      $data['keahlian_detail']=json_encode($this->mguru->get_m_keahlianGuru($id_guru));

          // id keahlian
      $keahlian_detail=($this->mguru->get_m_keahlianGuru($this->session->userdata('id_guru')));
      $mapel_id ="";
      foreach ($keahlian_detail as $key) {
        $mapel_id =$mapel_id."".$key['mapelID'].",";
      }
  // id keahlian
      $data['notif_pertanyaan_mentor'] = $this->mkonsultasi->get_notif_pertanyaan_to_teacher(substr_replace($mapel_id, "", -1));

          // jika guru
      $this->parser->parse('templating/index-b-guru', $data);
    }else{
        // jika siswa redirect ke welcome
      redirect(site_url('login'));
    }
    #END Cek USer#
  }

    //menampilkan video manager untuk user
  public function videomanager() {
    redirect( '/videoback' );
  }

    //halaman untuk mengupload  video
  public function uploadvideo() {
    redirect( '/videoback' );
  }


    //untuk merubah data guru.
  public function setting() {
    $this->load->view( 'templating/t-header' );
    $this->load->view( 'vProfileGuru' );
    $this->load->view( 'templating/t-footer' );
  }
  //untuk menampilkan form updt guru
  public function pengaturanProfileguru() {
  //get data komen yg belum di baca
    $data['datKomen']=$this->datKomen();
  ##count komen
  //get id guru
    $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
    $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
  ## count komen
  // get matapelajaran untuk dropdwon
    $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
    $penggunaID=$this->session->userdata['id'] ;  
  //get data guru by penggunaID
    $arrGuru = $this->mguru->get_datguru( $penggunaID);
    $guruID=$arrGuru[0]['id'];
    $namaDepan=$arrGuru[0]['namaDepan'];
    $photo=$arrGuru[0]['photo'];
    $data['guru']=$arrGuru[0];
  //#get mapel guru
    $data['guruMapel']=$this->get_keahlianGuru($guruID,1);
  //#
  //
  //cek jika belum ada foto atau masih default 
    if ($photo=='' || $photo==' ' || $photo=='default.jpg') {
    //jika true generate foto default
      $data['photo']= $this->generateavatar->generate_first_letter_avtar_url($namaDepan);
      $data['oldphoto']='';
    } else {
    //jika false set foto dengan data yg di db
      $data['photo']=base_url()."assets/image/photo/guru/".$photo;
      $data['oldphoto']=$photo;
    }

    $data['eMail']=$this->session->userdata['eMail'];

    $data['files'] = array(
      APPPATH . 'modules/guru/views/vPengaturanProfileGuru.php',
      );
    $data['judul_halaman'] = "Pengaturan Profile Guru";
    $this->parser->parse('templating/index-b-guru', $data);
  }

  public function ubahprofileguru() {

        //load library n helper
    $this->load->helper( array( 'form', 'url' ) );
    $this->load->library( 'form_validation' );


        //syarat pengisian form perubahan profile
    $this->form_validation->set_rules( 'namadepan', 'Nama Depan', 'required' );
    $this->form_validation->set_rules( 'alamat', 'Alamat', 'required' );
    $this->form_validation->set_rules( 'nokontak', 'No Kontak', 'required' );
    ;

        //pesan error atau pesan kesalahan pengisian form
    $this->form_validation->set_message( 'is_unique', '*Nama Pengguna sudah terpakai' );
    $this->form_validation->set_message( 'max_length', '*Nama Pengguna maksimal 12 karakter!' );
    $this->form_validation->set_message( 'min_length', '*Nama Pengguna minimal 5 karakter!' );
    $this->form_validation->set_message( 'required', '*tidak boleh kosong!' );


    //pengecekan inputan / pengisian form
    if ( $this->form_validation->run() == FALSE ) {
      $this->pengaturanProfileguru();
    } else {
      $namaDepan = htmlspecialchars( $this->input->post( 'namadepan' ) );
      $namaBelakang = htmlspecialchars( $this->input->post( 'namabelakang' ) );
      $alamat = htmlspecialchars( $this->input->post( 'alamat' ) );
      $noKontak = htmlspecialchars( $this->input->post( 'nokontak' ) );
      $biografi = htmlspecialchars( $this->input->post( 'biografi' ) );
      $data_post = array(
        'namaDepan' => $namaDepan,
        'namaBelakang' => $namaBelakang,

        'alamat' => $alamat,
        'noKontak' => $noKontak,
        'biografi' => $biografi,
        );

      $this->mguru->update_guru( $data_post );
        //update guru mapel
      $guruID=$this->session->userdata['id_guru'] ;
      $sumMapel=htmlspecialchars($this->input->post('sumMapel'));  
      $reset=htmlspecialchars($this->input->post('reset'));  
      if ($sumMapel!=0 && $reset==1) {
        $this->mguru->del_guruMapel($guruID);
      }
      for ($i=1; $i <= $sumMapel ; $i++) { 
        $datArr['mapelID']=$this->input->post('mapelIDke-'.$i);
        $datArr['guruID']=$guruID;
        $this->mregister->in_guruMapel($datArr);
      }
      redirect(site_url('guru/dashboard'));
    }
  }

  public function ubahakunguru() {

        //load library n helper
    $this->load->helper( array( 'form', 'url' ) );
    $this->load->library( 'form_validation' );


        //load library n helper
    $this->load->helper( array( 'form', 'url' ) );
    $this->load->library( 'form_validation' );

        //syarat pengisian form perubahan nama pengguna dan email
    $this->form_validation->set_rules( 'namapengguna', 'Nama Pengguna', 'trim|required|min_length[5]|max_length[12]|is_unique[tb_pengguna.namaPengguna]' );
    $this->form_validation->set_rules( 'email', 'Email', 'required|is_unique[tb_pengguna.email]' );

        //pesan error atau pesan kesalahan pengisian form
    $this->form_validation->set_message( 'is_unique', 'email', '*Email sudah terpakai' );
    $this->form_validation->set_message( 'is_unique', '*Nama Pengguna sudah terpakai' );
    $this->form_validation->set_message( 'max_length', '*Nama Pengguna maksimal 12 karakter!' );
    $this->form_validation->set_message( 'min_length', '*Nama Pengguna minimal 5 karakter!' );
    $this->form_validation->set_message( 'required', '*tidak boleh kosong!' );


    if ( $this->form_validation->run() == FALSE ) {
      $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
      $penggunaID=$this->session->userdata['id'] ;  
        //get data guru by penggunaID
      $data['guru'] = $this->mguru->get_datguru( $penggunaID);
      $this->load->view( 'templating/t-header' );
      $this->load->view( 'vPengaturanProfileGuru',$data );
      $this->load->view( 'templating/t-footer' );
    } else {
      $namaPengguna = htmlspecialchars( $this->input->post( 'namapengguna' ) );
      $email = htmlspecialchars( $this->input->post( 'email' ) );
      $data_post = array(
        'namaPengguna' => $namaPengguna,
        'email' => $email,
        );
      $this->mguru->update_akun( $data_post );
    }
  }

  public function ubahkatasandi() {

        //load library n helper
    $this->load->helper( array( 'form', 'url' ) );
    $this->load->library( 'form_validation' );


        //syarat pengisian form perubahan pasword
    $this->form_validation->set_rules( 'sandilama', 'Kata Sandi Lama', 'required' );
    $this->form_validation->set_rules( 'newpass', 'Kata Sandi Baru', 'required|matches[verifypass]' );
    $this->form_validation->set_rules( 'verifypass', 'Password Confirmation', 'required' );

        //pesan error atau pesan kesalahan pengisian form
    $this->form_validation->set_message( 'required', '*tidak boleh kosong!' );
    $this->form_validation->set_message( 'matches', '*Kata Sandi tidak sama!' );


    if ( $this->form_validation->run() == FALSE ) {
     $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
     $penggunaID=$this->session->userdata['id'] ;  
        //get data guru by penggunaID
     $data['guru'] = $this->mguru->get_datguru( $penggunaID);
     $this->load->view( 'templating/t-header' );
     $this->load->view( 'vPengaturanProfileGuru',$data );
     $this->load->view( 'templating/t-footer' );
   } else {
    $kataSandi = htmlspecialchars( md5( $this->input->post( 'newpass' ) ) );

    $data_post = array(
      'kataSandi' => $kataSandi,
      );
    $this->mguru->update_katasandi( $data_post );
  }
}

public function upload($oldphoto) {
  unlink( FCPATH . "./assets/image/photo/guru/".$oldphoto );
  $config['upload_path'] = './assets/image/photo/guru';
  $config['allowed_types'] = 'jpeg|gif|jpg|png';
  $config['max_size'] = 100;
  $config['max_width'] = 1024;
  $config['max_height'] = 768;
  $this->load->library('upload', $config);

  if (!$this->upload->do_upload('photo')) {


    $data['error'] = array('error' => $this->upload->display_errors());
    var_dump($data['error'])  ;
            // $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
            // $data['guru'] = $this->mguru->get_datguru();
            // $data['files'] = array(
            // APPPATH . 'modules/guru/views/vPengaturanProfileGuru.php');
            // $data['judul_halaman'] = "Pengaturan Profile Guru";
            //  $this->parser->parse('templating/index-b-guru', $data);

  } else {
    $file_data = $this->upload->data();
    $photo = $file_data['file_name'];
    $this->mguru->update_photo($photo);
  }
}

    // ubah email guru
public function ubahemailGuru() {

        //load library n helper
  $this->load->helper( array( 'form', 'url' ) );
  $this->load->library( 'form_validation' );


        //load library n helper
  $this->load->helper( array( 'form', 'url' ) );
  $this->load->library( 'form_validation' );

        //syarat pengisian form perubahan nama pengguna dan email

  $this->form_validation->set_rules( 'email', 'email', 'required|is_unique[tb_pengguna.eMail]' );

        //pesan error atau pesan kesalahan pengisian form
  $this->form_validation->set_message( 'is_unique', '*Email sudah terpakai' );
  $this->form_validation->set_message( 'required', '*tidak boleh kosong!' );


  if ( $this->form_validation->run() == FALSE ) {
    $this->pengaturanProfileguru();
  } else {
    $email = htmlspecialchars( $this->input->post( 'email' ) );

    $data_post = array(
      'eMail' => $email,
      );
    $this->msiswa->update_email( $data_post );
    redirect(site_url('guru/dashboard'));
  }

}


## Menampilkan daftar guru
// public function daftar(){
//     $data['mataPelajaran'] = $this->mregister->get_matapelajaran();
//     $data['judul_halaman'] = "Daftar Guru";
//     $data['files'] = array(
//         APPPATH . 'modules/register/views/v-daftar-guru.php',
//         );
//             // jika admin
//     $this->parser->parse('admin/v-index-admin', $data);
// }

## ajax menampilkan data guru
// function ajax_list_guru(){
//     $list  = $this->mguru->get_teacher_user();


//     $data = array();
//     $no = 0;
//     foreach ($list as $teacheritem) {
//         $row = array();
//         $no++;
//         $guruID=$teacheritem['guruID'];
//         $kelas = "btn btn-sm btn-primary detail-".$teacheritem['guruID'];
//         $row[] = $no;
//         $row[] = $teacheritem['namaDepan']." ".$teacheritem['namaBelakang'];
//         $row[] = $teacheritem['namaPengguna'];
//          $row[] = $this->get_keahlianGuru($guruID);
//         $row[] = $teacheritem['regTime'];
//         $row[] = '<a href=""  title="Mail To" onclick="edit_teacher('."'".$teacheritem['guruID']."'".')">'.$teacheritem['eMail'].'<i class="ico-mail-send"></i></a>';

//         $row[] = '<a class="btn btn-sm btn-warning"  title="Edit" onclick="edit_teacher('."'".$teacheritem['guruID']."'".')"><i class="ico-edit"></i></a>

//         <a class='."'".$kelas."'".' data-todo='."'".json_encode($teacheritem)."'".' title="Detail" onclick="detail_teacher('."'".$teacheritem['guruID']."'".')"><i class="ico-file5"></i></a>

//         <a class="btn btn-sm btn-danger"  title="Hapus" onclick="delete_teacher('."'".$teacheritem['guruID']."'".','."'".$teacheritem['penggunaID']."'".')"><i class="ico-remove"></i></a>';
//         $data[] = $row;
//     }
//     $output = array("data"=>$data);
//     echo json_encode($output);
// }

// <span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'+i+'"> <i class="ico-remove" onClick="removeMapel('+i+','+idMapel+')"></i> '+mapel+' </span> <input type="text" name="mapelIDke-'+i+'" value="'+idMapel+'" hidden="true" id="mapelIDke-'+i+'">

public function get_keahlianGuru($guruID='',$form='')
{
  $datkeahlianGuru=$this->mguru->get_m_keahlianGuru($guruID);
    // var_dump($datkeahlianGuru);
  $keahlianGuru='';
  $i=1;
  if ($form==1) {
    foreach ($datkeahlianGuru as $key ) {
      $keahlianGuru .='<span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'.$i.'"> <i class="ico-remove" onClick="removeMapel('.$i.','.$key["mapelID"].')"></i> '.$key["aliasMataPelajaran"].' </span> <input type="text" name="mapelIDke-'.$i.'" value="'.$key["mapelID"].'" hidden="true" id="mapelIDke-'.$i.'">';
      $i++;
    }
  } else {
    foreach ($datkeahlianGuru as $key ) {
      $keahlianGuru .=$key['aliasMataPelajaran'].', ';
    }
  }


  if ($datkeahlianGuru) {
    return $keahlianGuru;
  } else {
    return '<p style="color:red;">Belum Memilih keahlian mengajar</p>';
  }  
}
// hapus data guru
function drop_teacher(){
  $guruID=$this->input->post("guruID");
  $penggunaID=$this->input->post("penggunaID");
  $this->mguru->drop_guru( $guruID,$penggunaID );
}

function get_avatar_guru(){
  $avatar = $this->mguru->get_avatar();
  $nama=$this->session->userdata['NAMAGURU'];
  if ($avatar=='' || $avatar==' ' || $avatar=='default.jpg') {
    $photo= $this->generateavatar->generate_first_letter_avtar_url($nama);
  } else {
   $photo =  base_url()."assets/image/photo/guru/".$avatar;
 }

 echo "<img src=".$photo." class='img-circle' alt='' />";
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
        // $listKomen = $this->mkomen->get_all_komen();
  }

  return $listKomen;
}

public function daftar()
{
 $this->load->database();
 $jumlah_data = $this->mguru->jumlah_guru();

 $config['base_url'] = base_url().'guru/daftar/';
 $config['total_rows'] = $jumlah_data;
 $config['per_page'] = 2;

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
 $list = $this->mguru->data_guru($config['per_page'],$from);
 $this->tampGuru($list,$jumlah_data);
}

public function tampGuru($list='',$jumlah_data='')
{
  $data['judul_halaman'] = "Pengelolaan Data Guru";
  $data['files'] = array(
    APPPATH . 'modules/guru/views/v-daftar-guru.php',
    );
  $data['datGuru']=$list;

  $tb_guru=null;
  $no=1;
  foreach ($list as $key ) {
    $datReset=$key["penggunaID"].",'".$key["namaPengguna"]."'";
    $datChEmail=$key["penggunaID"].",'".$key["eMail"]."'";
    $guruID=$key['guruID'];
    $mengajar=$this->get_keahlianGuru($guruID);
    $datas="'".json_encode($key)."'";
    $tb_guru.='
    <tr class="tr-'.$no.'" >
      <td>'.$no.'</td>
      <td>'.$key["namaPengguna"].'</td>
      <td>'.$key["namaDepan"].' '.$key["namaBelakang"].'</td>
      <td>'.$mengajar.'</td>
      <td>'.$key["eMail"].'</td>
      <td>'.$key["regTime"].'</td>
      <td>
        <button class="btn btn-sm btn-info"  title="Lihat Detail Data Guru" data-todo='. $datas.' onclick="detail('.$no.')" id="data-'.$no.'"><i class="ico-folder-open-alt"></i></button>
        <button class="btn btn-sm btn-warning" title="Ubah Email" onclick="modalChEmail('.$datChEmail.')"><i class=" ico-envelop2"></i></button>
        <button class="btn btn-sm btn-danger" title="Reset Katasandi" onclick="resetSandi('.$datReset.')"><i class=" ico-key"></i></button>
        <button class="btn btn-sm btn-danger" title="Hapus Data guru" onclick="del_guru('.$no.')"><i class="ico-remove2"></i></button>
      </td>
    </tr>
    ';
    $no++;
  }
  $data['tb_guru']=$tb_guru;
  $data['jumlahGuru']=$jumlah_data;



  $hakAkses=$this->session->userdata['HAKAKSES'];
  if ($hakAkses=='admin') {
    $this->parser->parse('admin/v-index-admin', $data);
  } elseif($hakAkses=='guru'){
      // jika guru
      // $this->parser->parse('templating/index-b-guru', $data);
  }else{
      // jika siswa redirect ke welcome
    redirect(site_url('welcome'));
  }
}

  // reset sandi penggunaID 
public function resetPassword()
{
  $penggunaID=$this->input->post('penggunaID');
  $namaPengguna=$this->input->post('namaPengguna');
  $date=date("d");
  $newPassword=$namaPengguna.$date;
    //m5 katasandi
  $md5Sandi=md5($newPassword);
  $this->mguru->ch_password($md5Sandi,$penggunaID);
    // return kata sandi baru
  echo json_encode($newPassword);
}

  //update email
public function updateEmail()
{
  $penggunaID=$this->input->post('penggunaID');
  $newEmail=$this->input->post('email');

  $this->form_validation->set_rules( 'email', 'email', 'required|is_unique[tb_pengguna.eMail]' );
  if ( $this->form_validation->run() == FALSE ) {
    $msg="FALSE";
    echo json_encode($msg);
  }else{
    $this->mguru->ch_email($newEmail,$penggunaID);
    echo json_encode($newEmail);
  }
  


}

public function updateDatGuru()
{
  $data['id']=$this->input->post('guruID');
  $data['namaDepan']=$this->input->post('namaDepan');
  $data['namaBelakang']=$this->input->post('namaBelakang');
  $data['alamat']=$this->input->post('alamat');
  $data['nokontak']=$this->input->post('nokontak');
  $data['biografi']=$this->input->post('biografi');

  $this->mguru->ch_guru($data);
}

public function cekNamaPengguna()
{
 $this->form_validation->set_rules( 'namapengguna', 'namapengguna', 'required|is_unique[tb_pengguna.namaPengguna]' );
 if ( $this->form_validation->run() == FALSE ) {
  echo json_encode("FALSE");
}else{
  echo json_encode("TRUE");
}

}

  // cek input email
public function cekEmail()
{
  $this->form_validation->set_rules( 'email', 'email', 'required|is_unique[tb_pengguna.eMail]' );
  if ( $this->form_validation->run() == FALSE ) {
    echo json_encode("FALSE");
  }else{
    echo json_encode("TRUE");
  }
}

  // get mapel guru
public function get_mapelGuru()
{
 $mapel='';
 $no=1;
 $guruID=$this->input->post('guruID');
 $arrMapel=$this->mguru->get_mapel_by_guruID($guruID);
 if ($arrMapel!=array()) {
  foreach ($arrMapel as $key ) {
    $mapel.='<span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'.$no.'"> <i class="ico-remove" onClick="removeMapel('.$no.','.$key["mapelID"].')"></i> '.$key["aliasMataPelajaran"].' </span> <input type="text" name="mapelIDke-'.$no.'" value="'.$key["mapelID"].'" hidden="true" id="mapelIDke-'.$no.'">';
    $no++;
  }
  echo json_encode($mapel);
} else {
  echo json_encode("FALSE");
}
}

public function get_allMapel()
{
  $allMapel='';
  $arrMapel=$this->mguru->get_all_mapel();
  if ($arrMapel!=array()) {
    foreach ($arrMapel as $key ) {
      $allMapel.='<option class="op" value="'.$key['id'].'" id="id-'.$key['id'].'">'.$key['aliasMataPelajaran'].'</option>';
    }
    echo json_encode($allMapel);
  } else {
    echo json_encode("FALSE");
  }

}
  // update data guru
public function update_guru_jsonDat()
{
  $guruID = $this->input->post('guruID');
  $data['id']=$guruID;
  $data['namaDepan']=htmlspecialchars($this->input->post('namaDepan'));
  $data['namaBelakang']=htmlspecialchars($this->input->post('namaBelakang'));
  $data['alamat']=htmlspecialchars($this->input->post('alamat'));
  $data['nokontak']=htmlspecialchars($this->input->post('nokontak'));
  $data['biografi']=htmlspecialchars($this->input->post('biografi'));
  $this->mguru->ch_guru($data);

  $sumMapel=htmlspecialchars($this->input->post('sumMapel'));

  if ($sumMapel!=0) {
    $this->mguru->del_guruMapel($guruID);
  }
  for ($i=1; $i <= $sumMapel ; $i++) { 
    $datArr['mapelID']=$this->input->post('mapelIDke-'.$i);
    $datArr['guruID']=$guruID;
    $this->mregister->in_guruMapel($datArr);
  }
  echo json_encode( "berhasil");
}

public function ajax_mapelID()
{
  $guruID=$this->session->userdata['id_guru'];
  $arrMapel=$this->mguru->get_m_keahlianGuru($guruID);
  echo json_encode($arrMapel);
}

public function cariGuru($key=''){
  if ($key=='') {
    $key=htmlspecialchars($this->input->get('keyword'));
  } 

       // code u/ pagination
  $this->load->database();
  $jumlah_data = $this->mguru->sum_cari_guru($key);

  $config['base_url'] = base_url().'index.php/guru/cariGuru/'.$key.'/';
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

  $from = $this->uri->segment(4);
  $this->pagination->initialize($config);     
  $list = $this->mguru->data_guru_cari($config['per_page'],$from,$key);

  $this->tampGuru($list,$jumlah_data);

}

}
?>
