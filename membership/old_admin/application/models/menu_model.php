<?php

class Menu_model extends CI_Model
{
	function view($start = "")
	{
		$range = 100;

		if($start != "")
			$query 	= $this->db->query("
				SELECT *, IF(menu_isactive=1,'Active','Not Active') as status
				FROM menu
				LEFT JOIN menu_type ON menutype_id=menu_typeid
				WHERE menu_isdeleted != 1  ORDER BY menu_code ASC LIMIT $start,$range");
		else
			$query 	= $this->db->query("
				SELECT * , IF(menu_isactive=1,'Active','Not Active') as status
				FROM menu
				LEFT JOIN menu_type ON menutype_id=menu_typeid
				WHERE menu_isdeleted != 1 ORDER BY menu_code ASC");

		return $query->result_array();

	}

	function search($q)
	{

		$query 	= $this->db->query("SELECT * , IF(menu_isactive=1,'Active','Not Active') as status
			FROM menu
			LEFT JOIN menu_type ON menutype_id=menu_typeid
			WHERE (menu_code LIKE '%".$q."%' OR menu_name LIKE '%".$q."%' OR IF(menu_isactive=1,'Active','Not Active') LIKE '%".$q."%' OR menutype_name LIKE '%".$q."%') AND  menu_isdeleted != 1 ORDER BY menu_code ASC");

		return $query->result_array();
	}

	function typeList()
	{

		$this->db->order_by('menutype_name','ASC');
		$query = $this->db->get('menu_type');
		return $query->result_array();
	}


	function insert()
	{
		$data = array(
			'menu_code'     	=> $this->input->post("code"),
			'menu_name'     	=> $this->input->post("name"),
			'minimum_order'     => $this->input->post("minimum_order"),
			'menu_typeid'   	=> $this->input->post("type"),
			'menu_isactive'  => $this->input->post("status")
			);
		$query = $this->db->insert('menu', $data);
		return $query;
	}

	function edit($id)
	{

		$this->db->where('menu_id', $id);

		$query = $this->db->get('menu');

		return $query->result_array();

	}

	function update()
	{

		$data = array(
			'menu_code'     	=> $this->input->post("code"),
			'menu_name'     	=> $this->input->post("name"),
			'minimum_order'     => $this->input->post("minimum_order"),
			'menu_typeid'   	=> $this->input->post("type"),
			'menu_isactive'  => $this->input->post("status")
			);

		$this->db->where('menu_id', $this->input->post("id"));
		$query = $this->db->update('menu', $data);


		return $query;

	}

	function delete($id)
	{

		$query 	= $this->db->query("UPDATE menu SET menu_isdeleted = 1 WHERE menu_id=".$id);

	}

}
