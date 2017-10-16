<?php

    function getDataBaseConnection()
    {
        $host='us-cdbr-iron-east-05.cleardb.net'; // cloud 9
        $dbname='heroku_a7fc18d9d1666df'; // table name
        $username='b3db65c6ab633e' ;
        $password="80751e19";
        //creates db connnection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // displays errors when accessing tables
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConn;
    }
?>