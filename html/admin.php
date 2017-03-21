<!DOCTYPE html5>
<html >
<head>
	<meta charset="UTF-8">
	<title>Admin Screen</title>
	<link rel="stylesheet" type='text/css' href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Lato:300,400|Fjalla+One'>
	<link rel="stylesheet" type='text/css' href="../css/stylesheet.css">
	<link rel="stylesheet" type='text/css' href="../css/stylesheet_viewRecord.css">
	
</head>

<body>
<header>
		<div class="icon full" alt="logo">Student Monitoring</div>
		<h2 class="full"><a href="../index.html" class="btnbutton">Log Out</a></h2>
</header>


<!--Search Facility-->
<div id="container">

	<form name="Search_Facility" action="admin_search_ViewRecord.php" method="post">
		<input class="search full" type="text" name="search" placeholder="Search..." /></br></br></br></br>
		<input class="search third" type="submit" name="submit" value="Search" />
	</form>
</div>
	

<div id="container">
	
	<?php 
	
		
		
		include "../connection/connection.php";
		
		$query = mysql_query(
							"SELECT `SM_Record`.`Record_ID`,`SM_Record`.`Student_ID`,`SM_Student`.`Student_ID`,`SM_Student`.`Student_Title`,`SM_Student`.`Student_Name`,
								`SM_Student`.`Student_Middle_Name`,`SM_Student`.`Student_Surname`,`SM_Student`.`DOB`,`SM_Student`.`Project_ID`,
								`SM_Project`.`Project_Name`,`SM_Project`.`Project_Description`,`SM_Student`.`Course_ID`,`SM_Course`.`Course_Name`,
								`SM_Course`.`Course_Date_Started`,`SM_Course`.`Course_Description`,`SM_Student`.`Supervisor_ID`,
								`SM_Supervisor`.`Supervisor_Name`,`SM_Record`.`Meeting_ID`,`SM_Meeting`.`Monthly_Date`,`SM_Meeting`.`Interin_Date`,
								`SM_Meeting`.`Other_Supervisor_Present`,`SM_Meeting`.`Meeting_Did_Not_Take_Place`,`SM_Meeting`.`Reasons`,
								`SM_Meeting`.`Progress`,`SM_Meeting`.`Issues`,`SM_Meeting`.`Action`,`SM_Meeting`.`Outcome`,`SM_Meeting`.`Other_Reasons`,
								`SM_Meeting`.`Student_Signature`,`SM_Meeting`.`Supervisor_Signature`,`SM_Meeting`.`Cur_Date`,`SM_Department`.`Department_ID`,
								`SM_Department`.`Department_Name`,`SM_Department`.`Department_Description`,`SM_Department`.`Department_Leader`,`SM_Student`.`Student_ID`,
								`SM_Student`.`Student_Name`,`SM_Student`.`Student_Middle_Name`,`SM_Student`.`Student_Surname`,`SM_Student`.`Student_Email`,`SM_Student`.`Project_ID`,
								`SM_Project`.`Project_Name`,`SM_Project`.`Project_Description`,`SM_Student`.`Course_ID`,`SM_Course`.`Course_Name`,
								`SM_Student`.`Supervisor_ID`,`SM_Supervisor`.`Supervisor_Name`,`SM_Department`.`Department_ID`,
								`SM_Department`.`Department_Name`,`SM_Department`.`Department_Description`,`SM_Department`.`Department_Leader` 
							FROM SM_Student
							LEFT JOIN `bg70ng`.`SM_Project` ON `SM_Student`.`Project_ID` = `SM_Project`.`Project_ID` 
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Student`.`Supervisor_ID` = `SM_Supervisor`.`Supervisor_ID` 
							LEFT JOIN `bg70ng`.`SM_Course` ON `SM_Student`.`Course_ID` = `SM_Course`.`Course_ID` 
							LEFT JOIN `bg70ng`.`SM_Record` ON `SM_Student`.`Student_ID` = `SM_Record`.`Student_ID` 
							LEFT JOIN `bg70ng`.`SM_Meeting` ON `SM_Record`.`Meeting_ID` = `SM_Meeting`.`Meeting_ID` 
							LEFT JOIN `bg70ng`.`SM_Department` ON `SM_Course`.`Department_ID` = `SM_Department`.`Department_ID` 
							ORDER BY `SM_Student`.`Student_Name` ASC"
						);
						
						
		
		
		while ($rows = mysql_fetch_array($query))
		{
			echo "
			
			<h2 class='heading full'>Student and Course Details</h2>
			<div id='containerStudentDetails1'>
					<h3 class='textFont'>Fullname: " . $rows['Student_Name'] . " " . $rows['Student_Middle_Name'] . " " . $rows['Student_Surname'] . "</h3>
					<h3 class='textFont'><br>Email: <a href='mailto:" . $rows['Student_Email'] . "' target='_top'>" . $rows['Student_Email'] . "</a></h3>
					<h3 class='textFont'><br>Course: " . $rows['Course_Name'] . "</h3>
					<h3 class='textFont'><br>Supervisor: " . $rows['Supervisor_Name'] . "</h3>
			</div>
			<div id='containerStudentDetails2'>
					<h3 class='textFont'>Department: " . $rows['Department_Name'] . "</h3>
					<h3 class='textFont'><br>Leader of Department: " . $rows['Department_Leader'] . "</h3>
			</div>
			<div id='containerStudentDetails3'>
					<h3 class='textFont'>Project: " . $rows['Project_Name'] . "</h3>
					<h3 class='textFont'><br>Description of the Project:<br> " . $rows['Project_Description'] . "</h3>
			</div>";
	
	
			echo "<h3 class='dateFormat'>Date of the Meeting: <em><strong>" . $rows['Cur_Date'] . "</strong></em></h3></br>";
			echo "<h3 class='meetingFormat'>Did the Meeting Take Place? - " . $rows['Meeting_Did_Not_Take_Place'] . "</h3></br>";
			
			echo 
				"<div class='containerMeetingsDetail1'>
					<h2 class='meetingFormat'>Reasons for the Meeting Did Not Take Place</h2>
					<h3>" . $rows['Reasons'] . "</h3>
				</div>";

			
			echo "<h2 class='heading full'>Meetings Details</h2>";
				
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
				
				echo "<a href='Report.php?id=$recordID' target='_blank'><button type='button' class='pdfButton'>PDF Report</button></a></br></br></br></br>";
				
				echo "<h1 class='separation'></h1></br>";
		}
		
		mysql_close($con); 
	?>

</div>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="../js/supScreenJavaScript.js"></script>

</body>
</html>