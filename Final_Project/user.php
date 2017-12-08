<?php
include'inc/userHeader.php';
session_start();
include '../dbConnection.php';
echo " <h2 class='display-4' style='text-align:center;'>Welcome, " .$_SESSION['userFullName'] ."!</h2>";
function table(){
$conn = getDatabaseConnection();
$sql="SELECT  game_id,game_name,genre,game_release,console_name,price FROM `vg_game` e INNER JOIN vg_console d ON e.console_id=d.console_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 $records = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
echo "<table style='margin:auto;width:80%;' class='table table-hover'>";
        echo " <thead class='thead-dark'><tr>
                <th>GAME</th>
                <th>GENRE</th>
                <th>RELEASE DATE</th>
                <th>CONSOLE</th>
                <th>PRICE</th>
             </tr></thead>";
             
        foreach($records as $r) {
            //echo "<tr><td>" . $r['game_id'] . "</td>";
            echo "<tr><td>" . $r['game_name'] . "</td>";
            echo "<td>" . $r['genre'] . "</td>";
            echo "<td>" . $r['game_release'] . "</td>";
            echo "<td>" . $r['console_name'] . "</td>";
            echo "<td> $" . $r['price'] . "</td></tr>";
           //echo"<td></td>";
        //    echo "<td><form action='cart.php'><input type='hidden' name='".$r['game_name'] ."'value='".$r['price']."'><input type='submit' value='Add'<button type='button' class='btn btn-outline-primary btn-block'</button></form></td></tr>";
          //  echo "<td><form action='deleteUser.php' onsubmit='return confirmDelete(\"".$r['firstName']."\")'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Delete'<button type='button' class='btn btn-outline-danger'></form></td></tr>";
        }
    
    echo "</table>";
}

table();
include"inc/footer.php";
?>