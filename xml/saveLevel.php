<?php
/*	
	Filename:	saveLevel.php

	Purpose:	hit by flash, saves level data
*/

$id = $_POST['levelID'];


// first delete everything from walls, heros, goals, and powerups with this level ID, because we'll be replacing them all
require_once('../config/db.php');
db_connect();


$query = 'DELETE FROM walls WHERE level_id = '.$id; 
mysql_query($query);
$query = 'DELETE FROM goals WHERE level_id = '.$id; 
mysql_query($query);
$query = 'DELETE FROM powerups WHERE level_id = '.$id; 
mysql_query($query);
$query = 'DELETE FROM heroes WHERE level_id = '.$id; 
mysql_query($query);

// now insert the new ones
$xml = simplexml_load_string(preg_replace('/\\\\/','',$_POST['levelXml']));

foreach($xml->el as $el) {
	if($el['type'] == 'wall') {
		$query = 'INSERT INTO walls(level_id, xPos, yPos) VALUES("'.$id.'","'.$el['xPos'].'","'.$el['yPos'].'")';
		mysql_query($query);
	} elseif($el['type'] == 'goal') { 
		$query = 'INSERT INTO goals(level_id, xPos, yPos) VALUES("'.$id.'","'.$el['xPos'].'","'.$el['yPos'].'")';
		mysql_query($query);
	} elseif($el['type'] == 'hero') { 
		$query = 'INSERT INTO heroes(level_id, xPos, yPos) VALUES("'.$id.'","'.$el['xPos'].'","'.$el['yPos'].'")';
		mysql_query($query);
	} elseif($el['type'] == 'powerup') { 
		$query = 'INSERT INTO powerups(level_id, xPos, yPos, strength) VALUES("'.$id.'","'.$el['xPos'].'","'.$el['yPos'].'","'.$el['strength'].'")';
		mysql_query($query);
	}
}



// for flash
echo "result=success";

?>
