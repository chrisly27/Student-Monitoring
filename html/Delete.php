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
	$record_id = $_GET['record_id'];
	$meeting_id = $_GET['meeting_id'];
	if (!is_numeric($record_id) || !is_numeric($meeting_id))
	{
		echo "Sorry, there is an error.";
		exit;
	}

	$sql_Delete_Record = "DELETE FROM `bg70ng`.`SM_Meeting` WHERE `SM_Meeting`.`Meeting_ID` = $record_id";

	if (!mysql_query($sql_Delete_Record,$con))
	{
		die("Error: " . mysql());
	}

	$sql_Delete_Meeting = "DELETE FROM `bg70ng`.`SM_Meeting` WHERE `SM_Meeting`.`Meeting_ID` = $meeting_id";

	if (!mysql_query($sql_Delete_Meeting,$con))
	{
		die("Error: " . mysql());
	}
	
	//Display a message to the user
	echo "<h1 class='record'>The Details has been Deleted from the database.</br></br></br>Thank You Very Much.</h1>";
	
	//Close the connection
	mysql_close($con);
?>

</body>
</html>