<?php
include'../../dbConnection.php';

$conn = getDataBaseConnection();


function getDeviceTypes()
{
  global $conn;
  $sql = "SELECT DISTINCT(deviceType) FROM `tc_device`ORDER BY deviceType";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
         $records =$stmt ->fetchAll(PDO::FETCH_ASSOC);
         foreach($records as $record)
         {
           echo "<option>" . $record['deviceType'] . "</option>";
         }
}
function displayDevices(){
  global $conn;
  $sql = "SELECT * FROM tc_device WHERE 1";
  if(isset($_GET['submit'])){
        $namedParameters=array();
     if (!empty($_GET['deviceName'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND deviceName LIKE :deviceName"; //using named parameters
            $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";

         }
         
        if (!empty($_GET['deviceType'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND deviceType = :dType"; //using named parameters
           $namedParameters[':dType'] =   $_GET['deviceType'] ;

         }     
         
         if (isset($_GET['available'])) {
           //  $sql.=" ORDER BY deviceName ASC";
             $sql.=" AND status LIKE 'A'";
             // $namedParameters[':status'] = "A" ;
         }
         $radiobtn=$_GET['orderBy'];
        if(isset($_GET['orderBy']) && $radiobtn=='price')
         {
           $sql.=" ORDER BY price";
         }
        
  } // end of if isset 
  else {
      $sql.=" ORDER BY deviceName";
  }
   
    //If user types a deviceName
      //$dName = $_GET['deviceName'];
     // $sql.=" AND deviceName LIKE '%'$dName'%'";
     //   "AND deviceName LIKE '%$_GET['deviceName']%'";
    //if user selects device type
      //  "AND deviceType = '$_GET['deviceType']";
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
         $records =$stmt ->fetchAll(PDO::FETCH_ASSOC);
   foreach($records as $record)
         {
           echo  $record['deviceName']. " ".$record['deviceType']. " ". $record['price'] ." ".$record['status'].
           "<a target='checkoutHistory' href='checkoutHistory.php?deviceId=".$record['deviceId']."'> Checkout History </a> <br />";
           
         }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5: Device Search </title>
        <style>
          @import url("css/styles.css");
          body{
            background:#8585ad;
          }
        </style>
    </head>
    <body>
      <div id= "headerTop">
    <h1 > Technology Center: Checkout System </h1>
    <div id=input>
    <form>
      Device:  <input type="text" name="deviceName" placeholder="Device Name"/>
      Type:
      <select name="deviceType">
        <option value="">Select One</option>
        {
         <?=getDeviceTypes()?>
        }
      </select>
      <input type="checkbox" name="available" id="available"/>
      <label for="available">Available</label>
      <br>
            Order by:
            <input type="radio" name="orderBy" id="orderByName" value="name"/> 
             <label for="orderByName"> Name </label>
            <input type="radio" name="orderBy" id="orderByPrice" value="price" /> 
             <label for="orderByPrice"> Price </label>
      
        <input type="submit" value="Search!" name="submit"/>
    </form>
    </div>
    </div>
    <hr>
    <div id="displayDevices">
    <?=displayDevices()?>
    </div>
    <div id="windowframe">
    <iframe name="checkoutHistory" width="400" height="400"></iframe>
    </div>
    </body>
</html>