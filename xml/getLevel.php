<?php

/*
	Filename:	getLevel.php

	Purpose:	Used to obtain an xml file representing a particular level for MoveIt

	Author:		Justin Bachorik

	Date:			3/21/09
*/

require_once('../config/db.php');

db_connect();
echo("<?xml version='1.0' ?>\n");
echo("<level>\n");
$query = sprintf("SELECT * FROM levels WHERE id = %s",
									mysql_real_escape_string($_GET['id']));
$result = mysql_query($query);
$meta = mysql_fetch_assoc($result);
	echo("\t<el type='title' name='".$meta['name']. "' />\n");
	echo("\t<el type='creator' name='".$meta['creator']. "' />\n");
	echo("\t<el type='initial_strength' num='".$meta['initial_strength']. "' />\n");

$query = sprintf("SELECT * FROM walls WHERE level_id = %s",
									mysql_real_escape_string($_GET['id']));
$result = mysql_query($query);

while($wall = mysql_fetch_assoc($result)) {
	echo("\t<el type='wall' xPos='".$wall['xPos']."' yPos='".$wall['yPos']. "' />\n");
}

$query = sprintf("SELECT * FROM powerups WHERE level_id = %s",
									mysql_real_escape_string($_GET['id']));
$result = mysql_query($query);

while($powerups = mysql_fetch_assoc($result)) {
	echo("\t<el type='powerup' xPos='".$powerups['xPos']."' yPos='".$powerups['yPos']. "' strength='".$powerups['strength']."' />\n");
}

$query = sprintf("SELECT * FROM goals WHERE level_id = %s",
									mysql_real_escape_string($_GET['id']));
$result = mysql_query($query);
$goal = mysql_fetch_assoc($result);
echo("\t<el type='goal' xPos='".$goal['xPos']."' yPos='".$goal['yPos']. "' />\n");

$query = sprintf("SELECT * FROM heroes WHERE level_id = %s",
									mysql_real_escape_string($_GET['id']));
$result = mysql_query($query);
$hero = mysql_fetch_assoc($result);
echo("\t<el type='hero' xPos='".$hero['xPos']."' yPos='".$hero['yPos']. "' />\n");


echo('</level>');

?>
