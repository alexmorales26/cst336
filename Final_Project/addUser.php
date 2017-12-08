<?php
include"inc/adminHeader.php";
?>
<script>
    $(document).ready(function(){
       
       $("#sign").click(function(){
           
         $("#InfoModal").modal("show");
     //   $("#petInfo").html("<img src='img/loading.gif'>");
       });
       $("#logger").click(function(){
            var user = document.getElementById("InputEmail1").value;
        var pass = document.getElementById("InputPassword1").value;
         $("#success").html("");
        if(user.length == 0 || pass.length == 0){
            $("#success").html("Incorrect Email/Password");
            // document.getElementById("success").innerHTML+="Incorrect Email/Password";
        }
       });

    });
</script>
<?php
session_start();
include'../dbConnection.php';
function message($var){
    if($var){
         echo "<h3>Added Successfully</h3>";
    }
    else{
        echo "<h3> EXISTS ALREADY </h3>";
    }
}

if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}

if (isset($_POST['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $conn=getDatabaseConnection();
    $firtName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email    = $_POST['email'];
    $username= $_POST['username'];
    $password = sha1($_POST['password']);
      // if(checkAvailablity($firstName,$lastName,$email,$username,$password)){
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
           // message(false);
            header("Location: admin.php");
       }
    //   else
    //   {
    //       echo "EXISTS"; 
    //   }
?>
<script>
var btn=document.getElementById("add");
btn.disabled=true;
 function popUp()
            {
                alert("Successfully Added User !!");
              
            }
</script>


<style>
    .adder{
        pointer-events:none;
        
    }
</style>
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
    </head>
    <body>
        <h1 class="display-5">Add New User</h1>
        <hr>
<fieldset>
    <legend > New User Form</legend>
    <hr>
        <form method="POST">
       <div class="form-group row">
            <label for="fName" class="col-md-4 col-form-label">First Name</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="fName" placeholder="John" required >
    </div>
    <br><br>
     <label for="lName" class="col-md-4 col-form-label">Last Name</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="lName" placeholder="Smith" required >
    </div><br><br>
    <label for="email" class="col-md-4 col-form-label">Email</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="email" placeholder="email@example.com" required>
    </div><br><br>
    <label for="username" class="col-md-4 col-form-label">Username</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="username" placeholder="username" required >
    </div><br><br>
    <label for="password" class="col-md-4 col-form-label">Password</label>
    <div class="col-md-8">
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div><br><br>
    <div id="error"></div>
  </div>
    <input type="submit" name="addUserForm" value="Add User!"class="btn btn-outline-success btn btn-primary btn-lg btn-block" onclick="popUp()"/>
    </form>
</fieldset>
    </body>
</html>






<?php include "inc/footer.php"; ?>