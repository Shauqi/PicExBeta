<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbName = "picexdb";
   
   $conn = mysql_connect("localhost", "root", "");
   mysql_select_db($dbName, $conn);
   
   $output='';
   
   if(isset($_POST['search']))
   {
	   $searchq=$_POST['search'];
	   $searchq=preg_replace("#[^0-9a-z]#i","",$searchq);
	   
	   $query = mysql_query("SELECT * FROM picexclient WHERE username LIKE '%$searchq%'") or die("could not search");
	   $count = mysql_num_rows($query);
	   if($count==0)
	   {
		   $output='There was no search results!';
	   }
	   else
	   {
		   while($row=mysql_fetch_array($query))
		   {
			   $uname = $row['username'];
			   
			   
			   $output .= '<div> '.$uname.'</div>';
		   }
	   }
   }
?>
<!DOCTYPE html>
<html>

<head>
<title>Search</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
function searchq()
{
	var searchTxt = $("input[name='search']").val();
	
	$.post("search.php",{searchVal: searchTxt}, function(output)
	{
		$("#output").html(output);
		});
}


</script>	
</head>

<body>
	<form action="prac2.php" method="post">
	  <input type="text" name="search" placeholder="Search for members..." onKeyDown="searchq();"/>
	  <input type="submit" value=">>" />
	</form>
    
    <div id="output">
    
    </div>
</body>

</html>