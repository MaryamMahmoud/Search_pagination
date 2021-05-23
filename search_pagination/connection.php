<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_lab4";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection failed.." . $conn->connect_error);
}
?>