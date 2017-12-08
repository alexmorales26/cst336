<?php
include'inc/adminHeader.php';
session_start();
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}
?>
<script>
var btn=document.getElementById("delete");
btn.disabled=true;
</script>


<style>
    .del{
        pointer-events:none;
        
    }
</style>

<?php
function displayUsers()
{
include'../dbConnection.php';
$conn=getDatabaseConnection();
//print_r($conn);
 $sql = "SELECT * 
            FROM tc_user
            ORDER BY lastName";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetchAll(PDO::FETCH_ASSOC); // expecting only one record
  echo "<table style='margin:auto;width:80%;' class='table table-hover'>";
        echo " <thead class='thead-dark'><tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                 <th>Username</th>
                  <th>Password</th>
                   <th>Added on</th>
                <th>Update Info</th>
             </tr></thead>";
             
        foreach($records as $r) {
            echo "<tr><td>" . $r['userId'] . "</td>";
            echo "<td>" . $r['firstName'] . "</td>";
            echo "<td>" . $r['lastName'] . "</td>";
            echo "<td>" . $r['email'] . "</td>";
            echo "<td>" . $r['username'] . "</td>";
            echo "<td> Confidential</td>";
            echo "<td>" . $r['creationDate'] . "</td>";
          //  echo"<td></td>";
            echo "<td><form action='deletefile.php'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Delete'<button type='button' class='btn btn-outline-danger'</button></form></td>";
          //  echo "<td><form action='deleteUser.php' onsubmit='return confirmDelete(\"".$r['firstName']."\")'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Delete'<button type='button' class='btn btn-outline-danger'></form></td></tr>";
        }
    
    echo "</table>";
}

displayUsers();

?>
