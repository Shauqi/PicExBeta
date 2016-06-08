<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbName = "picexdb";
   
   $conn = mysql_connect("localhost", "root", "");
   mysql_select_db($dbName, $conn);
   
   $output='';
   
   if(isset($_POST['Search']))
   {
	   $searchq=$_POST['Search'];
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
			   $fname = $row['firstname'];
			   $lname = $row['lastname'];
			   $id = $row['id'];
			   
			   $output .= '<div> '.$fname.' '.$lname.'</div>';
		   }
	   }
   }
?>
<!DOCTYPE html>
<html>

<head>
<title>Search</title>	
</head>

<body>
	<form action="prac1.php" method="post">
	  <input type="text" name="Search" placeholder="Search for members..."/>
	  <input type="submit" value=">>" />
	</form>
    
    <?php print("$output");?>
</body>

</html>