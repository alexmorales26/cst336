<?php
session_start(); // starts or continues an existing session

//$players= array("Juan"=>20);
//$players["John"] = 40; //key will be john

$_SESSION['Juan']=40;

//echo $players["John"];
echo "<br />";
echo $_SESSION["Juan"];


?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>