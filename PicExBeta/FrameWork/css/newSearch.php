<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "picexdb";

$us=$_SESSION['user'];
$pass=$_SESSION['pass'];
$name;
$gender;
$age;
$email;
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
	<script type="text/javascript" src="jquery.js"></script>
	
	<style type="text/css">

	.outer{
		position:relative;
		width:90%;
		height:100%;
		margin-left: 5%;
		overflow:hidden;
	}
	.overlay{
		width:90%;
		position:absolute;
		height:98%;
		background: red;
		opacity:0.3;
		margin-left: 5%;
		top: 100%;
		transition: top 0.5s;
	}
	.like_btn{
		background: #eee;
		margin-top: 30%;
		padding: 10px 50px;
		color:#222;
		display:inline-block;
		font-weight:bold;
	}
	.outer:hover .overlay{
		top: 0%;
		transition: top 1s;
	}

	</style>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
    function searchq()
    {
	var searchTxt = $("input[name='searchBox']").val();
	
	$.post("searchPage.php",{searchVal: searchTxt}, function(output)
	{
		$("#output").html(output);
		});
    }


    </script>	

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
                    margin-top: -1px;" alt="<?php echo $_SESSION['user'][0]?>"></button>
                <ul class="dropdown-menu">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="Logout.php">logout</a></li>
                </ul>
                </div>
			</div>
			<?php echo $_SESSION['user']?>
			<form action="newSearch.php" method="post">
                <input type="text" placeholder="Search..." required style="color:black" onKeyDown="searchq();">
                <input type="button" value="Search">
            </form>
		</div>		
		</div>

		
		<div id="output">

		
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
				<div class="row text-center"><small>&copy Shauqi-2016</small></div>
			</div>
			<div class="col-4"></div>
		</div>

	</div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
</body>
</html>