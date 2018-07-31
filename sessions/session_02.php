<?php
//initiate session
session_start();
//check that form has been submitted and that name is not empty
if($_POST && !empty($_POST['name']))
{
	//set session variable
	$_SESSION['name']=$_POST['name'];

}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		//check session variable is set
		if(isset($_SESSION['name']))
		{
			//if set, greet by name
			echo 'Hi, ' . $_SESSION['name'] . '.<a href="session_03.php">Next</a>';
		}else{
			//if not set, send back to login
			echo 'Who are you?<a href="session_01.php">Log in</a>';
		}

	?>
</body>
</html>

