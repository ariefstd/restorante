<?php

class Email_template_model extends CI_Model
{	
	function get_all()
	{
		$query 	= $this->db->query("SELECT * FROM email_template ORDER BY title ASC");
		
		if($query->num_rows >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_detail($id)
	{
		return $this->db->query("SELECT * FROM email_template WHERE id = ? ORDER BY title ASC",array($id))->row();
	}	
	
	function delete($id){
		return $this->db->query("DELETE FROM email_template WHERE id = ?",array($id));
	}
	
	function insert($data){
		return $this->db->insert('email_template',$data);
	}
	
	function update($data,$id){
		return $this->db->update('email_template', $data, "id = ".$id);
	}
}