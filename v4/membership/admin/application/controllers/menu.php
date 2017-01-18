<?php

class Menu extends CI_Controller {

	private $page_id;
	private $current_page;

	function __construct()

	{
		parent::__construct();
		$this->load->model('menu_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'menu';
	}

	public function index()
	{
		$result = $this->menu_model->view();
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu/view',
			'result'		=> $result
			);
		$this->load->view('includes/template',$data);
	}


	public function search()
	{
		$result = $this->menu_model->search($this->input->post("q"));
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu/view',
			'result'		=> $result
			);
		$this->load->view('includes/template',$data);
	}


	public function add()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu/add',
			'type' 	=> $this->menu_model->typeList()
			);
		$this->load->view('includes/template',$data);
	}


	public function edit($id)
	{
		$result = $this->menu_model->edit($id);
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu/edit',
			'type' 			=> $this->menu_model->typeList(),
			'result'		=> $result[0]
			);
		$this->load->view('includes/template',$data);
	}

	public function do_add()
	{
		$result= $this->menu_model->insert();
		redirect("menu/");
	}


	public function do_edit()
	{

		$result=$this->menu_model->update();

		redirect("menu/");

	}


	public function delete($id)
	{

		$this->menu_model->delete($id);

		redirect("menu/");

	}


}
