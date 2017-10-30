<?php
include'../../dbConnection.php';
$conn=getDatabaseConnection("tcp");
$sql="DELETE FROM tc_user WHERE userId=".$_GET['userId'];

 $stmt=$conn->prepare($sql);
$stmt->execute();
    
header("Location:index.php");


?>