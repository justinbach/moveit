<? 
/*	Filename:	index.php

		Purpose:	Main page for level editor - move it!

		Author:		Justin Bachorik

		Date:			3/22/09
*/

// function to display all the level rows
function get_level_rows() {

	require_once('../config/db.php');
	db_connect();
	$query = 'SELECT * FROM levels ORDER BY `order` ASC';	
	$result = mysql_query($query);
	while($level = mysql_fetch_assoc($result)) {
		$curlevel = $level['id'];
		echo "<tr>";
		echo "<td>".$level['name']."</td>";
		echo "<td>".$level['creator']."</td>";
		echo "<td>".$level['modified']."</td>";
		//echo "<td>".$level['active']."</td>";
		$selected = $level['active'] == false ? 'selected' : '';
		echo "<td><select name='".$curlevel."_active'>";
		echo "<option value='1'>true</option>";
		echo "<option value='0' $selected>false</option>";
		echo "</select></td>";
		echo "<td><input name='".$curlevel."_order' type='text' size='3' value='".$level['order']."'/></td>";
		echo "<td><a href='edit.php?id=$curlevel'>Edit</a></td>";
		echo "<td><a onclick=\"return confirm('Are you sure you want to delete ".$level['name']."?');\" href='delete.php?id=$curlevel'>Delete</a></td>";
	}
}

// check whether this form has self-submitted; if so, include the right script
if(isset($_POST['submitted']) && $_POST['submitted'] == true) 
	include('levels_updater.php');


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
			<?php if(isset($_POST['submitted']) && $_POST['submitted'] == true) {?><h2>Levels Updated.</h2><?php } ?>
			<div id='innercontent'>
				<div id='newlink'><a href='../index.php'>Play Move It!</a></div>
				<div id='newlink'><a href='new.php'>Create a new level</a></div>
				<form action='index.php' method='post'>
					<table>
						<tr>
							<th>Level Name</th>
							<th>Creator</th>
							<th>Modified</th>
							<th>Active?</th>
							<th>Order</th>
							<th>Edit</th>	
							<th>Delete</th>
						</tr>
						<? get_level_rows(); ?>
					</table>
					<input type='hidden' name='submitted' value='true' />
					<input id='submitbtn' type='submit' value='  update  ' />
				</form>
			</div>
		</div>
	</body>
</html>


