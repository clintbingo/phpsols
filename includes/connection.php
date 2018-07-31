<?php

function dbConnect($usertype, $connectionType='mysqli'){
	$host='localhost';
	$db='phpsols';
	if($usertype=='read'){
		$user='psread';
		$pwd='pHoMFWcoYnI6sq0o';
	}elseif($usertype=='write'){
		$user='pswrite';
		$pwd='wa5BI5oMdNIqLdhm';
	}else{
		exit('Unrecognized user');
	}
	//connection goes here
	if($connectionType=='mysqli'){
		$conn=@ new mysqli($host, $user, $pwd, $db);
		if($conn->connect_error){
			exit($conn->connect_error);
		}
		return $conn;
	}else{
		try{
			return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}