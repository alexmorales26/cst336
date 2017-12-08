<?php
include"inc/adminHeader.php";
session_start();
include'../dbConnection.php';
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}
function getUserInfo($userId){
    $conn=getDatabaseConnection();
    $sql =" SELECT * FROM `tc_user` WHERE userId = $userId";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetch(PDO::FETCH_ASSOC); // expecting only one record  
 return $records;
}
if (isset($_POST['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $conn=getDatabaseConnection();
    $firtName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email    = $_POST['email'];
    $username= $_POST['username'];
    $password = sha1($_POST['password']);
           $sql = "INSERT INTO `tc_user`
            (firstName,lastName,email,username,password,creationDate)
            VALUES
            (:fName,:lName,:email,:username,:password,CURRENT_TIMESTAMP)";
            $namedParameters=array();
            $namedParameters[':fName']= $firtName;
            $namedParameters[':lName']=$lastName;
            $namedParameters[':email']=$email;
            $namedParameters[':username']=$username;
            $namedParameters[':password'] =$password;
            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            header("Location: admin.php");
}
    if(isset($_GET['userId']))
{
    $userInfo=getUserInfo($_GET['userId']);
}
?>
<!DOCTYPE html>
<html>
    <head>
         <style>
             h1{
                 text-align:center;
             }
             fieldset{
                 margin:auto;
              
               display: block;
                width: 20%;
             }
         </style>
         <script>

              function popUp()
            {
                 alert("Successfully updated User !!");
            }
         </script>
    </head>
    <body>
        <h1 class="display-5">Update User</h1>
        <hr>
<fieldset>
    <legend > Update User Form</legend>
    <hr>
        <form method="POST">
       <div class="form-group row">
            <label for="fName" class="col-md-4 col-form-label" >First Name</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="fName"  value="<?=$userInfo['firstName']?>"required >
    </div>
    <br><br>
     <label for="lName" class="col-md-4 col-form-label">Last Name</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="lName"  value="<?=$userInfo['lastName']?>"required >
    </div><br><br>
    <label for="email" class="col-md-4 col-form-label">Email</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="email"  value="<?=$userInfo['email']?>"required>
    </div><br><br>
    <label for="username" class="col-md-4 col-form-label">Username</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="username"  value="<?=$userInfo['username']?>"required >
    </div><br><br>
    <label for="password" class="col-md-4 col-form-label">Password</label>
    <div class="col-md-8">
      <input type="password" class="form-control" name="password" value="<?=$userInfo['password']?>"required>
    </div><br><br>
    <div id="error"></div>
  </div>
    <input type="submit" name="addUserForm" value="Update User!"class="btn btn-outline-success btn btn-primary btn-lg btn-block" onclick='popUp()'/>
    </form>
</fieldset>
    </body>
</html>






<?php include "inc/footer.php"; ?>