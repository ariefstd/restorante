<?php

class Account_model extends CI_Model
{
	function get_profile($id)
	{
		$query 	= $this->db->query("SELECT username,name,email,date_created,last_login FROM users
									WHERE id=".$id);
		return $query;
	}
	
	function profile_update()
	{
		$input_username = xss_clean($this->input->post('username'));
		$input_password = xss_clean($this->input->post('password'));
		$input_name 	= xss_clean($this->input->post('name'));
		$input_email 	= xss_clean($this->input->post('email'));
		
		$id				= $this->input->post('id');
		$now = now();
		
		$query 	= $this->db->query("UPDATE users SET
									username='". $input_username ."', name='". $input_name ."', email='". $input_email ."', last_login='". $now ."'
									WHERE id=".$id);

		$data = array(
					'id'			=> $id,
					'name'      	=> $input_name,
                    'username'      => $input_username,
                    'is_logged_in'  => true
        );

        $this->session->set_userdata($data);    //store user login data into session


		return true;
	}
	
	function password_change()
	{
		$old_pwd	= xss_clean($this->input->post('old_pwd'));
		$id			= $this->input->post('id');
		
		$query 	= $this->db->query("SELECT * 
									FROM users 
									WHERE password='" .md5($old_pwd). "' AND id=".$id." LIMIT 1"
									);

		if($query->num_rows == 1)
		{
			$new_pwd 	= xss_clean($this->input->post('new_pwd'));
			$id			= $this->input->post('id');
			
			$query 	= $this->db->query("UPDATE users SET
										password ='". md5($new_pwd) ."' WHERE id=".$id);
			
			return true;
		}
		else
		{
			return false;
		}
			

	}
}
