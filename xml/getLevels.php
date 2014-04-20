<?

// file to get an xml array of all active levels in Move It!

require_once('../config/db.php');

db_connect();
echo("<?xml version='1.0' ?>\n");
echo("<levels>\n");
$query = "SELECT * FROM levels WHERE active=1 ORDER BY `order`";

$result = mysql_query($query); 

while($level = mysql_fetch_assoc($result)) {
	echo("\t<level id='".$level['id']."' />\n");
}

echo("</levels>");

?>
