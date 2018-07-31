<?php
if(!file_exists($userlist)||!is_readable($userlist))
{
	$error="Login in facility unavailable. Please try later.";
}else{

	$file=fopen($userlist,'r');
	//ignore the titles in the first row of the CSV file
	//$titles=fgetcsv($file);	
	//loop through the remaining lines
	while(($data = fgetcsv($file)) !==false){
		//if the first element is null ignore
		if(is_null($data[0])){
			continue;
		}
		//if username and password match, create a session variable
		//regenerate the session ID, and break out of the loop
		if($data[0]==$username && password_verify($password, $data[1]))
		{
			$_SESSION['authenticated']='Jethro Tull';
			$_SESSION['start']=time();
			session_regenerate_id();
			break;
		}
	}
	fclose($file);
	if(isset($_SESSION['authenticated']))
	{
		header("Location: $redirect");
		exit;
	}else{
		$error='Invalid username or password';
	}
}
