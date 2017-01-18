<?php 

class Membership extends CI_Controller {

	private $page_id;
	private $current_page;
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('membership_model');
		
		$this->login_session_check->is_logged_in();
		//$this->login_session_check->permission_check();
		$this->current_page = 'membership';
	}
	
	public function index()
	{
		$result = $this->membership_model->view();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/view',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function search()
	{
		$result = $this->membership_model->search($this->input->get("q"));
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/search',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function view_expiry()
	{
		$result = $this->membership_model->view_expiry();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/view_expiry',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function view_expired()
	{
		$result = $this->membership_model->view_expired();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/view_expired',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function birthday()
	{
		$result = $this->membership_model->get_birthday();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/birthday',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	/*
	public function import(){
		$this->load->helper('string');
		$this->load->config('nhk');
		if (($handle = fopen(FCPATH."assets/vip.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	$pass = random_string('alnum', 8);	
		    	echo "member_card_no = ".$data[31] . "<br />";
				echo "username = ".$data[31] . "<br />";
				echo "pass = ".md5($this->config->item("hash_code").$pass) . "<br />";
				echo "temp pass = ".$pass . "<br />";
				echo "full_name = ".$data[3] ." ".$data[1]. "<br />";
				$gender = trim(strtolower($data[3]))=='mr' ? "male" : "female";
				$contact_no = "";
				if($data[12]!="" && $data[14]!="")
					$contact_no = $data[12].", ".$data[14];
				else if($data[12]!="" && $data[14]=="")
					$contact_no = $data[12];
				else if($data[12]=="" && $data[14]!="")
					$contact_no = $data[14];
				$d = explode("/",$data[18]);
				$strd = $d[1]." ".$d[0].", ".$d[2];
				$dob = date("Y-m-d",strtotime($strd));
				$expire = explode("/",$data[30]);
				$expiretime = mktime(0,0,0,$expire[1],$expire[0],$expire[2]);
				$jointime = mktime(0,0,0,$expire[1],$expire[0],($expire[2]-1)); 
				echo "gender = ".$gender. "<br />";
				echo "email = ".$data[17]. "<br />";
				echo "contact_no = ".$contact_no. "<br />";
				echo "mobile_no_1 = ".$data[15]. "<br />";
				echo "occupation = ".$data[11]. "<br />";
				echo "address = ".$data[4]. "<br />";
				echo "dob = ".$dob. "<br />";
				echo "date_join = ".$jointime. "<br />";
				echo "expiry_date = ".$expiretime. "<br />";
				echo "status = active<br />";
				echo " --------------- <br /><br />";
				
				$datainsert = array(
					"member_card_no" => $data[31],
					"username" => $data[31],
					"password" => md5($this->config->item("hash_code").$pass),
					"temp_pass" => $pass,
					"full_name" => $data[3] ." ".$data[1],
					"gender" => $gender,
					"email" => $data[17],
					"contact_no" => $contact_no,
					"mobile_no_1" => $data[15],
					"occupation" => $data[11],
					"address" => $data[4],
					"dob" => $dob,
					"date_join" => $jointime,
					"expiry_date" => $expiretime,
					"status" => "active",
					"temp_user_status" => "1"
				);
				$this->db->insert('membership',$datainsert);
		    }
		    fclose($handle);
		}	
	}
	*/
	
	public function sms()
	{
		$this->load->model('sms_model');
		$result = $this->sms_model->get_sms();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/sms',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function noemail()
	{
		$result = $this->membership_model->get_noemail();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/noemail',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function newrenewer()
	{
		$result = $this->membership_model->get_newrenewer();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/newrenewer',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function usernamepass()
	{
		$result = $this->membership_model->get_usernamepass();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/usernamepass',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
		
	public function print_post($type,$page)
	{
		$range = 100;
		$start = $page==1 ? "0" : ($page * $range) - $range;
		switch($type){
			case "noemail" : 
				$result = $this->membership_model->get_noemail($start);
				$template = "noemail";
				break;
			case "newrenewer" : 
				$result = $this->membership_model->get_newrenewer($start);
				$template = "newrenewer";
				break;
			case "usernamepass" : 
				$result = $this->membership_model->get_usernamepass($start);
				$template = "usernamepass";
				break;
			case "birthday" : 
				$result = $this->membership_model->get_birthday($start);
				$template = "birthday";
				break;	
		}
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'result'		=> $result
		);
		
		$this->load->config('nhk');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$this->load->library('fpdf_lib');
		//$this->pdf = new PDF_Chinese();
		$this->fpdf_lib->AddGBFont();
		$this->fpdf_lib->AddBig5Font();
		foreach ($result->result_array() as $resultdata){
			$this->fpdf_lib->AddPage();	
			$this->fpdf_lib->Cell(28,1,'',0);
			$this->fpdf_lib->Cell(80,8,'Date: '.date("d M Y"));
			$this->fpdf_lib->Ln(8);
			$this->fpdf_lib->Cell(28,1,'',0);
			$this->fpdf_lib->Cell(80,8,'To: '.$resultdata["full_name"]);
			$this->fpdf_lib->Ln(8);
			
			$addresses = explode("<br />",$resultdata["address"]);
			foreach($addresses as $address){
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(80,4,strip_tags($address));	
			}
			if($type=="birthday"){
				$this->fpdf_lib->Ln(11);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','BU');
				$this->fpdf_lib->MultiCell(80,8,'Subject : Happy Birthday');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(80,8,'Dear : '.$resultdata["full_name"]);
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"The management of New Hong Kong Restaurant would like to take this opportunity to wish you happy birthday for the month of ".date("M",strtotime($resultdata["dob"])).". A complimentary meal voucher worth RM30 will be given to you as a token of appreciation for your continuous support to us. Once again, we wish you a very good health and all your dreams come true.");
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','BU');
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('RM30 优惠券'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('尊敬的'.$resultdata["full_name"]));	
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('本酒樓衷心的祝賀您'.date("m",strtotime($resultdata["dob"])).'月份生日快樂.'));
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('特此獻上RM30禮券. 供你在本酒樓享用, 以感謝您一直以來對本酒樓的支持及照顧.'));
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('再一次，希望您身體健康和美夢成真.'));
			}else if($type=="newrenewer"){
				$this->fpdf_lib->Ln(7);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(80,8,'Dear Sir / Ms,');				
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','BU');
				$this->fpdf_lib->MultiCell(80,8,'New Hong Kong Previllage Card');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,"The management of New Hong Kong Restaurant would like to extend our deepest gratitude for your continuous support to our restaurant these past years and looking forward to another great year with you.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Attached, please find your Previllage Card (Card No: ".$resultdata["member_card_no"].") which will take effective from ".date("d/m/Y",$resultdata["date_join"])." till ".date("d/m/Y",$resultdata["expiry_date"]).". As our Previllage Card holder, you will enjoy special rate on selected items dining at our restaurant. You will also be the 1st to be notified on all our promotional activities and great deals.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"We wish you a very good health & all your dreams come true.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Your sincerely,");
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','BU');
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('新香港酒樓貴賓卡'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('衷心的感謝您這幾年來對新香港酒樓不間斷的支持和鼓勵, 為表謝意, 特此獻上您的貴賓卡（貴賓卡號碼: '.$resultdata["member_card_no"].'.）. 此貴賓卡將從'.date("Y",$resultdata["date_join"]).'年'.date("m",$resultdata["date_join"]).'月'.date("d",$resultdata["date_join"]).'日起生效，有效期為一年。'));	
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('尊貴的貴賓卡持有人, 您將享用新香港酒樓指定的餐飲優惠, 以及各類的籌辦活動訊息.'));
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('本管理层由衷的感谢您长期的支持和鞭策，希望您身体健康.'));
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('Yours Sincerely,'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','U');
				$this->fpdf_lib->MultiCell(80,8,'Online membership account');
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,"Please login with Username and Password below:");
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"URL:http://nhkrestaurant.com/v3/membership.html");
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Username: ".$resultdata["username"]);
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				//$this->fpdf_lib->MultiCell(142,4,"Password: nhk1234");
				$this->fpdf_lib->MultiCell(142,4,"Password: ".$resultdata["username"]);
			}else if($type=="oldnewrenewer"){
				$this->fpdf_lib->Ln(7);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(80,8,'Dear Sir / Ms,');				
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','BU');
				$this->fpdf_lib->MultiCell(80,8,'New Hong Kong Previllage Card');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,"The management of New Hong Kong Restaurant would like to extend our deepest gratitude for your continuous support to our restaurant these past years and looking forward to another great year with you.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"As our Previllage Card holder, you will enjoy special rate on selected items dining at our restaurant. You will also be the 1st to be notified on all our promotional activities and great deals.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"We wish you a very good health & all your dreams come true.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Your sincerely,");
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','BU');
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('新香港酒樓貴賓卡'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('衷心的感謝您這幾年來對新香港酒樓不間斷的支持和鼓勵.'));	
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('尊貴的貴賓卡持有人，您將享用新香港酒樓指定的餐飲優惠，以及各類的籌辦活動訊息.'));
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('本管理層由衷的感謝您長期的支持和鞭策，希望您身體健康.'));
				$this->fpdf_lib->Ln(2);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('Yours Sincerely,'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','U');
				$this->fpdf_lib->MultiCell(80,8,'Online membership account');
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,"Please login with Username and Password below:");
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"URL:http://nhkrestaurant.com/v3/membership.html");
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Username: ".$resultdata["username"]);
				$this->fpdf_lib->Ln(1.5);
				$this->fpdf_lib->Cell(28,1,'',0);
				//$this->fpdf_lib->MultiCell(142,4,"Password: nhk1234");
				$this->fpdf_lib->MultiCell(142,4,"Password: ".$resultdata["username"]);
			}else if($type=="usernamepass"){
				$this->fpdf_lib->Ln(11);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(80,8,'Dear Sir / Ms,');				
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','BU');
				$this->fpdf_lib->MultiCell(80,8,'Membership Login Account');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,"It's here! After months of preparations, we now proudly present to you our newly launched online membership website!");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"If you have a busy life style or want a hassle-free way to register/renew your New Hong Kong membership, from now on, you can register/renew your membership at wwwnhkrestaurant.com/v3/membership.html ");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"And to make the access even easier, we have also generated an username and temporary password for you. ");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Please find below your username and temporary password to access our online membership website.");
				$this->fpdf_lib->Ln(3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Username : ".$resultdata["username"]);
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,"Password : ".$resultdata["temp_pass"]);
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->MultiCell(142,4,'>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','');
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('親愛的會員'));
				$this->fpdf_lib->Ln(5);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('經過數個月的籌備, 讓我們為您精彩呈現新香港的會員專頁！'));	
				$this->fpdf_lib->Ln(3.3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('如果您生活忙碌, 無暇更新您的會員資格, 又或者您想要一個更省時的方法註冊成為新香港的會員, 從今天開始, 您可以選擇到我們的會員專頁來註冊/更新您的會員資格.'));
				$this->fpdf_lib->Ln(3.3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('網址是：http://nhkrestaurant.com/v3/membership.html'));
				$this->fpdf_lib->Ln(3.3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('為了更方便您的使用, 我們已為您準備了用戶名（username）和臨時密碼（password). （如下）'));
				$this->fpdf_lib->Ln(3.3);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('您可用以下的用戶名與臨時密碼來訪問我們的會員專頁：'));
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('Username：'.$resultdata["username"]));
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Big5','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('Password：'.$resultdata["temp_pass"]));
				$this->fpdf_lib->Ln(1);
				$this->fpdf_lib->Cell(28,1,'',0);
				$this->fpdf_lib->SetFont('Times','',9);
				$this->fpdf_lib->MultiCell(142,4,$this->ncr_decode('Yours Sincerely,'));
			}
		}
		$this->fpdf_lib->Output($type.'.pdf', 'D');
	}
	
	public function ncr_decode($string, $target_encoding='BIG5') {
		//return @iconv('UTF-8','BIG5//IGNORE', $this->html_entity_decode_utf8($string));
		return mb_convert_encoding($string,'Big-5','UTF-8');
	}
	
	public function popprint_post($type)
	{
		$range = 100;
		switch($type){
			case "noemail" : 
				$result = $this->membership_model->get_noemail();
				$total = sizeof($result->result_array());
				$page = ceil($total/$range);
				break;	
			case "newrenewer" : 
				$result = $this->membership_model->get_newrenewer();
				$total = sizeof($result->result_array());
				$page = ceil($total/$range);
				break;
			case "usernamepass" : 
				$result = $this->membership_model->get_usernamepass();
				$total = sizeof($result->result_array());
				$page = ceil($total/$range);
				break;	
			case "birthday" : 
				$result = $this->membership_model->get_birthday();
				$total = sizeof($result->result_array());
				$page = ceil($total/$range);
				break;	
		}
		
		$data = array(
			'current_page' 	=> 'popup',
			'total'		=> $total,
			'page'		=> $page,
			'range'		=> $range,
			'type'		=> $type,
		);
		
        $this->load->view('membership/popprint_post',$data);
	}

	
	public function add()
	{
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/add',
		);
		
        $this->load->view('includes/template',$data);
	}
		
	public function edit($id)
	{
		$result = $this->membership_model->edit($id);
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/edit',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	public function insert()
	{
		$this->membership_model->insert();
		redirect("membership/");
	}
	
	public function update()
	{
		$this->membership_model->update();
		redirect("membership/");
	}
	
	public function delete($id)
	{
		$this->membership_model->delete($id);
		redirect("membership/");
	}
	
	public function export_excel($type){
		$now = now();
		$oneweek = 604800;
		$today = now();
		$todaybirthday = date("m",strtotime('+1 month'));
		$fields = "id,member_card_no,username,password,full_name,ic_passport,gender,email,contact_no,mobile_no_1,mobile_no_2,nationality,occupation,address,mailing_add,card_collection ,FROM_UNIXTIME(date_join) as date_join,FROM_UNIXTIME(renewal_date) as renewal_date,FROM_UNIXTIME(expiry_date) as expiry_date ,status";
		switch($type){
			case "all" :
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "noemail" : 
				$sql = "SELECT $fields FROM membership WHERE email='' AND is_deleted != 1 AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "newrenewer" : 
				$sql = "SELECT $fields FROM membership WHERE (".$today." - date_join <=".$oneweek." OR (".$today." - renewal_date <=".$oneweek."  AND renewal_date!='')) AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "birthday" : 
				$sql = "SELECT $fields FROM membership WHERE MONTH(dob) = $todaybirthday  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "expiry" : 
				$sql = "SELECT $fields FROM membership WHERE expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) AND  is_deleted != 1 ORDER BY id DESC";
				break;	
			case "expired" : 
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "ordermenu" :
				$sql = "SELECT $fields FROM membership WHERE MONTH(dob) = $todaybirthday  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC";
				break;
				
		}	
		$result = mysql_query($sql);
		
		$this->load->library('fpdfaddress_lib');
		$this->fpdfaddress_lib->AddGBFont();
		$this->fpdfaddress_lib->AddBig5Font();
		$count = 0;
		$col = 1;
		$x = 10;
		$this->fpdfaddress_lib->SetAutoPageBreak(true,1);
		while($data = mysql_fetch_array($result)){
			if($count>23 || $count==0){	
				$this->fpdfaddress_lib->AddPage();
				$count = 0;
				$col = 1;
				$x = 10;
			}
			
			if($col<=3){
				if($col==1){
					$x=10;
					$y=$this->fpdfaddress_lib->GetY(); 
				}elseif($col==2){
					$x=80;
				}elseif($col==3){
					$x=150;
				}				
				$col++;
				
			}else{
				$x=10;
				$col=2;
				if($count==21)
					$y=$y+37;
				else
					$y=$y+36;
			}
			$this->fpdfaddress_lib->SetY($y);	
			$addresses = explode("<br />",$data["address"]);
			$this->fpdfaddress_lib->SetX($x);	
			$this->fpdfaddress_lib->SetFont('Arial','B',10);
			$this->fpdfaddress_lib->MultiCell(60,4,$data["full_name"],0);
			$this->fpdfaddress_lib->SetFont('Arial','',10);
			foreach($addresses as $address){
				$this->fpdfaddress_lib->SetX($x);	
				$this->fpdfaddress_lib->MultiCell(60,4,strip_tags($address),0);
			}
			$count++;
		}	
		$this->fpdfaddress_lib->Output($type.'.pdf', 'D');
		exit;
	}
	
	/*
	public function export_excel($type){
		$now = now();
		$oneweek = 604800;
		$today = now();
		$todaybirthday = date("m",strtotime('+1 month'));
		$fields = "id,member_card_no,username,password,full_name,ic_passport,gender,email,contact_no,mobile_no_1,mobile_no_2,nationality,occupation,address,mailing_add,card_collection ,FROM_UNIXTIME(date_join) as date_join,FROM_UNIXTIME(renewal_date) as renewal_date,FROM_UNIXTIME(expiry_date) as expiry_date ,status";
		switch($type){
			case "all" :
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "noemail" : 
				$sql = "SELECT $fields FROM membership WHERE email='' AND is_deleted != 1 AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "newrenewer" : 
				$sql = "SELECT $fields FROM membership WHERE (".$today." - date_join <=".$oneweek." OR (".$today." - renewal_date <=".$oneweek."  AND renewal_date!='')) AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "birthday" : 
				$sql = "SELECT $fields FROM membership WHERE MONTH(dob) = $todaybirthday  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "expiry" : 
				$sql = "SELECT $fields FROM membership WHERE expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) AND  is_deleted != 1 ORDER BY id DESC";
				break;	
			case "expired" : 
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
				
		}	
		$result = mysql_query($sql);
		
		$this->load->library('fpdfaddress_lib');
		$this->fpdfaddress_lib->AddGBFont();
		$this->fpdfaddress_lib->AddBig5Font();
		$count = 0;
		$col = 1;
		$x = 10;
		while($data = mysql_fetch_array($result)){
			if($count>23 || $count==0){	
				$this->fpdfaddress_lib->AddPage();
				$count = 0;
			}		
			if($col<=3){
				if($col==1){
					$x=10;
					$y=$this->fpdfaddress_lib->GetY(); 
				}elseif($col==2){
					$x=80;
					$this->fpdfaddress_lib->SetY($y);
				}elseif($col==3){
					$x=150;
					$this->fpdfaddress_lib->SetY($y);
				}				
				$col++;
				
			}else{
				$x=10;
				$col=1;	
			}
				
			$addresses = explode("<br />",$data["address"]);
			foreach($addresses as $address){
				$this->fpdfaddress_lib->SetX($x);	
				$this->fpdfaddress_lib->MultiCell(80,4,strip_tags($address));
			}
			$count++;
		}	
		$this->fpdfaddress_lib->Output($type.'.pdf', 'D');
		exit;
	}
	*/
	
	/*
	public function export_excel($type)
	{
		$now = now();
		$oneweek = 604800;
		$today = now();
		$todaybirthday = date("m",strtotime('+1 month'));
		$fields = "id,member_card_no,username,password,full_name,ic_passport,gender,email,contact_no,mobile_no_1,mobile_no_2,nationality,occupation,address,mailing_add,card_collection ,FROM_UNIXTIME(date_join) as date_join,FROM_UNIXTIME(renewal_date) as renewal_date,FROM_UNIXTIME(expiry_date) as expiry_date ,status";
		switch($type){
			case "all" :
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "noemail" : 
				$sql = "SELECT $fields FROM membership WHERE email='' AND is_deleted != 1 AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "newrenewer" : 
				$sql = "SELECT $fields FROM membership WHERE (".$today." - date_join <=".$oneweek." OR (".$today." - renewal_date <=".$oneweek."  AND renewal_date!='')) AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
			case "birthday" : 
				$sql = "SELECT $fields FROM membership WHERE MONTH(dob) = $todaybirthday  AND  is_deleted != 1 AND dob IS NOT NULL AND $now < expiry_date ORDER BY id DESC";
				break;	
			case "expiry" : 
				$sql = "SELECT $fields FROM membership WHERE expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) AND  is_deleted != 1 ORDER BY id DESC";
				break;	
			case "expired" : 
				$sql = "SELECT $fields FROM membership WHERE is_deleted != 1 AND $today >= expiry_date ORDER BY id DESC";
				break;
			case "usernamepass" : 
				$sql = "SELECT $fields FROM membership WHERE temp_user_status='1' AND  is_deleted != 1 AND $today < expiry_date ORDER BY id DESC";
				break;	
				
		}	
		$this->load->library('excel');

		$result = mysql_query($sql);
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("New Hong Kong Restaurant")
									 ->setLastModifiedBy("New Hong Kong Restaurant")
									 ->setTitle("Office 2007 XLSX Customer Database")
									 ->setSubject("Office 2007 XLSX Customer Database")
									 ->setDescription("Customer Database for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Membership Database");
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Membership');
		
		
		
		$col = 0;
		while ($row = mysql_fetch_field($result)) {
			 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $row->name);
			 $col++;
		}
		
		$rowIterator = 2;
		while($row = mysql_fetch_assoc($result)) {
		  $col = 0;
		  foreach($row as $key=>$value) {
			  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowIterator, $value);
			  $col++;
		  }
		  $rowIterator++;
		}
	
		// Redirect output to a client's web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="membership.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	*/
	
	/*
	public function export_expiry_excel()
	{
		$this->load->library('excel');
		
		$today = now();
		$sql = "SELECT id,member_card_no,username,password,full_name,ic_passport,gender,email,contact_no,mobile_no_1,mobile_no_2,nationality,occupation,address,mailing_add,card_collection ,FROM_UNIXTIME(date_join) as date_join,FROM_UNIXTIME(renewal_date) as renewal_date,FROM_UNIXTIME(expiry_date) as expiry_date ,status FROM membership WHERE is_deleted != 1 AND expiry_date BETWEEN UNIX_TIMESTAMP(now()) AND UNIX_TIMESTAMP(DATE_ADD(now(),INTERVAL 1 MONTH)) ORDER BY id DESC";
		
		$result = mysql_query($sql);
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("New Hong Kong Restaurant")
									 ->setLastModifiedBy("New Hong Kong Restaurant")
									 ->setTitle("Office 2007 XLSX Customer Database")
									 ->setSubject("Office 2007 XLSX Customer Database")
									 ->setDescription("Customer Database for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Membership Database");
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Membership');
		
		
		
		$col = 0;
		while ($row = mysql_fetch_field($result)) {
			 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $row->name);
			 $col++;
		}
		
		$rowIterator = 2;
		while($row = mysql_fetch_assoc($result)) {
		  $col = 0;
		  foreach($row as $key=>$value) {
			  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowIterator, $value);
			  $col++;
		  }
		  $rowIterator++;
		}
	
		// Redirect output to a client's web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="membership.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	*/
	public function email_reminder($type="")
	{
		switch($type){
			case "noemail" : 
				//$result = $this->membership_model->get_noemail();
				//$total = sizeof($result->result_array());
				//$page = ceil($total/$range);
				break;	
			case "newrenewer" : 
				//$result = $this->membership_model->get_newrenewer();
				//$total = sizeof($result->result_array());
				//$page = ceil($total/$range);
				break;
			case "usernamepass" : 
				//$result = $this->membership_model->get_usernamepass();
				//$total = sizeof($result->result_array());
				//$page = ceil($total/$range);
				break;	
		}
		$this->load->model("email_template_model");
		$templates = $this->email_template_model->get_all();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'type'			=> $type,
			'main_content' 	=> 'membership/email_reminder',
			'templates'		=> $templates->result_array()
		);
		
        $this->load->view('includes/template',$data);	
	}
	
	public function addedit_template($id="")
	{
		$data = array(
			'current_page' 	=> 'popup'
		);	
		if(!empty($id)){
			$this->load->model("email_template_model");
			$result = $this->email_template_model->get_detail($id);
			$res = array("result"=>$result);
			$data["result"] = $result;
		}	
        $this->load->view('membership/addedit_template',$data);
	}
	
	public function saveupdate_template(){
		$this->load->model("email_template_model");
		$data = array(
			"title" =>$this->input->post("txtTitle"),
			"message" =>$this->input->post("txtMessage")
		);
		if($this->input->post("mode")=="add")
			$this->email_template_model->insert($data);
		else
			$this->email_template_model->update($data,$this->input->post("template_id"));
	}
	
	public function delete_template($id){
		$this->load->model("email_template_model");
		$result = $this->email_template_model->delete($id);
	}
	
	public function store_email()
	{
		$this->load->model("email_model");
		$cat = $this->input->post("selGroup");
		$configupload['upload_path'] = FCPATH.'assets/uploads/';
		$configupload['allowed_types'] = 'gif|jpg|png|pdf|doc|xls';
		$configupload['max_size']	= '1000';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$dataupload = array();
		$this->load->library('upload', $configupload);
		if ($this->upload->do_upload("fl"))
			$dataupload = $this->upload->data();
		
		$start_date = "";
		$end_date = "";
		$hour = $this->input->post("hour")=="" ? '00' : $this->input->post("hour");
		$minute = $this->input->post("minute")=="" ? '00' : $this->input->post("minute");
		if($this->input->post("start")!="")
		{
			$seperator = explode("/",$this->input->post("start"));
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0]." ".$hour.":".$minute.":00";
			$start_date = $new_date;
		}
		
		if($this->input->post("end")!="")
		{
			$seperator = explode("/",$this->input->post("end"));
			$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0]." ".$hour.":".$minute.":00";
			$end_date = $new_date;
		}
		
		$data = array(
			"title" => $this->input->post('txtTitle'),
			"category" => $cat,
			"message" => $this->input->post('txtMessage'),
			"frequency" => $this->input->post('rdoFrequency'),
			"attach" => $dataupload["full_path"],
			"start_date" => $start_date,
			"end_date" => $end_date,
			"every" => $this->input->post('selEvery'),
			"status" => '1',
			"created_at" => date("Y-m-d H:i:s")
		);
		$email_id = $this->email_model->insert('email',$data);
		redirect("membership/email");
	}	
	
	public function email(){
		$result = $this->membership_model->get_all_email();
		
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/email',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}
	
	function email_detail($id){
		$result = $this->membership_model->get_email_detail_all($id);
		$data = array(
			'current_page' 	=> $this->current_page,
			'main_content' 	=> 'membership/email_detail',
			'result'		=> $result
		);
		
        $this->load->view('includes/template',$data);
	}

	function set_email_status($id){
		$result = $this->membership_model->get_email($id);
		$status = $result[0]["status"]=="1" ? "0" : "1";
		$this->db->query("UPDATE email SET status = ? WHERE id = ?",array($status,$id));
		redirect("membership/email");
	}
}