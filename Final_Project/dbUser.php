<?php
include '../../dbConnection.php';
$conn = getDatabaseConnection();
$sql="SELECT * FROM tc_user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
    echo json_encode($record);
?>