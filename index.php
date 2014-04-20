<?php
/*
	Filename:	index.php
	
	Purpose:	Main page for Move It!

	Author:		Justin Bachorik

	Date:			3/22/09

*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Move It!</title>
		<link rel='stylesheet' href='style.css' />
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js'></script>
	<script type="text/javascript">
			swfobject.embedSWF("MoveItMultiLevel.swf", "flashcontent", "550", "400", "9.0.0");
			</script>

	</head>
	<body>
		<div id='wrapper'>
			<h1>Move It!</h1>
			<div id='flashwrapper'>
				<div id='flashcontent'>
				</div>	
			</div>
			<div id='footer'>
			&copy; <?php echo date('Y');?> Justin Bachorik
			</div>
		</div>
	</body>
</html>


