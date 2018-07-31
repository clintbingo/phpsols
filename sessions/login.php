<?php
$error='';
if(isset($_POST['login']))
{
	session_start();
	$username=$_POST['username'];
	$password=$_POST['password'];
	//location of usernames and passwords
	$userlist='C:/private/encrypted.csv';
	//locaton to redirect on success
	$redirect='http://phpsols/sessions/menu.php';
	require_once '../includes/authenticate.php';

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<?php
	if($error)	
	{
		echo "<p>$error</p>";
	}elseif(isset($_GET['expired'])) {?>
		<p>Your session has expired. Please log in again.</p>
	<?php }	?>
	<form method="post" action="">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</p>
		<p>
			<input name="login" type="submit" value="Log in">
		</p>
	</form>
</body>
</html>