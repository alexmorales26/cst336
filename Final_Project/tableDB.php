<?php
include '../dbConnection.php';
$conn = getDatabaseConnection();
//SELECT game_id,game_name,game_release,console_name,price FROM `vg_game` e INNER JOIN vg_console d ON e.console_id=d.console_id ORDER by console_name
$sql="SELECT ROUND(AVG(price)) as average FROM `vg_game`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
    echo json_encode($record);
    
?>    