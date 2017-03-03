<!DOCTYPE html5>
<html >
<head>
	<meta charset="UTF-8">
	<title>Student Record Form</title>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400|Fjalla+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/stylesheet.css">

  
</head>

<body>
	<header>  
		<div class="icon full" alt="logo">Student Monitoring</div>
		<!--<h2 class="full"> ASIM edit: <em>Floating Labels</em> &nbsp; <i class="fa fa-twitter"></i> <a href="https://twitter.com/AntonSimanov" target="_blank">  @AntonSimanov</a></h2> -->
		<h2 class="full"><a href="../html/supScreen.php" class="btnbutton">Back</a></h2>
	</header>

<?php
	//Connection function from another file
	include "../connection/connection.php";
	
	//Checking the URL contain id
	$id = $_GET['id'];
	if (!is_numeric($id))
	{
		echo "Sorry, there is an error.";
		exit;
	}
	
	//Variable from the form page
	$student_id = $_GET["id"];
	$forename = $_POST["First_Name"];
	$surname = $_POST["Last_Name"];
	$department = $_POST["Department"];
	$directores = $_POST["directors_Present"];
	$supervisors = $_POST["supervisors_Present"];
	$meeting = $_POST["meeting_happen"];
	$resons = $_POST["reason_not_attended"];
	$progress = $_POST["progress"];
	$issues = $_POST["issues"];
	$actions = $_POST["actions"];
	$outcome = $_POST["outcome"];
	$O_Outcome = $_POST["Other_outcome"];
	$interim = $_POST["date_OfInterimMeeting"];
	$monthlyDate = $_POST["monthlydate"];
	$currentDate = date("Y-m-d");
	$studentSignature = $_POST["student_signature_link"];
	$supervisorSignature = $_POST["supervisor_signature_link"];
	
	//Insering data into meeting's table
	$sql = "INSERT INTO `bg70ng`.`SM_Meeting` 
		(	`Meeting_ID`, `Monthly_Date`, `Interin_Date`, `Other_Supervisor_Present`, 
			`Meeting_Did_Not_Take_Place`, `Reasons`, `Progress`, `Issues`, `Action`, 
			`Outcome`, `Other_Reasons`, 
			`Student_Signature`, `Supervisor_Signature`, `Cur_Date`
		) 
		VALUES 
		(	NULL, '$monthlyDate', '$interim', '$supervisors', '$meeting', '$resons', 
			'$progress', '$issues', 
			'$actions', '$outcome', '$O_Outcome', '$studentSignature', '$supervisorSignature', 
			'$currentDate'
		)";
		
		echo $currentDate;
	if (!mysql_query($sql,$con))
	{
		die("Error: " . mysql());
	}
	
	//Select last data from meeting's table
	$select = mysql_query ("SELECT * FROM `SM_Meeting` ORDER BY `Meeting_ID` DESC LIMIT 1");
	$row = mysql_fetch_object($select);
	echo mysql_error();
	
	//Get the id
	$lastID = $row->Meeting_ID;

	//Insert the student and meeting's id into record's table
	$sql_Record = "INSERT INTO `bg70ng`.`SM_Record` 
					(`Record_ID`, `Student_ID`, `Meeting_ID`) 
					VALUES 
					(NULL, '$student_id', '$lastID');";
	
	 if (!mysql_query($sql_Record,$con))
	{
		die("Error: " . mysql());
	} 
	
	//Display a message to the user
	echo "<h1 class='record'>The details has been recorded in the database.</br></br></br>Thank You Very Much.</h1>";
	
	//Close the connection
	mysql_close($con);
?>






























</body>
</html>