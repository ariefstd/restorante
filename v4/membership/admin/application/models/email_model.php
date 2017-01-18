<?php

class Email_model extends CI_Model
{
	public function insert($table,$data){
		$this->db->insert($table,$data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	
	public function get_ready_to_send($id){
		return $this->db->query("SELECT * FROM email_detail WHERE fk_email_id = ? AND status = 'pending'",array($id))->result_array();
	}	
	
	public function get_all($start = "")
	{
		$range = 100;
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM email ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM email ORDER BY id DESC");
		
		if($query->num_rows >= 1)
		{
			return $query;
		}
		return false;
	}
	
	public function get_detail($id){
		return $this->db->query("SELECT * FROM email_detail WHERE fk_email_id = ?",array($id));
	}
}