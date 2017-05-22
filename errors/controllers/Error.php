<?php 
/**
* 
*/
class Error extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct(); 
	}

	function index(){
		$this->output->set_status_header('404'); 
        $data['content'] = 'error_404'; // View name 
		echo "string";
	}
}
 ?>