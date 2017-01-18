<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * @name		CodeIgniter FPDF Library
 * @author		Denny Sutanto
 * @link		http://coorde.com/
 * @license		MIT License Copyright (c) 2012 Denny Sutanto
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
require_once(APPPATH.'third_party/fpdf/chinese.php');

class Fpdf_lib extends PDF_Chinese{
	public function __construct(){
		parent::__construct();	
	}	
	// Page footer
	function Header()
	{
		$this->Image('assets/img/print/logo.png',40,16,20,25);
		$this->Cell(170,11,'',0);
		$this->Ln();
		$this->Cell(50,1,'',0);
		$this->SetFont('Big5','',14);
		$this->Cell(120,6,mb_convert_encoding('新香港酒家（柔）私人有限公司','Big-5','UTF-8'),0,0,'C');
		$this->Ln();
		$this->Cell(50,1,'',0);
		
		$this->SetFont('Times', '', 14);
		$this->Cell(120,6,'Sing Siang Kang Restaurant (Johor) Sdn Bhd (34531-U)',0,0,'C');
		$this->SetFont('Times', '', 9);
		$this->Ln(20);
	}
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-35);
	    $this->Cell(28,1,'',0);
		$this->SetFont('Times','',9);
		$this->Cell(142,4,"*This is computer generated, no signature required.");
		$this->Ln(5);
		$this->Cell(28,1,'',0);
		$this->SetFont('big5','',9);
		$this->Cell(142,4,mb_convert_encoding('這是電腦打印的文件, 將不附上簽名. ','Big-5','UTF-8'));
		$this->Ln(5);
		$this->Image('assets/img/print/temp.png',40,$this->GetY(),134,0.2);
		$this->Ln(3);
		$this->SetFont('Times','',9);
		$this->Cell(28,1,'',0);
		$this->Cell(142,4,"69 A,B,C, Jalan Ibrahim sultan, 80300 Johor Bahru T: 07-2222608  F:07-2247208",0,0,'B');
	}
}
/*
$pdf=new PDF_Chinese();
$pdf->AddBig5Font();
$pdf->AddPage();
$pdf->SetFont('Big5','',20);
$pdf->Write(10,'�{�ɮ�� 18 C ��� 83 %');
$pdf->Output();
 * 
 */