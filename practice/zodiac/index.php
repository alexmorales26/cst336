<!DOCTYPE html>
<?php

function years ($start, $end)
{
    $sum=0;
    $zodiac = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
$j =0;
for($i =$start ; $i <=$end; $i+=4)
{
    if($j==11)
    {
        $j=0;
    }
    else {
        $name=$zodiac[$j];
    }
    if($i >1900)
    {
       
    
             echo "<img src='img/$name.png' width='70'/>";
    

    }
    if ($i % 100==0)
    {
        $sum+=$i;
         echo "<li> Year".  $i . " Happy NEW CENTURY! </li>";
          // echo "<img src='img/$name.png' width='70'/>";
    }
    else {
             $sum+=$i;
           echo "<li> Year".  $i. "</li>";  
            // echo "<img src='img/$name.png' width='70'/>";
    }
    $j++;
}
return $sum;
}
?>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        
<h1> Chinese Zodiac List </h1>
  <form>
        <input type="text" name="start" placeholder ="start">
        <input type="text" name="end" placeholder="end">
        <input type="submit" value="Submit"/>
    </form>
<ul> 
<?php

$total=years($_GET["start"],$_GET["end"]);
echo "<h2>year Sum " . $total. "</h2>" ;
?>
</ul>
    </body>
</html>