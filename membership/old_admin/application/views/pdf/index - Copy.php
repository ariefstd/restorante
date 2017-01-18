<?php
//require('../fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image(base_url().'assets/img/banner1.jpg',10,6,70);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(55,10,'NHK RESTAURANT',1,0,'C');
	// Line break
	$this->Ln(20);
}

function BasicTable($header)
{
	// Header
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Data
	/*
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
	*/
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

		
		foreach ($test as $row)
		{
			//$data[] = array($row['order_address'], $row['order_clientid'], $row['order_message'] );				
			//$header=array('Book Title','Author','Year');
			$date = $row['order_date'];
			$time = $row['order_time'];
			$address = $row['client_address'];
			$email = $row['client_email'];
			$contact = $row['client_contact'];
			$price = $row['order_totalprice'];
			if($price < 1){
				$price = 0;				
			}else{				
			$price = $row['order_totalprice'];
			}
			$fname = $row['client_firstname'];
			$lname = $row['client_lastname'];
			$message = $row['order_message'];
			$event = $row['event_name'];
			$catering_type = $row['cateringtype_name'];
			$menu_order = $row['menutype_name'];
			//$order_status = $row['order_status'];				
			//$test = "34234134134";
		}	

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetX(15);	
		$pdf->SetFont('Arial','',12);		
		$pdf->Cell(400,10,'Date : '.$date.'  '.$time);
$pdf->SetY(45);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Address : '.$address);	
$pdf->SetY(50);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Client name : '.$fname.' '.$lname);				
$pdf->SetY(55);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Message : '.$message);
$pdf->SetY(60);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Phone : '.$contact);
$pdf->SetY(65);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Email : '.$email);	
$pdf->SetY(70);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Event : '.$event);
$pdf->SetY(75);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Catering type : '.$catering_type);	
$pdf->SetY(80);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Ordered menu : '.$menu_order);	
$pdf->SetY(85);
$pdf->SetX(15);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(40,10,'Total Price : '.$price);	

$pdf->SetY(100);
$pdf->SetX(15);
//$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
//$pdf->BasicTable($header);
																		
		//$pdf->Cell(10,10,print_r($header, true), 0,0,'L');
		$pdf->Output();
?>
