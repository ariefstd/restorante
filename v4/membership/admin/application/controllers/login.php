<?php 



class Login extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model('login_model');

		$this->current_page = 'login';

	}

	

	public function index()

	{

		$this->view();

	}

	

	public function view()

    { 

		$data = array(

			'current_page' 	=> $this->current_page,

			'main_content' 	=> 'authentication/login_view'

		);

        $this->load->view('includes/template',$data);

    }

	

	public function validate_login()

	{

		$result = $this->login_model->validate();

		

		if(isset($result))

		{ 

			$row = $result->row_array(); 

			$data = array(

					'id'			=> $row['id'],

					'name'      	=> $row['name'],

					'permission'    => $row['permission'],

					'type'    => $row['type'],

                    'username'      => $this->input->post('username'),

                    'is_logged_in'  => true

            );



            $this->session->set_userdata($data);    //store user login data into session



			$databack = array("success" => true, "url" => base_url("index.php/dashboard"));

		}

		else

		{	

			$databack = array("success" => false);		

		}

		echo json_encode($databack);

	}

}



