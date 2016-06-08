<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "picexdb";

$us=$_SESSION['user'];

$pass=$_SESSION['pass'];

if(isset($_SESSION['user']))
{
	$us=$_SESSION['user'];
	$user_id=$_SESSION['id'];
    $pass=$_SESSION['pass'];
}
else if(isset($_COOKIE['user']))
{
	$us=$_COOKIE['user'];
    $pass=$_COOKIE['pass'];
	$user_id=$_COOKIE['id'];
}

$name;
$gender;
$age;
$email;
$imageL;
// Create connection
$conn = mysql_connect("localhost", "root", "");
mysql_select_db($dbName, $conn);


$image_id = $_GET['id'];
$sql = "select * from like_info where user_id=" . $user_id . " and img_id=" . $image_id;
$res = mysql_query($sql);
if(mysql_num_rows($res) > 0){
	$response = array(
			'status'	=>	'error',
			'msg'		=>	'User alredy liked this'
		);
	echo json_encode($response);
}else{
	$sql = "insert into like_info (user_id,img_id) values (". $user_id .",". $image_id .")";
	mysql_query($sql);
	$response = array(
			'status'	=>	'success',
			'msg'		=>	''
		);

	$sql = "select * from clientimage where time=" . $image_id;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$like =  $row['like1'];
	}
	$like += 1;

	mysql_query("UPDATE  `picexdb`.`clientimage` SET  `like1` =  '". $like ."' WHERE  `clientimage`.`time` =". $image_id .";");

	$sql = "select * from clientimage where time=" . $image_id;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$img_id =  $row['img_id'];
		break;
	}

	$sql = "select * from picexclient where id=" . $img_id;
	
	$res = mysql_query($sql);
	
	while($row = mysql_fetch_array($res)){
		$rank =  $row['rank'];
	}

	$rank += 1;
	mysql_query("UPDATE  `picexdb`.`picexclient` SET  `rank` =  '". $rank ."' WHERE  `picexclient`.`id` =". $img_id .";");
	echo json_encode($response);
}

