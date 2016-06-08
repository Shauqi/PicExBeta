<?php
session_start();
if(isset($_SESSION['user']))
{
   header('Location: PicExBeta.php');
}
else if(isset($_COOKIE['user']))
{
	header('Location: PicExBeta.php');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "picexdb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$conn->close();
?>

<!doctype html>
<html>

<head>
   <title>Pic Ex Beta</title>
   <link rel="stylesheet" type="text/css" href="bootstrap.css">
   <link rel="stylesheet" type="text/css" href="style.css">   
</head>

<body>

    <?php
    if(isset($_GET['login_error'])&&$_GET['login_error']=='yes')
    {
    ?>
    <p style="color:red">Login error</p>
    <?php }?>

    <div class="Container-fluid">
      
      <div class="first">
          
          <div class="col-6" style="margin-left:2%;">
             <h1><big>Pic Ex<sup><i>&#946</i></sup></big></h1>
          </div>   

          <div class="col-6" style="margin-top:2%;">
             <form action="PicExBeta.php" method="post">
                UserName: <input type="text" name="UserName" style="color:black;">
                Password: <input type="password" name="PassWord" style="color:black;">
                <input type="Submit" name="Login" style="background-color:#ddd; color:black;"><br>
                <input type="checkbox" name="remember"> Remember Me
             </form>  
          </div>

      </div>

      <div class="row" style="background-color:green; color:white;  width:1380px; height: 550px;">

         l2
            <div class="row text-center" style="margin-top:2%;">
               <h1>Sign Up Here</h1>
            </div>
            <div class="row text-center">
               <form action="new5.php" method="post">
                  <div class="row" style="margin:1%">FirstName:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="FirstName" style="color:black;"></div>
                  <div class="row" style="margin:1%">LastName:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="LastName" style="color:black;"></div>
                  <div class="row" style="margin:1%">Select Gender: &nbsp<input type="radio" name="Gender" value="male" checked>Male &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="Gender" value="female"> Female</div>
                  <div class="row" style="margin:1%">Age: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" name="Age" style="color:black;"></div>
                  <div class="row" style="margin:1%">Email Address: &nbsp<input type="text" name="Email" style="color:black;"></div>
                  <div class="row" style="margin:1%">Password: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="pass" style="color:black;"></divs>
                  <div class="row" style="margin:1%"><input type="Submit" style="background-color:#ddd; color:black;"></div>
               </form>
            </div>

      </div>
   </div>
</body>

</html>