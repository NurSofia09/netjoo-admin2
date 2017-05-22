<?php

//============================================================+
// File name   : Banksoal.php
// Begin       : -
// Last Update : -2017-04-13
//
// Description : List pagination siswa
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
class Banksoal extends MX_Controller {



    function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model('Mbanksoal');
        $this->load->model('templating/Mtemplating');
        $this->load->model('komenback/mkomen');
        $this->load->library('parser');
        $this->load->library('pagination');
        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
    }

    public function index() {
       
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/test.php',
        );
        $data['judul_halaman'] = "test";
        $this->load->view('templating/index-b-guru', $data);
    }

    //pagination list soal
    public function listsoal()
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mbanksoal->jumlah_data();
       
        $config['base_url'] = base_url().'index.php/banksoal/listsoal/';
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
        
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $list = $this->Mbanksoal->data_soal($config['per_page'],$from);

        // var_dump($config['per_page']);
        // var_dump($from);
        $this->tampSoal($list);
    }

    //tampung list semua soal u/ ke view
    public function tampSoal($list)
    {
         $data['judul_halaman'] = 'Bank Soal <a class="btn btn-sm  btn-inverse btn-outline" href="formsoal" title="Tambah Data Soal" ><i class="ico-plus"></i></a>' ;
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-all2.php',
            );
         // $pilihan = $this->Mbanksoal->get_allpilihan();
        // ekstrak data db ke new arrat
          $data['datSoal']=array();
          foreach ( $list as $list_soal ) {
            $id_soal=$list_soal['id_soal'];
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $judulSoal = $list_soal['judul_soal'];
            $soal=$list_soal['soal'];
            $sumber=$list_soal['sumber'];
            $UUID=$list_soal['UUID'];
            $id_subbab=$list_soal['id_subbab'];
            $tingkat = $list_soal['aliasTingkat'];
            $mapel= $list_soal['keterangan'];
            $bab = $list_soal['judulBab'];
            $subBab = $list_soal['judulSubBab'];
            $tampBahas=$list_soal['pembahasan'];
            $pembahasan = '<a style="color:red;">Maaf Pembahasan Belum Tersedia !! </a>';
            $tampVideo = $list_soal['video_pembahasan'];
            $videoBahas ='';
            $tampImgSoal= $list_soal['gambar_soal'];
            $imgSoal='';
            $imgJawaban='';
            $tampimgbahas=$list_soal['gambar_pembahasan'];
            $imgBahas='';
            $jawaban=$list_soal['jawaban'];
            $isiJawaban = '';
            $create_by = $list_soal['create_by'];
            $audio = $list_soal['audio'];
                $tampJawaban = $this->Mbanksoal->get_jawaban($jawaban,$id_soal);
            if ($tampJawaban) {
                //untuk menampung data sementara jawaban
                $isiJawaban = $tampJawaban['jawaban'];
                $tampImgJawaban = $tampJawaban['imgJawaban'];
                if ($tampImgJawaban != '' && $tampImgJawaban != ' ' ) {
                     $imgJawaban=base_url().'/assets/image/jawaban/'.$tampImgJawaban;
                }
            }


            // pengecekan gambar pembahasan
            if ($tampimgbahas!= '' && $tampimgbahas != ' ' ) {
                $imgBahas = base_url().'/assets/image/pembahasan/'.$tampimgbahas;
            }

            // pengecekan pembahsan
            if ($tampBahas != '' && $tampBahas != ' ') {
                $pembahasan=$tampBahas;
            } else if($tampVideo !='' && $tampVideo !=' ') {
                $videoBahas=base_url().'/assets/video/videoPembahasan/'.$tampVideo;
                $pembahasan='';
            }
            
            // Pengecekan gambar Soal
            if ($tampImgSoal!='' && $tampImgSoal != ' ') {
                // jika gambar tidak null 
                $imgSoal=base_url().'/assets/image/soal/'.$tampImgSoal;
            } 


            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }

            $data['datSoal'][]=array(
                'id_soal'=>$id_soal,
                'judulSoal'=>$judulSoal,
                'soal'=>$soal,
                'audio'=>$audio,
                'imgSoal'=>$imgSoal,
                'kesulitan'=>$kesulitan,
                'publish'=>$publish,
                'random'=>$random,
                'sumber'=>$sumber,
                'tingkat'=>$tingkat,
                'mapel'=>$mapel,
                'bab'=> $bab,
                'subBab' => $subBab,
                'pembahasan' => $pembahasan,
                'imgBahas'=> $imgBahas,
                'videoBahas'=>$videoBahas,
                'UUID'=>$UUID,
                'id_subbab'=>$id_subbab,
                'jawaban'=>$jawaban,
                'isiJawaban'=>$isiJawaban,
                'imgJawaban'=>$imgJawaban,
                'create_by'=>$create_by

                );
          }
        // 

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

    public function listmp() {
        $tingkatID = htmlspecialchars($this->input->get('tingkatID'));
      
       
        $data['pelajaran'] = $this->Mbanksoal->get_pelajaran($tingkatID);
        $data['tingkatID'] = $tingkatID;

        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-list-mp.php',
            );

        $data['judul_halaman'] = "List  Mata Pelajaran";

        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
        // jika admin
        //cek jika sniping url
            if ($tingkatID==null) {
                redirect(site_url('admin'));
            } else {
                 $this->parser->parse('admin/v-index-admin', $data);
            }


        } elseif($hakAkses=='guru'){
                    // jika guru
            //cek jika sniping url
            if ($tingkatID==null) {
                redirect(site_url('guru/dashboard/'));
            } else {
                 $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
           
       
    }

    public function listbab() {
        $mpID = htmlspecialchars($this->input->get('mpID'));
        $data['bab'] = $this->Mbanksoal->get_bab($mpID);
        $data['judul_halaman'] = "List Bab";
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-list-bab.php',
            );
                #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            // jika admin
            if ($mpID == null) {
                redirect(site_url('admin'));
            } else {
               $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
             // jika guru
            if ($mpID == null) {
                 redirect(site_url('guru/dashboard/'));
            } else {
               $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
                        // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
                #END Cek USer#
    }

    public function listsubbab() {
        $babID = htmlspecialchars($this->input->get('bab'));

        $data['subbab'] = $this->Mbanksoal->get_subbab($babID);
        $data['judul_halaman'] = "List Sub Bab";
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-list-subbab.php',
            );
         #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            // jika admin
            if ($babID == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
            // jika guru
             if ($babID == null) {
                redirect(site_url('guru/dashboard/'));
            } else {
                $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
                        // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
    }
    ## START FUNCTION UNTUK HALAMAN SOAL PERSUB-BAB
    // Functon menampilkan halaman list soal per sub--bab
    public function subsoal($subBab ) {
        $data ['subBab'] = $subBab;
        $datSub=$this->Mbanksoal->dat_sub($subBab);
        $babID=$datSub->babID;
        $datBab=$this->Mbanksoal->get_judulBab($babID);
        $judulBab=$datBab->judulBab;
        $tingkatPelajaranID=$datBab->tingkatPelajaranID;
        $namaMp=$this->Mbanksoal->get_namaMp($tingkatPelajaranID);
        $data ['judulSub'] =$datSub->judulSubBab;
        $data['judul_halaman'] = "Bank Soal ".$namaMp."/".$judulBab;
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-sub.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            // jika admin
            if ($subBab == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
             // jika guru
            if ($subBab == null) {
                 redirect(site_url('guru/dashboard/'));
            } else {
               $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
    }
    // function untuk mengambil data soal
    function ajax_soalPerSub($subBab) {
        $list  = $this->Mbanksoal->get_soal($subBab);
         $pilihan = $this->Mbanksoal->get_pilihan($subBab);

        // $list = $this->load->mToBack->paket_by_toID($idTO);
        $data = array();

        $baseurl = base_url();
        foreach ( $list as $list_soal ) {
            $jawabanBenar= "";
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $soal=$list_soal['soal'];
            $ckRandom="";
            $ckPublish="";

            
             // menentukan tingkat kesulitan dengan indeks 1 - 3
            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }
            // menentukan jawaban benar
            foreach ( $pilihan as $piljawaban ) {
                $id_soal_fk=$piljawaban['id_soal'];
                $op=$piljawaban['pilihan'];
                if ($id_soal==$id_soal_fk && $jawaban == $op ) {
                    $jawabanBenar=$piljawaban['jawabanBenar'];
                } 
                
            }
            // menentukan checked random
            if ($random =='1') {
                $ckRandom="checked";
            } 
            //mnentukan checked publish
              if ($publish =='1') {
                $ckPublish="checked";
            } 
            
            $row = array();
            $row[] = $id_soal;
            $row[] = $list_soal['judul_soal'];
            $row[] = $list_soal['sumber'];
            $row[] = $kesulitan;
             $valSoal=$this->cek_soal_tabel($soal);
            if ($valSoal == true) {
                $row[] = '<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Soal</a>';
            } else if (strlen($soal)>160 ) {
           
                 $row[] = substr($soal,  0, 140). '... <a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            } else {
                $row[] = $soal;
            }
            
           
            $row[] = $jawabanBenar.'<input type="text" id="jawaban-'.$id_soal.'" value="'.$jawabanBenar.'" hidden="true">';
           $row[] ='
                    <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                                <label for="ckRand" >&nbsp;&nbsp;</label>
                    </span>';

            // $row[] ='
            //         <span class="checkbox custom-checkbox custom-checkbox-inverse">
            //                     <input type="checkbox" name="ckRand"'.$ckRandom.'>
            //                     <label for="ckRand" >&nbsp;&nbsp;</label>
            //         </span>';
            $row[] = '
            <form action="'.base_url().'index.php/banksoal/formUpdate" method="get">

                                                <input type="text" name="UUID" value="'.$list_soal['UUID'].'"  hidden="true">
                                                <input type="text" name="subBab" value="'.$list_soal['id_subbab'].'" hidden="true">
                                                <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSoal('."'".$list_soal['id_soal']."'".')"><i class="ico-remove"></i></a>';

            $data[] = $row;

        }
    
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
    } 
    ## END START FUNCTION UNTUK HALAMAN SOAL PERSUB-BAB#

    ##Start Function untuk halaman soal perBab##
     // function untuk mengambil data soal
    function ajax_soalPerbab($bab) {
        $list  = $this->Mbanksoal->get_soal_bab($bab);
        $pilihan = $this->Mbanksoal->get_pilihan_bab($bab);
        $data = array();
        $baseurl = base_url();
        foreach ( $list as $list_soal ) {
            $jawabanBenar= "";
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $soal=$list_soal['soal'];
            $ckRandom="";
            $ckPublish="";

             // menentukan tingkat kesulitan dengan indeks 1 - 3
            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }
            // menentukan jawaban benar
            foreach ( $pilihan as $piljawaban ) {
                $id_soal_fk=$piljawaban['id_soal'];
                $op=$piljawaban['pilihan'];
                if ($id_soal==$id_soal_fk && $jawaban == $op ) {
                    $jawabanBenar=$piljawaban['jawabanBenar'];
                } 
                
            }
            // menentukan checked random
            if ($random =='1') {
                $ckRandom="checked";
            } 
            //mnentukan checked publish
              if ($publish =='1') {
                $ckPublish="checked";
            } 
            
            $row = array();
            $row[] = $id_soal;
            $row[] = $list_soal['judul_soal'];
            $row[] = $list_soal['sumber'];
            $row[] = $list_soal['judulSubBab'];
            $row[] = $kesulitan;
               $valSoal=$this->cek_soal_tabel($soal);
            if ($valSoal == true) {
                $row[] = '<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Soal</a>';
            } else if (strlen($soal)>160 ) {
           
                 $row[] = substr($soal,  0, 140). '... <a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            } else {
                $row[] = $soal;
            }
            
           
            $row[] = $jawabanBenar.'<input type="text" id="jawaban-'.$id_soal.'" value="'.$jawabanBenar.'" hidden="true">';
           $row[] ='
                    <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                                <label for="ckRand" >&nbsp;&nbsp;</label>
                    </span>';

            // $row[] ='
            //         <span class="checkbox custom-checkbox custom-checkbox-inverse">
            //                     <input type="checkbox" name="ckRand"'.$ckRandom.'>
            //                     <label for="ckRand" >&nbsp;&nbsp;</label>
            //         </span>';
            $row[] = '
            <form action="'.base_url().'index.php/banksoal/formUpdate" method="get">

                                                <input type="text" name="UUID" value="'.$list_soal['UUID'].'"  hidden="true">
                                                <input type="text" name="subBab" value="'.$list_soal['id_subbab'].'" hidden="true">
                                                <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSoal('."'".$list_soal['id_soal']."'".')"><i class="ico-remove"></i></a>';

            $data[] = $row;

        }
    
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
    } 

    ##
 ##Start Function untuk halaman soal per mata pelajaran##
     // function untuk mengambil data soal
    function ajax_soalPerMp($idMp) {
      $list  = $this->Mbanksoal->get_soal_mp($idMp);
        $pilihan = $this->Mbanksoal->get_pilihan_mp($idMp);
        $data = array();
        $baseurl = base_url();
        foreach ( $list as $list_soal ) {
            $jawabanBenar= "";
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $ckRandom="";
            $ckPublish="";

             // menentukan tingkat kesulitan dengan indeks 1 - 3
            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }
            // menentukan jawaban benar
            foreach ( $pilihan as $piljawaban ) {
                $id_soal_fk=$piljawaban['id_soal'];
                $op=$piljawaban['pilihan'];
                if ($id_soal==$id_soal_fk && $jawaban == $op ) {
                    $jawabanBenar=$piljawaban['jawabanBenar'];
                } 
                
            }
            // menentukan checked random
            if ($random =='1') {
                $ckRandom="checked";
            } 
            //mnentukan checked publish
              if ($publish =='1') {
                $ckPublish="checked";
            } 
            
            $row = array();
            $row[] = $id_soal;
            $row[] = $list_soal['judul_soal'];
            $row[] = $list_soal['sumber'];
            $row[] = $list_soal['judulBab'];
            $row[] = $kesulitan;
            $soal=$list_soal['soal'];
              $valSoal=$this->cek_soal_tabel($soal);
            if ($valSoal == true) {
                $row[] = '<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Soal</a>';
            } else if (strlen($soal)>160 ) {
           
                 $row[] = substr($soal,  0, 140). '... <a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            } else {
                $row[] = $soal;
            }
            
           
            $row[] = $jawabanBenar.'<input type="text" id="jawaban-'.$id_soal.'" value="'.$jawabanBenar.'" hidden="true">';
           $row[] ='
                    <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                                <label for="ckRand" >&nbsp;&nbsp;</label>
                    </span>';

            // $row[] ='
            //         <span class="checkbox custom-checkbox custom-checkbox-inverse">
            //                     <input type="checkbox" name="ckRand"'.$ckRandom.'>
            //                     <label for="ckRand" >&nbsp;&nbsp;</label>
            //         </span>';
            $row[] = '
            <form action="'.base_url().'index.php/banksoal/formUpdate" method="get">

                                                <input type="text" name="UUID" value="'.$list_soal['UUID'].'"  hidden="true">
                                                <input type="text" name="subBab" value="'.$list_soal['id_subbab'].'" hidden="true">
                                                <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSoal('."'".$list_soal['id_soal']."'".')"><i class="ico-remove"></i></a>';

            $data[] = $row;

        }
    
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
    } 
 ##Start Function untuk halaman soal per mata pelajaran##
     // function untuk mengambil data soal
    function ajax_soalPerTkt($tingkatID) {
      $list  = $this->Mbanksoal->get_soal_tkt($tingkatID);
        $pilihan = $this->Mbanksoal->get_pilihan_tkt($tingkatID);
        $data = array();
        $baseurl = base_url();
        foreach ( $list as $list_soal ) {
            $jawabanBenar= "";
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $ckRandom="";
            $ckPublish="";

             // menentukan tingkat kesulitan dengan indeks 1 - 3
            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }
            // menentukan jawaban benar
            foreach ( $pilihan as $piljawaban ) {
                $id_soal_fk=$piljawaban['id_soal'];
                $op=$piljawaban['pilihan'];
                if ($id_soal==$id_soal_fk && $jawaban == $op ) {
                    $jawabanBenar=$piljawaban['jawabanBenar'];
                } 
                
            }
            // menentukan checked random
            if ($random =='1') {
                $ckRandom="checked";
            } 
            //mnentukan checked publish
              if ($publish =='1') {
                $ckPublish="checked";
            } 
            
            $row = array();
            $row[] = $id_soal;
            $row[] = $list_soal['judul_soal'];
            $row[] = $list_soal['sumber'];
            $row[] = $list_soal['keterangan'];
            $row[] = $kesulitan;
            $soal=$list_soal['soal'];
            $valSoal=$this->cek_soal_tabel($soal);
            if ($valSoal == true) {
                $row[] = '<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Soal</a>';
            } else if (strlen($soal)>160 ) {
           
                 $row[] = substr($soal,  0, 140). '... <a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            } else {
                $row[] = $soal;
            }
            
           
            $row[] = $jawabanBenar.'<input type="text" id="jawaban-'.$id_soal.'" value="'.$jawabanBenar.'" hidden="true">';
           $row[] ='
                    <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                                <label for="ckRand" >&nbsp;&nbsp;</label>
                    </span>';

            // $row[] ='
            //         <span class="checkbox custom-checkbox custom-checkbox-inverse">
            //                     <input type="checkbox" name="ckRand"'.$ckRandom.'>
            //                     <label for="ckRand" >&nbsp;&nbsp;</label>
            //         </span>';
            $row[] = '
            <form action="'.base_url().'index.php/banksoal/formUpdate" method="get">

                                                <input type="text" name="UUID" value="'.$list_soal['UUID'].'"  hidden="true">
                                                <input type="text" name="subBab" value="'.$list_soal['id_subbab'].'" hidden="true">
                                                <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSoal('."'".$list_soal['id_soal']."'".')"><i class="ico-remove"></i></a>';

            $data[] = $row;

        }
    
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
    } 

    ## START FUNCTION UNTUK HALAMAN ALL SOAL##
    //function untuk menampilkan halaman all soal
    public function allsoal()
    {
        // $data['soal'] = $this->Mbanksoal->get_allsoal();
        // $data['pilihan'] = $this->Mbanksoal->get_allpilihan();
       
        $data['judul_halaman'] = "Bank Soal";
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-all.php',
            );
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

    // function untuk mengambil data soal
    function ajax_listAllSoal() {
        $list = $this->Mbanksoal->get_allsoal();
        $pilihan = $this->Mbanksoal->get_allpilihan();

        // $list = $this->load->mToBack->paket_by_toID($idTO);
        $data = array();

        $baseurl = base_url();
        $no=1;
        foreach ( $list as $list_soal ) {
             $jawabanBenar= "";
            $jawaban=$list_soal['jawaban'];
            $tingkat=$list_soal['kesulitan'];
            $id_soal=$list_soal['id_soal'];
            $random=$list_soal['random'];
            $publish=$list_soal['publish'];
            $ckRandom="";
            $ckPublish="";
            $soal=$list_soal['soal'];
            // pengecekan soal jika ada tabel
            $valSoal=$this->cek_soal_tabel($soal);
             // menentukan tingkat kesulitan dengan indeks 1 - 3
            if ($tingkat == '3') {
                $kesulitan = 'Sulit';
            } elseif ($tingkat == '2') {
                $kesulitan = 'Sedang';
            }else {
               $kesulitan = 'Mudah';
            }
            // menentukan jawaban benar
            foreach ( $pilihan as $piljawaban ) {
                $id_soal_fk=$piljawaban['id_soal'];
                $op=$piljawaban['pilihan'];
                if ($id_soal==$id_soal_fk && $jawaban == $op ) {
                    $jawabanBenar=$piljawaban['jawabanBenar'];

                }    
            }
            // menentukan checked random
            if ($random =='1') {
                $ckRandom="checked";
            } 
            //mnentukan checked publish
              if ($publish =='1') {
                $ckPublish="checked";
            } 
            
            $row = array();
            $row[] = $no;
            $row[] = $list_soal['judul_soal'];
            $row[] = $list_soal['sumber'];
            $row[] = $list_soal['keterangan'];
            $row[] = $kesulitan;
            if ($valSoal == true) {
                $row[] = '<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Soal</a>';
            } else if (strlen($soal)>160 ) {
              // <a class="btn btn-sm btn-primary detail-'.$list_video['videoID'].'"  title="Play"
              // data-id='."'".json_encode($list_video)."'".'
              // onclick="detail('."'".$list_video['videoID']."'".')"
              // >
              // <i class=" ico-play3"></i>
              //   </a> 
                 $row[] = substr($soal,  0, 140). '... <a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            } else {
                $row[] = $soal.'<a class="label label-info   detail-'.$id_soal.'"  title="lihat detail" data-id='."'".json_encode($list_soal)."'".'onclick="detailSoal('."'".$id_soal."'".')"><i class="ico-eye" ><i>Lihat Detail</a>';
            }
            
           
            $row[] = $jawabanBenar.'<input type="text" id="jawaban-'.$id_soal.'" value="'.$jawabanBenar.'" hidden="true">';
           $row[] ='
                    <span class="checkbox custom-checkbox custom-checkbox-inverse">
                                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                                <label for="ckRand" >&nbsp;&nbsp;</label>
                    </span>';

            // $row[] ='
            //         <span class="checkbox custom-checkbox custom-checkbox-inverse">
            //                     <input type="checkbox" name="ckRand"'.$ckRandom.'>
            //                     <label for="ckRand" >&nbsp;&nbsp;</label>
            //         </span>';
            $row[] = '
            <form action="'.base_url().'index.php/banksoal/formUpdate" method="get">

                                                <input type="text" name="UUID" value="'.$list_soal['UUID'].'"  hidden="true">
                                                <input type="text" name="subBab" value="'.$list_soal['id_subbab'].'" hidden="true">
                                                <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSoal('."'".$list_soal['id_soal']."'".')"><i class="ico-remove"></i></a>';

            $data[] = $row;
            $no++;

        }
        $output = array(
            
            "data"=>$data,
        );

        echo json_encode( $output );
    } 

    #Start Function untuk form upload bank soal#\


    // pengecekan soal jika ada tabel
    public function cek_soal_tabel($soal)
    {
         if (strpos($soal, '<table') !== false) {
            return true;
        }else{
            return false;
        }
    }

    public function formsoal() {

        $data['judul_halaman'] = "Bank Soal";
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-form-soal.php',
            );
         #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
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
        }else{
          // jika siswa redirect ke welcome
          redirect(site_url('welcome'));
        }
        #END Cek USer#
    }

    public function uploadsoal() {
        //load library n helper
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $subBabID = htmlspecialchars($this->input->post('subBabID'));
        //syarat pengisian form upload soal
        $this->form_validation->set_rules('judul', 'Judul Soal', 'trim|required|is_unique[tb_banksoal.judul_soal]');
           $options = htmlspecialchars($this->input->post('op-jawaban'));
           $jum_pilihan = htmlspecialchars($this->input->post('opjumlah'));
           $UUID = uniqid();
           $soal = ($this->input->post('editor1'));
           var_dump($soal);
           $gambarSoal = $this->input->post('gambarSoal');
           $judul_soal = htmlspecialchars($this->input->post('judul'));
           $jawaban = htmlspecialchars($this->input->post('jawaban'));
           $kesulitan = htmlspecialchars($this->input->post('kesulitan'));
           $sumber = htmlspecialchars($this->input->post('sumber'));
           $publish = htmlspecialchars($this->input->post('publish'));
           $random = htmlspecialchars($this->input->post('random'));
           $pembahasan = $this->input->post('editor2');
           $opmedia=$this->input->post('opmedia');
           $a = htmlspecialchars($this->input->post('a'));
           $b = htmlspecialchars($this->input->post('b'));
           $c = htmlspecialchars($this->input->post('c'));
           $d = htmlspecialchars($this->input->post('d'));
           $e = htmlspecialchars($this->input->post('e'));
           $create_by = $this->session->userdata['id'];
           //kesulitan indks 1-3
           $dataSoal = array(
               'judul_soal' => $judul_soal,
               'soal' => $soal,
               'jawaban' => $jawaban,
               'sumber' => $sumber,
               'kesulitan' => $kesulitan,
               'publish' => $publish,
               'create_by' => $create_by,
               'id_subbab' => $subBabID,
               'UUID' => $UUID,
               'random' => $random,
               'pembahasan'=>$pembahasan
           );

           //call fungsi insert soal
           $this->Mbanksoal->insert_soal($dataSoal);
            $this->up_img_soal($UUID);
             //call fungsi upload soal listening
            $this->up_listening($UUID);
           // // mengambil id soal untuk fk di tb_piljawaban
           $data['tb_banksoal'] = $this->Mbanksoal->get_soalID($UUID)[0];
           $soalID = $data['tb_banksoal']['id_soal'];
           #Start pengecekan jenis inputan jawaban#
           //pengkondisian untuk jenis inputan text atau gambar

           if ($options == 'text') {
               #jika inputan text
               //cek tipe jumlah pilihan jawaban
            
            if ($jum_pilihan=='4') {
               $dataJawaban = array(
                   array(
                       'pilihan' => 'A',
                       'jawaban' => $a,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'B',
                       'jawaban' => $b,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'C',
                       'jawaban' => $c,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'D',
                       'jawaban' => $d,
                       'id_soal' => $soalID
                   )
               );
            } else {
                $dataJawaban = array(
                   array(
                       'pilihan' => 'A',
                       'jawaban' => $a,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'B',
                       'jawaban' => $b,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'C',
                       'jawaban' => $c,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'D',
                       'jawaban' => $d,
                       'id_soal' => $soalID
                   ),
                   array(
                       'pilihan' => 'E',
                       'jawaban' => $e,
                       'id_soal' => $soalID
                   )
               );
            }
               //call function insert jawaban tet
               $this->Mbanksoal->insert_jawaban($dataJawaban);
           } else {
               #jika inputan gambar
               //call functiom upload gamabar
               $this->up_img_jawaban($soalID);
           }
           #END pengecekan jenis inputan jawaban#

           # Start pengecekan media pembahasan
           if ($opmedia=='video') {
                // call funtion upload video pembahasan
                $this->up_video_pembahasan($UUID);
           } else {
                // call funtion upload gambar pembahasan
                $this->up_img_pembahasan($UUID);
           }
           #END pengecekan media pembahasan

           redirect(site_url('banksoal/listsoal'));
         // END SINTX UPLOAD SOAL  
    
    }

    //function upload gambar soal
     public function up_img_soal($UUID) {
        $config['upload_path'] = './assets/image/soal/';
        $config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        //random name
        $config['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["gambarSoal"]['name'];
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        $gambar = "gambarSoal";
        
        if ($this->upload->do_upload($gambar)) {
           $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        $data['UUID']=$UUID;
        $data['dataSoal']=  array(
            'gambar_soal' => $file_name);

            $this->Mbanksoal->ch_soal($data);
        }
       
    }
    //function upload gambar pembahasan
    public function up_img_pembahasan($UUID)
    {   
         // echo "img pembahasan";
         $configpmb['upload_path'] = './assets/image/pembahasan/';
        $configpmb['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $configpmb['max_size'] = 100;
        $configpmb['max_width'] = 1024;
        $configpmb['max_height'] = 768;
                //random name
        $configpmb['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["gambarPembahasan"]['name'];
        $configpmb['file_name'] = $new_name;

        $this->load->library('upload', $configpmb);
        $this->upload->initialize($configpmb);
        $gambar = "gambarPembahasan";
       
        if ($this->upload->do_upload($gambar)) {
            $file_data = $this->upload->data();
            $file_name = $file_data['file_name'];
            $data['UUID']=$UUID;
            $data['dataSoal']=  array(
            'gambar_pembahasan' => $file_name
            );

            $this->Mbanksoal->ch_soal($data);
        } 
       
    }
    // fungsi upload video
    public function up_video_pembahasan($UUID)
    {
        // echo "video pembahasan";
          $configvideo['upload_path'] = './assets/video/videoPembahasan';
        $configvideo['allowed_types'] = 'mp4';
        $configvideo['max_size'] = 90000;
        $this->load->library('upload', $configvideo);
        $this->upload->initialize($configvideo);
             // pengecekan upload
        if (!$this->upload->do_upload('video')) {
                // jika upload video gagal
            $error = array('error' => $this->upload->display_errors());

        } else {
                // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
              $file_data = $this->upload->data();
           $file_name = $file_data['file_name'];
        $data['UUID']=$UUID;
        $data['dataSoal']=  array(
            'video_pembahasan' => $file_name,
            'pembahasan'=>'');

            $this->Mbanksoal->ch_soal($data);
           
        }
    }
 //function update gambar pembahasan
    public function ch_img_pembahasan($UUID)
    {   
        $oldImgPembahasan = $this->Mbanksoal->get_oldimg_pembahasan($UUID);
        $oldVidePembahasan = $this->Mbanksoal->get_oldvideo_pembahasan($UUID);
         // echo "img pembahasan";
         $configpmb['upload_path'] = './assets/image/pembahasan/';
        $configpmb['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $configpmb['max_size'] = 100;
        $configpmb['max_width'] = 1024;
        $configpmb['max_height'] = 768;
                        //random name
        $configpmb['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["gambarPembahasan"]['name'];
        $configpmb['file_name'] = $new_name;
        $this->load->library('upload', $configpmb);
        $this->upload->initialize($configpmb);
        $gambar = "gambarPembahasan";
        
        if ($this->upload->do_upload($gambar)) {
             // unlink
            // unlink(FCPATH . "./assets/image/pembahasan/" . $oldImgPembahasan);
                if ($oldImgPembahasan!='' && $oldImgPembahasan!=' ') {
                   unlink(FCPATH . "./assets/image/pembahasan/" . $oldImgPembahasan);
                 }
             $file_data = $this->upload->data();
            $file_name = $file_data['file_name'];
            $data['UUID']=$UUID;
            $data['dataSoal']=  array(
                'gambar_pembahasan' => $file_name,
                'video_pembahasan' => ' '
            );

            $this->Mbanksoal->ch_soal($data);
        }
       
    }

 //function update Video pembahasan
    public function ch_video_pembahasan($UUID)
    {
         $oldImgPembahasan = $this->Mbanksoal->get_oldimg_pembahasan($UUID);
        // echo "video pembahasan";
          $configvideo['upload_path'] = './assets/video/videoPembahasan';
        $configvideo['allowed_types'] = 'mp4';
        $configvideo['max_size'] = 90000;
        $this->load->library('upload', $configvideo);
        $this->upload->initialize($configvideo);
             // pengecekan upload
        if (!$this->upload->do_upload('video')) {
                // jika upload video gagal
            $error = array('error' => $this->upload->display_errors());

        } else {
                // jika uplod video berhasil jalankan fungsi penyimpanan data video ke db
            //di komen dulu karena sedang dalam perbaikan
            
              $file_data = $this->upload->data();
           $file_name = $file_data['file_name'];
        $data['UUID']=$UUID;
        $data['dataSoal']=  array(
            'video_pembahasan' => $file_name,
            'pembahasan'=>'');

            $this->Mbanksoal->ch_soal($data);
        }
    }

    // update image soal
    public function ch_img_soal($UUID) {
        // config upload file img soal
        $config['upload_path'] = './assets/image/soal/';
        $config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        //config random name
        $config['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["gambarSoal"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        //menampung value input name imgae soal
        $gambar = "gambarSoal";
        //menampung img lama 
        $oldgambar = $this->Mbanksoal->get_oldgambar_soal($UUID)[0]['gambar_soal'];
        // melakukan upload img soal
        if ($this->upload->do_upload($gambar)) {
            // cek jika img lama null
         if ($oldgambar!='' && $oldgambar!=' ') {
            // jiaka imga lama ada maka hapus gambar lama di server
            unlink(FCPATH . "./assets/image/soal/" . $oldgambar );
         }
         $file_data = $this->upload->data();
         $file_name = $file_data['file_name'];
         $data['UUID']=$UUID;
         //menampung data img lama ke array untuk diupdate ke db
         $data['dataSoal']=  array(
          'gambar_soal' => $file_name);
         $this->Mbanksoal->ch_soal($data);
        }
        // $this->Mbanksoal->insert_gambar($datagambar);
    }
    //function untuk mengupload gambar pilihan jawaban
    public function up_img_jawaban($soalID) {
        $config2['upload_path'] = './assets/image/jawaban/';
        $config2['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config2['max_size'] = 100;
        $config2['max_width'] = 1024;
        $config2['max_height'] = 768;

        $n = '1';
        $datagambar = array();
        for ($x = 1; $x <= 5; $x++) {
            $gambar = "gambar" . $n;
                    //random name
        $config2['encrypt_name'] = TRUE;
        $new_name = time().$_FILES[$gambar]['name'];
        $config2['file_name'] = $new_name;
        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);

            if ($this->upload->do_upload($gambar)) {
              $file_data = $this->upload->data();
              $file_name = $file_data['file_name'];
              if ($n == '1') {
                  $pilihan = "A";
              } else if ($n == '2') {
                  $pilihan = "B";
              } else if ($n == '3') {
                  $pilihan = "C";
              } else if ($n == '4') {
                  $pilihan = 'D';
              } else {
                  $pilihan = 'E';
              }

              $datagambar[] = array('pilihan' => $pilihan,
                'gambar' => $file_name,
                'id_soal' => $soalID);
            } else {
                
            }
            $n++;
        }

        $this->Mbanksoal->insert_gambar($datagambar);
    }

    #ENDFunction untuk form upload soal#
    #START Function untuk form update bank soal #

    public function formUpdate() {
        $subBabID =htmlspecialchars($this->input->get('subBab'));
        $data['subBabID'] = $subBabID;
        $data['infosoal']=$this->Mbanksoal->get_info_soal($subBabID);
        $UUID = htmlspecialchars($this->input->get('UUID'));
        $data['page'] = htmlspecialchars($this->input->get('page'));
        //get data soan where==UUID
        $data['banksoal'] = $this->Mbanksoal->get_onesoal($UUID)[0];
        $id_soal = $data['banksoal']['id_soal'];
            //get piljawaban == id soal
        $data['piljawaban'] = $this->Mbanksoal->get_piljawaban($id_soal);
        $data['judul_halaman'] = "Bank Soal";
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-update-soal.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            // jika admin
            if ($data['subBabID'] == null || $UUID == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
            // jika guru
            if ($data['subBabID'] == null || $UUID == null) {
                redirect(site_url('guru/dashboard/'));
            } else {
                $this->parser->parse('templating/index-b-guru', $data);
            }
        }else{
                        // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
         #END Cek USer#
    }

    public function updatebanksoal() {
        #Start post data soal#
        $judul_soal = htmlspecialchars($this->input->post('judul'));
        $jum_pilihan = htmlspecialchars($this->input->post('opjumlah'));
        $options = htmlspecialchars($this->input->post('options'));
        $soal = ($this->input->post('editor1'));
        $soalID = htmlspecialchars($this->input->post('soalID'));
        $UUID = htmlspecialchars($this->input->post('UUID'));
        $subBabID = htmlspecialchars($this->input->post('subBabID'));
        $jawaban = htmlspecialchars($this->input->post('jawaban'));
        $kesulitan = htmlspecialchars($this->input->post('kesulitan'));
        $sumber = htmlspecialchars($this->input->post('sumber'));
        $publish = htmlspecialchars($this->input->post('publish'));
         $random = htmlspecialchars($this->input->post('random'));
         $pembahasan = $this->input->post('editor2');
          $opmedia=$this->input->post('opmedia');
        $create_by = $this->session->userdata['id'];
        #END post data soal#

        //pege redirect
        $page = htmlspecialchars($this->input->post('page')); 


        #Start post data pilihan jawaban#
        $idA = htmlspecialchars($this->input->post('idpilA'));
        $idB = htmlspecialchars($this->input->post('idpilB'));
        $idC = htmlspecialchars($this->input->post('idpilC'));
        $idD = htmlspecialchars($this->input->post('idpilD'));
        $idE = htmlspecialchars($this->input->post('idpilE'));
        $data['a'] = htmlspecialchars($this->input->post('a'));
        $data['b'] = htmlspecialchars($this->input->post('b'));
        $data['c']= htmlspecialchars($this->input->post('c'));
        $data['d'] = htmlspecialchars($this->input->post('d'));
        $data['e'] = htmlspecialchars($this->input->post('e'));
        #END post data pilihan jawaban#
        //keterangan *kesulitan index 1-3

        $data['UUID'] = $UUID;
        $data['dataSoal'] = array(
            'judul_soal' => $judul_soal,
            'soal' => $soal,
            'jawaban' => $jawaban,
            'sumber' => $sumber,
            'kesulitan' => $kesulitan,
            'publish' => $publish,
            'create_by' => $create_by,
            'random' => $random,
            'pembahasan' => $pembahasan,
            'id_subbab' => $subBabID
        );

        //call fungsi insert soal
        $this->Mbanksoal->ch_soal($data);
        $this->ch_img_soal($UUID);
        //update audio u/ soal listening
        $this->ch_listening($UUID);
        #data yg dilempar ke function count_pilihan#
        // data['id_soal'] digunakan untuk function pengecekan jumlah pilihan
        $data['id_soal']=$soalID;
        $data['jum_pilihan']=$jum_pilihan;
       
        ######################
        // cek jumlah pilihan jawaban di db
       $this->count_pilihan($data);
        #Start pengecekan jenis inputan jawaban#
        //pengkondisian untuk jenis inputan text atau gambar
        if ($options == 'text') {
            #jika inputan text
              if ($jum_pilihan=='4') {

               $data['dataJawaban']  = array(
                  array(
                    'pilihan' => 'A',
                    'jawaban' => $data['a'],
                ),
                array(
                    'pilihan' => 'B',
                    'jawaban' => $data['b'],
                ),
                array(
                    'pilihan' => 'C',
                    'jawaban' => $data['c'],
                ),
                array(
                    'pilihan' => 'D',
                    'jawaban' => $data['d'],
                )
               );
            } else {
                $data['dataJawaban']  = array(
                   array(
                    'pilihan' => 'A',
                    'jawaban' => $data['a'],
                ),
                array(
                    'pilihan' => 'B',
                    'jawaban' => $data['b'],
                ),
                array(
                    'pilihan' => 'C',
                    'jawaban' => $data['c'],
                ),
                array(
                    'pilihan' => 'D',
                    'jawaban' => $data['d'],
                ),
                array(
                    'pilihan' => 'E',
                    'jawaban' => $data['e'],
                )
               );
            }
             
            //call function insert jawaban tet
            $this->Mbanksoal->ch_jawaban($data);
            // $this->Mbanksoal->ch_jawaban($data);
        } else {
            #jika inputan gambar
            // call functiom upload gamabar
            $this->ch_img_jawaban($soalID);
        }
        #END pengecekan jenis inputan jawaban#

        # Start pengecekan media pembahasan
           if ($opmedia=='video' ) {
                $oldImgPembahasan = $this->Mbanksoal->get_oldimg_pembahasan($UUID);
                if ($oldImgPembahasan != '' && $oldImgPembahasan != ' ') {
                    unlink(FCPATH . "./assets/image/pembahasan/" . $oldImgPembahasan);
                }
                 $data['dataSoal']=  array(
                    'pembahasan' => ' ',
                    'gambar_pembahasan' => ' '
                    );

            $this->Mbanksoal->ch_soal($data);
                // call funtion upload video pembahasan
                $this->ch_video_pembahasan($UUID);
            }else{
            // var_dump($opmedia);
                // call funtion upload gambar pembahasan
                $oldVidePembahasan = $this->Mbanksoal->get_oldvideo_pembahasan($UUID);
                if ($oldVidePembahasan != '' && $oldVidePembahasan != ' ')  {
                    unlink(FCPATH . "./assets/video/videoPembahasan/" . $oldVidePembahasan);
                }
                
                $data['dataSoal']=  array(
                    'video_pembahasan' => ' ',
                    'link' => ''
                    );
                $this->ch_img_pembahasan($UUID);
               
           }


           #END pengecekan media pembahasan
        redirect(site_url('banksoal/listsoal/'. $page));
    }



    // pengecekan jumlaha pilihan
    public function count_pilihan($data){

      $id_soal=$data['id_soal'];
      $count_dat=$this->Mbanksoal->get_count_pilihan($id_soal);
      $a = $count_dat;
      if ( $count_dat>$data['jum_pilihan']) {
        $this->Mbanksoal->del_oneJawaban( $id_soal);
      } else if ($count_dat < 2 && $data['jum_pilihan'] == 4 ) {
        echo
          $dataJawaban = array(
            array('pilihan' => 'A',
             'id_soal' => $id_soal),
            array('pilihan' => 'B',
                'id_soal' => $id_soal),
            array('pilihan' => 'C',
                'id_soal' => $id_soal),
            array('pilihan' => 'D',
                'id_soal' => $id_soal));
          $this->Mbanksoal->insert_jawaban($dataJawaban);
      }else if ($count_dat < 2 && $data['jum_pilihan'] == 5 ) {
          $dataJawaban = array(
            array('pilihan' => 'A',
                'id_soal' => $id_soal),
            array('pilihan' => 'B',
                'id_soal' => $id_soal),
            array('pilihan' => 'C',
                'id_soal' => $id_soal),
            array('pilihan' => 'D',
                'id_soal' => $id_soal),
            array('pilihan' => 'E',
                'id_soal' => $id_soal));
           $this->Mbanksoal->insert_jawaban($dataJawaban);
      }else if ($count_dat<$data['jum_pilihan']) {
        // insert pilihan jawaban option E
        $pil_E = array(
          'pilihan' => 'E',
          'id_soal' => $id_soal
        );
        $this->Mbanksoal->add_oneJawaban($pil_E);

      }

    }

    public function ch_img_jawaban($soalID) {

        // unlink( FCPATH . "./assets/image/jawaban/".$xxxx );
        $config2['upload_path'] = './assets/image/jawaban/';
        $config2['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config2['max_size'] = 100;
        $config2['max_width'] = 1024;
        $config2['max_height'] = 768;
         //random name
        $config2['encrypt_name'] = TRUE;
        $oldgambar = $this->Mbanksoal->get_oldgambar($soalID);
        $n = '1';
        $datagambar = array();
        // pengulngan untuk mendapat kan data gambar lama
        foreach ($oldgambar as $rows) {
            // remove old gambar        
            $gambar = "gambar" . $n;

             $new_name = time().$_FILES[$gambar]['name'];
             $config2['file_name'] = $new_name;
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);

            //name old gambar
            $oldImg = $rows['gambar'];
            // pengecekan upload
            if ($this->upload->do_upload($gambar)) {
              // jika upload berhasil hapus gambar sebelumnya
                if ($oldImg!='' || $oldImg != ' ') {
                   unlink(FCPATH . "./assets/image/jawaban/" . $oldImg);
                }
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
                if ($n == '1') {
                    $pilihan = "A";
                } else if ($n == '2') {
                    $pilihan = "B";
                } else if ($n == '3') {
                    $pilihan = "C";
                } else if ($n == '4') {
                    $pilihan = 'D';
                } else {
                    $pilihan = 'E';
                }
                // tampung nama gambar yg berhasil di upload ke array
                $datagambar[] = array('pilihan' => $pilihan,
                    'gambar' => $file_name,
                    'id_soal' => $soalID,
                    'id_pilihan' => $rows['id_pilihan']);
           
            }else{
              //  
            }

            $n++;
        }
        // pengecekan jika array kosong
        if ($datagambar!=array()) {
          // jika array tidak kosong panggil function ch_gambar
         $this->Mbanksoal->ch_gambar($datagambar);
        }
    }

    #END Function untuk form update bank soal #
    #END Function untuk delete bank soal #
    //untuk fungsi hapus di view list soal tabel ajax
    public function deletebanksoal($data) {
        $this->Mbanksoal->del_banksoal($data);
    }
    //untuk fungsi hapus di list soal bukan ajax
    public function deletebanksoal2() {
        if ($this->input->post()) {
            $post = $this->input->post();
             $this->Mbanksoal->del_banksoal($post['id']);
        }
           redirect(site_url('banksoal/listsoal'));
    }
    // fungsi untuk memfilter video yang akan di tampilkan
    public function filtersoal()
    {
        $tingkatID = $this->input->post('tingkat');
        $mpID = $this->input->post('mataPelajaran');
        $bab=$this->input->post('bab');
        $subbab=$this->input->post('subbab');
        if ($subbab != null) {
            //list soal
            $this->subsoal($subbab);
        } else if ($bab != null) {
            $this->soalBab($bab);
        } else if ($mpID != null) {
            $this->soalMp($mpID);
        } else if ($tingkatID != null) {
            $this->soalTingkat($tingkatID);
        } else {
           $this->allsoal();
            // $this->listsoal($subbab);
        }    
    }


    // list soal per bab
    public function soalBab($babID)
    { 
        // $subBab = htmlspecialchars($this->input->get('subbab'));
        $data ['babID'] = $babID;
        $datBab=$this->Mbanksoal->get_judulBab($babID);
        $data['judulBab']=$datBab->judulBab;
        $tingkatPelajaranID=$datBab->tingkatPelajaranID;
        $namaMp=$this->Mbanksoal->get_namaMp($tingkatPelajaranID);
        $data['judul_halaman'] = "Bank Soal ".$namaMp;
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-bab.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
            // jika admin
            if ($babID == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
             // jika guru
            if ($babID == null) {
                 redirect(site_url('guru/dashboard/'));
            } else {
               $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
    }

     // list soal per mata Pelajaran
    public function soalMp($mpID)
    { 
        // $subBab = htmlspecialchars($this->input->get('subbab'));
        $data ['mpID'] = $mpID;
        $tingkatPelajaranID=$mpID;
        $namaMp=$this->Mbanksoal->get_namaMp($mpID);
        $data['namaMp']=$namaMp;
        $data['judul_halaman'] = "Bank Soal ".$namaMp;
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-mp.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
            // jika admin
            if ($mpID == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
             // jika guru
            if ($mpID == null) {
                 redirect(site_url('guru/dashboard/'));
            } else {
               $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
    }

    // list soal per tingkat
    public function soalTingkat($tingkatID)
    { 
        // $subBab = htmlspecialchars($this->input->get('subbab'));
        $data ['tingkatID'] = $tingkatID;
        $tingkatPelajaranID=$tingkatID;
        $tingkat=$this->Mbanksoal->get_namaTingkat($tingkatPelajaranID);
        $data['tingkat']=$tingkat;
        $data['judul_halaman'] = "Bank Soal ".$tingkat;
        $data['files'] = array(
            APPPATH . 'modules/banksoal/views/v-soal-tingkat.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
            // jika admin
            if ($tingkatID == null) {
                redirect(site_url('admin'));
            } else {
                $this->parser->parse('admin/v-index-admin', $data);
            }
            
        } elseif($hakAkses=='guru'){
             // jika guru
            if ($tingkatID == null) {
                 redirect(site_url('guru/dashboard/'));
            } else {
               $this->parser->parse('templating/index-b-guru', $data);
            }
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
        #END Cek USer#
    }

    public function filtersoal2()
    {
        $tingkatID = $this->input->get('tingkat');
        $mpID = $this->input->get('mataPelajaran');
        $bab=$this->input->get('bab');
        $subbab=$this->input->get('subbab');
        if ($subbab != null) {
            //list soal
            $this->listsoalSub($subbab);
        } else if ($bab != null) {
            $this->listsoalBab($bab);
        } else if ($mpID != null) {
            $this->listsoalMp($mpID);
        } else if ($tingkatID != null) {
            $this->listsoalTingkat($tingkatID);
        } else {
           $this->listsoal();
            // $this->listsoal($subbab);
        }    
    }

    //menampilkan list soal sub (tidak menggunkan datatable)
    public function listsoalSub($subbab='')
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mbanksoal->jumlah_soal_sub($subbab);

        
        $config['base_url'] = base_url().'index.php/banksoal/listsoalSub/'.$subbab.'/';
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
        $list = $this->Mbanksoal->data_soal_sub($config['per_page'],$from,$subbab);
      
        $this->tampSoal($list);
    }

     //menampilkan list soal bab (tidak menggunkan datatable)
    public function listsoalBab($bab="")
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mbanksoal->jumlah_soal_bab($bab);

        
        $config['base_url'] = base_url().'index.php/banksoal/listsoalBab/'.$bab.'/';
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
        $list = $this->Mbanksoal->data_soal_bab($config['per_page'],$from,$bab);
      
        $this->tampSoal($list);
    }

    public function listsoalMp($mpID='')
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mbanksoal->jumlah_soal_mp($mpID);
        
        $config['base_url'] = base_url().'index.php/banksoal/listsoalMp/'.$mpID.'/';
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
        $list = $this->Mbanksoal->data_soal_mp($config['per_page'],$from,$mpID);

        $this->tampSoal($list);
    }

    //menampilkan list soal tingkat (tidak menggunkan datatable)
     public function listsoalTingkat($tingkatID="")
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->Mbanksoal->jumlah_soal_tingkat($tingkatID);
        
        $config['base_url'] = base_url().'index.php/banksoal/listsoalTingkat/'.$tingkatID.'/';
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
        $list = $this->Mbanksoal->data_soal_tingkat($config['per_page'],$from,$tingkatID);
        $this->tampSoal($list);
    }

    // menampilkan soal saya
    public function mysoal()
    {
         // code u/pagination
       $this->load->database();
       $idPengguna = $this->session->userdata['id'];
        $jumlah_data = $this->Mbanksoal->jumlah_soalSaya($idPengguna);
       
        $config['base_url'] = base_url().'index.php/banksoal/mysoal/';
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
        
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $list = $this->Mbanksoal->data_soalSaya($config['per_page'],$from);

        $this->tampSoal($list);
    }
    //search autocomplete soal berdasarkan judul soal
    public function autocomplete()
    {
     $keyword = $_GET['term'];
        // cari di database
     $data = $this->Mbanksoal->get_cari($keyword);  

        // format keluaran di dalam array
     $arr = array();
     foreach($data as $row)
     {
        $arr[] = array(
            'value' =>"Judul: ".$row['judul_soal'].", Sumber: ".$row['sumber'],
            'url'=>base_url('banksoal/cari')."/".$row['judul_soal'],
            );
    }
        // minimal PHP 5.2
    echo json_encode($arr);
  }

  // cari soal berdasarkan nama
  public function cari($keyget='')
  {
      // code u/pagination
       $this->load->database();
           $keyword = $this->input->post('keyword');
           if ($keyget!='') {
               $keyword=$keyget;
           }
      $datCari = $this->Mbanksoal->get_cari2($keyword);
        $jumlah_data = $this->Mbanksoal->jumlah_soalCari($keyword);
       
        $config['base_url'] = base_url().'index.php/banksoal/cari/';
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
        
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $list = $this->Mbanksoal->data_soalCari($keyword,$config['per_page'],$from);

        // var_dump($list);
        $this->tampSoal($list);

  }
  //function upload gambar soal
     public function up_listening($UUID) {
        // echo "masuk listening";
        $configvoice['upload_path'] = './assets/audio/soal/';
        $configvoice['allowed_types'] = 'mp3';
                $configvoice['max_size'] = 30000;
        //random name
        $configvoice['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["listening"]['name'];
        $configvoice['file_name'] = $new_name;

        $this->load->library('upload', $configvoice);
        $this->upload->initialize($configvoice);
        $listening = "listening";
        
        if ($this->upload->do_upload($listening)) {
           $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        $data['UUID']=$UUID;
        $data['dataSoal']=  array(
            'audio' => $file_name);
            $this->Mbanksoal->ch_soal($data);
        }else{
            // $error = array('error' => $this->upload->display_errors());
            // var_dump( $error);
        }
       
    }

    public function ch_listening($UUID)
    {
         // config upload file audio soal
        $configvoice['upload_path'] = './assets/audio/soal/';
        $configvoice['allowed_types'] = 'mp3';
                $configvoice['max_size'] = 30000;
        //config random name
        $configvoice['encrypt_name'] = TRUE;
        $new_name = time().$_FILES["gambarSoal"]['name'];
        $configvoice['file_name'] = $new_name;
        $this->load->library('upload', $configvoice);
        //menampung value input name imgae soal
        $listening = "listening";
        //menampung audio lama 
        $oldAudio= $this->Mbanksoal->get_oldAudio_soal($UUID)[0]['audio'];
        // melakukan upload audio soal
            $this->upload->initialize($configvoice);
        if ($this->upload->do_upload($listening)) {
          // echo "masuk listening ch22"." ".$oldAudio."<br> ";
            // cek jika audio lama null
         if ($oldAudio!='' && $oldAudio!=' ') {
            // jiaka audio lama ada maka hapus gambar lama di server
            unlink(FCPATH . "./assets/audio/soal/" . $oldAudio );
         }
         //get nama file yg di upload ke server
         $file_data = $this->upload->data();
         $file_name = $file_data['file_name'];
         $data['UUID']=$UUID;
         //menampung data audio lama ke array untuk diupdate ke db
         $data['dataSoal']=  array(
          'audio' => $file_name);
         $this->Mbanksoal->ch_soal($data);
        }else{
           $error = array('error' => $this->upload->display_errors());
        }
    }

    // fungsi untuk menghapus gambar soal
    public function delImgSoal($UUID)
    {
        $oldImg=$this->Mbanksoal->get_oldgambar_soal($UUID);
        if ($oldImg) {
            $namaImg=$oldImg[0]['gambar_soal'];
             unlink(FCPATH . "./assets/image/soal/" . $namaImg);
             $data['UUID']=$UUID;
            $data['dataSoal']=  array(
                'gambar_soal' => ' ',
            );
               $this->Mbanksoal->ch_soal($data);
        }
    }

        // fungsi untuk menghapus gambar soal
    public function delImgpilihan($UUID,$pilihan)
    {
        $oldImg=$this->Mbanksoal->get_oldgambar_pilihan($UUID,$pilihan);
        if ($oldImg != null) {
            $namaImg=$oldImg[0]['gambar'];
             unlink(FCPATH . "./assets/image/jawaban/" . $namaImg);
             $data['id_pilihan']=$oldImg[0]['id_pilihan'];
            $data['dataJawaban']=  array(
                'gambar' => ' ',
            );
               $this->Mbanksoal->ch_single_img($data);
        }
    }

        // fungsi untuk menghapus gambar soal
    public function delAudioSoal($UUID)
    {
     $oldAudio=$this->Mbanksoal->get_oldAudio_soal($UUID);
        if ($oldAudio) {
            $namaAudio=$oldAudio[0]['audio'];
             unlink(FCPATH . "./assets/audio/soal/" . $namaAudio);
             $data['UUID']=$UUID;
             $data['dataSoal']=  array(
                'audio' => ' ',
            );
               $this->Mbanksoal->ch_soal($data);
        }
    }

        // fungsi untuk menghapus gambar pembahasan
    public function delImgPembahasan($UUID)
    {
        $oldImg=$this->Mbanksoal->get_oldgambar_soal($UUID);
        if ($oldImg) 
        {
            $namaImg=$oldImg[0]['gambar_pembahasan'];
             unlink(FCPATH . "./assets/image/pembahasan/" . $namaImg);
             $data['UUID']=$UUID;
            $data['dataSoal']=  array(
                'gambar_pembahasan' => ' ',
            );
               $this->Mbanksoal->ch_soal($data);
        }
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