<?php

/* 
	Filename:	new.php
	
	Purpose:	new level creator for move it

	Author:		Justin Bachorik

	Date:			3/22/09
*/

// check to see if we've self-submitted
if(isset($_POST['submitted']) && $_POST['submitted'] == 'true') {

	// create the entry in the levels table
	require_once('../config/db.php');
	db_connect();

	// figure out what the order value will be
	$result = mysql_query('SELECT MAX(`order`) AS highest FROM levels');
	$arr = mysql_fetch_assoc($result);
	$neworder = $arr['highest']+1;



	$levelname = mysql_real_escape_string($_POST['name']);
	$creator = mysql_real_escape_string($_POST['creator']);
	$initial_strength = mysql_real_escape_string($_POST['initial_strength']);


	// make the call
	$query = "INSERT INTO levels(name, creator, initial_strength, active, `order`) VALUES('$levelname', '$creator', $initial_strength, 0, $neworder)";
	mysql_query($query);

	header('Location:edit.php?id='.mysql_insert_id());

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Move It Level Editor</title>
		<link rel='stylesheet' href='style.css' />
	</head>
	<body>
		<div id='wrapper'>
			<h1>Move It! Level Editor</h1>  
			<h3>Create a new level</h3>
			<div id='newform'>
				<form action='new.php' method='POST'>
					<label for='name'>Level Name</label>
					<input type='text' name='name' size='20' />
					<br/>
					<label for='creator'>Creator Name</label>
					<input type='text' name='creator' size='20' />
					<label for='initial_strength'>Initial Strength</label>
					<select name='initial_strength' />
						<?php for($i = 10; $i > 0; $i--) echo "<option>$i</option>";?>
					</select>
					<input type='hidden' name='submitted' value='true' /> 
					<input type='submit' value='  create  ' />
				</form>
			</div>
			<a href="index.php">Back to level index</a>
		</div>
	</body>
</html>


