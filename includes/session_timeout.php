<?php
session_start();
ob_start();
//set a time limit in seconds
$timelimit=1000;
//get the current time
$now=time();
//where to direct if  rejected
$redirect='http://phpsols/authenticate/login_db.php';
//if session variable is not set, redirect to login page
if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated']!='Jethro Tull')
{
	header('Location: $redirect');
	exit;
}elseif($now>$_SESSION['start']+$timelimit){
	//if timelimit hase expired, destroy session and redirect
	$_SESSION=[];
	//invalidate the session cookie
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '',time()-86400, '/');
	}
	//end session and redirect with query string
	session_destroy();
	header("Location:{$redirect}?expired=yes");
	exit;
}else{
	//if it's got this far, it's OK, so update start time
	$_SESSION['start']=time();
}
?>