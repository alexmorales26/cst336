<?php
include '../../dbConnection.php';
$conn = getDatabaseConnection();
$sql="SELECT * FROM db_history";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
    echo json_encode($record);
?>