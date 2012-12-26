<?php 
session_start();


if (isset ($_FILES["file"]))
{

	if ((($_FILES["file"]["type"] == "text/plain"))
	&& ($_FILES["file"]["size"] < 20000))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
		$console="console.log('Return Code: " . $_FILES["file"]["error"] . "');\n"; 
		}
	  else
		{
		$_SESSION['file_name']=$_FILES['file']['name'];
		//echo " Upload: " . $_FILES["file"]["name"] . "<br />";
		/*
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
		*/
		if (file_exists("upload/" . $_FILES["file"]["name"]))
		  {
		// echo $_FILES["file"]["name"] . " already exists. ";
		  }
		else
		  {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "upload/" . $_FILES["file"]["name"]);
		// echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		  }
		}
		header('Location: wordpop?file='.$_FILES["file"]["name"]);
	  }
	else
	  {
	  $console.="alert('Invalid file format Please choose Text file');";
	  }
}
  

$js="function load_file(){";
			if (isset ($_GET["file"]))
			{
$js.="var file_name='upload/".$_GET["file"]."';";
			}else{
$js.="var file_name='alice_in_wonderland.txt';";
			}
$js.="return file_name;}if(load_file()!='undef'){jQuery(document).ready(function (){jQuery.get(load_file(),function(data){jQuery('#text-body').text(data);});});}";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>JavaScript Text Search</title>
<link rel="icon" href="/img/ninja.gif" sizes="16x16" />
<link rel="stylesheet" type="text/css" href="/reset.css" />
<link rel="stylesheet" type="text/css" href="wordpop.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
</head>
<body>
<?php
echo "<script type='text/javascript'>".$console."\n".$js."</script>\n";
?>
<div class='full-body'>
<div class='heading'>
<span> Word pop with Numbers</span>
</div>
<pre id='text-body' class='text-class'></pre>
<div id ='upload' class='upload'>
<form id='uform' action='<? $_SERVER["PHP_SELF"] ?>' method='post'
enctype='multipart/form-data' style='display:none' >
<input type='file' name='file' id='file' value='Upload your file'/>
<input type='submit' value='submit'/>
</form>
<span id='ubutton' class='ubute bute'>Upload Your File</span>
</div>
<div id='match-list' class='list-class'>
<input type='text' placeholder='Enter number [2-9]' id='input_txt' />
<span id='input_number' class='sbute bute'>Enter</span>
<div class='match'>
<span class='list-heading'>Popular Prefix Matches</span>
<table id='result-list' class='result-class'>
<tr><td>No Results</td></tr>  
</table>
</div>
<div class='match'>
<span class='list-heading'>Popular Exact Matches</span>
<table id='result-list-2' class='result-class'>    
<tr><td>No Results</td></tr> 
</table>
</div>
</div>
</div>
<script type='text/javascript' src='wordpop.js'></script>
<script type='text/javascript'>jQuery('#file').change(function(){if ($(this).val()){jQuery('#uform').submit();}});jQuery('#ubutton').click(function(){jQuery('#file').click();
});

</script>
</body>
</html>
