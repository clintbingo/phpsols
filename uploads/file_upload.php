<?php
use PhpSolutions\File\Upload;
//set the maximum upload size in bytes
//$max=3000000;
if(isset($_POST['upload']))
{
	//destination the path to the upload folder
	$destination='C:\\upload_test\\';
	$max=51200;
	require_once '../PhpSolutions/File/Upload.php';
	try{
		$loader=new Upload($destination);
		$loader->setMaxSize($max);
		$loader->allowAllTypes();
		$loader->upload();
		$result=$loader->getMessages();
	}catch(Exception $e){
		echo $this->getMessage();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/journey.css" rel="stylesheet" type="text/css">

</head>
<body>
	<?php
	if(isset($result))
	{
		echo '<ul>';
			foreach($result as $message){
				echo "<li>$message</li>";
			}
		echo '</ul>';
	}
	?>
	<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
		<p>
			<label for="image">Upload image</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?= $max; ?>">
			<input type="file" name="image" id="image">
			<!-- <input type="file" name="image[]" id="image" mulitple> -->
		</p>
		<p>
			<input type="submit" name="upload" id="upload" value="Upload"> 
		</p>
	</form>
</body>
</html>