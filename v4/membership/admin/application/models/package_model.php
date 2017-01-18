<?php
class Package_model extends CI_Model
{
	function submit($id_main,$name,$price,$description)
	{
		$data = array(
		   'id_main_category' 	=> $id_main, 
		   'name_package'     	=> $name,
		   'price' 				=> $price,
		   'descriptions'		=> $description
		);

		$query = $this->db->insert('package', $data);
		return $query;
	}
	function view()
	{
		$query 	= $this->db->query("SELECT a.*,b.id as id_main,b.name_main_category  FROM package a JOIN main_category b ON b.id=a.id_main_category");
		
		return $query->result_array();
	}
	function delete($id)
	{
		$this->db->delete('package', array('id' => $id)); 
	}
	function get_data($id)
	{
		$this->db->select('a.*,b.id as id_main,b.name_main_category');
		$this->db->from('package a');
		$this->db->join('main_category b','b.id = a.id_main_category');
		// Check if we're getting one row or all records
		if($id != NULL){
			// Getting only ONE row
			$this->db->where('a.id', $id);
			$this->db->limit('1');
			$query = $this->db->get();
			if( $query->num_rows() == 1 )
			{
				// One row, match!
				return $query->row();        
			} else {
				// None
				return false;
			}
		}
	}

	function update($id,$id_main,$name,$price,$description)
	{
		$data = array(
		   'id_main_category' 	=> $id_main, 
		   'name_package'     	=> $name,
		   'price' 				=> $price,
		   'descriptions'		=> $description
		);
		$this->db->where('id', $id);
		$this->db->update('package', $data);
	}

	function search($q)
	{
		$query 	= $this->db->query("SELECT * FROM main_category
		WHERE name_main_category LIKE '%".$q."%' OR descriptions LIKE '%".$q."%' ORDER BY name_main_category ASC");

		return $query->result_array();
	}
}
