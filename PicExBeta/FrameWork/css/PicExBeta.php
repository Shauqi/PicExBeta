<?php
session_start();
if(isset($_POST['searchBox']))
{
	    header('Location:searchPage.php');
}
else if(isset($_SESSION['user']))
{
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbName = "picexdb";

   $us=$_SESSION['user'];
   $pass=$_SESSION['pass'];
   $id=$_SESSION['id'];
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
}
else if(isset($_COOKIE['user']))
{	
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbName = "picexdb";
   $us=$_COOKIE['user'];
   $pass=$_COOKIE['pass'];
   $id=$_COOKIE['id'];
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
}
else
{
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "picexdb";

    $us=$_POST['UserName'];
    $pass=$_POST['PassWord'];
    $imageL;

    // Create connection
    $conn = mysql_connect("localhost", "root", "");
    mysql_select_db($dbName, $conn);

    $sql = "SELECT * from picexclient where username='". $us ."'" ;
    $result = mysql_query($sql);
    $val1=0;
    while ($row = mysql_fetch_array($result)) 
    {
        if($row["password"]==$pass)
        {
    	    $val1=1;
	        $imageL=$row["image_link"];
	        if(isset($_POST['remember']))
	        {
	        	setcookie("user",$us, time()+(30));
				setcookie("pass",$pass,time()+(30));
				setcookie("id",$row["id"],time()+(30));
				setcookie("pic",$row["image_link"],time()+(30));
	        }
			else
			{
				$_SESSION['user'] = $_POST['UserName'];
	            $_SESSION['pass'] = $_POST['PassWord'];
	            $_SESSION['id'] = $row["id"];
			    $_SESSION['pic']=$row["image_link"];	
			}
	        break;
        }
    }

    if(!$val1)
    {	
	    header('Location:Login.php?login_error=yes');
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
			<?php echo $us?>
			<form action="searchPage.php" method="post">
                <input type="text" name="searchBox" placeholder="Search..." required style="color:black">
                <input type="button" value="Search">
            </form>
		</div>		
		</div>

		<div class="row text-center" style="margin-top:20px;" >
			<?php
			    $sql = "SELECT * from clientimage ORDER BY time DESC" ;
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result))
                {
                		$imageL=$row["img_link"];
                		$user_id=$row["img_id"];
                		$img_id=$row["time"];
                		$img_comment=$row["comment"];
			?>
			<div class="row"><h1><?php echo $img_comment;?></h1></div>
			<div class="outer">
				<img id="<?php echo $row["time"]; ?>" src="<?php echo $imageL ?>" height="90%" width="90%" style="margin-bottom:20px"/>
				
				<div class="overlay">
					<a href="#" class="like_btn" id="<?php echo $row['time'] ?>" >Like</a>
				</div>
			</div>
            
            <?php
			$sql2 = "SELECT * from picexcomment where cmmntid='". $img_id ."' ORDER BY cmmnttime" ;
			$result2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($result2))
			{
				$com=$row2["comm"];
				$pic1=$row2["pic"];
				$name=$row2["name"];
			?>
            <div class="row" style="display:flex; margin-left:75px; margin-top:20px">
            <div class="row" style="margin-right:10px; margin-left:55px"><img src="<?php echo $pic1?>" height="50px" width="50px"/></div>
            <div class="row" style="margin-left:0px"><h4 style="margin-top:0px; margin-bottom:0px"><?php echo $name?></h4><br>
            <p><?php echo $com?></p><br></div>
            </div>
            <?php } ?>
            
            <div class="row text-center">
            <form action="cmmnt.php" method="post">
            <input type="text" name="comm" placeholder="Comment here"/>
            <input type="hidden" name="cmmnt_id" value="<?php echo $row['time'] ?>"/>
            <input type="submit" value="Enter"/>
            </form>
            </div>
			</br>
			<?php
		        }
			?>
		</div>


<script type="text/javascript">


	$(".like_btn").click(function(e){
		e.preventDefault();

		var obj = $(this);

		var id = $(this).attr('id');
		$.get("http://localhost/PicExBeta/FrameWork/css/like.php?id=" + id, function(res){
			var response = JSON.parse(res);
			if(response['status'] == 'error'){
				alert(response['msg']);
			}
			obj.text("Liked");
		});

	});


</script>



		<div class="row">
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
				<div class="row text-center"><small>&copy Shauqi-2016</small></div>
			</div>
			<div class="col-4"></div>
		</div>

	</div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
</body>
</html>