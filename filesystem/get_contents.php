<?php

//nl2br(readfile('C:/private/sonnet.txt'));

//echo nl2br(file_get_contents('C:/private/sonnet.txt'));

// $sonnet=file_get_contents('C:/private/sonnet.txt');
// //replace the new lines with spaces
// $words=str_replace('\n',' ', $sonnet);
// //split into array of words
// $words=explode(' ',$words);
// //extract the first nine array elements
// $first_line=array_slice($words, 0, 8);
// //join the first nine elements and display
// echo implode(' ', $first_line);


$sonnet=file('c:/private/sonnet.txt', FILE_IGNORE_NEW_LINES);
echo $sonnet[0];


//echo file('c:/private/sonnet.txt')[0];

