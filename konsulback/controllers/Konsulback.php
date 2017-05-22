<?php 
 /**
  * 
  */
 class Konsulback extends MX_Controller
 {
  private $limit = 10;
  function __construct()
  {
    $this->load->helper( 'session' );
    parent::__construct();
    $this->load->model( 'Mkonsulback' );
    $this->load->library('parser');
    $this->load->model('konsultasi/mkonsultasi');
    $this->load->model('guru/mguru');

    $this->load->model('tryout/mtryout');
    $this->load->model('tingkat/mtingkat');
    $this->load->model('matapelajaran/mmatapelajaran');
    $this->load->model('komenback/mkomen');
    $this->load->library('sessionchecker');
    $this->sessionchecker->checkloggedin();
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

    //history di guru 
  public function myhistory()
  {
      $data['count_komen']=$this->jumlah_komen();
    $data['konsultasi'] = $this->mkonsultasi->get_pertanyaan_blm_direspon();
      $data['count_konsultasi'] = count($data['konsultasi']);

    $data['judul_halaman'] = "History Konsultasi";
    $data['files'] = array(
      APPPATH . 'modules/konsulback/views/v-history-konsul.php',
      );
    $penggunaID=$this->session->userdata['id'];
      // get jumlah respon
    $data['countJawab']=$this->Mkonsulback->get_count_jawab($penggunaID);
      // get data guru
    $datguru=$this->Mkonsulback->get_datguru($penggunaID);
    $data['nama']=$datguru['namaDepan'].' '.$datguru['namaBelakang'];
    $data['photo']=base_url().'assets/image/photo/siswa/'.$datguru['photo'];
    $data['countLove']=$this->Mkonsulback->get_count_love($penggunaID);
      // get respon atau jawaban
    $data['respon']=$this->Mkonsulback->get_respone_by_guru($penggunaID);
    $tamppoin=($data['countJawab']*5)+($data['countLove']*10);
    $data['poin']=$tamppoin;
      //get data komen untuk tabel histrori komen
    $data['komen']=$this->Mkonsulback->get_komen_love($penggunaID);
    

    // get data untuk pertanyaan yang ditujukan pada guru tersebut.
    $id_guru = 37;
    $jumlah_postingan = $this->mkonsultasi->get_pertanyaan_punya_mentor_number_search($id_guru,$key='');
    $data['question_to_teacher']=$this->mkonsultasi->get_pertanyaan_punya_mentor($id_guru,'all','all',0,$jumlah_postingan);

    // print_r($data['question_to_teacher']);
    #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
         // jika admin
      $this->parser->parse('admin/v-index-admin', $data);
    } elseif($hakAkses=='guru'){
         // jika guru
        //## Notification komen video
      $data['datKomen']=$this->datKomen();
      $id_guru = $this->session->userdata['id_guru'];
      // get jumlah komen yg belum di baca
      $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
      //## Notification komen videosss
      $this->parser->parse('templating/index-b-guru', $data);
    }else{
        // jika siswa redirect ke welcome
      redirect(site_url('login'));
    }
          #END Cek USer#
  }
    // history guru berdasarkan id guru
  public function history($penggunaID)
  {

    $data['judul_halaman'] = "History Konsultasi";
    $data['files'] = array(
      APPPATH . 'modules/konsulback/views/v-history-konsul.php',
      );
      // get jumlah respon
    $data['countJawab']=$this->Mkonsulback->get_count_jawab($penggunaID);
      // get data guru
    $datguru=$this->Mkonsulback->get_datguru($penggunaID);
    $data['nama']=$datguru['namaDepan'].' '.$datguru['namaBelakang'];
    $data['photo']=base_url().'assets/image/photo/siswa/'.$datguru['photo'];
    $data['countLove']=$this->Mkonsulback->get_count_love($penggunaID);
      // get respon atau jawaban
    $data['respon']=$this->Mkonsulback->get_respone_by_guru($penggunaID);
    $tamppoin=($data['countJawab']*5)+($data['countLove']*10);
    $data['poin']=$tamppoin;
      //get data komen untuk tabel histrori komen
    $data['komen']=$this->Mkonsulback->get_komen_love($penggunaID);
         #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
         // jika admin
      $this->parser->parse('admin/v-index-admin', $data);
    } elseif($hakAkses=='guru'){
         // jika guru
      $this->parser->parse('templating/index-b-guru', $data);
    }else{
        // jika siswa redirect ke welcome
      redirect(site_url('login'));
    }
          #END Cek USer#
  }

  public function aq_konsul ()
  {
    $data['judul_halaman'] = "Akumulasi Konsultasi";
    $data['files'] = array(
      APPPATH . 'modules/konsulback/views/v-aq-konsul.php',
      );
    $dat_guru=$this->Mkonsulback->get_aq_konsul();
    $tampAq=array();
    foreach ($dat_guru as $value) {
      $penggunaID=$value['penggunaID'];
      $love=$this->Mkonsulback->get_count_love($penggunaID);
      $datguru=$this->Mkonsulback->get_datguru($penggunaID);
      $countJawab=$this->Mkonsulback->get_count_jawab($penggunaID);
      $poin=($countJawab*5)+($love*10);
      $tampAq[]=array('poin'=>$poin,
        'nama'=>$value['namaDepan'].' '.$value['namaBelakang'],
        'mapel'=>$value['mapel'],
        'love'=>$love,
        'countJawab'=>$countJawab,
        'penggunaID'=>$penggunaID
        );
    }
    rsort($tampAq);
    $data['dat_aq']=$tampAq;
         #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
         // jika admin
      $this->parser->parse('admin/v-index-admin', $data);
    } elseif($hakAkses=='guru'){
         // jika guru
      $this->parser->parse('templating/index-b-guru', $data);
    }else{
        // jika siswa redirect ke welcome
      redirect(site_url('login'));
    }
         // #END Cek USer#
  }

  public function listkonsul(){
    $data = array(
      'judul_halaman' => 'Neon - Konsultasi',
      'judul_header'=> 'Daftar Pertanyaan'
      );

    $data['files'] = array(
      APPPATH.'modules/konsulback/views/v-back-daftar-konsul.php'
      );

    ##KONFIGURASI UNTUUK PAGINATION
    // $config = array();
    // $config["base_url"] = base_url() . "konsultasi/listkonsul/";
    // $config["total_rows"] = $this->mkonsultasi->get_all_questions_number($key);
    // $config["per_page"] = 10;
    // $config["uri_segment"] = 3;

    // $config['cur_tag_open'] = "<a style='background:#f27c66;color:white'>";
    // $config['cur_tag_close'] = '</a>';



    // $config['first_link'] = "<span title='Page Awal'> << </span>"; 
    // $config['last_link'] = "<span title='Page Akhir'> >> </span>";
    // $this->pagination->initialize($config);
    // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
  ##KONFIGURASI UNTUUK PAGINATION


  //## Notification komen video
    $data['datKomen']=$this->datKomen();
    $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
    $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
  //## Notification komen video

    $this->parser->parse('templating/index-b-guru', $data);




  }

    // public function listkonsul()
    // {
    //   $data = array(
    //   'judul_halaman' => 'Neon - Konsultasi',
    //   'judul_header'=> 'Daftar Pertanyaan'
    //   );

    // $data['files'] = array(
    //   APPPATH.'modules/konsulback/views/v-back-daftar-konsul.php'
    //   );
    // // $data['mapel'] = $this->mmatapelajaran->get_mapel_by_tingkatID($this->get_tingkat_siswa());
    // $limit=2;
    // $data['questions']=$this->Mkonsulback->all($limit);
    // $penggunaID=$this->session->userdata['id'];
    // $dat_guru=$this->Mkonsulback->get_datguru($penggunaID);
    // $mataPelajaranID=$dat_guru['mataPelajaranID'];
    // $data['my_questions']=$this->Mkonsulback->get_my_questions($mataPelajaranID,$limit);

    // //Start cek load more all ask/konsul
    //    // panjang array
    //    $lnAll=count($questions);
    //    // get id last id untuk cek ketersedian pertanyaan semua
    //    $idlastAll=ln-1;
    //    $last_pertanyaanID=$data['questions'][$idlast]['pertanyaanID'];
    //    $cekloadAll=$this->cek_emty_konsul_all($last_pertanyaanID);
    // // ##END cek load more all ask/ konsu.

    // //Start cek load more all ask/konsul
    //    // panjang array
    //    $lnMapel=count($questions);
    //    // get id last id untuk cek ketersedian pertanyaan pr mapel
    //    $idlastMapel=ln-1;
    //    $last_pertanyaanID=$data['my_questions'][$idlast]['pertanyaanID'];
    //    // $cekloadMaple=$this->cek_emty_konsul_mapel($last_pertanyaanID);
    // // ##END cek load more ask/ konsu per mapel.
    //   $this->parser->parse('templating/index-b-guru', $data);
    // }
    // cek validasi disable or enable load more untuk 
  public function cek_emty_konsul_all($last_askID)
  {
    $countArr=$this->Mkonsulback->count_konsulAll($last_askID);
    
    if ($countArr == 0) {
      return 'false';
    } else {
      return 'true';
    }
    
  }
    // cek validasi disable or enable load more untuk 
  public function cek_emty_konsul_mapel($last_askIDMp)
  {
    $penggunaID=$this->session->userdata['id'];
    $dat_guru=$this->Mkonsulback->get_datguru($penggunaID);
    $mataPelajaranID=$dat_guru['mataPelajaranID'];

    $countArr=$this->Mkonsulback->count_konsulMapel($last_askIDMp,$mataPelajaranID);

    if ($countArr == 0) {
      return 'false';
    } else {
      return 'true';
    }
    
  }
    // function more listkonsul
  public function moreallsoal()
  {
   $getLastContentId=$this->input->post('getLastContentId');
   $data['moreask']=$this->Mkonsulback->more_all_soal($getLastContentId);

   $lnAll=count($data['moreask']);
       // get id last id untuk cek ketersedian pertanyaan semua
   $idlastAll=$lnAll-1;
   $last_pertanyaanID=$data['moreask'][$idlastAll]['pertanyaanID'];
   $data['cekloadAll2']=$this->cek_emty_konsul_all($last_pertanyaanID);

   $this->load->view('v-load-all-ask',$data);
 }
        // function more listkonsul
 public function moremapelsoal()
 {
  $penggunaID=$this->session->userdata['id'];
  $dat_guru=$this->Mkonsulback->get_datguru($penggunaID);
  $data['mataPelajaranID']=$dat_guru['mataPelajaranID'];
  $data['getLastContentId']=$this->input->post('getLastContentId');
  $data['moreask1']=$this->Mkonsulback->more_guru_soal($data);

  $lnMapel=count($data['moreask1']);
       // get id last id untuk cek ketersedian pertanyaan semua
  $idlastMapel=$lnMapel-1;
  $last_askIDMp=$data['moreask1'][$idlastMapel]['pertanyaanID'];
  $data['cekloadMapel2']=$this->cek_emty_konsul_mapel($last_askIDMp);
  
      // var_dump($getLastContentId);
  $this->load->view('v-load-mapel-ask',$data);
}
    // Test
public function pagination()
{
  $this->load->library('pagination');
  $config['base_url']='http://localhost/netjoo-2/index.php/konsulback/pagination';
  $config['per_page']=2;
  $config['num_link']=2;
  $config['total_rows']=$this->db->get('tb_k_pertanyaan')->num_rows();
  $this->pagination->initialize($config);
  $data['query']=$this->db->get('tb_k_pertanyaan',$config['per_page'],$this->uri->segment(3));
  var_dump($data['query']);
  $this->load->view('konsulback/test.php', $data);


}

function get_id_siswa(){
 return $this->Mkonsulback->get_id_siswa();

}
function get_tingkat_siswa(){
  $id_tingkat = $this->mtingkat->get_level_by_siswaID_all($this->get_id_siswa());
  if ($id_tingkat) {
    return $id_tingkat[0]['tingkatID'];
  } 
  
}
  // test
    // ajax pagination
public function ajax()
{
      // $this->load->model('Mkonsulback', 'tb_k_pertanyaan');
      // $query = $this->tb_k_pertanyaan->all($this->limit);
      // $total_rows = $this->tb_k_pertanyaan->count();
      // $this->load->helper('app');
      // $pagination_links = pagination($total_rows, $this->limit);
      // $data['pagination']=compact('query', 'pagination_links');
      // if ( ! $this->input->is_ajax_request()) $this->load->view('v-hpagination');
      // $this->load->view('v-ajax-pagination', $data);

      // if ( ! $this->input->is_ajax_request()) $this->load->view('v-fpagination');
      ###########################################################
      // Konfig halaman
      #######################################################
  $data['judul_halaman']='Neon - Konsultasi';
  $data['judul_header']='Daftar Pertanyaan';

      // $data['mapel'] = $this->mmatapelajaran->get_mapel_by_tingkatID($this->get_tingkat_siswa());
      // get data semua pertanyaan
  $data['questions']=$this->mkonsultasi->get_all_questions();
  $penggunaID=$this->session->userdata['id'];
  $dat_guru=$this->Mkonsulback->get_datguru($penggunaID);
  $mataPelajaranID=$dat_guru['mataPelajaranID'];
      // get pertanyaan berdasarkan keahlian guru
  $data['my_questions']=$this->Mkonsulback->get_my_questions($mataPelajaranID,$this->limit);
      ###################################
      // Konfig pagination
      ####################################
  $this->load->model('Mkonsulback', 'tb_k_pertanyaan');
      //query1 = all pertanyaan
  $data['query'] = $this->tb_k_pertanyaan->all($this->limit);
      //query2 =  pertanyaan berdasarkan mp
      // $data['query2'] = $this->tb_k_pertanyaan->all($this->limit);
  $total_rows = $this->tb_k_pertanyaan->count();
  $this->load->helper('app');
      // pagination untuk tab semua pertanyaan
  $data['pagination_links'] = pagination($total_rows, $this->limit);
      // pagination untuk tab pertanyaan berdasarkan keahlian guru
  $data['pagination_links1'] = pagination($this->Mkonsulback->count_my_questions($mataPelajaranID),$this->limit);
  $data['test']='hekoooo';
      // $data['pagination']=compact('query', 'pagination_links');
  
      ######################################
      // Pengecekan Untuk Jaquery pagination 
      ######################################
  if ( ! $this->input->is_ajax_request()){
    $data['files'] = array(
      APPPATH.'modules/konsulback/views/v-ajax-pagination.php'
      );
    $data['allasks'] = array(
      APPPATH.'modules/konsulback/views/v-ajax-all-ask.php'
      );
    $data['myasks'] = array(
      APPPATH.'modules/konsulback/views/v-ajax-my-ask.php'
      );
    $this->load->view('templating/index-b-guru', $data);
  }else{
        // hasil view tab pagination
    $this->load->view('v-ajax-my-ask',$data);
        // $this->load->view('v-ajax-all-ask',$data);
  }

  
} 

public function konsultasi($id_pertanyaan)
{
 $single_pertanyaan = $this->mkonsultasi->get_pertanyaan($id_pertanyaan)[0];

 $jumlah = $this->mkonsultasi->get_jumlah_postingan($id_pertanyaan);
 $date = $single_pertanyaan['date_created'];

 $timestamp = strtotime($date);

 $data = array(
  'judul_halaman' => 'Neon - Konsultasi',
  'judul_header'=> $single_pertanyaan['judulPertanyaan'],
  'isi'=> $single_pertanyaan['isiPertanyaan'],
  'author'=> $single_pertanyaan['namaDepan']." ".$single_pertanyaan['namaBelakang'],
  'jumlah'=>$jumlah,
  'sub'=>$single_pertanyaan['judulSubBab'],
  'akses'=>$single_pertanyaan['hakAkses'],
  'id_pertanyaan'=>$id_pertanyaan,
  'id_pengguna'=>$this->session->userdata('id'),
  'tanggal'=>date("d", $timestamp),
  'bulan'=>date("M", $timestamp),
  'photo'=>base_url("assets/image/photo/siswa/".$single_pertanyaan['photo'])
  );
            // print_r($data);
 $data['isi'] = $single_pertanyaan['isiPertanyaan'];
 $data['data_postingan'] = $this->mkonsultasi->get_postingan($id_pertanyaan);
 $data['files'] = array(
  APPPATH.'modules/konsulback/views/v-konsultasi-back.php'
  );


 if ($this->hakakses=='admin') {

   redirect('login');
 }else if($this->hakakses=='guru'){
   $id_guru = $this->session->userdata['id_guru'];
  // get jumlah komen yg belum di baca
   $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
   $this->parser->parse('templating/index-b-guru', $data);
 }

}

    //add jawaban.
function ajax_add_jawaban(){
  $data = array(
    'isiJawaban' => $this->input->post( 'isiJawaban' ),
    'penggunaID' => $this->input->post( 'penggunaID' ),
    'pertanyaanID' =>$this->input->post( 'pertanyaanID' ),
    );
  $this->mkonsultasi->insert_jawaban($data);
}

function check_point($id_jawaban){
  $id_siswa = $this->get_id_siswa();
  $id_pengguna = $this->get_id_pengguna($id_jawaban);
  $komentar = "Asd";
  $id_jawab = $this->input->post('idJawaban');
  // $id_jawab = "53";


  $data = array(
    'siswaID' => $id_siswa,
    'penggunaID' => $id_pengguna,
    'komentar' =>$komentar,
    'jawabID'=>$id_jawab
    );
  

  $check = $this->mkonsultasi->check_postingan($data);
  echo json_encode($check);
}

// /add point.
function ajax_add_point($id_jawaban){
  //penggunaID
  //siswaID
  $id_siswa = $this->get_id_siswa();
  $id_pengguna = $this->get_id_pengguna($id_jawaban);
  $komentar = $this->input->post('isiKomentar');
  $id_jawab = $this->input->post('idJawaban');

  $data = array(
    'siswaID' => $id_siswa,
    'penggunaID' => $id_pengguna,
    'komentar' =>$komentar,
    'jawabID'=>$id_jawab
    );
  // var_dump($data);

  // $check = $this->mkonsultasi->check_postingan($data);
  $this->mkonsultasi->insert_point($data);
  // var_dump($check); 
  // "<script>alert('masuk')</script>";

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
} ?>