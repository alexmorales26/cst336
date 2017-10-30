<?php
session_start();
//print_r($_POST);
include'../../dbConnection.php';
$conn=getDatabaseConnection("tcp");
//print_r($conn);


$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql =" SELECT * FROM tc_admin WHERE username= :username AND password= :password";
$namedParameters =array();
$namedParameters[':username'] =$username;
$namedParameters[':password']=$password;

$stmt =$conn->prepare($sql);
$stmt->execute($namedParameters);
 $record =$stmt ->fetch(PDO::FETCH_ASSOC); // expecting only one record
 
 if(empty($record))
 {
    header("Location: index.php?login=Error");
 }
 else{
     $_SESSION['username'] = $record['username'];
       $_SESSION['adminFullName'] = $record['firstName'] ." ". $record['lastName'];
     header("Location: admin.php"); // redirecting to admin portal 
 }

?>