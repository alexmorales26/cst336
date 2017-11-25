<?php
// /cst336/dbConnection.php

include '../../dbConnection.php';
$conn = getDatabaseConnection();
 //print_r($conn);

$sql = "SELECT *
        FROM tc_user
        WHERE username = :username"; 

$namedParameters = array();
$namedParameters[':username'] = $_GET['username'];
       
        
$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record



echo json_encode($record);
?>
