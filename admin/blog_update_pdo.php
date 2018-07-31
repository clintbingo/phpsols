<?php 
require_once '../includes/connection.php';
//initialise flags
$OK=false;
$done=false;
//create database connection
$conn=dbConnect('write','pdo');
//get details of selected row
if(isset($_GET['article_id']) && !$_POST){
	//prepare SQL query
	$sql='SELECT article_id, title, article FROM blog WHERE article_id=?';
	$stmt=$conn->prepare($sql);
	//pass the placeholder value to execute() as a single-element array
	$OK=$stmt->execute([$_GET['article_id']]);
	//bind the results
	$stmt->bindColumn(1, $article_id);
	$stmt->bindColumn(2, $title);
	$stmt->bindColumn(3, $article);
	$stmt->fetch();
}
//if form has been submitted, update record
if(isset($_POST['update'])){
	//prepare update query
	$sql='UPDATE blog SET title = ?, article=? WHERE article_id=?';
	$stmt=$conn->prepare($sql);
	$done=$stmt->execute([$_POST['title'],$_POST['article'],$_POST['article_id']]);
}
//redirect if $_GET['article_id'] not defined
if($done || !isset($_GET['article_id'])){
	header('Location: http://phpsols/admin/blog_list_pdo.php');
	exit;
}
//store error message if query fails
if(isset($stmt)&& !$OK && !$done){
	$errorInfo=$stmt->errorInfo();
	if(isset($errorInfo[2])){
		$error-$errorInfo[2];
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
	<p><a href="blog_list_pdo.php">List all entries</a></p>
	<?php if(isset($error)){
		echo "<p class='warning'>Error: $error</p>";
	}
	if($article_id==0) { ?>
		<p class="warning">Invalid request: record does not exist.</p>
	<?php } else { ?>	
	<form method="post" action="">
		<p>
			<label for="title">Title</label>
			<input type="text" name="title" value="<?= htmlentities($title);?>">
		</p>
		<p>
			<label for="article">Article</label>
			<textarea name="article" id="article"><?= htmlentities($article);?></textarea> 
		</p>
		<p>
			<input type="hidden" name="article_id" value="<?= ($article_id);?>">
			<input type="submit" name="update" value="Update Entry" id="update">
		</p>
	</form>
	<?php } ?>
</body>
</html>