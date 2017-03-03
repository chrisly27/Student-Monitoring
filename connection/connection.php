<?php
$con = mysql_connect("server","username","password");
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }
mysql_select_db("username", $con);
?>
