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
    $pass=$_SESSION['pass'];
	$id=$_SESSION['id'];
}
else if(isset($_COOKIE['user']))
{
	$us=$_COOKIE['user'];
    $pass=$_COOKIE['pass'];
	$id=$_COOKIE['id'];
}
$imageL;
// Create connection
$conn = mysql_connect("localhost", "root", "");
mysql_select_db($dbName, $conn);

$sql = "SELECT * from picexclient where username='". $us ."'" ;
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    if($row["password"]==$pass)
    {
    	$imageL=$row["image_link"];
    	break;
    }
}

?>

<!doctype html>
<html>
<head>
	<title>Pic Ex Beta</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
	<div class="container-fluid">
		<div class="first">
		<div class="col-4 text-center">
			<div class="fifth">
				<h1><big>Pic Ex<sup><i>&#946</i></sup></big></h1>
			</div>
		</div>
		
		<div class="col-8">
			<div class="fifth">
			<ul class="nav nav-pills" style="background:red;">
            <li role="presentation"><a href="PicExBeta.php" style="color:white;">Home</a></li>
            <li role="presentation"><a href="topGallery.php" style="color:white;">Top Galleries</a></li>
            <li role="presentation"><a href="topPhotographer.php" style="color:white">Top 10 Photographer</a></li>
            <li role="presentation"><a href="yourPic.php" style="color:white">Your Pics</a></li>
            <li role="presentation"><a href="Masterpiece.php" style="color:white">Upload Your Masterpiece</a></li>
            </ul>
			</div>
		</div>

		<div class="col-4 text-center">
			<div class="fifth">
			    <!-- Single button -->
                <div class="btn-group">
                <button data-toggle="dropdown" style="width:64px;height:64px;background:#2c3e50;border:0px solid #000;border-radius:50px;color:#fff;"><img src="<?php echo $imageL ?>" style="width:64px;height:64px;background:#2c3e50;border:0px solid #000;border-radius:50px;color:#fff;margin-left:-6px;
                    margin-top: -1px;"></button>
                <ul class="dropdown-menu">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="Logout.php">logout</a></li>
                </ul>
                </div>
			</div>
			<?php echo $_SESSION['user']?>
			<form>
                <input type="text" placeholder="Search..." required style="color:black">
                <input type="button" value="Search">
            </form>
		</div>		
		</div>

		<div class="row text-center" style="margin-top:20px" >
			<?php
			    $sql = "SELECT * from clientimage" ;
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result))
                {
                	if($row["img_id"]==$id)
                	{
                		$imageL=$row["img_link"];
			?>
			<img src="<?php echo $imageL ?>" height="90%" width="90%" style="margin-bottom:20px"/></br>
			<?php
		            }
		        }
			?>
		</div>

		<div class="third">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="row text-center">
				<h2>Follow Me@</h2>
				</div>
				<div class="fourth">
					<a href="https://www.facebook.com/SymbioShauqi"><img src="3.png" width="10%" height="10%"></a>
					<a href="https://twitter.com/HasanShauqi"><img src="2.png" width="15%" height="15%"></a>
					<a href="https://bd.linkedin.com/in/mahmudul-hasan-shauqi-7a5b3b103"><img src="4.png" width="15%" height="15%"></a>
					<a href="https://www.pinterest.com/hasan5500/"><img src="5.png" width="15%" height="15%"></a>
					<a href="https://github.com/Shauqi"><img src="6.png" width="15%" height="15%"></a>
				</div>
				<div class="row text-center"><small>&copy Shauqi-2015</small></div>
			</div>
			<div class="col-4"></div>
		</div>

	</div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
</body>
</html>
