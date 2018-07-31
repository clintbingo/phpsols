<?php

//store the pathname in a variable
$filename='c:/private/sonnet.txt';
//open the file in read only mode
$file=fopen($filename,'r');
//read the file and store its content
$contents=fread($file, filesize($filename));
//close the file
fclose($file);
//display the contents with <br/> tags
echo nl2br($contents);
