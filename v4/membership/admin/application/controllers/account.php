<?php 

class Account extends CI_Controller {

	private $page_id;
	private $current_page;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
		
		$this->login_session_check->is_logged_in();
		//$this->login_session_check->permission_check();
		$this->current_page = 'account';
	}
	
	public function index()
	{
		redirect("index.php/account/profile");
	}
	
	public function profile()
	{
		$uid = $this->session->userdata('id');
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'account/profile_view'
		);
		
		$data['profile'] = $this->account_model->get_profile($uid);
        $this->load->view('includes/template',$data);
	}
	
	public function profile_update()
	{
		$result = $this->account_model->profile_update();
		redirect("index.php/account/profile");
	}
	
	public function password()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'account/password_view'
		);
        $this->load->view('includes/template',$data);
	}
	
	public function password_change()
	{
		$result = $this->account_model->password_change();
			
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'account/password_change',
			'pwd_status'	=> $result
		);
        $this->load->view('includes/template',$data);
	}
	
	
	public function settings()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'account/settings_view'
		);
        $this->load->view('includes/template',$data);
	}
	
	public function backup_db()
	{
		
		$db_name = 'ci_t4';
		$datestring = "%Y%m%d";
		$time = time();
		$curr_date = mdate($datestring, $time);
		$filename = $db_name. '_' . $curr_date . '.sql';
	
		$this->load->dbutil();
		$prefs = array(
                'format'      => 'txt',         
                'newline'     => "\n"
        );
		$backup =& $this->dbutil->backup($prefs); 

		$my_path = "/db/".$filename;			
		write_file($my_path, $backup);

		//$this->load->helper('download');
		//force_download($filename, $backup); 
		
		redirect('index.php/account/db_backup');
	}
	
	public function db_backup()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'account/settings_db_updated'
		);
        $this->load->view('includes/template',$data);
	}
}

