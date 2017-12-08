<?php
session_start();
include'../dbConnection.php';
$conn=getDatabaseConnection();
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}
function getDepartmentinfo()
{
 include'../../dbConnection.php';
$conn=getDatabaseConnection("tcp");
//print_r($conn);
$sql =" SELECT deptName,departmentId FROM `tc_department` ORDER BY deptName";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetchAll(PDO::FETCH_ASSOC); // expecting only one record   
 return $records;
}

if (isset($_GET['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $firtName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $email    = $_GET['email'];
    $universityId = $_GET['universityId'];
    $phone    = $_GET['phone'];
    $gender   = $_GET['gender'];
    $role   = $_GET['role'];
    $deptId   = $_GET['deptId'];
      //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
    $sql = "INSERT INTO tc_user
            (firstName,lastName,email,universityId,gender,phone,role,deptId)
            VALUES
            (:fName,:lName,:email,:universityId,:gender,:phone,:role,:deptId)";
    $namedParameters=array();
    $namedParameters[':fName']= $firtName;
    $namedParameters[':lName']=$lastName;
    $namedParameters[':email']=$email;
    $namedParameters[':gender']=$gender;
    $namedParameters[':universityId'] =$universityId;
    $namedParameters[':phone']=$phone;
    $namedParameters['role']=$role;
    $namedParameters[':deptId']=$deptId;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Adding New User </title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
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
        <h1 class="display-3">Admin Section</h1>
        <hr>
<fieldset>
    <legend > Add  New Users </legend>
        <form>
        First Name: <input type="text" name="firstName" required /><br/>
        Last Name: <input type="text" name="lastName" required/><br/>
         Email: <input type="text" name="email" required/> <br>
      University ID: <input type="text" name="universityId" required/> <br/>
      Phone: <input type="text" name="phone" required/><br/>
      Gender: <input type="radio" name="gender" value="F" id="genderF" required/>
              <label for="genderF">Female</label>
              <input type="radio" name="gender" value="M" id="genderM" required/>
              <label for="genderM">Male</label>
              <br/>
        Role: <select name="role" required>
                <option value="">Select One</option>
                <option>Faculty</option>
                <option>Student</option>
                <option>Staff</option>
                </select>
                <br/>
    Department: <select name="deptId" required>
                <option value="">Select One</option>
                <?php
                $departments=getDepartmentinfo();
                  foreach ($departments as $record) {
                echo "<option value='$record[departmentId]'>$record[deptName]</option>";
             }
                ?>
                </select>        
                <br/><br/>
                  <input type="submit" name="addUserForm" value="Add User!"class="btn btn-outline-primary btn btn-primary btn-lg btn-block"/>
    </form>
</fieldset>
    </body>
</html>