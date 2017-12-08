<?php
include 'inc/adminHeader.php';
session_start();
if(!isset($_SESSION['username'])) // validates that the admin is logged in
{
    header("Location: index.php");
}

echo " <h2 class='display-4' style='text-align:center;'>Welcome, " .$_SESSION['adminFullName'] ."!</h2>";
include'../dbConnection.php';
function displayUsers()
{
 echo " <h3 class='display-5' style='text-align:center;'>User Table</h3>";

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
            echo "<td><form action='update.php'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Update'<button type='button' class='btn btn-outline-success'</button></form></td>";
          //  echo "<td><form action='deleteUser.php' onsubmit='return confirmDelete(\"".$r['firstName']."\")'><input type='hidden' name='userId' value='".$r['userId']."'><input type='submit' value='Delete'<button type='button' class='btn btn-outline-danger'></form></td></tr>";
        }
    
    echo "</table>";
}

?>
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> User Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body information">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- avg -->
<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Average price on catalog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body info">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- consoles -->
<!-- Modal -->
<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Most Expensive Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body info2">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
   // document.getElementById("sign").setAttribute("display","none");
   // document.getElementById("search").setAttribute("display","none");
   $("#delete").click(function(){
       if(confirm("If You proceed. Any users deleted will be permanately deleted from our system!")){
           location.href="delete.php";
       }
      
   });
   
   $("#report").click(function(){
    //module
     $("#Modal").modal("show");
     $(".information").html("");
         $.ajax({
     
               type: "GET",
               url: "retrieveUserDB.php",
               dataType: "json",
              // data: {"":""},
               success: function(data,status) {
                  $(".information").append("<h2>Number of Users: "+ data[0].total +"</h2><br>");
               },
               complete: function(data,status) { //optional, used for debugging purposes
               //alert(status);
               }
            
     });//ajax
   });
    
     $("#avg").click(function(){
    //module
     $("#Modal2").modal("show");
     $(".info").html("");
         $.ajax({
     
               type: "GET",
               url: "tableDB.php",
               dataType: "json",
              // data: {"":""},
               success: function(data,status) {
               // var counter=0,count=0;
                // for(var i =0; i < data.length;i++){
                //  count++;
                // }
                  $(".info").append("<h2> Average price on catalog: $"+data[0].average+".00</h2><br>");
               
               },
               complete: function(data,status) { //optional, used for debugging purposes
               //alert(status);
               }
            
     });//ajax
   });
     $("#numG").click(function(){
    //module
     $("#Modal3").modal("show");
     $(".info2").html("");
         $.ajax({
     
               type: "GET",
               url: "consoleDB.php",
               dataType: "json",
              // data: {"":""},
               success: function(data,status) {
                $(".info2").append("<h2> Most Expensive Item:$"+data[0].maximum+".00</h2><br>");
              //    $(".info2").append("<h2>"+ data[0].maximum +"</h2><br>");
                 
               
               },
               complete: function(data,status) { //optional, used for debugging purposes
               //alert(status);
               }
            
     });//ajax
   });
</script>

<?php 
displayUsers();
include"inc/footer.php";
?>