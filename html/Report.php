<?php
require("fpdf/fpdf.php");
//require('fpdf/image_alpha.php');

class PDF extends FPDF
{
	//Logo and Header
	function Header()
	{
		
		//logo
		//$this->Image("../images/searchIcon.png", 10, 6, 30);
		$this->SetTextColor(69,174,114);
		$this->SetFont("Arial", "B", 35);
		$this->setFillColor(128,212,164); 
		$this->Cell(1);
		$this->Cell(190, 20, "Student Monitoring Report", 0, 0, "C", TRUE);
		$this->Ln(19);
		
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 5, "", 0, 0, "C", TRUE);
		$this->Ln(10);
	}
	
	//Footer
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFillColor(128,212,164);
		$this->SetFont("Arial", "I", 8);
		$this->Cell(190, 10, "Page " . $this->PageNo(). "/{nb}", 0, 0, "C", TRUE);
	}
}


//Instanciation of inherited class
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","", 12);
for ($i=1; $i<=30;$i++)
	$pdf->Cell(0,10,"Print Line: ".$i, 0, 1);
$pdf->Output();
?>
