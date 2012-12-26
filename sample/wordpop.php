
<!DOCTYPE HTML>
<html>
<head>
<title>JavaScript Text Search</title>
<link rel="icon" href="/img/ninja.gif" type="img/ninja.gif" sizes="16x16" />
<link rel="stylesheet" type="text/css" href="wordpop.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
<script type='text/javascript'>
$(document).ready(
function load_file(){
    $("#text-body").load("alice_in_wonderland.txt",function(){});
});

function upload_file(){
	$("#file").click();
	console.log('upload file clicked');
	}
</script>
</head>
<?php
if (isset ($_FILES["file"]))
{
	echo $_FILES["file"]["type"];
	
	if ((($_FILES["file"]["type"] == "text/plain"))
	&& ($_FILES["file"]["size"] < 20000))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	  else
		{
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	
		if (file_exists("upload/" . $_FILES["file"]["name"]))
		  {
		  echo $_FILES["file"]["name"] . " already exists. ";
		  }
		else
		  {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "upload/" . $_FILES["file"]["name"]);
		  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		  }
		}
		
		echo "<script type='text/javascript'>
			alert('".$_FILES["file"]["name"]."');
			var file_name='upload/".$_FILES["file"]["name"]."';
			alert(file_name);
			</script>";
	  }
	else
	  {
	  echo "Invalid file";
	  }
}
?>
<body>
<div class='full-body'>
<div class='heading'>
<span class='main-heading'>String Search through Numeric Keypad</span>
<span class='sub-heading'></span>
</div>
<pre id='text-body' class='text-class'></pre>
<div class='upload'>
<input type='file' name='file' id='file' value='Upload your file'/>
<div class='bute newbute' onclick='upload_file();'>Upload Text File</div>
</div>
<div id='match-list' class='list-class'>
<input type="text" placeholder="Enter number [2-9]" id="input_txt" />
<span id="input_number" class='button-class'>Enter</span>
<div class='match'>
<span class='list-heading'>Popular Prefix Matches</span>
<table id="result-list" class='result-class'>
<tr><td>No Results</td></tr>  
</table>
</div>
<div class='match'>
<span class='list-heading'>Popular Exact Matches</span>
<table id="result-list-2" class='result-class'>    
<tr><td>No Results</td></tr> 
</table>
</div>

</div>
</div>

<script type="text/javascript" src="wordpop.js"></script>

</body>
</html>
