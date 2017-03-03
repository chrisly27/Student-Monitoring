<!DOCTYPE html5>
<html >
<head>
	<meta charset="UTF-8">
	<title>Student Record Form</title>
	<link rel="stylesheet" type='text/css' href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Lato:300,400|Fjalla+One'>
	<link rel="stylesheet" type='text/css' href="../css/stylesheet.css">
	<link rel="stylesheet" type='text/css' href="../css/stylesheet_superv.css">
  
</head>

<body class="back">
<header>
	<a href="supScreen.php"><div class="icon full" alt="logo">Student Monitoring</div></a>
		<!--<h2 class="full"> ASIM edit: <em>Floating Labels</em> &nbsp; <i class="fa fa-twitter"></i> <a href="https://twitter.com/AntonSimanov" target="_blank">  @AntonSimanov</a></h2> -->
		<h2 class="full"><a href="../index.html" class="btnbutton">Back</a></h2>
</header>


<!--Search Facility-->
<div id="container">


	<input class="search half" type="text" name="search" placeholder="Search..."/>
	<!--<form action="" method="post">
		<input class="search half" type="text" name="search" placeholder="Search..."/>
		<input class="" type="submit" name="submit" value="Search"/>
	</form>-->
	
		<?php
			/*$search_value=$_POST["search"];
			include "../connection/connection.php";
			if(!$con){
				echo 'Connection Faild: '.$con;
				}else{
					$sql=mysql_query("select * from SM_Student where Student_Name like '%$search_value%'");

						while ($row = mysql_fetch_array($sql))
						{
							echo "Name: " . $row["Student_Name"];
						}  
					}*/
		?>


	<h2 class="separation full"></h2>
	
</div>

<?php
	include "../connection/connection.php";
	
	
	$result = mysql_query(
							"SELECT `SM_Student`.`Student_ID`,`SM_Student`.`Student_Name`,`SM_Student`.`Student_Middle_Name`,`SM_Student`.`Student_Surname`,`SM_Course`.`Course_Name`,
								`SM_Department`.`Department_Name`,`SM_Project`.`Project_Name`,`SM_Supervisor`.`Supervisor_Name` FROM SM_Student
							LEFT JOIN `bg70ng`.`SM_Project` ON `SM_Student`.`Project_ID` = `SM_Project`.`Project_ID` 
							LEFT JOIN `bg70ng`.`SM_Supervisor` ON `SM_Student`.`Supervisor_ID` = `SM_Supervisor`.`Supervisor_ID` 
							LEFT JOIN `bg70ng`.`SM_Course` ON `SM_Student`.`Course_ID` = `SM_Course`.`Course_ID` 
							LEFT JOIN `bg70ng`.`SM_Department` ON `SM_Course`.`Department_ID` = `SM_Department`.`Department_ID`
							ORDER BY `SM_Student`.`Student_Name`"
						);
	
	
	
	
	
	
	
	echo "
		<div id='container'>
			<table>
				<thead>
					<tr>
						<th class='headHeight'>&nbsp;Forename&nbsp;</th>
						<th class='headHeight'>&nbsp;Middlename&nbsp;</th>
						<th class='headHeight'>&nbsp;Surname&nbsp;</th>
						<th class='headHeight'>&nbsp;Course Name&nbsp;</th>
						<th class='headHeight'>&nbsp;Department Name&nbsp;</th>
						<th class='headHeight'>&nbsp;Project Name&nbsp;</th>
						<th class='headHeight'>&nbsp;Supervisor Name&nbsp;</th>
						<th class='headHeight'>&nbsp;&nbsp;Option&nbsp;</th>
						<th class='headHeight'>&nbsp;&nbsp;Option&nbsp;</th>
					</tr>
				</thead>
				<tbody>";
				
				while ($row = mysql_fetch_array($result))
				{
					echo "
						<tr>
							<td>&nbsp;" . $row['Student_Name'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Student_Middle_Name'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Student_Surname'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Course_Name'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Department_Name'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Project_Name'] . "&nbsp;</td>
							<td>&nbsp;" . $row['Supervisor_Name'] . "&nbsp;</td>
							<td>&nbsp;&nbsp;<a href=\"view_record.php?id=" . $row['Student_ID'] . "\">View Records&nbsp;</td>
							<td>&nbsp;&nbsp;<a href=\"student_form.php?id=" . $row['Student_ID'] . "\">Add New Record</a>&nbsp;</td>
						</tr>";
				}
			echo "</tbody>
			</table>";
	

	//The green dot lines to separate the container
	echo "<h2 class='separation full'></h2>
		</div>";
		
	mysql_close($con);
?>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="../js/supScreenJavaScript.js"></script>

</body>
</html>