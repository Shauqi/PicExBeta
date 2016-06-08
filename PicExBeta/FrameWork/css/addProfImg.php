<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "picexdb";

    $us=$_POST['UserName'];
    $pass=$_POST['PassWord'];

    // Create connection
    $conn = mysql_connect("localhost", "root", "");
    mysql_select_db($dbName, $conn);
	
	if(isset($_SESSION['user']))
    {
		$us=$_SESSION['user'];
        $pass=$_SESSION['pass'];
	}
	else if(isset($_COOKIE['user']))
	{
		$us=$_COOKIE['user'];
        $pass=$_COOKIE['pass'];	
	}
    $image_link="";

if($_FILES['image_file']['error']>0)
{
	echo "error";
}
else
{
	$prefix = $_SESSION['username'].time();
	$link = "upload/" .$prefix . $_FILES["image_file"]["name"];
	move_uploaded_file($_FILES["image_file"]["tmp_name"], $link);
	$image_link = "http://localhost/PicExBeta/FrameWork/css/upload/". $prefix . $_FILES["image_file"]["name"];
}


mysql_query("UPDATE picexclient SET image_link='". $image_link ."' WHERE username='". $us ."'");

header('Location:profile.php');

$conn->close();
?>