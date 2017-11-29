<?php
include '../../dbConnection.php';
$conn = getDatabaseConnection();
$key =$_POST['itemsz'];
    $sql = "INSERT INTO
        db_history
        (`object`,`date`)
        VALUES
        ('$key',CURRENT_TIMESTAMP)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
?>
