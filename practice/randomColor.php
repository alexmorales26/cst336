<?php
function randomcolor()
{
  return "rgba( " . rand(0,255)."," . rand(0,255)."," . rand(0,255).",".(rand(0,100)/100).");";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Random Background color </title>
        <meta charset="utf-8" />
        <style>
        body{
        /*background-color:rgba(15,20,240,.5);*/
        <?php
        
       
        echo "background-color:" .randomcolor();
        ?>
        }
          h1{
        /*background-color:rgba(15,20,240,.5);*/
        <?php
        
       
        echo "color:" .randomcolor();
        echo "background-color:".randomcolor();
        ?>
        }
        
         h2{
            background-color: <?=randomcolor()?>
        }
        </style>
    </head>
    <body>
<h1>Welcome !</h1>
<h2>HOLA MIJO!</h2>
    </body>
</html>