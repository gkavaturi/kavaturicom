<?php
session_start();
error_reporting(E_ALL | E_STRICT);
echo "Session is ".$_SESSION['test'];
?>