<?php

class Login_session_check extends CI_Model
{
    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if(!isset($is_logged_in) || $is_logged_in != true )
        {
			redirect(base_url("index.php/expired"));
        }
    }
	
	function permission_check()
    {
        $permission = $this->session->userdata('permission');

        if( $permission == 0 )
        {
			redirect(base_url("index.php/permission"));
        }
    }
}
