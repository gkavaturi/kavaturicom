<?php
session_start();
if (isset($_SESSION["test"])){
$_SESSION["test"]=$_SESSION["test"]++;
}else{
	$_SESSION["test"];
	}
echo "Session is ".$_SESSION['test'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='refresh' content="0; url=wordpop.php" />
<title>Untitled Document</title>
</head>
<body>
</body>
</html>
