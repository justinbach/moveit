<?php

// CONSTANTS FILE FOR DB CONNECTION


function db_connect() {
	$db_server = 'nope';
	$db_name = 'nope';
	$db_user = 'nope';
	$db_pass = 'nope';
	mysql_connect($db_server,$db_user,$db_pass);
	mysql_select_db($db_name);
}

function db_disconnect() {
	mysql_close();
}




?>
