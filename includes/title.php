<?php $title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	  $title = str_replace('_',' ', $title);	
	  //$title = ucfirst($title);
	  if(strtolower($title)=='index'){
	  	$title='home';
	  }
	  $title = ucwords($title);
?>