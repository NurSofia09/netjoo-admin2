<?php 
/**
 * 
 */
 class Help_admin extends MX_Controller
 {

 	function __construct()
 	{
 		parent::__construct();
		$this->load->library('parser');
		$this->load->model('M_hadmin');
		$this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
 	}

 	function cekSession() {
        $status = false;
        $hakAkses = $this->session->userdata['HAKAKSES'];
        if ($hakAkses == 'admin') {
            $status = true;
        } elseif ($hakAkses == 'guru') {
            // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        } else {
            redirect(site_url('login'));
        }
        return $status;
    }

 	public function index()
 	{
 		$data['judul_halaman'] = "User Guide - Admin";
		$data['files'] = array(
				APPPATH . 'modules/help_admin/views/v-user_guide_admin.php',
				);

		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} else {
			redirect(site_url('login'));
		}
 	}

 	//get list  pdf user guide admin
 	public function get_list_user_guide_admin($value='')
 	{
 		// get data user_guide
 		$data=$this->M_hadmin->sc_user_guide_admin();
 		
 		foreach ($data as $key ) {
 			$status_user_guide=$key->status_user_guide;
 		} 		
 		
 		echo json_encode($dat);
 	}

 }
?>