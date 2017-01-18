<?php

class Order_model extends CI_Model
{
	function view($start = "")
	{
		$type = $this->session->userdata('type');
		if($type=='manager')
			$in='1';
		else if($type=='account')
			$in='2';
		else
			$in='0';

		$range = 100;

		if($start != "")
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package FROM `order` a
				LEFT JOIN catering_type b ON b.cateringtype_id=a.order_cateringtypeid
				LEFT JOIN client c ON c.client_id=a.order_clientid
				LEFT JOIN order_status d ON d.orderstatus_id=a.order_statusid
				LEFT JOIN order_detail e ON e.orderdetail_orderid = a.order_id
				LEFT JOIN menu f ON f.menu_id = e.orderdetail_menuid
				LEFT JOIN menu_type g ON g.menutype_id = f.menu_typeid
				LEFT JOIN package h ON h.id = g.package_id
				WHERE a.order_statusid = $in
				ORDER BY a.order_date DESC, a.order_time DESC
				LIMIT $start,$range
				");
		else
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package FROM `order` a
				LEFT JOIN catering_type b ON b.cateringtype_id=a.order_cateringtypeid
				LEFT JOIN client c ON c.client_id=a.order_clientid
				LEFT JOIN order_status d ON d.orderstatus_id=a.order_statusid
				LEFT JOIN order_detail e ON e.orderdetail_orderid = a.order_id
				LEFT JOIN menu f ON f.menu_id = e.orderdetail_menuid
				LEFT JOIN menu_type g ON g.menutype_id = f.menu_typeid
				LEFT JOIN package h ON h.id = g.package_id
				WHERE a.order_statusid = $in
				ORDER BY a.order_date DESC, a.order_time DESC
				");

		return $query->result_array();

	}

	function search($q)
	{
		$type = $this->session->userdata('type');
		if($type=='manager')
			$in='1';
		else if($type=='account')
			$in='2';
		else
			$in='0';

		$query 	= $this->db->query("SELECT * FROM client WHERE (client_firstname LIKE '%".$q."%' OR client_lastname LIKE '%".$q."%' OR client_contact LIKE '%".$q."%' OR client_email LIKE '%".$q."%') AND  client_isdeleted != 1 ORDER BY client_firstname ASC");

		return $query->result_array();
	}

	function edit($id)
	{

		$query 	= $this->db->query("SELECT * FROM `order`
			LEFT JOIN catering_type ON cateringtype_id=order_cateringtypeid
			LEFT JOIN client ON client_id=order_clientid
			LEFT JOIN order_status ON orderstatus_id=order_statusid
			LEFT JOIN event ON event_id=order_eventid
			WHERE order_id = $id
			ORDER BY order_date DESC, order_time DESC
			");

		return $query->result_array();

	}

	function detail($id)
	{

		$query 	= $this->db->query("SELECT * FROM `order_detail`
			LEFT JOIN menu ON menu_id=orderdetail_menuid
			LEFT JOIN menu_type ON menutype_id=menu_typeid
			WHERE orderdetail_orderid = $id
			ORDER BY menutype_name ASC, menu_code ASC
			");

		return $query->result_array();

	}

	function confirm()
	{

		$data = array(
			'order_totalprice'     	=> $this->input->post("price"),
			'order_statusid'     	=> 2
			);

		$this->db->where('order_id', $this->input->post("id"));
		$query = $this->db->update('order', $data);


		return $query;

	}

	function complete()
	{
		$data = array(
			'order_statusid'=> 3
			);
		$this->db->where('order_id', $this->input->post("id"));
		$query = $this->db->update('order', $data);
		return $query;
	}

	// Cancle or delete model
	public function cancle_model($id='')
	{
		$this->db->delete('order', array('order_id' => $id));
		// $this->db->delete('order_detail',array('orderdetail_orderid' => $id));
	}
}
/*SELECT a.order_id,a.order_date,a.order_time FROM `order` a
LEFT JOIN catering_type b ON b.cateringtype_id=a.order_cateringtypeid
LEFT JOIN client c ON c.client_id=a.order_clientid
LEFT JOIN order_status d ON d.orderstatus_id=a.order_statusid
LEFT JOIN order_detail e ON e.orderdetail_orderid = a.order_id
LEFT JOIN menu f ON f.menu_id = e.orderdetail_menuid
LEFT JOIN menu_type g ON g.menutype_id = f.menu_typeid
LEFT JOIN package h ON h.id = g.package_id*/
