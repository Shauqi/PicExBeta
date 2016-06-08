<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "picexdb";
$cmmnt = $_POST['comm'];
$cmmntid = $_POST['cmmnt_id'];

$conn = mysql_connect("localhost", "root", "");
mysql_select_db($dbName, $conn);

$us=$_SESSION['user'];
$pass=$_SESSION['pass'];
if(isset($_SESSION['user']))
{
	$us=$_SESSION['user'];
    $pass=$_SESSION['pass'];
	$pic=$_SESSION['pic'];
}
else if(isset($_COOKIE['user']))
{
	$us=$_COOKIE['user'];
    $pass=$_COOKIE['pass'];
	$pic=$_COOKIE['pic'];
}
$imageL='';
$sql = "SELECT * from picexclient where username='". $us ."'" ;
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    if($row["password"]==$pass)
    {
        $imageL=$row["image_link"];
        break;
    }
}

$sql = "INSERT INTO picexcomment (cmmntid,comm,pic,name)
VALUES ('$cmmntid', '$cmmnt', '$imageL', '$us')";
mysql_query($sql);
header('Location:PicExBeta.php');
?>