 <?php 
 $name=$_POST["name"] ;
 $pass=$_POST["pass"];
 if ($name && $pass){
$link = mysql_connect('kavaturicom.fatcowmysql.com', 'kavaturi', 'Ambition0338'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db(kavaturi_db);
$result=mysql_query("SELECT * FROM users WHERE name='".$name."' AND password='".$pass."'");

if (mysql_num_rows($result)){
	echo "<meta http-equiv='refresh' content='0;url=common_room.php'>";
	} 
else{
	print "Not authenticated\n";
	print '<script type="text/javascript">
	function invalid(){
	  $("#err").text("Invalid ID/Password").show();
	}
	$(document).ready(function(){invalid();});
	</script>';
	}
 }
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="test.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
function create_user(){
	//alert('create new user called');
	}
</script>
<title>Login Page</title>

</head>
<body >
<div class='newuser bute newbute' onclick='create_user();'>Register New User</div>
<div class='container'>
<form id='login' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
<span class='cell left text'>Name:</span><span class='cell right'><input type='text' id ='name' name='name' placeholder='Enter name or id'/></span><br/>
<span class='cell left text'>Password:</span><span class='cell right'><input type='password' id='pass' name='pass' /></span>
</form>
<div id='sub'><span class='submit bute'>Submit</span></div>
<span id='err'></span>

</div>

<script type='text/javascript'>
function display(){
	//alert($("#name").val()+" "+$("#pass").val());
	   if ($("#name").val() && $("#pass").val()) {
        $("#err").text("Checking...").show();
		
        return true;
      }
      $("#err").text("Please enter ID/Password").show().fadeOut(1500);
      return false;
	}

	$("#sub").click(function(){
 $("#login").submit()});
$("#login").submit(function() {
   display();
    });

</script> 
</body>
</html>