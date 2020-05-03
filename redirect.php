<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$t = $_SESSION["type"];
if(strcmp($t,"admin")==0)
{
	header("location: admin.php");
	exit;
}
if(strcmp($t,"assistant")==0)
{
	header("location: assistant.php");
	exit;
}
?>