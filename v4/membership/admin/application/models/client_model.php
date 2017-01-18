<?php

class Client_model extends CI_Model
{
	function view($start = "")
	{
		$range = 100;

		if($start != "")	
			$query 	= $this->db->query("SELECT * FROM client WHERE client_isdeleted != 1  ORDER BY client_firstname ASC LIMIT $start,$range");
		else
			$query 	= $this->db->query("SELECT * FROM client WHERE client_isdeleted != 1 ORDER BY client_firstname ASC");
		
		return $query->result_array();

	}

	function search($q)
	{

		$query 	= $this->db->query("SELECT * FROM client WHERE (client_firstname LIKE '%".$q."%' OR client_lastname LIKE '%".$q."%' OR client_contact LIKE '%".$q."%' OR client_email LIKE '%".$q."%') AND  client_isdeleted != 1 ORDER BY client_firstname ASC");

		return $query->result_array();
	}
	

	function insert()
	{

		$data = array(
		   'client_firstname'     	=> $this->input->post("first"), 
		   'client_lastname'     	=> $this->input->post("last"), 
		   'client_contact'    		=> $this->input->post("telp"), 
		   'client_email'     		=> $this->input->post("email")
		);

		$query = $this->db->insert('client', $data);

		return $query;

	}

	function edit($id)
	{

		$this->db->where('client_id', $id);

        $query = $this->db->get('client');

        return $query->result_array();

	}

	function update()
	{

		$data = array(
		   'client_firstname'     	=> $this->input->post("first"), 
		   'client_lastname'     	=> $this->input->post("last"), 
		   'client_contact'    		=> $this->input->post("telp"), 
		   'client_email'     		=> $this->input->post("email")
		);

		$this->db->where('client_id', $this->input->post("id"));
		$query = $this->db->update('client', $data);


		return $query;

	}

	function delete($id)
	{

		$query 	= $this->db->query("UPDATE client SET client_isdeleted = 1 WHERE client_id=".$id);	

	}

}