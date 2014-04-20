<?php

/*
	Filename:	delete.php

	Purpose:	Handles level deletion

	Author:		Justin Bachorik

	Date:			3/21/09
*/

if(!isset($_GET['id']))			// we expect an id to be passed in
	header('location:index.php');

require_once('../config/db.php');

db_connect();

$id = mysql_real_escape_string($_GET['id']);

mysql_query("DELETE FROM levels WHERE id=$id");

header('location:index.php');

?>


