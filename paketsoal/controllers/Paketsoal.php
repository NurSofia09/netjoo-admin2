<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
/**
 *
 */
class paketsoal extends MX_Controller
{
	public function __construct() {
		$this->load->library( 'parser' );
		$this->load->model( 'mpaketsoal' );
		$this->load->model( 'banksoal/mbanksoal' );
		$this->load->model( 'latihan/mlatihan' );
		 $this->load->model('komenback/mkomen');
		$this->load->library( 'form_validation' );
		$this->load->helper( array( 'form', 'url' ) );
		$this->load->model('templating/mtemplating');
		        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
		parent::__construct();
		if ($this->session->userdata('loggedin')==true) {
			if ($this->session->userdata('HAKAKSES')=='siswa'){
				redirect('welcome');
			}else if($this->session->userdata('HAKAKSES')=='guru'){
               // redirect('guru/dashboard');
			}else if($this->session->userdata('HAKAKSES')=='admin'){
               // redirect('guru/dashboard');
			}else{
				redirect('login');
			}
		}
	}

	##ajax untuk melakukan update pada paket soal
	public function ajax_update() {
		$data = array(
			'idpaket' => $this->input->post( 'idpaket' ),
			'nm_paket' => $this->input->post( 'nama_paket' ) ,
			'jumlah_soal' => $this->input->post( 'jumlah_soal' ),
			'deskripsi' =>$this->input->post( 'deskripsi' ),
			'durasi' =>$this->input->post( 'durasi' )
			);

		$this->mpaketsoal->rubahpaket( array( 'id' => $this->input->post( 'id' ) ), $data );
		echo json_encode( array( "status" => TRUE ) );
	}
	#

	##ajax untuk melakukan edit, mengambil nilai dari hasil query
	public function ajax_edit( $id ) {
		$data = $this->mpaketsoal->get_by_id( $id );
		echo json_encode( $data );
	}
	#

	#menampilkan semoa paket soal
	function ajax_list() {
		$list = $this->load->mpaketsoal->getpaketsoal();
		$data = array();

		$baseurl = base_url();
			$no = 0;
		foreach ( $list as $paket_soal ) {
			$no++;
			$penggunaID = $paket_soal['penggunaID'];
			 $hakAkses=$this->session->userdata['HAKAKSES'];
			$sesId = $this->session->userdata['id'];
			$statusRandom =  $paket_soal['random'];
			$row = array();
			$row[] = $no;
			$row[] = $paket_soal['nm_paket'];
			$row[] = $paket_soal['jumlah_soal'];
			$row[] = $paket_soal['durasi'];
			//pengecekan status random
			if ($statusRandom=='1') {
				$row[] ='YA';
			}else{
				$row[] ='TIDAK';
			}
			
			if ($penggunaID == $sesId || $hakAkses == "admin") {
				$row[] = '<a class="btn btn-sm btn-warning"  title="Edit" onclick="edit_paket('."'".$paket_soal['id_paket']."'".')"><i class="ico-edit"></i></a>
			<a class="btn btn-sm btn-success"  title="Add Soal" href="addbanksoal/'."".$paket_soal['id_paket']."".'"><i class="ico-file-plus2"></i></a>
			<a class="btn btn-sm btn-danger"  title="Hapus" onclick="delete_paket('."'".$paket_soal['id_paket']."'".')"><i class="ico-remove"></i></a>';
			}else{
				$row[] = '';
			}
			

			$data[] = $row;

		}
	##
		

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}


	#ajax untuk menampilkan soal yang terdapat pada paket soal tertentu.
	function ajax_listsoal($idpaket) {
		$list = $this->load->mpaketsoal->soal_by_paketID($idpaket);
		$data = array();


		//mengambil nilai list
		$baseurl = base_url();
		foreach ( $list as $list_soal ) {
			$kesulitan = $list_soal['kesulitan'];
			if ($kesulitan == 3) {
				$kesulitan = "Sulit";
			} else if ($kesulitan == 2) {
				$kesulitan = "Sedang";
			} else {
				$kesulitan ="Mudah";
			}
			
			$row = array();
			$row[] = $list_soal['id_soal'];
			$row[] = $list_soal['judul_soal'];
			$row[] = $list_soal['sumber'];
			$row[] = $list_soal['soal'];
			$row[] = $kesulitan;
			$row[] = '
			<a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_soal('."'".$list_soal['id']."'".')"><i class="ico-remove"></i></a>';
			$data[] = $row;

		}

		$output = array(
			"data"=>$data,
			);
		echo json_encode( $output );
	}
	##

	function index() {
		$this->tambahpaketsoal();
	}

	#daftar paket soal
	function tambahpaketsoal() {		
		$data['paket_soal'] = $this->load->mpaketsoal->getpaketsoal();
		$data['judul_halaman'] = "Buat Paket Soal";
		$data['files'] = array(
			APPPATH.'modules/paketsoal/views/v-create-paket-soal.php',
			);
		
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
			$this->load->view('templating/index-b-guru', $data);  


		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}
	##

	##menambahkan soal
	function add_soal() {
		
		$data['paket_soal'] = $this->load->mpaketsoal->getpaketsoal();
		$data['judul_halaman'] = "Tambahkan Paket Soal";
		$data['files'] = array(
			APPPATH.'modules/paketsoal/views/v-create-paket-soal.php',
			);
		$hakAkses=$this->session->userdata['HAKAKSES'];
		if ($hakAkses=='admin') {
        // jika admin
			$this->parser->parse('admin/v-index-admin', $data);


		} elseif($hakAkses=='guru'){
                    // jika guru
			$this->load->view('templating/index-b-guru', $data);  


		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}
	##

	#menambahkan paket soal ke dalam database
	function addpaketsoal() {
		$this->form_validation->set_rules( 'nama_paket', "Error Nama Paket", 'required' );

		$data = array(
			'nm_paket' => $this->input->post( 'nama_paket' ) ,
			'jumlah_soal' => $this->input->post( 'jumlah_soal' ),
			'deskripsi' =>$this->input->post( 'deskripsi' ),
			'durasi' =>$this->input->post( 'durasi' ),
			'random'=>$this->input->post('random'),
			'penggunaID'=>$this->session->userdata['id']

			);

		$this->mpaketsoal->insertpaketsoal( $data );
	}
	##

	function droppaketsoal(  ) {
		$id=$this->input->post('id');
		$this->mpaketsoal->droppaket( $id );
	}

	#mengupdate paket soal
	function updatepaketsoal() {
		$id=$this->input->post( 'id_paket' );
		$data = array(
			'nm_paket' =>  $this->input->post( 'nama_paket' ) ,
			'deskripsi' => $this->input->post( 'deskripsi' ),
			'jumlah_soal' => $this->input->post( 'jumlah_soal' ),
			'durasi' => $this->input->post( 'durasi' ),
			'random'=>$this->input->post('random')
			);

		$this->mpaketsoal->rubahpaket( $id, $data );
	}
	##

	##mengambil paket soal dirubah ke json
	function ambil_paket_soal() {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->load->mpaketsoal->getpaketsoal() ) ) ;
	}
	##

	#menambahkan soal ada paket tertentu.

	function get_validasi($idpaket){
		$paket_soal = $this->load->mpaketsoal->getpaket_by_id($idpaket);
		$jumlah_soal = (int)$paket_soal['jumlah_soal'];
		$jumlah_soal_paket = $this->load->mpaketsoal->get_jumlah_soal($idpaket);

		if ($jumlah_soal>=$jumlah_soal_paket) {
			// gaboleh inputin
			echo json_encode(false);
		}else{
			// boleh inputin
			echo json_encode(true);
		}

	}

	function addbanksoal( $idpaket ) {
		
		$paket_soal = $this->load->mpaketsoal->getpaket_by_id($idpaket);
		$jumlah_soal = (int)$paket_soal['jumlah_soal'];

		$data['judul_halaman'] = "Tambahkan Bank Soal";
		if (!$paket_soal==array()) {
			$data['listadd_soal']=$this->load->mpaketsoal->soal_by_paketID($idpaket);
			$data['panelheading'] = "Soal Untuk Paket soal ".$paket_soal['nm_paket'];
			$data['id_paket']=$idpaket;
			
			$data['files'] = array(
				APPPATH.'modules/paketsoal/views/v-add-soal.php',
				);	
		} else {
			$data['files'] = array(
				APPPATH . 'modules/templating/views/v-data-notfound.php',
				);
		}
		
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
			$this->load->view('templating/index-b-guru', $data);
		}else{
            // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}
	##

	#
	function ajax_get_soal_by_subbabid( $subBabID ) {

		$list = $soal=$this->mbanksoal->get_soal( $subBabID );
		$data = array();


		//mengambil nilai list
		$baseurl = base_url();
		foreach ( $list as $list_soal ) {
			$n='1';
			$row = array();

			$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
			<input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
			<label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
		</span>";
		$row[] = $list_soal['judul_soal'];
		$row[] = $list_soal['sumber'];
		$row[] = $list_soal['soal'];
		$row[] = $list_soal['kesulitan'];
		$data[] = $row;
		$n++;

	}

	$output = array(
		"data"=>$data,
		);
	echo json_encode( $output );

}


	#Start Function add soal paket#
public function addsoaltopaket()
{
	
	$idSoal = $this->input->post('data');
	$idSubbab = $this->input->post('idSubBab');
	$idpaket = $this->input->post('id_paket');

	$mmpaket=array();
	foreach ($idSoal as $key ) {		 
		$mmpaket[] = array(
			'id_paket' => $idpaket,
			'id_soal' => $key,
			'id_subbab' => $idSubbab);

	}


	$this->mpaketsoal->insert_soal_paket($mmpaket);

}
	#END Function add soal paket#

	#hapus paket soal
public function dropsoalpaket($id)
{
	$this->mpaketsoal->drop_soal_paket($id);

}
	##

	#ajax untuk menampilkan soal yang sudah di pub, belum terdaftar di paket dan statusnya 1
function ajax_unregistered_soal( $id_paket,$subBabId) {
	$param['id_paket'] = $id_paket;
	$param['subBabId'] = $subBabId;
	$data=array();
	$list = $soal=$this->mbanksoal->get_soal_terdaftar($param);

		//mengambil nilai list
	$baseurl = base_url();
	foreach ( $list as $list_soal ) {
		$n='1';
		$kesulitan = $list_soal['kesulitan'];
		if ($kesulitan == 3) {
			$kesulitan = "Sulit";
		} else if ($kesulitan == 2) {
			$kesulitan = "Sedang";
		} else {
			$kesulitan ="Mudah";
		}
		$row = array();
		$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'><input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal']."><label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label></span>";
		$row[] = $list_soal['judul_soal'];
		$row[] = $list_soal['sumber'];
		$row[] = $list_soal['soal'];
		$row[] = $kesulitan;
		$data[] = $row;
		$n++;

	}

	$output = array(
		"data"=>$data,
		);
	echo json_encode( $output );

}

public function get_soal_byid_paket($idpaket){
	$list = $this->mpaketsoal->get_soal_by_idpaket($idpaket);
	$data = array();
	foreach ($list as $list_soal) {
		$n='1';
		$row = array();
		$row[] = $list_soal['id_soal'];
		$row[] = $list_soal['judul_soal'];
		$row[] = $list_soal['soal'];
		$data[] = $row;

		$n++;

	}
	$output = array(
		"data"=>$data,
		);

	echo json_encode( $output );
	
}

		#
function ajax_get_soal_byid( $bab ) {

	$list = $soal=$this->mlatihan->get_soal_bybab( $bab );
	$data = array();


		//mengambil nilai list
	$baseurl = base_url();
	foreach ( $list as $list_soal ) {
		$n='1';
		$row = array();

		$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
		<input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
		<label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
	</span>";
	$row[] = $list_soal['judul_soal'];
	$row[] = $list_soal['sumber'];

	$row[] = $list_soal['soal'];

	if ($list_soal['kesulitan']=='0') {
		$row[] = "Mudah";
	} else if($list_soal['kesulitan']=='1'){
		$row[] = "Sedang";
	}else{
		$row[] = "Sulit";
	}
	$row[]='<a class="btn btn-success soal-'.$list_soal['id_soal'].'" title="lihat soal" onclick=detail_soal('.$list_soal['id_soal'].') data-todo='."'".json_encode($list_soal)."'".'> <i class="ico ico-eye"></i></a>';
	$data[] = $row;
	$n++;

}

$output = array(
	"data"=>$data,
	);
echo json_encode( $output );

}



#
function ajax_get_soal_bylatihanid( $latihan ) {

	$list = $soal=$this->mlatihan->get_soal_bybab( $bab );
	$data = array();


		//mengambil nilai list
	$baseurl = base_url();
	foreach ( $list as $list_soal ) {
		$n='1';
		$row = array();

		$row[] = "<span class='checkbox custom-checkbox custom-checkbox-inverse'>
		<input type='checkbox' name="."soal".$n." id="."soal".$list_soal['id_soal']." value=".$list_soal['id_soal'].">
		<label for="."soal".$list_soal['id_soal'].">&nbsp;&nbsp;</label>
	</span>";
	$row[] = $list_soal['judul_soal'];
	$row[] = $list_soal['sumber'];

	$row[] = $list_soal['soal'];

	if ($list_soal['kesulitan']=='0') {
		$row[] = "Mudah";
	} else if($list_soal['kesulitan']=='1'){
		$row[] = "Sedang";
	}else{
		$row[] = "Sulit";
	}
	$row[]='<a class="btn btn-success soal-'.$list_soal['id_soal'].'" title="lihat soal" onclick=detail_soal('.$list_soal['id_soal'].') data-todo='."'".json_encode($list_soal)."'".'> <i class="ico ico-eye"></i></a>';
	$data[] = $row;
	$n++;

}

$output = array(
	"data"=>$data,
	);
echo json_encode( $output );

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
