<?php 

class Permission extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->current_page = 'permission';
	}
	
	public function index()
	{
		$this->session->sess_destroy();
		$this->view();
	}
	
	public function view()
    { 
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'authentication/permission_view'
		);
        $this->load->view('includes/template',$data);
		
    }
	
}

