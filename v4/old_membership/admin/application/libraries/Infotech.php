<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infotech{
	function __construct(){
		$this->CI =& get_instance();	
		$this->CI->load->config("infotech");	
	}
	
	public function send($data){
		$this->CI->load->model("sms_model");	
		$type = $data["encoding"] == "roman" ? "0" : "5";
		$text = $data["encoding"] == "roman" ? urlencode($data["message"]) : bin2hex(mb_convert_encoding($data["message"], 'UCS-2', 'auto'));	
		$params = '?username='.$this->CI->config->item("infotech_username")."&password=".$this->CI->config->item("infotech_password")."&api=1&type=".$type;
		$params .= '&to='.trim(str_replace("-", "", $data["msisdn"]))."&from=".$this->CI->config->item("infotech_sender");
		$params .= '&text='.$text;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->CI->config->item('infotech_url').$params);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute cURL.
		$response = curl_exec($ch);
		$r = explode(",",$response);
		if(count($r)==1)
			$this->CI->sms_model->store_msgid($data["id"],'',$r[0]);
		else
			$this->CI->sms_model->store_msgid($data["id"],$r[0],$r[2]);	
	}
	
	public function check_credit(){
		$params = '?username='.$this->CI->config->item("infotech_username")."&password=".$this->CI->config->item("infotech_password")."&profile=credit";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->CI->config->item('infotech_url').$params);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute cURL.
		$response = curl_exec($ch);
		return $response;
	}
	
	public function update_dn2($id,$msgid,$msisdn){
		$this->CI->load->model("sms_model");	
		$params = '?username='.$this->CI->config->item("infotech_username")."&password=".$this->CI->config->item("infotech_password");
		$params .= '&mobileno='.trim(str_replace("-", "", $msisdn))."&msgid=".$msgid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->CI->config->item('infotech_url').$params);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute cURL.
		$response = curl_exec($ch);
		$r = explode(",",$response);
		$this->CI->sms_model->update_dn2($id,$r[0],$r[2],$r[3]);
	}
}
