<?php
	// Define $username and $password
	$username = $_POST['username'];
	$password = $_POST['psword'];
	
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	include "connection.php";
	
	
	$query = mysql_query("SELECT `Login_ID`,`Login_First_Name`,`Login_Password`,`Login_Type` From `SM_Login` WHERE `Login_First_Name` LIKE '%$username%' AND `Login_Password` = '$password'");
	
	$result = mysql_fetch_object($query);
	echo mysql_error();
	
	
	$name = $result->Login_First_Name;
	$password = $result->Login_Password;
	
	if (empty($name) || empty($password))
	{ echo 
			"";?>
		
				<script type='text/javascript'>
					alert('There is an error.\n\nCheck you user and password.');
					
					window.open("../index.html", "_top");
					
				</script>
			
		<?php	"";
	}
	
	$type = $result->Login_Type;
	
	
	if ($type == "Admin")
	{
		header("location: ../html/admin.php"); // Redirecting To Other Page
	}
	else if ($type == "Supervisor")
	{
		header("location: ../html/supScreen.php"); // Redirecting To Other Page
	}
	else
	{
		
	}
	
	mysql_close($con); // Closing Connection
?>


<script>

</script>