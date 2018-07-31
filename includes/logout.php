<?php
//run the script only if the logout button is clicked
if(isset($_POST['logout']))
{
	//empty the $_SESSION array
	$_SESSION=[];
	//invalidate the session cookie
	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '', time()-86400, '/');
	}
	//end session and redirect
	session_destroy();
	header('Location: http://phpsols/sessions/login.php');
	exit;
}
?>
<form method="post" action="">
		<input type="submit" name="logout" value="Log out">
</form>