<?php 
/**
* 
*/
class Logout extends MX_Controller
{
	public function index(){
        $this->session->unset_userdata("id");
        $this->session->unset_userdata("USERNAME");
        $this->session->unset_userdata("HAKAKSES");
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();

        $this->session->set_flashdata('notif', ' Terimakasih sudah belajar bersama kami');
        redirect(site_url('login'));
	}
}
 ?>