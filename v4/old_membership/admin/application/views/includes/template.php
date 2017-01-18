<?php

    $this->load->view('includes/header');
	if($current_page == "login" || $current_page == "logout" || $current_page == "expired")
		$this->load->view($main_content);
    $this->load->view('includes/footer');

