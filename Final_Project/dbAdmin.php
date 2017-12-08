<?php
include '../dbConnection.php';
session_start();
$conn = getDatabaseConnection();
$username = $_POST['InputEmail'];
$password = sha1($_POST['InputPassword']);

$sql =" SELECT * FROM tc_admin WHERE username= :username AND password= :password";
$namedParameters =array();
$namedParameters[':username'] =$username;
$namedParameters[':password']=$password;

$stmt =$conn->prepare($sql);
$stmt->execute($namedParameters);
 $record =$stmt ->fetch(PDO::FETCH_ASSOC); // expecting only one record
 
 if(empty($record))
 {
    //header("Location:index.php?login=Error"); //error
    $sql =" SELECT * FROM tc_user WHERE username= :username AND password= :password";
     $namedParameters =array();
     $namedParameters[':username'] =$username;
     $namedParameters[':password']=$password;
     $stmt =$conn->prepare($sql);
     $stmt->execute($namedParameters);
      $record =$stmt ->fetch(PDO::FETCH_ASSOC); // expecting only one record
      if(empty($record)){   // check users table
       header("Location:index.php?login=Error");
      }
      else // if it exists then log in 
      {
        $_SESSION['username'] = $record['username'];
       $_SESSION['userFullName'] = $record['firstName'] ." ". $record['lastName'];
      header("Location: user.php"); // redirecting to admin portal 
      }
 }
 else{ // admin access
     $_SESSION['username'] = $record['username'];
       $_SESSION['adminFullName'] = $record['firstName'] ." ". $record['lastName'];
     header("Location: admin.php"); // redirecting to admin portal 
 }

    
    
    
?>