<?php
function displaySymbol($symbols)
{
    echo "<img src='../Labs/Lab_2/img/$symbols.png' width='70'/>";
}
$symbols= array("lemon","orange","cherry");

//print_r($symbols); // displays array contents, only for debugging purposes

//echo displaySymbol($symbols[0]);

//echo $symbols[0]; // displays first element in array 

$symbols[]="grapes"; // adds element at the end of the array

//$symbols[2]="seven"; // replacing the value in index 2

array_push($symbols,"seven"); // adds element at the end of the array 

//echo displaySymbol($symbols[4]);

for ($i=0; $i < count($symbols); $i++) // count() returns array size
{
    displaySymbol($symbols[$i]);
}
sort($symbols); // order elements in ascending order

// r_sort($symbols); // reverse sort
print_r($symbols);

shuffle($symbols);
echo"<hr>";
print_r($symbols);
echo"<hr>";

$lastSymbol= array_pop($symbols); // retrieves and Removes Last element in array 
displaySymbol($lastSymbol);
echo"<hr>";

foreach($symbols as $s)
{
    displaySymbol($s);
}

unset($symbols[2]); //removes element 
echo"<hr>";
print_r($symbols);
$symbols = array_values($symbols); // re-indexes the array 
echo "<hr>";
print_r($symbols);



// display random symbol

echo displaySymbol($symbols[array_rand($symbols)]);





?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Arrays  </title>
        <meta charset="utf-8" />
    </head>
    
    <body>


    </body>
</html>