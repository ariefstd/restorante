<?php
class tuto1 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf/fpdf');
		$this->load->library('tcpdf/tcpdf');
		$this->load->model('order_model');
		
		$this->login_session_check->is_logged_in();
		//$this->login_session_check->permission_check();
		//$this->current_page = 'sms';
	}

//require('../fpdf.php');

	public function index()
	{
		//$pdf = new FPDF();
		//$pdf->AddPage();
		//$pdf->SetFont('Arial','B',16);

		//$this->db->select('*');
		//$this->db->from('order');
		//$this->db->where('serial', $id);
		//$query = $this->db->get();
			//foreach ($query->result() as $row)
			//{
				//$address = $row->order_address;
				//$test = "34234134134";
			//}
		//$pdf->Cell(40,10,'Gadgadgag');
		//$pdf->Output();
		redirect('tuto1/testsadja/');

	}

	public function testsadja($id)
	{
		/*
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $id);
		$this->load->view('pdf/index');
		*/
		$data['test'] = $this->order_model->pdf_show($id);	
		$this->load->view('pdf/index', $data);
		//$this->order_model->pdf_show($id);
	}

	public function account($id)
	{
		/*
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $id);
		$this->load->view('pdf/index');
		*/
		$data['test'] = $this->order_model->account_pdf($id);	
		
		$this->load->view('pdf/account', $data);
		//$this->order_model->pdf_show($id);
	}


	public function testexcel()
	{
		/*
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $id);
		$this->load->view('pdf/index');
		*/

		$data['test'] = $this->order_model->export_excel_confirm();	
		$this->load->view('excel/index', $data);
		//$this->order_model->pdf_show($id);
	}	

	public function testexcel2()
	{
		/*
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $id);
		$this->load->view('pdf/index');
		*/

		$data['test'] = $this->order_model->account_excel();	
		$this->load->view('excel/index', $data);
		//$this->order_model->pdf_show($id);
	}	
	
}
?>
