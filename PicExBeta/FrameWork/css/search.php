<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbName = "picexdb";
   
   $conn = mysql_connect("localhost", "root", "");
   mysql_select_db($dbName, $conn);
   
   $output='';
   
   if(isset($_POST['searchVal']))
   {
	   $searchq=$_POST['searchVal'];
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
   echo $output;
?>
