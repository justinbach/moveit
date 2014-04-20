<?php

// CONSTANTS FILE FOR DB CONNECTION


function db_connect() {
	$db_server = 'localhost';
	$db_name = 'moveit';
	$db_user = 'moveitmgt';
	$db_pass = 'm0v317!';
	mysql_connect($db_server,$db_user,$db_pass);
	mysql_select_db($db_name);
}

function db_disconnect() {
	mysql_close();
}




?>
