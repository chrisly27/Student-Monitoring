<?php

include "../connection/connection.php";
	
	$id = $_GET['id'];
	if (!is_numeric($id))
	{
		echo "<h1>Sorry, there is an error with the URL address.<br>This URL does not exist.</h1>";
		exit;
	}
	
	$sql = mysql_query(
							"SELECT `SM_Record`.`Record_ID`,`SM_Record`.`Student_ID`,`SM_Student`.`Student_Title`,`SM_Student`.`Student_Name`,
								`SM_Student`.`Student_Middle_Name`,`SM_Student`.`Student_Surname`,`SM_Student`.`DOB`,`SM_Student`.`Project_ID`,
								`SM_Project`.`Project_Name`,`SM_Project`.`Project_Description`,`SM_Student`.`Course_ID`,`SM_Course`.`Course_Name`,
								`SM_Course`.`Course_Date_Started`,`SM_Course`.`Course_Description`,`SM_Student`.`Supervisor_ID`,
								`SM_Supervisor`.`Supervisor_Name`,`SM_Record`.`Meeting_ID`,`SM_Meeting`.`Monthly_Date`,`SM_Meeting`.`Interin_Date`,
								`SM_Meeting`.`Other_Supervisor_Present`,`SM_Meeting`.`Meeting_Did_Not_Take_Place`,`SM_Meeting`.`Reasons`,
								`SM_Meeting`.`Progress`,`SM_Meeting`.`Issues`,`SM_Meeting`.`Action`,`SM_Meeting`.`Outcome`,`SM_Meeting`.`Other_Reasons`,
								`SM_Meeting`.`Student_Signature`,`SM_Meeting`.`Supervisor_Signature`,`SM_Meeting`.`Cur_Date`,`SM_Department`.`Department_ID`,
								`SM_Department`.`Department_Name`,`SM_Department`.`Department_Description`,`SM_Department`.`Department_Leader` 
							FROM SM_Student
							LEFT JOIN `bg70ng`.`SM_Project` ON `SM_Student`.`Project_ID` = `SM_Project`.`Project_ID` 
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Student`.`Supervisor_ID` = `SM_Supervisor`.`Supervisor_ID` 
							LEFT JOIN `bg70ng`.`SM_Course` ON `SM_Student`.`Course_ID` = `SM_Course`.`Course_ID` 
							LEFT JOIN `bg70ng`.`SM_Record` ON `SM_Student`.`Student_ID` = `SM_Record`.`Student_ID` 
							LEFT JOIN `bg70ng`.`SM_Meeting` ON `SM_Record`.`Meeting_ID` = `SM_Meeting`.`Meeting_ID` 
							LEFT JOIN `bg70ng`.`SM_Department` ON `SM_Course`.`Department_ID` = `SM_Department`.`Department_ID` 
							WHERE `SM_Record`.`Record_ID` = $id"
						);
	
	$row = mysql_fetch_object($sql);
	echo mysql_error();
	
	$studentId = $row->Student_ID;
	$forename = $row->Student_Name;
	$middlename = $row->Student_Middle_Name;
	$surname = $row->Student_Surname;
	$depart = $row->Department_Name;
	$course = $row->Course_Name;
	$supervisor = $row->Supervisor_Name;
	$project = $row->Project_Name;
	$project_description = $row->Project_Description;
	$leader = $row->Department_Leader;
	$monthlyDate = $row->Monthly_Date;
	$interimDate = $row->Interin_Date;
	$otherSupervisor = $row->Other_Supervisor_Present;
	$meetingDidNotTakePlace = $row->Meeting_Did_Not_Take_Place;
	$outcome = $row->Outcome;
	$otherReason = $row->Other_Reasons;
	$Reasons = $row->Reasons;
	$Progress = $row->Progress;
	$Issues = $row->Issues;
	$Action = $row->Action;
	$StudentSign = $row->Student_Signature;
	$SupervisorSign = $row->Supervisor_Signature;
	$meetingDate = $row->Cur_Date;
	$currentDate = date("d/m/Y");
	

require("fpdf/fpdf.php");
//require('fpdf/image_alpha.php');

//require("Requestimage.php");



class VariableStream
{
    private $varname;
    private $position;

    function stream_open($path, $mode, $options, &$opened_path)
    {
        $url = parse_url($path);
        $this->varname = $url['host'];
        if(!isset($GLOBALS[$this->varname]))
        {
            trigger_error('Global variable '.$this->varname.' does not exist', E_USER_WARNING);
            return false;
        }
        $this->position = 0;
        return true;
    }

    function stream_read($count)
    {
        $ret = substr($GLOBALS[$this->varname], $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }

    function stream_eof()
    {
        return $this->position >= strlen($GLOBALS[$this->varname]);
    }

    function stream_tell()
    {
        return $this->position;
    }

    function stream_seek($offset, $whence)
    {
        if($whence==SEEK_SET)
        {
            $this->position = $offset;
            return true;
        }
        return false;
    }
    
    function stream_stat()
    {
        return array();
    }
}



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
	
	function StudentDetails($forename, $middlename, $surname, $meetingDate, 
							$project, $Reasons, $Progress, $Issues, $Action, $otherSupervisor,
							$outcome, $otherReason, $StudentSign, $SupervisorSign, $meetingDate,
							$monthlyDate, $interimDate, $leader, $currentDate, $depart, $supervisor)
	{
		$this->SetFont("Arial", "", 14);
		$this->setFillColor(255,255,255);
		
		$this->Cell(1);
		$this->Cell(65, 10, "Name of Student: ", "LTR",0,"L",0);
		$this->Cell(125, 10, $forename . " " . $middlename . " " . $surname, "LTR",0,"L",0);
		$this->Ln();
		
		$this->Cell(1);
		$this->Cell(65, 10, "Date of Meeting", "LTR",0,"L",0);
		$this->Cell(30, 10, $meetingDate, "LTR",0,"L",0);
		
		$this->Cell(15, 10, "Dept: ", "LTR",0,"L",0);
		$this->Cell(80, 10, $depart, "LTR",0,"L",0);
		$this->Ln();
		
		$this->Cell(1);
		$this->Cell(65, 10, "Directory of Studies present ", "LTR",0,"L",0);
		$this->Cell(125, 10, $supervisor, "LTR",0,"L",0);
		$this->Ln();
		
		$this->Cell(1);
		$this->Cell(65, 10, "Other Supervisor(s) present ", "LTRB",0,"L",0);
		$this->Cell(125, 10, $otherSupervisor, "LTRB",0,"L",0);
		$this->Ln(12);
		$this->Ln(2);

		$this->Cell(1);
		$this->Cell(65, 10, "Meeting did not take place: ", "LRTB",0,"L", 0);
		$this->SetFont("Arial", "", 12);
		$this->MultiCell(125, 10, "Reasons: \n" . $Reasons, "LRTB",1,"L", 0);
		$this->Cell(1);
		$this->Ln(8);
		
		$this->SetFont("Arial", "B", 14);
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 3, "", 0, 0, "C", TRUE);
		$this->Ln(5);
		
		$this->Cell(1);
		$this->Cell(190, 7, "Progress made since last meeting", "LRTB",0,"L",0);
		$this->Ln();
		$this->SetFont("Arial", "", 12);
		$this->SetFillColor(255,255,255);
		$this->Cell(1);
		$this->MultiCell(190, 10, $Progress, "LRB",1,"L",0);
		$this->Ln(8);
		
		$this->SetFont("Arial", "B", 14);
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 3, "", 0, 0, "C", TRUE);
		$this->Ln(5);
		
		$this->Cell(1);
		$this->Cell(190, 7, "Issues discussed during meeting", "LRTB",0,"L",0);
		$this->Ln();
		$this->SetFont("Arial", "", 12);
		$this->SetFillColor(255,255,255);
		$this->Cell(1);
		$this->MultiCell(190, 10, $Issues, "LRB",1,"L",0);
		$this->Ln(8);

		$this->SetFont("Arial", "B", 14);
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 3, "", 0, 0, "C", TRUE);
		$this->Ln(5);
		
		$this->Cell(1);
		$this->Cell(190, 7, "Agreed Action", "LRTB",0,"L",0);
		$this->Ln();
		$this->SetFont("Arial", "", 12);
		$this->SetFillColor(255,255,255);
		$this->Cell(1);
		$this->MultiCell(190, 10, $Action, "LRB",1,"L",0);
		$this->Ln(8);

		$this->SetFont("Arial", "B", 14);
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 3, "", 0, 0, "C", TRUE);
		$this->Ln(5);
		
		$this->SetFont("Arial", "B", 14);
		$this->Cell(1);
		$this->Cell(64, 7, "Dates of Interim", "LTRB",0,"C",0);
		$this->Cell(62, 7, "Outcome of Meeting", "LTRB",0,"C",0);
		$this->Cell(64, 7, "Other outcome", "LTRB",0,"C",0);
		$this->Ln();
		
		$this->SetFont("Arial", "", 12);
		$this->SetFillColor(255,255,255);
		$this->Cell(1);
		$this->Cell(64, 10, $interimDate, "LTRB",0,"C",0,0);
		$this->Cell(62, 10, $outcome, "LTRB",0,"C",0,0);
		$this->MultiCell(64, 10, $otherReason, "LTRB",1,"L",0,0);
		$this->Ln();
		
		
		
		
		
		
		
		
		
		
		
		$this->SetY(-100);
		$this->SetFont("Arial", "B", 14);
		$this->SetFillColor(69,174,114);
		$this->Cell(1);
		$this->Cell(190, 3, "", 0, 0, "C", TRUE);
		$this->Ln(5);
		
		$this->SetFont("Arial", "B", 14);
		$this->Cell(1);
		$this->Cell(95, 7, "Student Signature", "B",0,"C",0);
		$this->Cell(95, 7, "Supervisor Signature", "B",0,"C",0);
		$this->Ln();

		$this->Cell(1);
		$this->Cell(95, 50, "", "",0,"C",0);
		$this->Cell(95, 50, "", "",0,"C",0);
		$this->Ln();
		
		
		
		//$image1 = $StudentSign . ".png";
		//$this->Cell(40, 40, $this->Image($image1, $this->GetX(), $this->GetY(), 30.78),0,0,"L", FALSE);
		
		
		//$me = $this->Image($StudentSign . ".jpgn")
		
		//$this->Cell(50,50, $me ,"",0,"R",0);
		
		
		
		
		
		$currentDate = date("d/m/Y");
		$this->SetY(-31);
		$this->SetFont("Arial", "", 14);
		$this->Cell(1);
		$this->Cell(100, 10, "", "",0,"C",0);
		$this->Cell(85, 10, "Report Produce on: " . $currentDate, "",0,"R",0);
		$this->Ln();
	}
}

	
	



//Instanciation of inherited class
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","", 12);


$pdf->StudentDetails($forename, $middlename, $surname, $meetingDate, 
						$project, $Reasons, $Progress, $Issues, $Action, $otherSupervisor,
						$outcome, $otherReason, $StudentSign, $SupervisorSign, $meetingDate,
						$monthlyDate, $interimDate, $leader, $currentDate, $depart, $supervisor);
	
	
	
	
	
	
$pdf->Image($StudentSign . ".jpg", 0, 50 , 100);

	
	
	

$pdf->Output();
?>
