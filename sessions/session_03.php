<?php session_start(); 
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 

	if(isset($_SESSION['name']))
	{
		//if set, greet by name
		echo 'Hi, ' . $_SESSION['name'] . '. See, I remembered your name!<br>';
		//unset session variable
		unset($_SESSION['name']);
		//invalidate the session cookie
		if(isset($_COOKIE[session_name()]))
		{
			setcookie(session_name(), '', time()-86400, '/');
		}
		ob_flush();
		//end session
		session_destroy();
		echo '<a href="session_02.php">Page 2</a>';
	}else{
		//display if not recognized
		echo "Sorry, I don't know you.";
		echo '<a href="session_01.php">Log in</a>';
	}
	?>
</body>
</html>