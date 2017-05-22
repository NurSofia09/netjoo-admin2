<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
 class Linetopik extends MX_Controller
 {
 	
 	function __construct()
 	{
 		$this->load->model('Mlinetopik');
 		$this->load->library('parser');
        $this->load->model('tesonline/mtesonline');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        $this->sessionchecker->cek_token();
        
 	}

 	public function index()
 	{
 		echo "string";
 	}

    //list mapel untuk memilih step line
    public function lineMapel($tingkatID)
    {
        $data = array(
            'judul_halaman' => 'Netjoo - Welcome',
            'judul_header' => 'Mata Pelajaran',
             'judul_header2' =>'mapel'
        );
        $data['datMapel'] = $this->Mlinetopik->get_mapel($tingkatID);
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/linetopik/views/v-line-mapel.php',
            APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/index', $data);
    }

 	public function learningLine($babID)
 	{
 		$data = array(
      'judul_halaman' => 'Netjoo - Welcome',
      'judul_header' => 'Welcome',
      'judul_header2' =>'Time Line'
    );

 		$dat=$this->Mlinetopik->get_line_topik($babID);
        //list topik side bar
        $data['topik']=$this->Mlinetopik->get_topik($babID);
 		$data['datline']=array(); 
    $step=false;
 		foreach ($dat as $rows) {
 			$tampJenis = $rows['jenisStep'];
 			$UUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
            // pengecekan jenis step line
 			if ($tampJenis == '1') {
                // jika step line video
 				$jenis='Video';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie ';
                    $link = base_url('index.php/linetopik/step_video/').$UUID;
                    $status ="enable";
                } else {
                    $icon='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }

 			}else if ($tampJenis == '2') {
        // jika step line Materi atau modul
 				$jenis='Materi';
 				// pengecekan disable atau enable step
          if ($step == true || $urutan == '1' ) {
              $icon ='ico-file6';
              $link = base_url('index.php/linetopik/step_materi/').$UUID;
              $status ="enable";
          } else {
             $icon='ico-file6';
             $link = 'javascript:void(0)';
             $status ="disable";
          }
 			}else{
                // jika step line latihan atau quiz
 				$jenis='Latihan';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                  $icon='ico-pencil';
                 $link = 'javascript:void(0)';
                 $status ="disable";
                }
 			}
 			$data['datline'][]=array(
                'namaTopik'=>$rows['namaTopik'],
                'deskripsi'=>$rows['deskripsi'],
 				'namaStep'=> $rows['namaStep'],
                'bab'=>$rows['judulBab'],
                'mapel'=>$rows['keterangan'],
                'tingkat'=>$rows['aliasTingkat'],
 				'jenisStep'=>$jenis,
 				'icon' =>$icon,
 				'link' => $link,
                'status'=>$status);
            $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;
 		}
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/linetopik/views/v-line-topik.php',
            APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/index', $data);
 	}

 	// view step video
 	public function step_video($UUID)
 	{
        // pengecekan jika snip url
        $snip=$this->Mlinetopik->get_stepLog($UUID);
        if ($snip==false) {
          redirect('/welcome');
        }
        //get stepID untuk save log
         $stepID= $this->Mlinetopik->get_stepID($UUID);
        // save log step line
        $this->logLine($stepID);
 		 $data = array(
            'judul_halaman' => 'Netjoo - Step Video',
            'judul_header' => 'Step Video',
            'judul_header2' =>'Video Belajar'
        );
 		 $data['datVideo']=$this->Mlinetopik->get_datVideo($UUID);
         // get UUID TOPIK
         $data['UUID']=$data['datVideo']['UUID'];
         // Start get tanggal dan bulan
            $timestamp = strtotime($data['datVideo']['date_created']);
            $data['tgl']=date("d", $timestamp);
            $data['bulan']=date("M", $timestamp);
         // END get tanggal dan bulan
         //Start get data untuk time line side bar
           $dat=$this->Mlinetopik->get_topic_step2($UUID);
            $data['datline']=array();
            //menampung bolean t/f utuk disable enable step
            $step=false;
        foreach ($dat as $rows) {
            $data['namaTopik']=$rows['namaTopik'];
            $data['deskripsi']=$rows['deskripsi'];
            $data['topikUUID']=$rows['topikUUID'];
            $tampJenis = $rows['jenisStep'];
            $stepUUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
            // Pengecekan jenis step line
           if ($tampJenis == '1') {
                $jenis='Video';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie ';
                    $link = base_url('index.php/linetopik/step_video/').$stepUUID;
                    $status ="enable";
                } else {
                   $icon='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }else if ($tampJenis == '2') {
                $jenis='Materi';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon =' ico-file6';
                    $link = base_url('index.php/linetopik/step_materi/').$stepUUID;
                    $status ="enable";
                } else {
                   $icon =' ico-file6';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }else{
                $jenis='Latihan';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                    $icon ='ico-pencil';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }
                        //cek line yg dipilih
            if ($stepUUID==$UUID) {
               $status="current";
            }
            $data['datline'][]=array(
                'namaStep'=> $rows['namaStep'],
                'jenisStep'=>$jenis,
                'icon' =>$icon,
                'link' => $link,
                'status'=>$status);
            $data['tingkat']  = $rows['aliasTingkat'];
            $data['mapel']   = $rows['keterangan'];
            $data['bab']      = $rows['judulBab'];
            $data['topik']    = $rows['namaTopik'];
              $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;
        }
          // END get data time untuk side bar
 		  $data['files'] = array(

            APPPATH . 'modules/homepage/views/v-header-login.php',

            APPPATH . 'modules/linetopik/views/v-step-video.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );

     
        $this->parser->parse('templating/index', $data);

 	}

    // save log step
    public function logLine($stepID)
    {
       
        $log=$this->Mlinetopik->get_log($stepID);
        // pengecekan log step line
        
        if ($log == false) {
            
            $datLog = array(
                'penggunaID'=>$hakAkses=$this->session->userdata['id'],
                'stepID'=>$stepID);
            //jika log belum ada maka save log
            $this->Mlinetopik->save_log($datLog);
        }else{
           
        }

        return $log;
        
    }


 	// View step Materi
 	 	public function step_materi($UUID)
 	{
         $stepID= $this->Mlinetopik->get_stepID($UUID);
        $this->logLine($stepID);
 		 $data = array(

            'judul_halaman' => 'Netjoo - Step Materi',

            'judul_header' => 'Step Materi',
             'judul_header2' =>'Modul Belajar'

        );
 		$data['datMateri']=$this->Mlinetopik->get_datMateri($UUID);

         // get UUID TOPIK
        $data['UUID']=$data['datMateri']['UUID'];
          // get tanggal dan bulan
        $timestamp = strtotime($data['datMateri']['date_created']);
        $data['tgl']=date("d", $timestamp);
        $data['bulan']=date("M", $timestamp);
          //Start get data untuk time line side bar
        $dat=$this->Mlinetopik->get_topic_step2($UUID);
        $data['datline']=array();
         $step=false;
        foreach ($dat as $rows) {
            $data['namaTopik']=$rows['namaTopik'];
            $data['deskripsi']=$rows['deskripsi'];
            $data['topikUUID']=$rows['topikUUID'];
            $tampJenis = $rows['jenisStep'];
            $stepUUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
           if ($tampJenis == '1') {
                $jenis='Video';
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie';
                    $link = base_url('index.php/linetopik/step_video/').$stepUUID;
                    $status ="enable";
                } else {
                    $icon ='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }else if ($tampJenis == '2') {
                $jenis='Materi';
                
                if ($step == true || $urutan == '1' ) {
                    $icon ='ico-file6';
                    $link = base_url('index.php/linetopik/step_materi/').$stepUUID;
                    $status ="enable";
                } else {
                    $icon ='ico-file6';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }else{
                $jenis='Latihan';
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                    $icon ='ico-pencil';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }
            //cek line yg dipilih
            if ($stepUUID==$UUID) {
               $status="current";
            }
            $data['datline'][]=array(
                'namaStep'=> $rows['namaStep'],
                'jenisStep'=>$jenis,
                'icon' =>$icon,
                'link' => $link,
                'status'=>$status);
            $data['tingkat']  = $rows['aliasTingkat'];
            $data['mapel']   = $rows['keterangan'];
            $data['bab']      = $rows['judulBab'];
            $data['topik']    = $rows['namaTopik'];
            $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;
        }
          // END get data time untuk side bar
         
 		  $data['files'] = array(

            APPPATH . 'modules/homepage/views/v-header-login.php',

            APPPATH . 'modules/linetopik/views/v-step-materi.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );


        $this->parser->parse('templating/index', $data);

 	}

    public function create_session_id_latihan($id_latihan){

        $this->session->set_userdata('id_latihan',$id_latihan);
        $UUID=$this->Mlinetopik->get_UUID($id_latihan);
      
        redirect('/linetopik/step_quiz/'.$UUID, 'refresh');
         // redirect('/tesonline/mulaitest', 'refresh');

    }

 	// view step Quiz
 	 public function step_quiz($UUID)
 	{
       
 		if (!empty($this->session->userdata['id_latihan'])) {
            $data['limitQuiz']=$this->Mlinetopik->get_limitQuiz($UUID);
           $data['id_latihan'] = $this->session->userdata['id_latihan'];
            $this->load->view('templating/t-headersoal');

            $query = $this->load->Mlinetopik->get_soqlQuiz($data);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];
            // $this->parser->parse('templating/index', $data);
            $this->load->view('v-step-quiz.php', $data);
            $this->load->view('templating/t-footersoal');
        } else {
            $this->errorTest();
        }

 	}

    // Cek jawaban quiz
    public function cekJawaban() {
        $data = $this->input->post('pil');
        $id = $this->session->userdata['id_latihan'];
        $id_latihan = $this->session->userdata['id_latihan'];
        // $level = $this->mtesonline->levelLatihan($id_latihan)[0]->level;
        $result = $this->load->mtesonline->jawabansoal($id);
        $datQuiz = $this->Mlinetopik->get_datQuiz($id);
        $minBenar = $datQuiz ['jumlah_benar'];
        $benar = 0;
        $salah = 0;
        $kosong = 0;
        $koreksi = array();
        $idSalah = array();
        $jumlahsoal = sizeOf($result);
        for ($i = 0; $i < sizeOf($result); $i++) {
            $id = $result[$i]['soalid'];
            // $data[$id];
            if (!isset($data[$id])) {
                $kosong++;
                $koreksi[] = $result[$i]['soalid'];
                $idSalah[] = $i;
            } else if ($data[$id] == $result[$i]['jawaban']) {
                $benar++;
            } else {
                $salah++;
                $koreksi[] = $result[$i]['soalid'];
                $idSalah[] = $i;
            }
        }
        $data['jumlahsoal']   = $jumlahsoal;
        $data['syarat']       = $minBenar;
        $data['jumlahBenar']  = $benar;
        $data['jumlahSalah']  = $salah;
        $data['jumlahKosong'] = $kosong;
         // cek ke lulusan
        $tampStep = $this->Mlinetopik->get_stepID2($id_latihan);
        $stepID = $tampStep['id'];
        // $UUID = $tampStep['UUID'];
        $data['stepUUID']     = $tampStep['UUID'];
        if ($benar >= $minBenar ) {
          $data['hasil'] = "Selamat Anda Lulus";
             
             $this->logLine($stepID);
         } else {
          $data['hasil'] = "Selamat Anda Gagal, Silahkan Coba Lagi";
         }
         
         // redirect('/linetopik/timeLine/'.$UUID);
         $this->laporanQuiz($data);
    }

    public function timeLine($UUID)
    {
        $data = array(

            'judul_halaman' => 'Netjoo - Timeline',

            'judul_header' => 'Timeline',
             'judul_header2' =>'Timeline'

        );

         $dat=$this->Mlinetopik->get_topic_step($UUID);
        $data['datline']=array();
         $step=false;
        foreach ($dat as $rows) {
            $data['namaTopik']=$rows['namaTopik'];
            $data['deskripsi']=$rows['deskripsi'];
            $tampJenis = $rows['jenisStep'];
            $UUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
           if ($tampJenis == '1') {
                $jenis='Video';
                
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie';
                    $link = base_url('index.php/linetopik/step_video/').$UUID;
                    $status ="enable";
                    
                } else {
                    $icon ='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }

            }else if ($tampJenis == '2') {
                $jenis='Materi';
                
                if ($step == true || $urutan == '1' ) {
                    $icon ='ico-file6';
                    $link = base_url('index.php/linetopik/step_materi/').$UUID;
                    $status ="enable";
                } else {
                    $icon ='ico-file6';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }else{
                $jenis='Latihan';
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                    $icon ='ico-pencil';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }
            }
            $data['datline'][]=array(
                'namaStep'=> $rows['namaStep'],
                'jenisStep'=>$jenis,
                'icon' =>$icon,
                'link' => $link,
                'bab'=>$rows['judulBab'],
                'mapel'=>$rows['keterangan'],
                'tingkat'=>$rows['aliasTingkat'],
                'status'=>$status);
              $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;
            $babID = $rows['babID'];
;        }
        $data['topik']=$this->Mlinetopik->get_topik($babID);
          // END get data time untuk side bar
         
          $data['files'] = array(

            APPPATH . 'modules/homepage/views/v-header-login.php',

            APPPATH . 'modules/linetopik/views/v-oneline.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );


        $this->parser->parse('templating/index', $data);
    }

    //menampilkan laporan hasil quiz
    public function laporanQuiz($datArr)
    {
      $data = array(

            'judul_halaman' => 'Netjoo - Step Materi',

            'judul_header' => 'Step Quiz',
             'judul_header2' =>'Step Quiz'

        );
      $stepUUID=$datArr['stepUUID'];
      $dat=$this->Mlinetopik->get_topic_step2($stepUUID);
      $data['data']=$datArr;

        // Start step line data
        $data['datline']=array();
        // 
        $step=false;
        foreach ($dat as $rows) {
            $tampJenis = $rows['jenisStep'];
            $UUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
            // pengecekan jenis step line
            if ($tampJenis == '1') {
                // jika step line video
                $jenis='Video';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie ';
                    $link = base_url('index.php/linetopik/step_video/').$UUID;
                    $status ="enable";
                } else {
                    $icon='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }

            }else if ($tampJenis == '2') {
                // jika step line Materi atau modul
                $jenis='Materi';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon ='ico-file6';
                    $link = base_url('index.php/linetopik/step_materi/').$UUID;
                    $status ="enable";
                } else {
                   $icon='ico-file6';
                   $link = 'javascript:void(0)';
                   $status ="disable";
                }
            }else{
                // jika step line latihan atau quiz
                $jenis='Latihan';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                  $icon='ico-pencil';
                 $link = 'javascript:void(0)';
                 $status ="disable";
                }
            }
            $data['namaTopik']=$rows['namaTopik'];
            $data['bab'] =$rows['judulBab'];
            $data['mapel'] =$rows['keterangan'];
            $data['tingkat']=$rows['aliasTingkat'];
            $data['topikUUID']=$rows['topikUUID'];
            $data['datline'][]=array(
                'deskripsi'=>$rows['deskripsi'],
                'namaStep'=> $rows['namaStep'],
               
                'jenisStep'=>$jenis,
                'icon' =>$icon,
                'link' => $link,
                'status'=>$status);
            $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;

        }

      // END step line data

        $data['files'] = array(

            APPPATH . 'modules/homepage/views/v-header-login.php',

            APPPATH . 'modules/linetopik/views/v-hasil-quiz.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );


        $this->parser->parse('templating/index', $data);
    }

    //PENCARIAN TOPIK
    public function cariTopik()
    {   
        $data = array(
            'judul_halaman' => 'Netjoo - Step Line',
            'judul_header' => 'Hasil Pencarian',
             'judul_header2' =>'Hasil Pencarian Topik'
        );
        $kunciCari=htmlspecialchars($this->input->get('keycari'));
        
        $dat=$this->Mlinetopik->get_cariTopik($kunciCari);
        
         $data['topik']=$this->Mlinetopik->get_topik_bynama($kunciCari);
        $data['datline']=array();
        // Start step line
          $step=false;
        foreach ($dat as $rows) {
            $tampJenis = $rows['jenisStep'];
            $UUID = $rows['stepUUID'];
            $stepID = $rows['stepID'];
            $urutan = $rows ['urutan'];
            // pengecekan jenis step line
            if ($tampJenis == '1') {
                // jika step line video
                $jenis='Video';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon='ico-movie ';
                    $link = base_url('index.php/linetopik/step_video/').$UUID;
                    $status ="enable";
                } else {
                    $icon='ico-movie';
                    $link = 'javascript:void(0)';
                    $status ="disable";
                }

            }else if ($tampJenis == '2') {
                // jika step line Materi atau modul
                $jenis='Materi';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                    $icon ='ico-file6';
                    $link = base_url('index.php/linetopik/step_materi/').$UUID;
                    $status ="enable";
                } else {
                   $icon='ico-file6';
                   $link = 'javascript:void(0)';
                   $status ="disable";
                }
            }else{
                // jika step line latihan atau quiz
                $jenis='Latihan';
                // pengecekan disable atau enable step
                if ($step == true || $urutan == '1' ) {
                   $icon ='ico-pencil';
                  $latihanID = $rows['latihanID'];
                   $link = base_url('index.php/linetopik/create_session_id_latihan/').$latihanID;
                   $status ="enable";
                } else {
                  $icon='ico-pencil';
                 $link = 'javascript:void(0)';
                 $status ="disable";
                }
            }
            $data['datline'][]=array(
                'namaTopik'=>$rows['namaTopik'],
                'deskripsi'=>$rows['deskripsi'],
                'namaStep'=> $rows['namaStep'],
                'bab'=>$rows['judulBab'],
                'mapel'=>$rows['keterangan'],
                'tingkat'=>$rows['aliasTingkat'],
                'jenisStep'=>$jenis,
                'icon' =>$icon,
                'link' => $link,
                'status'=>$status);
            $log=$this->Mlinetopik->get_log($stepID);
            $step = $log;

        }
        $data['files'] = array(

            APPPATH . 'modules/homepage/views/v-header-login.php',

            APPPATH . 'modules/linetopik/views/v-line-topik.php',

            APPPATH . 'modules/homepage/views/v-footer.php',

        );

        $this->parser->parse('templating/index', $data);
        // END step line
    }


//search autocomplete soal berdasarkan judul soal
public function autocompleteTopik()
{
 $keyword = $_GET['term'];
  // cari di database
 $data = $this->Mlinetopik->get_cari_topik($keyword); 
 // format keluaran di dalam array
 $arr = array();
 foreach($data as $row)
 {
     $arr[] = array(
        'value' =>$row['namaTopik'],
        'url'=>base_url('linetopik/timeLine')."/".$row['UUID'],
        );
 }
        // minimal PHP 5.2
 echo json_encode($arr);
}
 

 } ?>