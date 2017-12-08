<?php
session_start();
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}
include'../dbConnection.php';
$conn=getDatabaseConnection();
$sql="DELETE FROM tc_user WHERE userId=".$_GET['userId'];

 $stmt=$conn->prepare($sql);
$stmt->execute();
  echo"<script>alert('USER HAS BEEN REMOVED')</script>";  
header("Location:admin.php");


?>