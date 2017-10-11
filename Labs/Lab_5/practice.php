<?php
$host = 'localhost'; // cloud 9
$dbname ='tcp';
$username='root';
$password='';
// create database connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username,$password);

//displays  databse related errors 
$dbConn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
function usersWithA(){
      global $dbConn;
    $sql ="SELECT * FROM tc_user WHERE firstName LIKE 'A%'";
  
    
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    $records= $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    
    //print_r($records);
    
    foreach($records as $record)
    {
        echo $record['firstName'] . " " . $record['lastName'] ." " . $record['email'] . "<br/>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <h3> Users whos first name starts with Letter "A"</h3>
        <?= usersWithA() ?>
    </body>
</html>