<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
 class Gallery extends MX_Controller
 {
 	private $upload_path = "./assets/image/gallery";
 	function __construct()
 	{
        date_default_timezone_set('Asia/Jakarta');
        
 		parent::__construct();
        $this->load->model('Mgallery');
        $this->load->model('banksoal/Mbanksoal');
        $this->load->model('templating/Mtemplating');
        $this->load->model('komenback/mkomen');
        $this->load->library('parser');
            $this->load->library('sessionchecker');
         $this->sessionchecker->checkloggedin();
 	}


	public function index()
	{
		$data['datImg'] = $this->Mgallery->get_datImg();
		$data['files'] = array(
            APPPATH . 'modules/gallery/views/v-gallery.php',
            );

        $data['judul_halaman'] = "Gallery";
        $data['judul_panel'] ="Semua Gambar";
        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 

        if ($hakAkses=='admin') {
        // jika admin
         $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
          // notification
          $data['datKomen']=$this->datKomen();
          $id_guru = $this->session->userdata['id_guru'];
          // get jumlah komen yg belum di baca
          $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
          //
          // jika guru
          $this->parser->parse('templating/index-b-guru', $data);
            
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
	}
 	//
 	public function formGallery()
 	{	
 		$idBab=htmlentities($this->input->post('bab'));
 		$data['idBab']=$idBab;
 		$data['datAttr']=$this->Mgallery->get_attribut($idBab);
 		 $data['files'] = array(
            APPPATH . 'modules/gallery/views/v-form-gallery.php',
            );

        $data['judul_halaman'] = "Upload Image Gallery";

        $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 

        if ($hakAkses=='admin') {
        // jika admin
         $this->parser->parse('admin/v-index-admin', $data);


        } elseif($hakAkses=='guru'){
          // jika guru
          //get data komen yg belum di baca
          $data['datKomen']=$this->datKomen();
          ##count komen
          //get id guru
          $id_guru = $this->session->userdata['id_guru'];
          // get jumlah komen yg belum di baca
          $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
          ## count komen
          $this->parser->parse('templating/index-b-guru', $data);
            
            
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
 	}

 // fungsi untuk memfilter gallery yang akan di tampilkan
    public function filtergallery()
    {
        $tingkatID = $this->input->post('tingkat');
        $mpID = $this->input->post('mataPelajaran');
        $bab=$this->input->post('bab');
        $subbab=$this->input->post('subbab');
         if ($bab != null) {
            $this->galleryBab($bab);
        } else if ($mpID != null) {
            $this->galleryMp($mpID);
        } else if ($tingkatID != null) {
            $this->galleryTingkat($tingkatID);
        } else {
           $this->index();
            // $this->listsoal($subbab);
        }    
    }

    //  gallery per tingkat
    public function galleryTingkat($tingkatID)
    { 
        $data['datImg'] = $this->Mgallery->get_datImg_tingkat($tingkatID);
       // $subBab = htmlspecialchars($this->input->get('subbab'));
        $data ['tingkatID'] = $tingkatID;
        $tingkatPelajaranID=$tingkatID;
        $tingkat=$this->Mbanksoal->get_namaTingkat($tingkatPelajaranID);
        $data['tingkat']=$tingkat;
                $data['judul_halaman'] = "Gallery";
        $data['judul_panel'] ="Gallery Berdasarkan Tingkat".$tingkat;
        $data['files'] = array(
            APPPATH . 'modules/gallery/views/v-gallery.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
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

    //  gallery per bab
    public function galleryMp($mpID)
    { 
        $data['datImg'] = $this->Mgallery->get_datImg_mapel($mpID);
         $data ['mpID'] = $mpID;
        $tingkatPelajaranID=$mpID;
        $namaMp=$this->Mbanksoal->get_namaMp($mpID);
        $data['namaMp']=$namaMp;
                $data['judul_halaman'] = "Gallery ";
                $data['judul_panel'] ="Gallery Berdasarkan Mata Pelajaran".$namaMp;
        $data['files'] = array(
          APPPATH . 'modules/gallery/views/v-gallery.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
           
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

    //  gallery per bab
    public function galleryBab($babID)
    { 
        $data['datImg'] = $this->Mgallery->get_datImg_bab($babID);
        $data ['babID'] = $babID;
        $datBab=$this->Mbanksoal->get_judulBab($babID);
        $data['judulBab']=$datBab->judulBab;
        $tingkatPelajaranID=$datBab->tingkatPelajaranID;
        $namaMp=$this->Mbanksoal->get_namaMp($tingkatPelajaranID);
        $data['judul_halaman'] = "Gallery ";
            $data['judul_panel'] ="Gallery Berdasarkan Mata Pelajaran".$namaMp;
        $data['files'] = array(
           APPPATH . 'modules/gallery/views/v-gallery.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses =='admin') {
           
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


 	public function upload($babID)
	{
		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}else{
				$file_data = $this->upload->data();
		        $file_name = $file_data['file_name'];
		        $UUID=uniqid();
		         $data['dataGallery']=  array(
	            'file_name' => $file_name,
	            'UUID' => $UUID,
	            'babID'=> $babID);

	            $this->Mgallery->in_gallery($data);
			}
		}
	}

	public function remove_img()
	{
		$upload_path = "./assets/image/gallery";
		$file = $this->input->post('file');
		$UUID = $this->input->post('UUID');
		$this->Mgallery->del_gallery($UUID);
		// unlink(FCPATH . $upload_path . "/" .$file );
		if ($file && file_exists($upload_path . "/" . $file)) {
			unlink($upload_path . "/" . $file);
		}	
}


	public function search_gallery()
    {
        $namafile = $_GET['term'];
          // var_dump($namapertanyaan);
          $result = $data['datImg']=$this->Mgallery->get_gallery($namafile);

          // var_dump($result);
          $gallery = array();
          foreach ($result as $key) {
            $gallery[] = array(
              'value'=>$key['file_name'],
              'url'=>base_url('/assets/image/gallery/').$key['file_name'],
              'icon'=>base_url('/assets/image/gallery/').$key['file_name']

              );
            // $pertanyaan[] = $key->judulPertanyaan  
          }
          echo json_encode($gallery);
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