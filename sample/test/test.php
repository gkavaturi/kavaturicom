<?php
session_start();

$_SESSION["test"]=$_SESSION["test"]+1;
echo "Session is ".$_SESSION['test'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
</head>
<body>
<a href='test2.php'>Go to test 2</a>
</body>
</html>
