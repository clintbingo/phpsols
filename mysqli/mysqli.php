<?php

require_once '../includes/connection.php';
$conn=dbconnect('read');

$sql='SELECT * FROM images';
$result=$conn->query($sql);
if(!$result)
{
	$error=$conn->error;
}else{
	$numRows=$result->num_rows;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		if(isset($error)){
			echo "<p>$error</p>";
		}else{
			echo "<p>A total of $numRows records were found.</p>";
		
	?>

		<table>
			<tr>
				<th>image_id</th>
				<th>filename</th>
				<th>caption</th>
			</tr>
			<?php while($row=$result->fetch_assoc()) { ?>
			<tr>
				<td><?= $row['image_id'];?></td>
				<td><?= $row['filename'];?></td>
				<td><?= $row['caption'];?></td>
			</tr>
			<?php } ?>
		</table>

	<?php } ?>
</body>
</html>