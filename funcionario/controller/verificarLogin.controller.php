<?php
	session_start();
 
	if($_SESSION["loggedin"] == false){
		header("location: index.php?link=1");
		exit;
	}