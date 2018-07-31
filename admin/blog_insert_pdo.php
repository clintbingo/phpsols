<?php 
if(isset($_POST['insert'])){
	require_once '../includes/connection.php';
	//initialise flag
	$OK=false;
	//create database connection
	$conn=dbConnect('write','pdo');
	//create SQL
	$sql='INSERT INTO blog (title, article) VALUES(:title,:article)';
	//prepare the statement
	$stmt=$conn->prepare($sql);
	//bind parameters and execute statement
	$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
	$stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
	//execute end get the number of affected rows
	$stmt->execute();
	$OK=$stmt->rowCount();
	//redirect if successful or display error
	if($OK){
		header('Location: http://phpsols/admin/blog_list_pdo.php');
		exit;
	}else{
		$errorInfo=$stmt->errorInfo();
		if(isset($errorInfo[2])){
			$error=$errorInfo[2];
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<h1>Insert new blog entry.</h1>
	<?php 
	if(isset($error)){
		echo "<p>Error: $error</p>";
	}
	?>
	<form method="post" action="">
		<p>
			<label for="title">Title</label>
			<input type="text" name="title">
		</p>
		<p>
			<label for="article">Article</label>
			<textarea name="article" id="article"></textarea> 
		</p>
		<p>
			<input type="submit" name="insert" value="Insert New Entry" id="insert">
		</p>
	</form>

</body>
</html>