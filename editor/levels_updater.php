<?php

/*	
	Filename:	levels_updater.php

	Purpose:	Processes variables in $_POST; included when main editor page self-submits

	Author:		Justin Bachorik

	Date:			3/22/09
*/

require_once('../config/db.php');
db_connect();

foreach($_POST as $k=>$v) {

	// fields have name scheme levelid_attribute
	$keyArr = explode('_',$k);
	$level = $keyArr[0];
	$attr = $keyArr[1];	
	if($level == 'submitted') break;	// check for last field, which doesn't belong in db
	
	// update the db
	$query = "UPDATE levels SET `$attr` = $v WHERE id = $level";
	mysql_query($query);
}
