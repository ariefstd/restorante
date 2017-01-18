<?php 

class Sms extends CI_Controller {

	private $page_id;
	private $current_page;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('sms_model');
		
		$this->login_session_check->is_logged_in();
		//$this->login_session_check->permission_check();
		$this->current_page = 'sms';
	}
	
	public function index()
	{
		$result = $this->sms_model->get_all();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'sms/sms',
			'result'		=> $result
		);
		$this->load->library("Infotech");
		$data["balance"] = $this->infotech->check_credit();
        $this->load->view('includes/template',$data);
	}
	
	public function addedit_template($id="")
	{
		$data = array(
			'current_page' 	=> 'popup'
		);	
		if(!empty($id)){
			$this->load->model("sms_template_model");
			$result = $this->sms_template_model->get_detail($id);
			$res = array("result"=>$result);
			$data["result"] = $result;
		}	
        $this->load->view('sms/addedit_template',$data);
	}
	
	public function saveupdate_template(){
		$this->load->model("sms_template_model");
		$data = array(
			"title" =>$this->input->post("txtTitle"),
			"message" =>$this->input->post("txtMessage")
		);
		if($this->input->post("mode")=="add")
			$this->sms_template_model->insert($data);
		else
			$this->sms_template_model->update($data,$this->input->post("template_id"));
	}
	
	public function delete_template($id){
		$this->load->model("sms_template_model");
		$result = $this->sms_template_model->delete($id);
	}
	
	public function send_sms($type="")
	{
		$this->load->model("sms_template_model");
		$templates = $this->sms_template_model->get_all();		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'sms/send_sms',
			'templates'		=> $templates->result_array(),
			'type'			=> $type
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function store_sms()
	{
		$this->load->model("sms_model");
		$cat = $this->input->post("txtMsisdn")=='' ? $this->input->post('selGroup') : 'personal';
		
		$start_date = "";
		$end_date = "";
		$hour = $this->input->post("hour")=="" ? '00' : $this->input->post("hour");
		$minute = $this->input->post("minute")=="" ? '00' : $this->input->post("minute");
		if($this->input->post("start")!="")
		{
			$seperator = explode("/",$this->input->post("start"));
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0]." ".$hour.":".$minute.":00";
			$start_date = $new_date;
		}
		
		if($this->input->post("end")!="")
		{
			$seperator = explode("/",$this->input->post("end"));
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0]." ".$hour.":".$minute.":00";
			$end_date = $new_date;
		}
		$data = array(
			"title" => $this->input->post('txtTitle'),
			"category" => $cat,
			"personal_msisdn" => $this->input->post('txtMsisdn'),
			"message" => $this->input->post('txtMessage'),
			"frequency" => $this->input->post('rdoFrequency'),
			"encoding" => $this->input->post('rdoEncoding'),
			"start_date" => $start_date,
			"end_date" => $end_date,
			"every" => $this->input->post('selEvery'),
			"status" => '1',
			"created_at" => date("Y-m-d H:i:s")
		);
		$sms_id = $this->sms_model->insert('sms',$data);
		if($sms_id){
			/*	
			if($data["frequency"]=="now"){
				$this->load->library("Infotech");
				$smses = $this->sms_model->get_ready_to_send($sms_id);
				foreach($smses as $sms){
					$this->infotech->send($sms);
				}
			}
			 */
		}else{
			log_message("error","Fail insert sms Data : ".$this->input->post('txtTitle'));
		}
		redirect("sms");
	}
	
	function detail($id){
		$result = $this->sms_model->get_detail($id);
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'sms/detail',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}

}