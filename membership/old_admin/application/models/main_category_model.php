<?php
class Main_category_model extends CI_Model
{
	function submit($name='',$desc='')
	{
		$data = array(
		   'name_main_category' => $name, 
		   'descriptions'     	=> $desc
		);

		$query = $this->db->insert('main_category', $data);

		return $query;
	}
	function view()
	{
		$query 	= $this->db->query("SELECT * FROM main_category");
		
		return $query->result_array();
	}
	function delete($id)
	{
		$this->db->delete('main_category', array('id' => $id)); 
	}
	function get_data($id)
	{
		$this->db->select('*');
		$this->db->from('main_category');
		// Check if we're getting one row or all records
		if($id != NULL){
		// Getting only ONE row
		$this->db->where('id', $id);
		$this->db->limit('1');
		$query = $this->db->get();
		if( $query->num_rows() == 1 ){
		// One row, match!
		return $query->row();        
		} else {
		// None
		return false;
		}
		}
	}

	function update($id,$name,$descriptions)
	{
		$data = array(
		   'name_main_category' => $name, 
		   'descriptions'     	=> $descriptions
		);
		$this->db->where('id', $id);
		$this->db->update('main_category', $data);
	}

	function search($q)
	{
		$query 	= $this->db->query("SELECT * FROM main_category
		WHERE name_main_category LIKE '%".$q."%' OR descriptions LIKE '%".$q."%' ORDER BY name_main_category ASC");

		return $query->result_array();
	}
}
