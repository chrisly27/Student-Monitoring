<!DOCTYPE html5>
<html >
<head>
	<meta charset="UTF-8">
	<title>Student Record Form</title>
	<link rel="stylesheet" type='text/css' href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Lato:300,400|Fjalla+One'>
	<link rel="stylesheet" type='text/css' href="../css/stylesheet.css">
	<link rel="stylesheet" type='text/css' href="../css/stylesheet_viewRecord.css">
	
</head>

<body>
<header>
		<div class="icon full" alt="logo">Student Monitoring</div>
		<!--<h2 class="full"> ASIM edit: <em>Floating Labels</em> &nbsp; <i class="fa fa-twitter"></i> <a href="https://twitter.com/AntonSimanov" target="_blank">  @AntonSimanov</a></h2> -->
		<h2 class="full"><a href="supScreen.php" class="btnbutton">Back</a></h2>
</header>


	
<?php

	include "../connection/connection.php";
	
	$id = $_GET['id'];
	if (!is_numeric($id))
	{
		echo "Sorry, there is an error.";
		exit;
	}
	
	
	//selecting query in order to get the detail of the student and department
	$result = mysql_query(
							"SELECT `SM_Record`.`Record_ID`,`SM_Record`.`Student_ID`,`SM_Student`.`Student_Name`,
								`SM_Student`.`Student_Middle_Name`,`SM_Student`.`Student_Surname`,`SM_Student`.`Project_ID`,
								`SM_Project`.`Project_Name`,`SM_Project`.`Project_Description`,`SM_Student`.`Course_ID`,`SM_Course`.`Course_Name`,
								`SM_Student`.`Supervisor_ID`,`SM_Supervisor`.`Supervisor_Name`,`SM_Record`.`Meeting_ID`,`SM_Department`.`Department_ID`,
								`SM_Department`.`Department_Name`,`SM_Department`.`Department_Description`,`SM_Department`.`Department_Leader` 
							FROM SM_Student
							LEFT JOIN `bg70ng`.`SM_Project` ON `SM_Student`.`Project_ID` = `SM_Project`.`Project_ID` 
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Student`.`Supervisor_ID` = `SM_Supervisor`.`Supervisor_ID` 
							LEFT JOIN `bg70ng`.`SM_Course` ON `SM_Student`.`Course_ID` = `SM_Course`.`Course_ID` 
							LEFT JOIN `bg70ng`.`SM_Record` ON `SM_Student`.`Student_ID` = `SM_Record`.`Student_ID` 
							LEFT JOIN `bg70ng`.`SM_Meeting` ON `SM_Record`.`Meeting_ID` = `SM_Meeting`.`Meeting_ID` 
							LEFT JOIN `bg70ng`.`SM_Department` ON `SM_Course`.`Department_ID` = `SM_Department`.`Department_ID` 
							WHERE `SM_Record`.`Student_ID` = $id"
						);
	$row = mysql_fetch_object($result);
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

	
?>

<!--Search Facility-->
<div id="container">

	<input class="search half" type="text" name="search" placeholder="Search..."/>
	
</div>


<div id="container">

	<h2 class="heading full">Student and Course Details</h2>
	<div id="containerStudentDetails1">
		<?php
			echo "<h3 class='textFont'>Fullname: $forename $middlename $surname</h3>";
			echo "<h3 class='textFont'><br>Course: $course</h3>";
			echo "<h3 class='textFont'><br>Supervisor: $supervisor</h3>";
		?>
	</div>
	<div id="containerStudentDetails2">
		<?php
			echo "<h3 class='textFont'>Department: $depart</h3>";
			echo "<h3 class='textFont'><br>Leader of Department: $leader</h3>";
			//echo "<br><br><br><br><h3 class='textFont'>Number of Meetings: xxxx in total";
		?>
	</div>
	<div id="containerStudentDetails3">
		<?php
			echo "<h3 class='textFont'>Project: $project</h3>";
			echo "<h3 class='textFont'><br>Description of the Project:<br> $project_description</h3>";
		?>
	</div>

</div>

<p></p>

<div id="container">

	<h2 class="heading full">Meetings Details</h2>
	
	<?php 
		
		
		$query = mysql_query(
							"SELECT `SM_Record`.`Record_ID`,`SM_Record`.`Student_ID`,`SM_Student`.`Student_ID`,`SM_Student`.`Student_Title`,`SM_Student`.`Student_Name`,
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
							WHERE `SM_Record`.`Student_ID` = $id
							ORDER BY `SM_Meeting`.`Cur_Date`DESC"
						);
		
		
		
		while ($rows = mysql_fetch_array($query))
		{
			echo "<h3 class='dateFormat'>Date of the Meeting: <em><strong>" . $rows['Cur_Date'] . "</strong></em></h3></br>";
			echo "<h3 class='meetingFormat'>Did the Meeting Take Place? - " . $rows['Meeting_Did_Not_Take_Place'] . "</h3></br>";
			
			echo 
				"<div class='containerMeetingsDetail1'>
					<h2 class='meetingFormat'>Reasons for the Meeting Did Not Take Place</h2>
					<h3>" . $rows['Reasons'] . "</h3>
				</div>";

				
				
			echo 
				"<table class='full'>
					<thead>
						<tr>
							<th class='headHeight'>&nbsp; Agreed Actions &nbsp;</th>
							<th class='headHeight'>&nbsp; Issues Discussed During Metting &nbsp;</th>
							<th class='headHeight'>&nbsp; Progress Made Since Last Meeting &nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>" . $rows['Action'] . "</td>
							<td>" . $rows['Issues'] . "</td>
							<td>" . $rows['Progress'] . "</td>
						</tr>
					</tbody>
				</table></br></br></br></br></br></br>";
				
				
				$Supervisor_Signature;
				if ($rows['Supervisor_Signature'] == null)
				{
					$Supervisor_Signature =  "No Signature Is Present";
				}
				else
				{
					$Supervisor_Signature = "Yes Signature Is Present";
				}
				
				$Student_Signatures;
				if ($rows['Student_Signature'] == null)
				{
					$Student_Signatures =  "No Signature Is Present";
				}
				else
				{
					$Student_Signatures = "Yes Signature Is Present";
				}
				echo
					"<table class='full'>
						<thead>
							<tr>
								<th class='headHeight'>&nbsp; Outcome of The Meeting &nbsp;</th>
								<th class='headHeight'>&nbsp; Dates of Interin Meetings &nbsp;</th>
								<th class='headHeight'>&nbsp; Other Supervisor Present &nbsp;</th>
								<th class='headHeight'>&nbsp; Supervisor Signature &nbsp;</th>
								<th class='headHeight'>&nbsp; Student Signature &nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>" . $rows['Outcome'] . "</td>
								<td>" . $rows['Interin_Date'] . "</td>
								<td>" . $rows['Other_Supervisor_Present'] . "</td>
								<td>" . $Supervisor_Signature . "</td>
								<td>" . $Student_Signatures . "</td>
							</tr>
						</tbody>
					</table>";

				echo "</br></br></br></br></br>";
				
				echo "<br><h3 class='others'>Other Outcome of the Meeting:</h3></br>";
				echo "<h4 class='other'>" . $rows['Other_Reasons'] . "</h4>";
				$recordID = $rows['Record_ID'];
				$meetingID = $rows['Meeting_ID'];
				$studentID = $rows['Student_ID'];
				
				echo "<a href='Delete.php?record_id=$recordID&meeting_id=$meetingID'><button type='button' class='pdfButton'>Delete Report</button></a>";
				echo "<a href='Report.php?id=$recordID' target='_blank'><button type='button' class='pdfButton'>PDF Report</button></a>";
				echo "<a href='Edit.php?id=$meetingID'><button type='button' class='pdfButton'>Edit Report</button></a></br></br></br></br>";
				
				//echo "<a href='pdf.php' class='pdfButton full' onclick='openWin()'>PDF</a></br></br></br></br></br>";
				
				
				echo "<h1 class='separation'></h1></br>";
		}
		
		mysql_close($con);
	?>

</div>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="../js/supScreenJavaScript.js"></script>

</body>
</html>