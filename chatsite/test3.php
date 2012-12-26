<?php 
echo "Hello world";
$link = mysql_connect('kavaturicom.fatcowmysql.com', 'kavaturi', 'Ambition0338'); 
mysql_select_db("kavaturi_db") or die(mysql_error());
?>