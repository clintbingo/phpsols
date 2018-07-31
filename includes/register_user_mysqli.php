<?php
use PhpSolutions\Authenticate\CheckPassword;

require_once __DIR__ . '/../PhpSolutions/Authenticate/CheckPassword.php';
$usernameMinChars = 6;
$errors= [];
$redirect='http://phpsols/sessions/login.php';
if(strlen($username)<$usernameMinChars)
{
	$errors[]="Username must be at least $usernameMinChars characters";
}
if(preg_match('/\s/', $username))
{
	$errors[]='Username should not contain spaces';
}
$checkPwd=new CheckPassword($password);
$checkPwd->requireMixedCase();
$checkPwd->requireNumbers(1);
$checkPwd->requireSymbols(1);
$passwordOk=$checkPwd->check();
if(!$passwordOk)
{
	$errors=array_merge($errors, $checkPwd->getErrors());
}
if($password!=$retyped){
	$errors[]="Your passwords don't match.";
}
if(!$errors)
{
//encrypt password using default encryption
$password=password_hash($password, PASSWORD_DEFAULT);
//include the connection file
require_once 'connection.php';
$conn=dbConnect('write');
//prepare sql statement
$sql='INSERT INTO users (username, pwd) VALUES (?,?)';
$stmt=$conn->stmt_init();
if($stmt=$conn->prepare($sql)){
	//bind parameters and insert the details into the database
	$stmt->bind_param('ss',$username, $password);
	$stmt->execute();
	}
	if($stmt->affected_rows==1){
		$success="$username has been registered. You may now log in.";		
	}elseif($stmt->errno==1062){
		$errors[]="$username is already in use. Please choose another username.";
	}else{
		$errors[]=$stmt->error;
	}
}