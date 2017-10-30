<?php
session_start();
include'../../dbConnection.php';
$conn=getDatabaseConnection("tcp");
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}
function getDepartmentinfo()
{
    global $conn;
//print_r($conn);
$sql =" SELECT deptName,departmentId FROM `tc_department` ORDER BY deptName";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetchAll(PDO::FETCH_ASSOC); // expecting only one record   
 return $records;
}
function getUserInfo($userId)
{
    global $conn;
    $sql =" SELECT * FROM `tc_user` WHERE userId = $userId";
$stmt =$conn->prepare($sql);
$stmt->execute();
 $records =$stmt ->fetch(PDO::FETCH_ASSOC); // expecting only one record  
 return $records;
}
if (isset($_GET['updateUserForm'])) { //admin has submitted form to update user
    $sql="UPDATE tc_user SET firstname = :fName,
			  lastName = :lName,email=:email,phone=:phone,gender=:gender,role=:role,deptId=:departmentId
			   WHERE userId=:userId";
	$namedParameters=array();
	$namedParameters[":fName"] = $_GET['firstName'];
	$namedParameters[":lName"] = $_GET['lastName'];
	$namedParameters[":email"] = $_GET['email'];
	$namedParameters[":phone"] = $_GET['phone'];
	$namedParameters[":gender"] = $_GET['gender'];
	$namedParameters[":role"] = $_GET['role'];
	$namedParameters[":departmentId"] = $_GET['deptId'];
	$namedParameters[":userId"] = $_GET['userId'];
	$stmt=$conn->prepare($sql);
	$stmt->execute($namedParameters);
    
}
if(isset($_GET['userId']))
{
    $userInfo=getUserInfo($_GET['userId']);
}
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <title>Admin: Update User </title>
        <script>
           function popUp()
            {
                alert("Successfully updated User !!");
            }
        </script>
        <style >
            h1,legend{
                text-align:center;
            }
            form{
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
    <legend  class="display-5"> Update Users Info</legend>
        <form >
            <input type="hidden" name="userId" value="<?=$userInfo['userId'] ?>"/>
        First Name: <input type="text" name="firstName" value="<?=$userInfo['firstName'] ?>" /><br/>
        Last Name: <input type="text" name="lastName"value="<?=$userInfo['lastName'] ?>"/><br/>
         Email: <input type="text" name="email" value="<?=$userInfo['email'] ?>"/> <br/>
      University ID: <input type="text" name="universityId" value="<?=$userInfo['universityId'] ?>"/> <br/>
      Phone: <input type="text" name="phone"value="<?=$userInfo['phone'] ?>"><br/>
      Gender: <input type="radio" name="gender" value="F" id="genderF"<?=(ucfirst($userInfo['gender'])=='F')?"checked":""?>/>
              <label for="genderF">Female</label>
              <input type="radio" name="gender" value="M" id="genderM"<?=(ucfirst($userInfo['gender'])=='M')?"checked":""?>/>
              <label for="genderM">Male</label>
              <br/>
        Role: <select name="role">
                <option value="">Select One</option>
                <option <?=(lcfirst($userInfo['role']) == 'faculty') ? "selected":""?> >Faculty</option>
                <option <?=(lcfirst($userInfo['role']) == 'student') ? "selected":""?> >Student</option>
                <option <?=(lcfirst($userInfo['role']) == 'staff') ? "selected":""?> >Staff</option>
                </select>
                <br/>
    Department: <select name="deptId">
                <option value="">Select One</option>
                <?php
                $departments=getDepartmentinfo();
                  foreach ($departments as $record) {
                //echo "<option" .($userInfo['deptId'] == $record['departmentId']) ? 'selected':''). "value='$record[departmentId]'>".$record[deptName] ."</option>";
                        echo "<option " .(($userInfo['deptId'] == $r['departmentId']) ? 'selected':''). "value='$record[departmentId]'>". $record['deptName'] . "</option>";
                }
                ?>
                </select>        
                <br/>
                <br/>
                  <input type="submit" name="updateUserForm" value="Update User!"class="btn btn-outline-success btn-primary btn-lg btn-primary btn-lg btn-block"onclick="popUp()"/>
    </form>
</fieldset>
    </body>
</html>