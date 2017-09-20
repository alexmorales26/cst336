<?php
//global
 $Val1="OtT3rS";
 $Val2="XXX";
 $Val3="XXX";
function backgroundDisplay()
{
    echo "<img src='../Homework_2/img/PS4controller.png'/>";
}
function display()
{
    echo "<img src='../Homework_2/img/PSN_Generator3.png'/>";
}
function display_id($id)
{
    echo $id;
}
function message()
{
    echo"DOPE" ;
}
function Generator()
{
    $Prefix= array("xxx","XXX","xXx","|||","zZz");
    $Sufix= array("xxx","XXX","xXx","|||","zZz");
    $ID = array("Sp1D3R_B1t3","Aw3sOmE","OtT3rS","MaN1cA","VeNoM");
    shuffle($Prefix);
    shuffle($Sufix);
    shuffle($ID);
    $randNum= rand(0,count($ID));
    $random_Prefix=array_rand($Prefix);
    $random_Sufix=array_rand($Sufix);
    $random_ID=array_rand($ID);
   $name=($Prefix[$random_Prefix].$ID[$random_ID].$Sufix[$random_Sufix]);
   $flag=false;$flag2=false;$flag3=false;
   for($i=0; $i < count($Prefix);$i++)
   {
       if($Val2==$Prefix[$i])
       {
           $flag=true;
           break;
       }
   }
   for($j=0; $j < count($ID);$j++)
   {
       if($Val1 == $ID[$j])
       {
           $flag2=true;
           break;
       }
   }
   for($x=0; $x <count($Sufix);$x++)
   {
       if($Val3==$Sufix[$x])
       {
           $flag3=true;
           break;
       }
   }
   if($flag && $flag2 && $flag3)
   {
       $message = "Available: ";
       return $message.$name;
   }
   else
   {
   return $name; 
   }
}


?>