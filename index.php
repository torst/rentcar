<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
  	else{ 
  		header("location:dashboard.php");}
?>
