<?php 
/**
* 
*/
class Materi extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mmateri');
		$this->load->library('parser');
		    $this->load->library('sessionchecker');
         $this->sessionchecker->checkloggedin();
	}

	// Menampilkan form materi
	public function form_materi()
	{
		$data['files'] = array(
			APPPATH . 'modules/materi/views/v-form-materi.php',
			);
		$data['judul_halaman'] = "Form Input Materi";
		$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
		if ($hakAkses=='admin') {
        // jika admin
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif($hakAkses=='guru'){
                 // jika guru
			 redirect(site_url('guru/dashboard/'));       
		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}

	// upload materi
	public function uploadMateri()
	{
		$judulMateri=htmlspecialchars($this->input->post('judul'));
		$subBabID = htmlspecialchars($this->input->post('subBabID'));
		$isiMateri = $this->input->post('editor1');
		$publish= htmlspecialchars($this->input->post('stpublish'));
 		$penggunaID = $this->session->userdata['id'];
 		$UUID = uniqid();
		$datMateri=array(
						'judulMateri'=>$judulMateri,
						'isiMateri'=>$isiMateri,
						'subBabID'=>$subBabID,
						'penggunaID'=>$penggunaID,
						'publish'=>$publish,
						'UUID'=>$UUID);

		// var_dump($datMateri);
		$this->Mmateri->in_materi($datMateri);
		redirect(site_url('materi/list_all_materi'));
	}

	// tampil list materi
	public function list_all_materi ()
	{
		$data['files'] = array(
			APPPATH . 'modules/materi/views/v-all-materi.php',
			);
		$data['judul_halaman'] = "Materi";
		$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
		if ($hakAkses=='admin') {
        // jika admin
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif($hakAkses=='guru'){
                 // jika guru
			 redirect(site_url('guru/dashboard/'));           
		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}
	// get ajax list materi
	public function ajax_get_all_materi()
	{
		$materi= $this->load->Mmateri->get_all_materi();
        $data = array();
        //var_dump($list);
        //mengambil nilai list
        $baseurl = base_url();
        $no='1';
        foreach ( $materi as $list_materi ) {
            $n='1';
            
            $row = array();
            if ($list_materi['publish']=='1') {
              $publish='Publish';
            }else{
              $publish='Tidak Publish';
            }
            $row[] = $no;
            $row[] = $list_materi['judulMateri'];
            $row[] =$list_materi['aliasTingkat'];
            $row[] =$list_materi['mapel'];
            $row[] =$list_materi['judulBab'];
            $row[] =$list_materi['judulSubBab'];
            $row[] =$list_materi['tgl'];
            $row[] =  $publish;
            $row[] = '  <a class="btn btn-sm btn-primary btn-outline detail-'.$list_materi['materiID'].'"  title="Lihat"
              data-id='."'".json_encode($list_materi)."'".'
              onclick="detail('."'".$list_materi['materiID']."'".')"
              >
              <i class=" ico-eye "></i>
                </a> 
              <a class="btn btn-sm btn-warning" href="materi/form_update_materi/'.$list_materi['UUID'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_materi('."'".$list_materi['UUID']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          
         

          $data[] = $row;
          $n++;
          $no++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
	}

	// menampilkan  form update materi
	public function form_update_materi($UUID)
	{
		$data['singleMateri']=$this->Mmateri->get_single_materi($UUID);
		$subBabID = $data['singleMateri'] ['subBabID'];
		$data['infomateri']=$this->Mmateri->get_tingkat_info($subBabID);
		$data['files'] = array(
			APPPATH . 'modules/materi/views/v-update-materi.php',
			);
		$data['judul_halaman'] = "Form Update Materi";
		$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
		if ($hakAkses=='admin') {
        // jika admin
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif($hakAkses=='guru'){
                 // jika guru
			$this->parser->parse('templating/index-b-guru', $data);          
		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}

	// update materi
	public function updateMateri()
	{	
		$data['UUID'] = $this->input->post('UUID');
		$judulMateri=htmlspecialchars($this->input->post('judul'));
		$subBabID = htmlspecialchars($this->input->post('subBabID'));
		$isiMateri = $this->input->post('editor1');
		$publish= htmlspecialchars($this->input->post('stpublish'));
 		$penggunaID = $this->session->userdata['id'];
		$data['datMateri']=array(
						'judulMateri'=>$judulMateri,
						'isiMateri'=>$isiMateri,
						'subBabID'=>$subBabID,
						'penggunaID'=>$penggunaID,
						'publish'=>$publish);

		
		$this->Mmateri->ch_materi($data);
		redirect(site_url('materi/list_all_materi'));
	}

	public function del_materi($UUID)
	{
		$this->Mmateri->drop_materi($UUID);
	}
}
?>