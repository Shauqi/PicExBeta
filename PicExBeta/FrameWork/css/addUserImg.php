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

    $us=$_SESSION['user'];
    $pass=$_SESSION['pass'];
    $id=$_SESSION['id'];
    $image_link="";
    $image_comment=$_POST['comments'];
    if($_FILES['image_file']['error']>0)
    {
	   echo "error";
    }
    else
    {
	   $prefix = $_SESSION['username'].time();
	   $link = "upload2/" .$prefix . $_FILES["image_file"]["name"];
	   move_uploaded_file($_FILES["image_file"]["tmp_name"], $link);
	   $image_link = "http://localhost/PicExBeta/FrameWork/css/upload2/". $prefix . $_FILES["image_file"]["name"];
    }


    $sql = "INSERT INTO clientImage (img_id,img_link,comment)
    VALUES ('$id', '$image_link', '$image_comment')";

    mysql_query($sql);
    header('Location:PicExBeta.php');

    $conn->close();
?>