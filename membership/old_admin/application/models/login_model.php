<?php

class Login_model extends CI_Model
{
    function validate()
    {
        $input_username = xss_clean($this->input->post('username'));
		$input_password = xss_clean($this->input->post('password'));
	
		$query 	= $this->db->query("SELECT * FROM users
									WHERE username = '". $input_username ."' AND password = '". md5($input_password) ."'
									LIMIT 1");

		if($query->num_rows == 1)
        {
			$now = now();
			$this->db->query("UPDATE users SET last_login=".$now." WHERE username='". $input_username ."'");
			return $query;
		}
    }
    
    function return_name($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query;
    }
}
