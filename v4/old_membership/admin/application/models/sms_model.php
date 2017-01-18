<?php

class Sms_model extends CI_Model
{
	public function insert($table,$data){
		return $this->db->insert($table,$data);
	}
	
	function get_smses($when){
		switch($when){
			case "now" : $result = $this->db->query("SELECT * FROM sms WHERE frequency = 'now' AND status = '1'")->result_array(); break;
			case "oneoff" : $result = $this->db->query("SELECT * FROM sms WHERE frequency = 'oneoff' AND start_date<=? AND status = '1'",array(date('Y-m-d H:i:s')))->result_array(); break;
			case "daily" : $result = $this->db->query("SELECT * FROM sms WHERE frequency = 'daily' AND ?>=start_date AND ?<=end_date AND status = '1'",array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')))->result_array(); break;
			case "monthly" : $result = $this->db->query("SELECT * FROM sms WHERE frequency = 'monthly' AND ?>=start_date AND ?<=end_date AND status = '1'",array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')))->result_array(); break;
		}
		return $result;
	}
	
	function get_sms_temp(){
		return $this->db->query("SELECT * FROM sms_temp ORDER BY id LIMIT 1")->result_array();
	}
	
	function get_sms_detail($sms_id){
		return $this->db->query("SELECT * FROM sms_detail WHERE fk_sms_id = ? AND status = 'pending'",array($sms_id))->result_array();
	}
	
	function update_sms($data,$id){
		$this->db->where('id', $id);	
		$this->db->update('sms',$data);
	}
	
	public function get_ready_to_send($id){
		return $this->db->query("SELECT * FROM sms_detail WHERE fk_sms_id = ? AND status = 'pending'",array($id))->result_array();
	}	
	
	public function get_all($start = "")
	{
		$range = 100;
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM sms ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM sms ORDER BY id DESC");
		
		if($query->num_rows >= 1)
		{
			return $query;
		}
		return false;
	}
	
	public function store_msgid($id,$msgid,$status)
	{
		$data = array(
			"msgid"=>$msgid,
			"status"=>$status,
			"sent_at" => date("Y-m-d H:i:s")
		);	
		return $this->db->update("sms_detail",$data,array('id' => $id));
	}
	
	public function update_dn2($id,$msgid,$status,$timestamp)
	{
		$data = array(
			"msgid"=>$msgid,
			"status"=>$status,
			"updated_at" => $timestamp
		);	
		return $this->db->update("sms_detail",$data,array('id' => $id));
	}
	
	public function get_detail($id){
		return $this->db->query("SELECT * FROM sms_detail WHERE fk_sms_id = ?",array($id));
	}
	
	public function get_pending_by_interval($interval){
		return $this->db->query("SELECT * FROM sms_detail WHERE status=200 AND sent_at >=(NOW() - INTERVAL $interval DAY)")->result_array();
	}
	
	function update_sms_temp($data,$id){
		$this->db->where('id', $id);	
		$this->db->update('sms_temp',$data);
	}
	
	function delete_sms_temp($id){
		$this->db->where('id', $id);	
		$this->db->delete('sms_temp');
	}
}