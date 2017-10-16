<?php
$host='localhost'; // cloud 9
$dbname='tcp'; // table name
$username='root' ;
$password="";
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function getusersAndDepartments()
{
    global $dbConn;
    $sql = "SELECT firstName,lastName,deptname FROM tc_user
    INNER JOIN tc_department
    ON tc_user.deptId=tc_department.departmentId";
    $stmt = $dbConn->prepare($sql);
$stmt->execute();
$records =$stmt ->fetchAll(PDO::FETCH_ASSOC);
//print_r($records);

    foreach($records as $record)
    {
        echo $record['firstName'] . ' '. $record['lastName'] . ' '. $record['deptname'] . '<br/>';
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title> SQL Joins</title>
    </head>
    <body>
<h2> Users and their corresponding departments (order by last name)</h2>


<?=getusersAndDepartments()?>
    </body>
</html>