<?php
//============================================================+
// File name   : example_007.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 007 for TCPDF class
//               Two independent columns with WriteHTMLCell()
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Two independent columns with WriteHTMLCell()
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('NEW HONGKONG RESTAURANT');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

$txt = <<<EOD
TABLE ORDER CLIENT

EOD;
$pdf->writeHTML($txt, true, 0, true, 0);
$pdf->writeHTML('', true, 0, true, 0);

// create columns content
$left_column = '';
$right_column = '';

		foreach ($test as $row)
		{
			//$data[] = array($row['order_address'], $row['order_clientid'], $row['order_message'] );				
			//$header=array('Book Title','Author','Year');
			$date = $row['order_date'];
			$time = $row['order_time'];
			$address = $row['client_address'];
			$email = $row['client_email'];
			$phone = $row['client_contact'];
			$price = $row['order_totalprice'];
			$menuname = $row['menu_name'];
			$order_paypal = $row['order_paypal'];
			if(empty($row['order_paypal']))	
			{				
				//echo 'Not Yet';	
				$order_paypal = 'not yet';
			}else{
				$order_paypal = $row['order_paypal'];
			}
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
			//$ordered_menu = $row['menutype_name'];
			$status = $row['orderstatus_name'];
			$minimum_order = $row['minimum_order'];
			//$order_status = $row['order_status'];				
			//$test = "34234134134";
		}	

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$y = $pdf->getY();
$x = $pdf->getX();

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', $y, 'Date & time', 1, 0, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $date.' '.$time, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Address', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $address, 1, 1, 1, true, 'J', true);


// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Client name', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $fname.' '.$lname, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Client phone', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $phone, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Client email', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $email, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Event', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $event, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Catering type', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $catering_type, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Menu name', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $menuname, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Price', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $price, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Status payment', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $status, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Menu available', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $minimum_order, 1, 1, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 63, 127);
// write the first column
$pdf->writeHTMLCell(40, '', '', '', 'Status paypal', 1, 0, 1, true, 'J', true);
// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(100, '', '', '', $order_paypal, 1, 1, 1, true, 'J', true);

$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(127, 31, 0);
// write the second column
$pdf->writeHTMLCell(140, '', '', '', '', 1, 1, 1, true, 'J', true);
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output(base_url().'assets/pdf/'.$email.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
