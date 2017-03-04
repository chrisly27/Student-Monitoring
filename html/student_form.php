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

	include "../connection/connection.php";

	$id = $_GET['id'];
	if (!is_numeric($id))
	{
		echo "Sorry, there is an error.";
		exit;
	}
	
	//selecting query in order to get the detail of the student and department
	$query = mysql_query("SELECT `SM_Student`.`Student_ID`,`SM_Student`.`Student_Name`,
							`SM_Student`.`Student_Surname`,`SM_Course`.`Course_Name`,
							`SM_Department`.`Department_Name`,
							`SM_Supervisor`.`Supervisor_Name` FROM SM_Department 
							LEFT JOIN `bg70ng`.`SM_Course` ON `SM_Department`.`Department_ID` = `SM_Course`.`Department_ID`
							LEFT JOIN `bg70ng`.`SM_Student` ON `SM_Course`.`Course_ID` = `SM_Student`.`Course_ID`
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Supervisor`.`Supervisor_ID` = `SM_Student`.`Supervisor_ID`
							WHERE `SM_Student`.`Student_ID` = $id");
	$row = mysql_fetch_object($query);
	echo mysql_error();
	
	$studentId = $row->Student_ID;
	$forename = $row->Student_Name;
	$surname = $row->Student_Surname;
	$depart = $row->Department_Name;
	$directStudy = $row->Supervisor_Name;

	mysql_close($con);
?>

<form action="submit.php?id=<?php echo $studentId; ?>" method="post">
	<!--  Student Detail -->	
	<div class="form-group">
		<h2 class="heading full">Student Detail</h2>		
		<div class="controls third">
			<input type="text" value="<?php echo $forename; ?>" id="firstName" class="floatLabel" name="First_Name">
			<label for="firstName">First Name</label>
		</div>
		<div class="controls third">
			<input type="text" value="<?php echo $surname; ?>" id="lastName" class="floatLabel" name="Last_Name">
			<label for="lastName">Last Name</label>
		</div>
		<div class="controls third">
			<input type="text" value="<?php echo $depart; ?>" id="department" class="floatLabel" name="Department">
			<label for="department">Department</label>
		</div>
		<div class="controls third">
			<input type="text" value="<?php echo $directStudy; ?>" id="directors_Present" class="floatLabel" name="directors_Present">
			<label for="directors_Present">Director of Studies Present</label>
		</div>
		<div class="controls third">
			<input type="text" id="supervisors_present" class="floatLabel" name="supervisors_Present">
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
			<textarea name="reason_not_attended" class="floatLabel" id="reason_not_attended"></textarea>
			<label for="reason_not_attended">Reason for not Attended.</label>
		</div>	
	</div>
	<!--  Detail of the Meeting -->
	<div class="form-group">
		<h2 class="heading full">Detail of the Meeting</h2>
		<div class="controls full">
			<textarea name="progress" class="floatLabel" id="progress"></textarea>
			<label for="progress">Progress Made Since Last Meeting</label>
		</div>
		<div class="controls full">
			<textarea name="issues" class="floatLabel" id="issues"></textarea>
			<label for="issues">Issues Discussed During Meeting</label>
		</div>
		<div class="controls full">
			<textarea name="actions" class="floatLabel" id="actions"></textarea>
			<label for="actions">Agreed Actions</label>
		</div>
	</div>
	<!--  Outcome of Meeting -->
	<div class="form-group">
	<h2 class="heading full">Outcome of Meeting</h2>
		
		<div class="controls third">
			<select class="floatLabel" name="outcome">
				<option value=""></option>
				<option value="Satisfactory"> Progress Satisfactory </option>
				<option value="Dissatisfactory"> Lack of Progress - Reasons below! </option>
				<option value="Others"> Other Outcomes - Reasons below! </option>
			</select>
		<label for="fruit">Did the Meeting Take Place?</label>
		<input type="text" name="Other_outcome" placeholder="Other Outcomes">
		</div>
		
		<div class="controls third">
			<textarea type="text" name="date_OfInterimMeeting" class="floatLabel" id="date_OfInterimMeeting"></textarea>
			<label for="date_OfInterimMeeting">Date of Next Interim Meeting - Separated by a commar (,).</label>
		</div>
		<!--Monthly Date-->
		<div class="controls third">
		<h2 class="heading full">Monthly Date</h2>
			<input type="date" id="monthlydate" max="01/09/2016" class="floatLabel" name="monthlydate" >
		</div>
	</div>
	<!--  Signature Place Hold -->
	<div class="form-group">
		<h2 class="heading full">Signature Holder</h2>
	
		<div class="controls full">

			<div class="controls half">
				<h2 class="heading half">Supervisor Signature</h2>
				<iframe src="signaturePad.php" style="width: 100%; height: 25%;"></iframe>
			</div>
			
			<div class="controls half">
				<h2 class="heading half">Student Signature</h2>
				<iframe src="signaturePad2.php" style="width: 100%; height: 25%;"></iframe>
			</div>
			
			<p class="half"><button onclick="myFunction()" type="button">Click Here to Save Signatures</button></p>
			<p class="half"><button onclick="myFunction2()" type="button">Click Here to Erase Signatures</button></p>
			
			
			<div class="controls half">
				<textarea type="text" name="supervisor_signature_link" class="floatLabel" id="supervisor_signature_link"></textarea>
				<label for="supervisor_signature_link">Supervisor Signature Link</label>
			</div>
			
			
			<div class="controls half">
				<textarea type="text" name="student_signature_link" class="floatLabel" id="student_signature_link"></textarea>
				<label for="student_signature_link">Student Signature Link</label>
			</div>
			
			
			
			
			<script>
				function myFunction()
				{
					document.getElementById("supervisor_signature_link").innerHTML = localStorage.getItem("supervisor");
					document.getElementById("student_signature_link").innerHTML = localStorage.getItem("student");
					
					alert("You can now submit the form.")
				}
				
				function myFunction2()
				{
					var r = confirm("Are you sure you want to erase the signature?\n\nIf yes, you will need to save each signature again before \nsubmitting the form. thank you.");
					
					if (r == true){
						
						document.getElementById("supervisor_signature_link").innerHTML = "";
						document.getElementById("student_signature_link").innerHTML = "";
						localStorage.clear();
					}
					else
					{
						
					}
					
				}
			</script>
			
		</div>
		
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