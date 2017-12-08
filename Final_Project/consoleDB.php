<?php
include '../dbConnection.php';
$conn = getDatabaseConnection();
$sql="SELECT ROUND(MAX(price)) as maximum FROM `vg_game`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
    echo json_encode($record);
?>