<?php 

class Client extends CI_Controller {

	private $page_id;
	private $current_page;

	function __construct()

	{

		parent::__construct();
		$this->load->model('client_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'client';

	}

	public function index()
	{

		$result = $this->client_model->view();

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'client/view',
			'result'		=> $result

		);

        $this->load->view('includes/template',$data);

	}

	
	public function search()
	{

		$result = $this->client_model->search($this->input->post("q"));

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'client/view',
			'result'		=> $result

		);

        $this->load->view('includes/template',$data);

	}
	

	public function add()
	{

		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'client/add',
		);

		
        $this->load->view('includes/template',$data);

	}

		
	public function edit($id)
	{

		$result = $this->client_model->edit($id);

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'client/edit',
			'result'		=> $result[0]

		);
		
		
        $this->load->view('includes/template',$data);

	}

	
	public function do_add()
	{

		$result= $this->client_model->insert();

		redirect("client/");

	}

	
	public function do_edit()
	{

		$result=$this->client_model->update();

		redirect("client/");

	}
	

	public function delete($id)
	{

		$this->client_model->delete($id);

		redirect("client/");

	}


}