<?php
require_once './includes/connection.php';
if($conn=dbConnect('read','pdo')){
	echo 'Connection successful';
}


