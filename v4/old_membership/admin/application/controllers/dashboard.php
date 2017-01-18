<?php 

class Dashboard extends CI_Controller {

	private $page_id;
	private $current_page;
	
	function __construct()
	{
		parent::__construct();
		$this->login_session_check->is_logged_in();
		//$this->login_session_check->permission_check();
		$this->current_page = 'dashboard';
	}
	
	public function index()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'dashboard_view'
		);
        $this->load->view('includes/template',$data);
	}
	
}

