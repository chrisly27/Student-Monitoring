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
	$MeetingID = $_GET["id"];
	$supervisors_Present = $_POST['supervisors_Present'];
	$meeting_happen = $_POST['meeting_happen'];
	$reason_not_attended = $_POST['reason_not_attended'];
	$progress = $_POST['progress'];
	$issues = $_POST['issues'];
	$actions = $_POST['actions'];
	$outcome = $_POST['outcome'];
	$Other_outcome = $_POST['Other_outcome'];
	$date_OfInterimMeeting = $_POST['date_OfInterimMeeting'];
	
	
	
	
	
	//Insering data into meeting's table
	$sql = "
				UPDATE `bg70ng`.`SM_Meeting` 
				SET 
					`Other_Supervisor_Present` = '$supervisors_Present', 
					`Meeting_Did_Not_Take_Place` = '$meeting_happen', 
					`Reasons` = '$reason_not_attended', 
					`Progress` = '$progress', 
					`Issues` = '$issues',
					`Action` = '$actions',
					`Outcome` = '$outcome',
					`Other_Reasons` = '$Other_outcome',
					`Interin_Date` = '$date_OfInterimMeeting'
				WHERE 
					`Meeting_ID` = '$MeetingID'
			";
		
		// $currentDate;
	if (!mysql_query($sql,$con))
	{
		die("Error: " . mysql_error());
	}
	
	
	//Display a message to the user
	echo "<h1 class='record'>The details has been successfully updated in the database.</br></br></br>Thank You Very Much.</h1>";
	
	//Close the connection
	mysql_close($con);
?>

</body>
</html>