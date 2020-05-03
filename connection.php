<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "id13476816_alyx";
 $dbpass = "@/ap5*+!L4XJxxa*";
 $db = "id13476816_project_alyx";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>