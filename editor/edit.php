<?php

/* 
	Filename:	edit.php
	
	Purpose:	Level editor for Move It!

	Author:		Justin Bachorik

	Date:			3/22/09
*/

// get the level infos
require_once('../config/db.php');
db_connect();

$id = mysql_real_escape_string($_GET['id']);
$query = 'SELECT * FROM levels WHERE id = "'.$id.'"';
$result = mysql_query($query);
if(mysql_num_rows($result) == 0)
	header('location: index.php');

$leveldata = mysql_fetch_assoc($result);
$name = $leveldata['name'];
$creator = $leveldata['creator'];
$modified = $leveldata['modified'];
$initial_strength = $leveldata['initial_strength'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Move It Level Editor</title>
		<link rel='stylesheet' href='style.css' />
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js'></script>
	<script type="text/javascript">
			swfobject.embedSWF("../LevelEditor.swf?id=<?php echo $id;?>", "flashcontent", "550", "400", "9.0.0");
			</script>

	</head>
	<body>
		<div id='wrapper'>
			<h1>Move It! Level Editor</h1>
			<h3>Editing "<?php echo $name; ?>"</h3>
			<h4>Initial Moves:	<?php echo $initial_strength; ?></h3>
			<h4>Creator:	<?php echo $creator; ?></h3>
			<h4>Last modified: <?php echo $modified; ?></h4>
			<h4><a href='test.php?id=<?php echo $id;?>'>Test Level (Remember To Save First!)</a></h4>
			<div id='flashwrapper'>
				<div id='flashcontent'>
				</div>	
			</div>
			<a href="index.php">Back to level index</a>
		</div>
	</body>
</html>


