<?php

class Order extends CI_Controller {

	private $page_id;
	private $current_page;

	function __construct()

	{

		parent::__construct();
		$this->load->library('pdf/fpdf');
		$this->load->library('tcpdf/tcpdf');		
		$this->load->model('order_model');
		$this->login_session_check->is_logged_in();
		$this->current_page = 'order';

	}

	public function index()
	{

		$result = $this->order_model->view();

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'order/view',
			'result'		=> $result

			);

		$this->load->view('includes/template',$data);

	}

	public function confirms()
	{
		$result = $this->order_model->view_confirm();
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'order/view',
			'result'		=> $result
			);
		$this->load->view('includes/template',$data);
	}

	public function search()
	{

		$result = $this->order_model->search($this->input->post("q"));

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'order/view',
			'result'		=> $result

			);

		$this->load->view('includes/template',$data);

	}

	public function confirm($id)
	{
		$result = $this->order_model->edit($id);
		$detail = $this->order_model->detail($id);
		$ordermenu= $this->order_model->order_menu($id);
		$alternatemenu = $this->order_model->alternatemenu_view($id);

		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'order/confirm',
			'result'		=> $result[0],
			'detail'		=> $detail,
			'alternatemenu'	=> $alternatemenu,
			'ordermenu'		=> $ordermenu
		);
		$this->load->view('includes/template',$data);
	}

	public function order_detail($id)
	{

		$result = $this->order_model->edit($id);
		//$detail = $this->order_model->detail($id);
		$detail = $this->order_model->detail_order($id);
		//$data['catering'] = $this->order_model->catering_view();
		$catering = $this->order_model->catering_view();
		$event = $this->order_model->event_view();
		$category = $this->order_model->category_view();
		$package = $this->order_model->package_view();
		$alternatemenu = $this->order_model->alternatemenu_view($id);
		
		$ordermenu = $this->order_model->ordermenu_view($id);
		$menu = $this->order_model->menu_view();
		$promotion = $this->order_model->menutype_view();
		$ordermenu2= $this->order_model->order_menu($id);
		$showtablemenu = $this->order_model->showtablemenu_view($id);

		$data = array(

			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'order/detail',
			'result'		=> $result[0],
			'detail'		=> $detail,
			'category'		=> $category,
			'package'		=> $package,
			'catering'		=> $catering,
			'event'			=> $event,
			'alternatemenu'	=> $alternatemenu,
			'ordermenu'		=> $ordermenu,
			'promotion'		=> $promotion,
			'menuview'		=> $menu,
			'ordermenu2'	=> $ordermenu2,
			'showtablemenu'	=> $showtablemenu
			);
		$this->load->view('includes/template',$data);
	}

	public function do_confirm($id)
	{
		$result=true;
		$order=$this->order_model->edit($this->input->post("id"));
		$order=$order[0];
		$detail=$this->order_model->detail($this->input->post("id"));
		
$query = $this->db->query("SELECT * FROM
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

		$ordermenu=$this->order_model->order_menu($id);
		//$alternatemenu = $this->order_model->alternatemenu_view($id);
		

		if($result)
		{
			$this->load->library('mailer');
$this->mailer->IsSMTP(); // telling the class to use SMTP
$this->mailer->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$this->mailer->SMTPAuth   = true;                  // enable SMTP authentication
$this->mailer->SMTPSecure = 'tls';
$this->mailer->Host       = "smtp.gmail.com"; // sets the SMTP server
$this->mailer->Port       = 587;                    // set the SMTP port for the GMAIL server
$this->mailer->Username   = "nhkcal@gmail.com"; 	// SMTP account username
$this->mailer->Password   = "nhkcal12345";      		// SMTP account password

$tr='';
foreach($detail as $dt)
{

	$tr.="
	<tr>
		<td align='left'>".$dt['menutype_name'].":</td>
		<td style='color:#0033FF;padding:5px 0 5px 0;'>[".$dt['menu_code']."] ".$dt['menu_name']."</td>
	</tr>
	";

}

$message = file_get_contents('application/template/invoice.html');
$message = str_replace('%%NAME%%', $order['client_firstname'].' '.$order['client_lastname'], $message ) ;
$message = str_replace('%%EMAIL%%', $order['client_email'], $message ) ;
$message = str_replace('%%PHONE%%', $order['client_contact'], $message ) ;
$message = str_replace('%%EVENT%%', $order['event_name'], $message ) ;
$message = str_replace('%%CATERING%%', $order['cateringtype_name'], $message ) ;
$message = str_replace('%%DATE%%', $order['order_date'], $message ) ;
$message = str_replace('%%TIME%%', $order['order_time'], $message ) ;
$message = str_replace('%%ADDRESS%%', $order['order_address'], $message ) ;
$message = str_replace('%%MESSAGE%%', $order['order_message'], $message ) ;
$message = str_replace('%%LIST%%', $tr, $message ) ;

foreach ($query->result_array() as $row)
	{
	$menu_name = $row['menu_name'];
	$category_menu = $row['name_main_category'];
	$package_menu = $row['name_package'];
	$date1 = $row['testings_date'];
	$time1 = $row['testings_time'];
	$datetime = $date1.' '.$time1;
	$pricing = $row['updatemenu_pricing'];
	
//foreach($ordermenu as $ordering)
//{
	$message = str_replace('%%ALTERNATEMENU%%', $menu_name, $message ) ;
	$message = str_replace('%%ALTERNATEPACKAGE%%', $package_menu, $message ) ;
	$message = str_replace('%%ALTERNATECATEGORY%%', $category_menu, $message ) ;
	$message = str_replace('%%ALTERNATEDATE%%', $datetime, $message ) ;
	$message = str_replace('%%ALTERNATEPRICE%%', $pricing, $message ) ;
}
$message = str_replace('%%TOTAL%%', $this->input->post("price"), $message ) ;
$message = str_replace('%%LINK%%', base_url()."../../../v4/payment.php?order=".$this->input->post("id"), $message );

$personal_mail = 'ariefstd.2006@gmail.com';
$personal_name = 'Mr. Gendonz Wemz';
//$this->mailer->AddAddress($personal_mail,'Mesute',' ','Odzille');
$this->mailer->AddAddress($order["client_email"],$order['client_firstname'].' '.$order['client_lastname']);
$this->mailer->AddCC($personal_mail, $personal_name);
$this->mailer->SetFrom($this->mailer->Username, 'New Hong Kong Restaurant');
$this->mailer->AddReplyTo($this->mailer->Username, 'New Hong Kong Restaurant');
$this->mailer->Subject='NHK: INVOICE';
$this->mailer->MsgHTML($message);

if($this->mailer->Send())
{
	$result=$this->order_model->confirm();
}

}
		$data['test'] = $this->order_model->pdf_show($id);	
		$this->load->view('pdf/index', $data);	//redirect("order/");

//redirect("order/");
}

public function complete($id)
{

	$result = $this->order_model->edit($id);
	$detail = $this->order_model->detail($id);

	$data = array(

		'current_page' 	=> $this->current_page,
		'main_content' 	=> 'order/complete',
		'result'		=> $result[0],
		'detail'		=> $detail

		);

	$this->load->view('includes/template',$data);

}

public function do_complete()
{

	$result=$this->order_model->complete();
	redirect("order/");

}

// Edit get id
public function edit($id='')
{
	$result = $this->order_model->edit($id);
	$data = array(
		'current_page' 	=> $this->current_page,
		'main_content' 	=> 'order/edit',
		'result'		=> $result
		);
	$this->load->view('includes/template',$data);
}
// Cancle or delete
public function cancle($id='')
{
	$this->order_model->cancle_model($id);
	redirect("order/");
}

public function order_edit($id){
      $this->order_model->order_edit($id);
		redirect('order');
      //$this->inventory_model->edit_data();               
}

}
