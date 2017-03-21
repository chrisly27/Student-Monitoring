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


<?php

	include "../connection/connection.php";

	$id = $_GET['id'];
	if (!is_numeric($id))
	{
		echo "Sorry, there is an error.";
		exit;
	}
	
	//selecting query in order to get the detail of the student and department
	$query = mysql_query("SELECT `SM_Meeting`.`Monthly_Date`,`SM_Meeting`.`Interin_Date`,
							`SM_Meeting`.`Other_Supervisor_Present`, `SM_Meeting`.`Meeting_Did_Not_Take_Place`,
							`SM_Meeting`.`Reasons`,`SM_Meeting`.`Progress`,`SM_Meeting`.`Issues`, `SM_Meeting`.`Action`,
							`SM_Meeting`.`Outcome`,`SM_Meeting`.`Other_Reasons`,`SM_Meeting`.`Cur_Date`,`SM_Meeting`.`Student_Signature`, 
							`SM_Meeting`.`Supervisor_Signature`,`SM_Record`.`Meeting_ID`,`SM_Student`.`Student_ID`,`SM_Student`.`Student_Name`,
							`SM_Student`.`Student_Middle_Name`, `SM_Student`.`Student_Surname`,`SM_Supervisor`.`Supervisor_Name` 
							FROM SM_Meeting 
							LEFT JOIN `bg70ng`.`SM_Record` ON `SM_Meeting`.`Meeting_ID` = `SM_Record`.`Meeting_ID` 
							LEFT JOIN `bg70ng`.`SM_Student` ON `SM_Record`.`Student_ID` = `SM_Student`.`Student_ID` 
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Student`.`Supervisor_ID` = `SM_Supervisor`.`Supervisor_ID` 
							WHERE `SM_Record`.`Meeting_ID` = $id");
							
	$row = mysql_fetch_object($query);
	echo mysql_error();
	
	$StudentID = $row->Student_ID;
	$MeetingID = $row->Meeting_ID;
	$forename = $row->Student_Name;
	$middle = $row->Student_Middle_Name;
	$surname = $row->Student_Surname;
	$super = $row->Supervisor_Name;
	$Other_Supervisor_Present = $row->Other_Supervisor_Present;
	$reasons = $row->Reasons;
	$action = $row->Action;
	$issue = $row->Issues;
	$progress = $row->Progress;
	$outcome = $row->Other_Reasons;
	$interim = $row->Interin_Date;

	
	

	mysql_close($con);
?>


	<header>  
		<div class="icon full" alt="logo">Student Monitoring</div>
		<!--<h2 class="full"> ASIM edit: <em>Floating Labels</em> &nbsp; <i class="fa fa-twitter"></i> <a href="https://twitter.com/AntonSimanov" target="_blank">  @AntonSimanov</a></h2> -->
		<h2 class="full"><a href="../html/view_record.php?id=<?php echo $StudentID ?>" class="btnbutton">Back</a></h2>
	</header>
	


<form action="update.php?id=<?php echo $MeetingID; ?>" method="post">
	<!--  Student Detail -->	
	<div class="form-group">
		<h2 class="heading full">Student Detail</h2>		
		<div class="controls third">
			<input type="text" value="<?php echo $forename . " " . $middle . " " . $surname; ?>" id="firstName" class="floatLabel" name="First_Name" required>
			<label for="firstName">First Name</label>
		</div>

		<div class="controls third">
			<input type="text" value="<?php echo $Other_Supervisor_Present; ?>" id="supervisors_present" class="floatLabel" name="supervisors_Present">
			<label for="supervisors_present">Other Supervisor(s) Present</label>
		</div>
		<div class="controls third">
			<select class="floatLabel" name="meeting_happen">
				<option value=""></option>
				<option value="Yes">Yes - Did</option>
				<option value="No">No - Didn't</option>
			</select>
			<label for="fruit">Did the Meeting Take Place?</label>
		</div>			
		<div class="controls full">
			<textarea name="reason_not_attended" class="floatLabel" id="reason_not_attended"><?php echo $reasons; ?> </textarea>
			<label for="reason_not_attended">Reason for not Attended.</label>
		</div>	
	</div>
	<!--  Detail of the Meeting -->
	<div class="form-group">
		<h2 class="heading full">Detail of the Meeting</h2>
		<div class="controls full">
			<textarea name="progress" class="floatLabel" id="progress" required><?php echo $progress; ?></textarea>
			<label for="progress">Progress Made Since Last Meeting</label>
		</div>
		<div class="controls full">
			<textarea name="issues" class="floatLabel" id="issues" required><?php echo $issue; ?></textarea>
			<label for="issues">Issues Discussed During Meeting</label>
		</div>
		<div class="controls full">
			<textarea name="actions" class="floatLabel" id="actions" required><?php echo $action; ?></textarea>
			<label for="actions">Agreed Actions</label>
		</div>
	</div>
	<!--  Outcome of Meeting -->
	<div class="form-group">
	<h2 class="heading full">Outcome of Meeting</h2>
		
		<div class="controls third">
			<select class="floatLabel" name="outcome" required>
				<option value=""></option>
				<option value="Satisfactory"> Progress Satisfactory </option>
				<option value="Dissatisfactory"> Lack of Progress - Reasons below! </option>
				<option value="Others"> Other Outcomes - Reasons below! </option>
			</select>
		<label for="fruit">Did the Meeting Take Place?</label>
		</div>
		
		<div class="controls third">
			<input type="text" value="<?php echo $outcome; ?>" name="Other_outcome" class="floatLabel" id="Other_outcome" required>
			<label for="Other_outcome">Other Outcomes</label>
		</div>
		
		
		<div class="controls third">
			<textarea type="text" name="date_OfInterimMeeting" class="floatLabel" id="date_OfInterimMeeting"><?php echo $interim; ?></textarea>
			<label for="date_OfInterimMeeting">Date of Next Interim Meeting - Separated by a commar (,).</label>
		</div>
	</div>
	<!--  Signature Place Hold -->
	<div class="form-group">

		<div class="controls full">
			<h2 class="heading full">
			<button name="submit" type="submit" class="full">Submit</a></button></h2>
		</div>
	</div>
</form>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../js/supScreenJavaScript.js"></script>

</body>
</html>