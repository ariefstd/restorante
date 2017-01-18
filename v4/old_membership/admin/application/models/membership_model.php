<?php

class Membership_model extends CI_Model
{
	function view($start = "")
	{
		$range = 100;
		$today = now();
		if($start != "")	
			$query 	= $this->db->query("SELECT * FROM membership WHERE is_deleted != 1 AND $today < expiry_date ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE is_deleted != 1 AND $today < expiry_date ORDER BY id DESC");	
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function search($q)
	{
		$query 	= $this->db->query("SELECT * FROM membership WHERE (member_card_no LIKE '%".$q."%' OR username LIKE '%".$q."%' OR full_name LIKE '%".$q."%') AND  is_deleted != 1 ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function view_expiry($start = "")
	{
		$range = 100;	
		$today = now();
		//$query 	= $this->db->query("SELECT * FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC");
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) AND  is_deleted != 1 ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) AND  is_deleted != 1 ORDER BY id DESC");	
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function view_expired($start = "")
	{
		$range = 100;	
		$today = now();
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_birthday($start = "")
	{
		$range = 100;	
		$nextmonth = date("m",strtotime('+2 months'));
		$today = date("m",strtotime('+1 month'));
		$now = now();
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE MONTH(dob) = ?  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC LIMIT $start,$range",array($today));
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE MONTH(dob) = ?  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC",array($today));
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_noemail($start = "")
	{
		$range = 100;
		$now = now();
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE email='' AND  is_deleted != 1 AND $now < expiry_date ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE email='' AND  is_deleted != 1 AND $now < expiry_date ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_newrenewer($start = "")
	{
		$range = 100;
		$oneweek = 604800;
		$today = now();
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE (".$today." - date_join <=".$oneweek." OR (".$today." - renewal_date <=".$oneweek." AND renewal_date!='' )) AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE (".$today." - date_join <=".$oneweek." OR (".$today." - renewal_date <=".$oneweek."  AND renewal_date!='')) AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_usernamepass($start = "")
	{
		$range = 100;
		$today = now();
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function insert()
	{
		$username   		= $this->input->post('username');
		$password    		= $this->input->post('password'); 
		$full_name    		= $this->input->post('full_name'); 
		$ic_passport		= $this->input->post('ic_passport'); 
		$gender    			= $this->input->post('gender');
		$email    			= $this->input->post('email');
		$contact_no    		= $this->input->post('contact_no');
		$mobile_no_1    	= $this->input->post('mobile_no_1');
		$mobile_no_2    	= $this->input->post('mobile_no_2');
		$nationality    	= $this->input->post('nationality');
		$occupation    		= $this->input->post('occupation');
		$address    		= $this->input->post('address');
		$mailing_add    	= $this->input->post('mailing_add');
		$card_collection    = $this->input->post('card_collection');
		$date_join    		= $this->input->post('date_join');
		$renewal_date    	= $this->input->post('renewal_date');
		$expiry_date    	= $this->input->post('expiry_date');
		$status    			= $this->input->post('status');
		$member_card_no    	= $this->input->post('member_card_no');
		$dob    			= $this->input->post('dob');
		

		if(isset($date_join))
		{
			$seperator = explode("/",$date_join);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$date_join = $new_date;
		}
		
		if(isset($renewal_date))
		{
			$seperator = explode("/",$renewal_date);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$renewal_date = $new_date;
		}
		
		
		if(isset($expiry_date))
		{
			$seperator = explode("/",$expiry_date);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$expiry_date = $new_date;
		}
		
		if(isset($dob))
		{
			$seperator = explode("/",$dob);
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0];
			$dob = $new_date;
		}
		
		if(strtolower($nationality)=="others")
			$nationality = $this->input->post('other');
		
		$data = array(
		   'username'     			=> $username, 
		   'password'     			=> $password, 
		   'full_name'     			=> $full_name, 
		   'ic_passport'     		=> $ic_passport, 
		   'gender'     			=> $gender, 
		   'email'     			 	=> $email, 
		   'contact_no'     		=> $contact_no, 
		   'mobile_no_1'     		=> $mobile_no_1, 
		   'mobile_no_2'     		=> $mobile_no_2, 
		   'nationality'     		=> $nationality, 
		   'occupation'     		=> $occupation, 
		   'address'     			=> $address, 
		   'mailing_add'     		=> $mailing_add, 
		   'card_collection'     	=> $card_collection, 
		   'date_join'     			=> $date_join, 
		   'renewal_date'     		=> $renewal_date,
		   'expiry_date'     		=> $expiry_date,
		   'dob'     				=> $dob, 
		   'status'     			=> $status,
		   'member_card_no'     	=> $member_card_no
		   
		);
		$query = $this->db->insert('membership', $data);

		return $query;
	}
	
	function edit($id)
	{
		$this->db->where('id', $id);
        $query = $this->db->get('membership');
        return $query;
	}
	
	function update()
	{
		$username   		= $this->input->post('username');
		$password    		= $this->input->post('password'); 
		$full_name    		= $this->input->post('full_name'); 
		$ic_passport		= $this->input->post('ic_passport'); 
		$gender    			= $this->input->post('gender');
		$email    			= $this->input->post('email');
		$contact_no    		= $this->input->post('contact_no');
		$mobile_no_1    	= $this->input->post('mobile_no_1');
		$mobile_no_2    	= $this->input->post('mobile_no_2');
		$nationality    	= $this->input->post('nationality');
		$occupation    		= $this->input->post('occupation');
		$address    		= $this->input->post('address');
		$mailing_add    	= $this->input->post('mailing_add');
		$card_collection    = $this->input->post('card_collection');
		$date_join    		= $this->input->post('date_join');
		$renewal_date    	= $this->input->post('renewal_date');
		$expiry_date    	= $this->input->post('expiry_date');
		$status    			= $this->input->post('status');
		$member_card_no    	= $this->input->post('member_card_no');
		$dob 				= $this->input->post('dob');
		
		$id    				= $this->input->post('id');
		
		
		if(isset($date_join))
		{
			$seperator = explode("/",$date_join);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$date_join = $new_date;
		}
		
		if(isset($renewal_date))
		{
			$seperator = explode("/",$renewal_date);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$renewal_date = $new_date;
		}
		
		if(isset($expiry_date))
		{
			$seperator = explode("/",$expiry_date);
			$new_date = $seperator[2].$seperator[1].$seperator[0];
			$new_date = strtotime($new_date);
			$expiry_date = $new_date;
		}
		
		if(isset($dob))
		{
			$seperator = explode("/",$dob);
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0];
			$dob = $new_date;
		}
		if(strtolower($nationality)=="others")
			$nationality = $this->input->post('other');
		$data = array(
		   'username'     			=> $username, 
		   'password'     			=> $password, 
		   'full_name'     			=> $full_name, 
		   'ic_passport'     		=> $ic_passport, 
		   'gender'     			=> $gender, 
		   'email'     			 	=> $email, 
		   'contact_no'     		=> $contact_no, 
		   'mobile_no_1'     		=> $mobile_no_1, 
		   'mobile_no_2'     		=> $mobile_no_2, 
		   'nationality'     		=> $nationality, 
		   'occupation'     		=> $occupation, 
		   'address'     			=> $address, 
		   'mailing_add'     		=> $mailing_add, 
		   'card_collection'     	=> $card_collection, 
		   'date_join'     			=> $date_join, 
		   'renewal_date'     		=> $renewal_date,
		   'dob'     				=> $dob,
		   'expiry_date'     		=> $expiry_date, 
		   'status'     			=> $status,
		   'member_card_no'     	=> $member_card_no
		   
		);
		
		
		$this->db->where('id', $id);
		$query = $this->db->update('membership', $data);

		return $query;
	}
	
	function delete($id)
	{
		$query 	= $this->db->query("UPDATE membership SET is_deleted = 1 WHERE id=".$id);	
	}
	
	function get_emails($when){
		switch($when){
			case "now" : $result = $this->db->query("SELECT * FROM email WHERE frequency = 'now' AND status = '1'")->result_array(); break;
			case "oneoff" : $result = $this->db->query("SELECT * FROM email WHERE frequency = 'oneoff' AND start_date<=? AND status = '1'",array(date('Y-m-d H:i:s')))->result_array(); break;
			case "daily" : $result = $this->db->query("SELECT * FROM email WHERE frequency = 'daily' AND ?>=start_date AND ?<=end_date AND status = '1'",array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')))->result_array(); break;
			case "monthly" : $result = $this->db->query("SELECT * FROM email WHERE frequency = 'monthly' AND ?>=start_date AND ?<=end_date AND status = '1'",array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')))->result_array(); break;
		}
		return $result;
	}
	
	function get_email_temp(){
		return $this->db->query("SELECT * FROM email_temp ORDER BY id LIMIT 1")->result_array();
	}
	
	public function get_all_email($start = "")
	{
		$range = 100;
		if($start != "")
			$query 	= $this->db->query("SELECT * FROM email ORDER BY id DESC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM email ORDER BY id DESC");
		
		if($query->num_rows() >= 1)
		{
			return $query;
		}
		return false;
	}
	
	function get_email($email_id){
		return $this->db->query("SELECT * FROM email WHERE id = ?",array($email_id))->result_array();
	}
	
	function get_email_detail($email_id){
		return $this->db->query("SELECT * FROM email_detail WHERE fk_email_id = ? AND status = 'pending'",array($email_id))->result_array();
	}
	
	function get_email_detail_all($email_id){
		return $this->db->query("SELECT * FROM email_detail WHERE fk_email_id = ?",array($email_id))->result_array();
	}
	
	function update_email_detail($data,$id){
		$this->db->where('id', $id);	
		$this->db->update('email_detail',$data);
	}
	
	function update_email($data,$id){
		$this->db->where('id', $id);	
		$this->db->update('email',$data);
	}
	function update_email_temp($data,$id){
		$this->db->where('id', $id);	
		$this->db->update('email_temp',$data);
	}
	
	function delete_email_temp($id){
		$this->db->where('id', $id);	
		$this->db->delete('email_temp');
	}
}