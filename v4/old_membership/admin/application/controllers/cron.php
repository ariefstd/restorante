<?php 

class Cron extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function update_dn2()
	{
		$this->load->model("sms_model");
		$this->load->config("nhk");
		$this->load->library("infotech");
		$result = $this->sms_model->get_pending_by_interval($this->config->item("sms_status_expiry"));
		foreach($result as $r){
			$this->infotech->update_dn2($r["id"],$r["msgid"],$r["msisdn"]);
		}
	}
	
	public function scheduled_sms($when){
		$this->load->model("membership_model");	
		$this->load->model("sms_model");	
		$this->load->library("Infotech");
		$res = $this->sms_model->get_smses($when);
		foreach($res as $r){
			switch($r["category"]){
				case "all" :
					$result = $this->membership_model->view()->num_rows();
					break;
				case "expiredsoon" :
					$result = $this->membership_model->view_expiry()->num_rows();
					break;
				case "expired" :
					$result = $this->membership_model->view_expired()->num_rows();
					break;
				case "newrenewer" :
					$result = $this->membership_model->get_newrenewer()->num_rows();
					break;				
				case "birthday" :
					$result = $this->membership_model->get_birthday()->num_rows();
					break;
				case "noemail" :
					$result = $this->membership_model->get_noemail()->num_rows();
					break;
				case "usernamepass" :
					$result = $this->membership_model->get_usernamepass()->num_rows();
					break;	
				case "personal" :
					$msisdn = explode(",", $r["personal_msisdn"]);
					$result = count($msisdn);
					break;	
			}
			$data = array(
				"fk_sms_id" => $r["id"],
				"title" => $r["title"],
				"category" => $r["category"],
				"personal_msisdn" => $r["personal_msisdn"],
				"message" => $r["message"],
				"encoding" => $r["encoding"],
				"current" =>0,
				"total"=> $result,
				"status" => '1',
				"created_at" => date("Y-m-d H:i:s")
			);
			$sms_id = $this->sms_model->insert('sms_temp',$data);
			if($r["frequency"]=='now' or $r["frequency"]=='oneoff'){	
				$data = array("status"=>"0");	
				$this->sms_model->update_sms($data,$r["id"]);
			}
		}
	}
	
	
	public function send_sms(){
		$range = 100;	
		$this->load->model("membership_model");
		$this->load->model("sms_model");	
		$this->load->library("Infotech");
		$res = $this->sms_model->get_sms_temp();
		foreach($res as $r){
			$start = $r["current"];
			switch($r["category"]){
				case "all" :
					$result = $this->membership_model->view($start)->result_array();
					break;
				case "expiredsoon" :
					$result = $this->membership_model->view_expiry($start)->result_array();
					break;
				case "expired" :
					$result = $this->membership_model->view_expired($start)->result_array();
					break;
				case "newrenewer" :
					$result = $this->membership_model->get_newrenewer($start)->result_array();
					break;				
				case "birthday" :
					$result = $this->membership_model->get_birthday($start)->result_array();
					break;
				case "noemail" :
					$result = $this->membership_model->get_noemail($start)->result_array();
					break;
				case "usernamepass" :
					$result = $this->membership_model->get_usernamepass($start)->result_array();
					break;	
				case "personal" :
					$msisdn = explode(",", $r["personal_msisdn"]);
					$result = array();
					$i=0;
					foreach($msisdn as $m){
						$result[$i]["full_name"]='';
						$result[$i]["mobile_no_1"] = str_replace("-", "", $m);	
						$i++;
					}
					break;	
			}	
			foreach($result as $rs){
				//if($rs["full_name"]!="")	
					//$message = "Hi ".$rs["full_name"].", ".$r["message"];
				//else
					$message = $r["message"];
				$detail = array(
					"fk_sms_id" =>$r["fk_sms_id"],
					"msisdn" => $rs["mobile_no_1"],
					"message" => $message,
					"encoding" => $r["encoding"],
					"status" => "pending" 
				);
				$this->db->insert('sms_detail',$detail);
				$last_id = $this->db->insert_id();
				$detail["id"] = $last_id;
				$this->infotech->send($detail);
				
			}
			
			if(($r["current"]+$range)>=$r["total"]){
				$this->sms_model->delete_sms_temp($r["id"]);	
			}else{
				$data = array("current"=>$r["current"]+$range);
				$this->sms_model->update_sms_temp($data,$r["id"]);
			}
		}	
	}
	
	public function scheduled_email($when)
	{
		$this->load->model("membership_model");
		$this->load->model("email_model");
		$res = $this->membership_model->get_emails($when);
		foreach($res as $r){
			switch($r["category"]){
				case "all" :
					$result = $this->membership_model->view()->num_rows();
					break;	
				case "birthday" :
					$result = $this->membership_model->get_birthday()->num_rows();
					break;
				case "newrenewer" :
					$result = $this->membership_model->get_newrenewer()->num_rows();
					break;
				case "expiredsoon" :
					$result = $this->membership_model->view_expiry()->num_rows();
					break;
				case "expired" :
					$result = $this->membership_model->view_expired()->num_rows();
					break;
				case "usernamepass" :
					$result = $this->membership_model->get_usernamepass()->num_rows();
					break;				
			}	
			$data = array(
				"fk_email_id" => $r["id"],
				"title" => $r["title"],
				"category" => $r["category"],
				"message" => $r["message"],
				"attach" => $r["attach"],
				"current" =>0,
				"total"=> $result,
				"status" => '1',
				"created_at" => date("Y-m-d H:i:s")
			);
			$this->email_model->insert('email_temp',$data);
			if($r["frequency"]=='now' or $r["frequency"]=='oneoff'){	
				$data = array("status"=>"0");	
				$this->membership_model->update_email($data,$r["id"]);
			}	
		}	
	}
	
	public function send_email()
	{
		$range = 100;	
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->load->model("membership_model");
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$res = $this->membership_model->get_email_temp();
		foreach($res as $r){
			$start = $r["current"];
			switch($r["category"]){
				case "all" :
					$result = $this->membership_model->view($start)->result_array();
					break;	
				case "birthday" :
					$result = $this->membership_model->get_birthday($start)->result_array();
					break;
				case "newrenewer" :
					$result = $this->membership_model->get_newrenewer($start)->result_array();
					break;
				case "expiredsoon" :
					$result = $this->membership_model->view_expiry($start)->result_array();
					break;
				case "expired" :
					$result = $this->membership_model->view_expired($start)->result_array();
					break;
				case "usernamepass" :
					$result = $this->membership_model->get_usernamepass($start)->result_array();
					break;				
			}	
			$attach = $r["attach"] ? $r["attach"] : "";
			if($attach)
				$this->email->attach($attach);
			foreach($result as $rs){
				if($rs["full_name"]!="")	
					$message = "Hi ".$rs["full_name"].", ".$r["message"];
				else
					$message = $r["message"];
				$detail = array(
					"fk_email_id" =>$r["fk_email_id"],
					"email" => $rs["email"],
					"message" => $message,
					"attach" => $attach,
					"status" => "pending" 
				);
				$this->db->insert('email_detail',$detail);
				$last_id = $this->db->insert_id();
				$this->email->clear();
				$this->email->to($rs["email"]);
				$this->email->from('membership@nhkrestaurant.com', 'New Hong Kong Restaurant');
				$this->email->subject($r["title"]);
				$this->email->message($message);
				if($this->email->send()){
					$data = array("status"=>"sent","sent_at"=>date("Y-m-d H:i:s"));
					$this->membership_model->update_email_detail($data,$last_id);
				}
			}
			
			if(($r["current"]+$range)>=$r["total"]){
				$this->membership_model->delete_email_temp($r["id"]);	
			}else{
				$data = array("current"=>$r["current"]+$range);
				$this->membership_model->update_email_temp($data,$r["id"]);
			}
		}	
	}
}