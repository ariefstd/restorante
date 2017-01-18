<?php 

class Package_controller extends CI_Controller {

	private $page_id;
	private $current_page;
	private $id;

	function __construct()

	{
		parent::__construct();
		$this->load->model('package_model');
		$this->load->model('main_category_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'menu';
	}

	public function index()
	{
		$result = $this->package_model->view();
		
		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'package/view',
			'result'		=> $result

		);

        $this->load->view('includes/template',$data);
	}

	function add()
	{
		$data = array(
			'data_main_category' => $this->main_category_model->view(),
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'package/add'
		);

		
        $this->load->view('includes/template',$data);
	}
	function submit()
	{
		$id_main 		= $this->input->post("main_category"); 
		$name 			= $this->input->post("package_name");
		$description 	= $this->input->post("description");
		$price 			= $this->input->post("price");
		
		$result = $this->package_model->submit($id_main,$name,$price,$description);
		redirect("package");

	}

	function delete()
	{
		$id = $this->uri->segment(2);
		$this->package_model->delete($id);
	}

	function edit()
	{
		$id = $this->uri->segment(2);
		$data = array(
			'data_result' 	=> $this->package_model->get_data($id),
			'current_page' 	=> $this->current_page,
			'data_main_category' => $this->main_category_model->view(),
			'main_content' 	=> 'package/edit',
		);
        $this->load->view('includes/template',$data);
	}

	function update()
	{
		$id_main 		= $this->input->post("main_category"); 
		$name 			= $this->input->post("package_name");
		$description 	= $this->input->post("description");
		$price 			= $this->input->post("price");
		
		$id 			= $this->input->post("id_package"); 
		$this->package_model->update($id,$id_main,$name,$price,$description);

		redirect("package");
	}

	public function search()
	{

		$result = $this->main_category_model->search($this->input->post("q"));
		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'main_category/view',
			'result'		=> $result
		);

        $this->load->view('includes/template',$data);

	}

}