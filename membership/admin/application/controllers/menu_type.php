<?php

class Menu_type extends CI_Controller {

	private $page_id;
	private $current_page;

	function __construct()

	{

		parent::__construct();
		$this->load->model('menu_type_model');
		$this->load->model('package_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'menu_type';

	}

	public function index()
	{

		$result = $this->menu_type_model->view();

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu_type/view',
			'result'		=> $result

			);

		$this->load->view('includes/template',$data);

	}


	public function search()
	{

		$result = $this->menu_type_model->search($this->input->post("q"));

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu_type/view',
			'result'		=> $result

			);

		$this->load->view('includes/template',$data);

	}


	public function add()
	{

		$data = array(
			'package'		=> $this->package_model->view(),
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu_type/add'
			);


		$this->load->view('includes/template',$data);

	}


	public function edit($id)
	{

		$result = $this->menu_type_model->edit($id);

		$data = array(
			'package'		=> $this->package_model->view(),
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'menu_type/edit',
			'result'		=> $result[0]

			);


		$this->load->view('includes/template',$data);

	}


	public function do_add()
	{

		$result= $this->menu_type_model->insert();

		redirect("menu_type/");

	}


	public function do_edit()
	{

		$result=$this->menu_type_model->update();

		redirect("menu_type/");

	}


	public function delete($id)
	{

		$this->menu_type_model->delete($id);

		redirect("menu_type/");

	}


}
