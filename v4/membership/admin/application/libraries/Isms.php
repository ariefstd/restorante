<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Isms{
	function __construct(){
		$this->CI =& get_instance();	
		$this->CI->load->config("isms");	
	}
	
	public function send($data){
		$this->CI->load->model("sms_model");	
		$type = $data["encoding"] == "roman" ? "1" : "2";
		//$text = $data["encoding"] == "roman" ? urlencode($data["message"]) : bin2hex(mb_convert_encoding($data["message"], 'UCS-2', 'auto'));	
		$text = urlencode($data["message"]);	
		$params = '?un='.$this->CI->config->item("isms_username")."&pwd=".$this->CI->config->item("isms_password")."&type=".$type;
		$params .= '&dstno='.trim(str_replace("-", "", $data["msisdn"]))."&sendid=".$this->CI->config->item("isms_sender");
		$params .= '&msg='.$text;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->CI->config->item('isms_url')."isms_send.php".$params);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Execute cURL.
		$response = curl_exec($ch);

		$r = explode(",",$response);
		$this->CI->sms_model->update_dn2($data["id"],'',$response,date('Y-m-d H:i:s'));
	}
	
	public function check_credit(){
		$params = '?un='.$this->CI->config->item("isms_username")."&pwd=".$this->CI->config->item("isms_password");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->CI->config->item('isms_url')."isms_balance.php".$params);
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
