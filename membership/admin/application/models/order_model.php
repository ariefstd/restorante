<?php

class Order_model extends CI_Model
{
	//ob_start();	
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


	function detail_order($id)
	{

		$query 	= $this->db->query("SELECT * FROM `menu_type` LEFT JOIN `order` ON `menu_type`.`menutype_id` = `order`.`order_cateringtypeid`  INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`orderdetail_orderid` INNER JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid` WHERE orderdetail_orderid = $id ORDER BY menutype_name ASC, menu_code ASC
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

	function catering_view()
	{
		$query = $this->db->get('catering_type');
		return $query->result_array();
	}

	function category_view()
	{
		$query = $this->db->get('main_category');
		return $query->result_array();
	}

	function package_view()
	{
		$query = $this->db->get('package');
		return $query->result_array();
	}
	
	function event_view()
	{
		$query = $this->db->get('event');
		return $query->result_array();
	}
	function menu_view()
	{
		//$query 	= $this->db->query("SELECT * FROM menu WHERE menu_isdeleted != 1");
		$this->db->where('menu_isdeleted !=1'); 
		$query = $this->db->get('menu');
		return $query->result_array();
	}

	function order_menu($id)
	{
		$query 	= $this->db->query("SELECT * FROM `menu` INNER JOIN `testings` ON `menu`.`menu_id` = `testings`.`menu_id` INNER JOIN `order` ON `order`.`order_id` = `testings`.`testing_orderid` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`orderdetail_orderid` WHERE `order_detail`.`orderdetail_orderid` = $id
			");

		return $query->result_array();
	}
	
	function menutype_view()
	{
		//$query 	= $this->db->query("SELECT * FROM menu WHERE menu_isdeleted != 1");
		//$this->db->where('menu_isdeleted !=1'); 
		$query = $this->db->get('menu_type');
		return $query->result_array();
	}

		
	function ordermenu_view($id)
	{
		$query 	= $this->db->query("SELECT * FROM `menu` INNER JOIN `order_detail` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid` WHERE
  `order_detail`.`orderdetail_id` = $id");
		return $query->result_array();
	}

	function showtablemenu_view($id)
	{
		$query 	= $this->db->query("SELECT *,`main_category`.`id` as `idCat`,`package`.`id` AS `idPac` FROM `order` INNER JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`orderdetail_orderid` INNER JOIN `menu` ON `menu`.`menu_id` = `order_detail`.`orderdetail_menuid` INNER JOIN `menu_type` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid` INNER JOIN `package` ON `package`.`id` = `menu_type`.`package_id` INNER JOIN `main_category` ON `main_category`.`id` = `package`.`id_main_category` WHERE
  `order_detail`.`orderdetail_id` = $id");
		return $query->result_array();
	}


	function alternatemenu_view($id)
	{
		$query 	= $this->db->query("SELECT * FROM
  `main_category`
  INNER JOIN `update_menu`
    ON `main_category`.`id` = `update_menu`.`updatemenu_idcat`
  INNER JOIN `package` ON `package`.`id` = `update_menu`.`updatemenu_idpac`
  INNER JOIN `order` ON `order`.`order_id` = `update_menu`.`updatemenu_idorder`
  INNER JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  INNER JOIN `testings` ON `order`.`order_id` = `testings`.`testing_orderid`
  INNER JOIN `menu` ON `menu`.`menu_id` = `testings`.`menu_id` 
  
  WHERE `order_detail`.`orderdetail_id` = $id GROUP BY `order`.`order_id`");
		return $query->result_array();
	}
	

	function order_edit($id)
	{
		/* this is for menu ...
		$available = $this->input->post('available');
		$dishes = $this->input->post('dishes');
		*/
		$message = $this->input->post('message');
		$idcat = $this->input->post('idcat');
		$event = $this->input->post('event');
		//$menuid = $this->input->post('menuid');
		$idpac = $this->input->post('idpac');
		$datepicker = $this->input->post('datepicker');
		$idpac = $this->input->post('idpac');
		$idcat = $this->input->post('idcat');
		$idorder = $this->input->post('idorder');
		$pricing = $this->input->post('pricing');
		
		$hour = $this->input->post('hour');
		$minute = $this->input->post('minute');
		$ampm = $this->input->post('ampm');
		$timer = $hour.':'.$minute.' '.$ampm;
		
		//$this->input->post('symbols');
		
		$edited = array(
			/*
			   'menu_name' => $dishes,
               'minimum_order' => $available
            
            	'order_eventid'	=> $event,
            	'order_cateringtypeid' => $type,
            	'order_message' => $message,
            	*/
            	//'orderdetail_menuid' => $menuid
               );
          $test = array(
            	//'order_eventid'	=> $event,
            	//'order_cateringtypeid' => $type,
            	'order_message' => $message  ,
            	//'order_cateringtypeid' => $promo ,
            	'order_date'  => $datepicker    
          ); 
          
          $updatemenu = array (
          	'updatemenu_idorder' => $idorder,
          	'updatemenu_idcat' => $idcat,
          	'updatemenu_idpac' => $idpac,
          	'updatemenu_pricing' => $pricing
          ); 
          
          	$this->db->insert('update_menu',$updatemenu);
          
          	$this->input->post('menu_id');
          	$id = $this->input->post('id');
          	$menutypeid = $this->input->post('menutypeid');
          	$pax = $this->input->post('pax');			
				          
			//$this->db->where('orderdetail_id', $id);
			//$this->db->update('order_detail', $edited);

            $this->db->where('order_id', $id);
			$this->db->update('order', $test);
			//$this->db->insert('update_menu',$updatemenu);

			$insert_data = array();
			//if(isset($this->input->post('menu_id'))){
				
				if($this->db->affected_rows() > 0)
				{
											
					foreach($this->input->post('menu_id') as $symb) 
					{
						$insert_data[] = array(
						'menu_id' => $symb,
						'testing_orderid' => $id,
						//'menutype_id' => $menutypeid,
						'testings_pax' => $pax,
						'testings_date' => $datepicker,
						'testings_time' => $timer
						);
					}
					

					return $this->db->insert_batch('testings', $insert_data);
				}	
			//}
				//$this->order_model->edit_datamenu($menuid);
				
	}
	
	function edit_datamenu($menuid){
        $edit_menu = array (
        'orderdetail_menuid' => $menuid
        );		
			$this->db->where('orderdetail_id', $menuid);
			$this->db->update('order_detail', $edit_menu);        
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
