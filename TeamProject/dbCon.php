<?php
    function getDatabaseConnection(){
    
    $host = 'us-cdbr-iron-east-05.cleardb.net';
    $dbname = 'heroku_a7fc18d9d1666df';
    $username = 'b3db65c6ab633e';
    $password = "80751e19";
    
    //creates db connection
    $dbConn = new PDO("mysql:host=$host; dbname=$dbname",$username, $password);
    
    //display errors when accessing tables
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn;
    
}

?>