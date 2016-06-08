<?php
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

$sql = "INSERT INTO picexclient (firstname, lastname, username, gender, age, email, password)
VALUES ('$_POST[FirstName]', '$_POST[LastName]', '$_POST[UserName]', '$_POST[Gender]', '$_POST[Age]', '$_POST[Email]', '$_POST[pass]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>