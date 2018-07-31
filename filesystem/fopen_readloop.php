<?php
//store the pathname in a variable
$filename='c:/private/sonnet.txt';
//open the file in read only mode
$file=fopen($filename,'r');
//create variable to store the contents
$contents='';
//loop through each line until end of file
while(!feof($file)){
	//retrieve next line, and add to contents
	$contents.=fgets($file);
}
fclose($file);
//display the contents with <br/> tags
echo nl2br($contents);



