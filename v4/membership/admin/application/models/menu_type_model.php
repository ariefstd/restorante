<?php

class Menu_type_model extends CI_Model
{
	function view($start = "")
	{

		$range = 100;

		if($start != "")
			$query 	= $this->db->query("
				SELECT *, IF(menutype_isactive=1,'Active','Not Active') as status ,b.*
				FROM menu_type a LEFT JOIN package b ON b.id = a.package_id
				ORDER BY menutype_name ASC LIMIT $start,$range");
		else
			$query 	= $this->db->query("
				SELECT *, IF(menutype_isactive=1,'Active','Not Active') as status ,b.*
				FROM menu_type a LEFT JOIN package b ON b.id = a.package_id
				ORDER BY menutype_name ASC ");

		return $query->result_array();

	}

	function search($q)
	{

		$query 	= $this->db->query("SELECT * , IF(menutype_isactive=1,'Active','Not Active') as status
			FROM menu_type
			WHERE (menutype_name LIKE '%".$q."%' OR menutype_description LIKE '%".$q."%' OR IF(menutype_isactive=1,'Active','Not Active') LIKE '%".$q."%') ORDER BY menutype_name ASC");

		return $query->result_array();
	}

	function insert()
	{

		$data = array(
			'menutype_name'     	=> $this->input->post("name"),
			'menutype_description'  => $this->input->post("description"),
			'menutype_path'   	=> empty($_FILES['image']['tmp_name'])?'':base_url().'application/uploads/'.date('Ymd_his').$_FILES['image']['name'],
			'menutype_isactive'  => $this->input->post("status"),
			'package_id'			=> $this->input->post('package')
			);

		$query = $this->db->insert('menu_type', $data);

		if($query && !empty($_FILES['image']['tmp_name']))
		{
			$config['file_name'] = date('Ymd_his').$_FILES['image']['name'];
			$config['upload_path'] = 'application/uploads/';
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			$up=$this->upload->do_upload('image');
			if($up)
			{
				$conf['image_library'] = 'gd';
				$conf['source_image'] = $config['upload_path'].$config['file_name'];
				$conf['width'] = 200;
				$conf['height'] = 349;

				$this->load->library('image_lib', $conf);

				$this->image_lib->resize();
			}

		}

		return $query;

	}

	function edit($id)
	{

		$this->db->where('menutype_id', $id);

		$query = $this->db->get('menu_type');

		return $query->result_array();

	}

	function update()
	{
		if(!empty($_FILES['image']['tmp_name']))
			$data = array(
				'menutype_name'     	=> $this->input->post("name"),
				'menutype_description'     	=> $this->input->post("description"),
				'menutype_path'   	=> base_url().'application/uploads/'.date('Ymd_his').$_FILES['image']['name'],
				'menutype_isactive'  => $this->input->post("status"),
				'package_id'			=> $this->input->post('package')
				);
		else
			$data = array(
				'menutype_name'     	=> $this->input->post("name"),
				'menutype_description'     	=> $this->input->post("description"),
				'menutype_isactive'  => $this->input->post("status"),
				'package_id'			=> $this->input->post('package')
				);

		$this->db->where('menutype_id', $this->input->post("id"));
		$query = $this->db->update('menu_type', $data);

		if($query && !empty($_FILES['image']['tmp_name']))
		{
			$config['file_name'] = date('Ymd_his').$_FILES['image']['name'];
			$config['upload_path'] = 'application/uploads/';
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			$up=$this->upload->do_upload('image');
			if($up)
			{
				$conf['image_library'] = 'gd';
				$conf['source_image'] = $config['upload_path'].$config['file_name'];
				$conf['width'] = 200;
				$conf['height'] = 349;

				$this->load->library('image_lib', $conf);

				$this->image_lib->resize();

			}

		}

		return $query;

	}

	function delete($id)
	{

		$query 	= $this->db->query("UPDATE menu_type SET menutype_isactive = 0 WHERE menutype_id=".$id);

	}

}
