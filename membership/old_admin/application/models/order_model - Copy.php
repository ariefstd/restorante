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
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package,`f`.`minimum_order`,`a`.`order_totalprice` FROM `order` a
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
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package,`f`.`minimum_order`,`a`.`order_totalprice` FROM `order` a
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

	function view_confirm($start = "")
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
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package,`f`.`minimum_order`,`a`.`order_totalprice` FROM `order` a
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
			$query 	= $this->db->query("SELECT a.order_id,a.order_date,a.order_time,a.event_date,a.event_time,a.order_statusid,d.orderstatus_id,d.orderstatus_name,c.client_id,c.client_firstname,c.client_lastname ,f.menu_id,f.menu_name,h.id as package_id,h.name_package,`f`.`minimum_order`,`a`.`order_totalprice` FROM `order` a
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

		$query 	= $this->db->query("SELECT * FROM `client`
  INNER JOIN `order` ON `client`.`client_id` = `order`.`order_clientid`
  INNER JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  INNER JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid`
  INNER JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
  INNER JOIN `package` ON `package`.`id` = `menu_type`.`package_id`
  INNER JOIN `order_status` ON `order_status`.`orderstatus_id` =
    `order`.`order_statusid`
WHERE (client_firstname LIKE '%".$q."%' OR client_lastname LIKE '%".$q."%' OR client_contact LIKE '%".$q."%' OR client_email LIKE '%".$q."%') AND  client_isdeleted != 1 ORDER BY client_firstname ASC");

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


	function order_edit($id)
	{
		$available = $this->input->post('available');
		$dishes = $this->input->post('dishes');
		$edited = array(
			   'menu_name' => $dishes,
               'minimum_order' => $available
               );
            $this->db->where('menu_id', $id);
			$this->db->update('menu', $edited);
	}


	public function pdf_show($id)
	{
			
		$this->db->select('
  `a`.`order_date`,
  `a`.`order_time`,
  `a`.`event_date`,
  `a`.`event_time`,
  `d`.`orderstatus_name`,
  `c`.`client_firstname`,
  `c`.`client_lastname`,
  `f`.`menu_name`,
  `h`.`name_package`,
  `f`.`minimum_order`,
  `a`.`order_totalprice`,
  `c`.`client_address`,
  `c`.`client_email`,
  `b`.`cateringtype_name`,
  `g`.`menutype_name`,
  `i`.`event_name`,
  `a`.`order_message`,
  `c`.`client_contact`');
		$this->db->from('`order` `a`
  LEFT JOIN `catering_type` `b` ON `b`.`cateringtype_id` =
    `a`.`order_cateringtypeid`
  LEFT JOIN `client` `c` ON `c`.`client_id` = `a`.`order_clientid`
  LEFT JOIN `order_status` `d` ON `d`.`orderstatus_id` = `a`.`order_statusid`
  LEFT JOIN `order_detail` `e` ON `e`.`orderdetail_orderid` = `a`.`order_id`
  LEFT JOIN `menu` `f` ON `f`.`menu_id` = `e`.`orderdetail_menuid`
  LEFT JOIN `menu_type` `g` ON `g`.`menutype_id` = `f`.`menu_typeid`
  LEFT JOIN `package` `h` ON `h`.`id` = `g`.`package_id`  
  LEFT JOIN `event` `i` ON `i`.`event_id` = `a`.`order_eventid`');
		$this->db->where('`a`.`order_id`', $id);
		$query = $this->db->get();
		return $query->result_array();
		/*
			$data = array(				
				'order_id' => $id,
			);
		*/
		//$this->load->view('pdf/index', $data);
	}	
	

function getExcel() {
$this->db->select('`a`.`order_date`, `a`.`order_time`, `a`.`event_date`, `a`.`event_time`, `d`.`orderstatus_name`,
  `c`.`client_firstname`,
  `c`.`client_lastname`,
  `f`.`menu_name`,
  `h`.`name_package`,
  `f`.`minimum_order`,
  `a`.`order_totalprice`,
  `c`.`client_address`,
  `c`.`client_email`,
  `b`.`cateringtype_name`,
  `g`.`menutype_name`,
  `i`.`event_name`,
  `a`.`order_message`,
  `c`.`client_contact`');
$this->db->from('`order` `a`
  LEFT JOIN `catering_type` `b` ON `b`.`cateringtype_id` =
    `a`.`order_cateringtypeid`
  LEFT JOIN `client` `c` ON `c`.`client_id` = `a`.`order_clientid`
  LEFT JOIN `order_status` `d` ON `d`.`orderstatus_id` = `a`.`order_statusid`
  LEFT JOIN `order_detail` `e` ON `e`.`orderdetail_orderid` = `a`.`order_id`
  LEFT JOIN `menu` `f` ON `f`.`menu_id` = `e`.`orderdetail_menuid`
  LEFT JOIN `menu_type` `g` ON `g`.`menutype_id` = `f`.`menu_typeid`
  LEFT JOIN `package` `h` ON `h`.`id` = `g`.`package_id`  
  LEFT JOIN `event` `i` ON `i`.`event_id` = `a`.`order_eventid`');
//$this->db->order_by('id','desc');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}

function account_pdf($id)
{
		$query 	= $this->db->query("SELECT * FROM   `order`
  LEFT JOIN `catering_type` ON `catering_type`.`cateringtype_id` =
    `order`.`order_cateringtypeid`
  LEFT JOIN `client` ON `client`.`client_id` = `order`.`order_clientid`
  LEFT JOIN `order_status` ON `order_status`.`orderstatus_id` =
    `order`.`order_statusid`
  LEFT JOIN `event` ON `event`.`event_id` = `order`.`order_eventid`
  LEFT JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  LEFT JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid`
  LEFT JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
			WHERE order_id = $id
			ORDER BY order_date DESC, order_time DESC
			");

		return $query->result_array();
}

function account_excel()
{
		$query 	= $this->db->query("SELECT * FROM   `order`
  LEFT JOIN `catering_type` ON `catering_type`.`cateringtype_id` =
    `order`.`order_cateringtypeid`
  LEFT JOIN `client` ON `client`.`client_id` = `order`.`order_clientid`
  LEFT JOIN `order_status` ON `order_status`.`orderstatus_id` =
    `order`.`order_statusid`
  LEFT JOIN `event` ON `event`.`event_id` = `order`.`order_eventid`
  LEFT JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  LEFT JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid`
  LEFT JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
			ORDER BY order_date DESC, order_time DESC
			");

		return $query->result_array();
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

	function export_excel_confirm($start = "")
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
			$query 	= $this->db->query("SELECT * FROM   `order`
  LEFT JOIN `catering_type` ON `catering_type`.`cateringtype_id` =
    `order`.`order_cateringtypeid`
  LEFT JOIN `client` ON `client`.`client_id` = `order`.`order_clientid`
  LEFT JOIN `order_status` ON `order_status`.`orderstatus_id` =
    `order`.`order_statusid`
  LEFT JOIN `event` ON `event`.`event_id` = `order`.`order_eventid`
  LEFT JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  LEFT JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid`
  LEFT JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
  LEFT JOIN `package` ON `package`.`id` = `menu_type`.`package_id`
				WHERE `order`.`order_statusid` = $in
				ORDER BY `order`.`order_date` DESC, `order`.`order_time` DESC
				LIMIT $start,$range
				");
		else
			$query 	= $this->db->query("SELECT * FROM   `order`
  LEFT JOIN `catering_type` ON `catering_type`.`cateringtype_id` =
    `order`.`order_cateringtypeid`
  LEFT JOIN `client` ON `client`.`client_id` = `order`.`order_clientid`
  LEFT JOIN `order_status` ON `order_status`.`orderstatus_id` =
    `order`.`order_statusid`
  LEFT JOIN `event` ON `event`.`event_id` = `order`.`order_eventid`
  LEFT JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  LEFT JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid`
  LEFT JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
  LEFT JOIN `package` ON `package`.`id` = `menu_type`.`package_id`
				WHERE `order`.`order_statusid` = $in
				ORDER BY `order`.`order_date` DESC, `order`.`order_time` DESC
				");

		return $query->result_array();

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
