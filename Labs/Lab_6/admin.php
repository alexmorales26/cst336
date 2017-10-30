<?php
session_start();
if(!isset($_SESSION['username'])) //check whether admin has logged in
{
    header("Location: index.php");
    exit();
}
function displayUsers()
{
include'../../dbConnection.php';
$conn=getDatabaseConnection("tcp");
//print_r($conn);
 $sql = "SELECT * 
            FROM tc_user
            ORDER BY lastName";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetchAll(PDO::FETCH_ASSOC); // expecting only one record
  echo "<table>";
        echo "<tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Uni. ID</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Dept. ID</th>
                <th>Update Info</th>
                <th>Delete User</th>
             </tr>";
             
        foreach($records as $r) {
            echo "<tr><td>" . $r['userId'] . "</td>";
            echo "<td>" . $r['firstName'] . "</td>";
            echo "<td>" . $r['lastName'] . "</td>";
            echo "<td>" . $r['email'] . "</td>";
            echo "<td>" . $r['universityId'] . "</td>";
            echo "<td>" . $r['gender'] . "</td>";
            echo "<td>" . $r['phone'] . "</td>";
            echo "<td>" . $r['role'] . "</td>";
            echo "<td>" . $r['deptId'] . "</td>";
            echo "<td><form action='updateUser.php'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Update'<button type='button' class='btn btn-outline-success'</button></form></td>";
            echo "<td><form action='deleteUser.php' onsubmit='return confirmDelete(\"".$r['firstName']."\")'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Delete'<button type='button' class='btn btn-outline-danger'></form></td></tr>";
        }
    
    echo "</table>";
}
?>
<!DOCTYPE html>
<html>
    <head>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <title>TCP ADMIN PAGE </title>
        <script>
            function confirmDelete(firstName)
            {
             return confirm("Are you sure you want to delete " + firstName +"?");   
            }
        </script>
            <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
            }
            
            table {
                margin: auto;
            }
            
            form {
                display: inline;
            }
            
            head, body {
                text-align: center;
            }
            
        </style>
    </head>
    <body>
    <h1 class="display-3">TCP ADMIN PAGE</h1>
    <h2 class="display-5"> Welcome <?=$_SESSION['adminFullName'] ?>! </h2>
    <hr>
    <form action="addUser.php">
        <input type="submit" value="Add new User"type="button" class="btn btn-outline-primary"/>
    </form>
       <form action="logout.php">
        <input type="submit" value="logout"type="button" class="btn btn-outline-danger"/>
    </form>
    <br/><br/> <br/>
    
    <?php
    displayUsers();
       
    ?>
    </body>
</html>