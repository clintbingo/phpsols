<?php

$file=fopen('C:/private/users.csv','r');

$titles=fgetcsv($file);
//initialise an empty array
$users=[];
//get remaining date from file
while(($data=fgetcsv($file))!==false)
{
	if(count($data)==1 && is_null($data[0]))
	{
		continue;                                        
	}
	$users[]=array_combine($titles, $data);

}
//close csv
fclose($file);

echo '<pre>';
print_r($users);
echo '</pre>';