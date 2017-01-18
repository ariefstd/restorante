<?php

class Sms_template_model extends CI_Model
{	
	function get_all()
	{
		$query 	= $this->db->query("SELECT * FROM sms_template ORDER BY title ASC");
		
		if($query->num_rows >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_detail($id)
	{
		return $this->db->query("SELECT * FROM sms_template WHERE id = ? ORDER BY title ASC",array($id))->row();
	}	
	
	function delete($id){
		return $this->db->query("DELETE FROM sms_template WHERE id = ?",array($id));
	}
	
	function insert($data){
		return $this->db->insert('sms_template',$data);
	}
	
	function update($data,$id){
		return $this->db->update('sms_template', $data, "id = ".$id);
	}
}