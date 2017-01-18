<?php 

class Main_category_controller extends CI_Controller {

	private $page_id;
	private $current_page;
	private $id;

	function __construct()

	{
		parent::__construct();
		$this->load->model('main_category_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'menu';
	}

	public function index()
	{
		$result = $this->main_category_model->view();
		
		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'main_category/view',
			'result'		=> $result

		);

        $this->load->view('includes/template',$data);
	}

	function add()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'main_category/formadd'
		);

		
        $this->load->view('includes/template',$data);
	}
	function submit()
	{
		$name = $this->input->post("name_main_category");
		$description = $this->input->post("description");
		if(!empty($name)){
			$result = $this->main_category_model->submit($name,$description);
			redirect("main_category");
		}else{
			redirect("add_main_category");
		}
	}
	function delete()
	{
		$id = $this->uri->segment(2);
		$this->main_category_model->delete($id);

		redirect("main_category");
	}

	function edit()
	{
		$id = $this->uri->segment(2);
		$data = array(
			'data_result' 			=> $this->main_category_model->get_data($id),
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'main_category/edit'
		);
        $this->load->view('includes/template',$data);
	}
	function update()
	{
		$id = $this->input->post("id");
		$name = $this->input->post("name_main_category");
		$description = $this->input->post("description");
		$this->main_category_model->update($id,$name,$description);

		redirect("main_category");
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