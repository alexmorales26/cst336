<?php
  include 'dbCon.php';
    $conn = getDatabaseConnection();
    
    function getUsers() {
        global $conn;
        
        $sql = "SELECT * FROM `db_user` WHERE 1 ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($users as $user) {
            echo "<option>" . $user['firstName'] . " " . $user['lastName'] . "</option>";
        }
    }
// Checkout page
session_start();
$movieDisplay= array();
$All = array();
if(isset($_GET['movieId'])){
    $_SESSION['movieId']=$_GET['movieId'];
    $index=$_SESSION['movieId'];
    array_push($movieDisplay,$_SESSION['movieName'][$index],$_SESSION['movieGenre'][$index],$_SESSION['movieYear'][$index]);
    array_push($All,$movieDisplay);
    //print_r($All);
}
//print_r($_SESSION);
//print($_SESSION['movieId']);
if(empty($_SESSION)){
    echo"Empty Cart";
}
function refreshCart()
{
    global $All;
       foreach((array)$All as $movie){
     echo "<tbody>";
    echo "<tr>";
        echo " <td>".''.$movie[0].''."</td>";
         echo"  <td>".''.$movie[1].''."</td>"; 
        echo    "<td>".''.$movie[2].''."</td>";
          echo " <td>";
   echo " <div class='inline'> ";
    echo"<a href='removeItem.php' class='btn btn-danger  btn-sm btn-block'role='button'>Remove Item</a>";
           echo"  </div>";
        echo    "</td>";
         echo " </tr>";
      echo "</tr>";
       echo "</tbody>";
    }
}

$username = $_GET['users'];
    
    function displayHistory() {
        global $conn;
        
        $sql = "SELECT * FROM `db_checkout` NATURAL LEFT OUTER JOIN `db_user` WHERE 1 ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>History</h3>";
        echo "<div class='container'>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>User ID</th>";
        echo "<th>User Name</th>";
        echo "<th>Movie Name</th>";
        echo "<th>Checkout Date</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach($history as $historys) {
            echo "<tr>";
            echo"<td>".''.$historys['userId'].''."</td>"; 
            echo"<td>".''.$historys['firstName'].' '.$historys['lastName'].''."</td>"; 
            echo"<td>".''.$historys['movieName'].''."</td>"; 
            echo"<td>".''.$historys['checkoutDate'].''."</td>"; 
            echo"<td>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "<h6>*Last updated 11.7.2017 @ 11:49pm</h6>";
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            function confirmCheckOut(first)
            {
                return confirm(first+" do you wish to checkout ?");
            }
        </script>
        <title>Checkout Cart</title>
        <style>
            @import url("css/styles.css");
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <h1 class="display-4" id="checkOutTitle"> Shopping Cart </h1>
        <hr />
        <nav class="navbar navbar-light">
            <form>
                <a class="btn btn-success btn-lg" href="index.php" role="button"> Go Back </a>
                <input class="btn btn-primary btn-lg" type="submit" value="Purchase!" id="checkoutBtn">
                <input type="submit" name="history" class="btn btn-default btn-lg" value="History">
            </form>
            <br />
            <form>
                <select name="users">
                    <option value="">Users</option>
                    <?=getUsers()?>
                </select>
            </form>
        </nav>
        <div class="container" id="checkoutCartTable">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th class="col-xs-3"> Title</th>
                    <th class="col-xs-3">Genre</th> 
                    <th class="col-xs-3">Year</th>
                    <th class="col-xs-3">Update Cart</th>
                </thead>
                <!-- --> 
                <?=refreshCart()?>
            </table>
        </div>

        <?php
            if (isset($_GET['history'])) {
                displayHistory();
            }
        ?>
        <script src="js/javaFunctions.js"></script>
    </body>
</html>