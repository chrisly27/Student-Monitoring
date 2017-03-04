<?php
$con = mysql_connect("fas-dbms.sunderland.ac.uk","bg70ng","Domingos");
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }
mysql_select_db("bg70ng", $con);
?>