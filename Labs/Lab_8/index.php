
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>AJAX: Sign Up Page</title>
<style type="text/css" id="diigolet-chrome-css">
 @import url("styles.css");
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script>

function checkPassword(){
       var pass = document.getElementById("fig");
       var pass2= document.getElementById("fig2");
       if(pass.value == pass2.value){
           $("#result").html("success");
       }
       else{
           $("#result").html("incorrect password try again!");
       }
}
    function getCity() {
        $.ajax({

            type: "GET",
            url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
            dataType: "json",
            data: { "zip": $("#zip").val()},
            success: function(data,status) {
              
          //   alert(data.city);
            $("#city").html(data.city);
             $("#lat").html(data.latitude);
            $("#long").html(data.longitude);
            },
            //complete: function(data,status) { //optional, used for debugging purposes
            //if(status=='error'){
            //alert(status);}
            
            //}
            error: function(status) {
            $("#zip").html("error");
            }
});//ajax
        
    }
     function getCounties() {
        
        //alert("You've selected state: " + $("#stateId").val());
        $.ajax({
        
        type: "GET",
        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
        dataType: "json",
        data: { "state": $("#stateId").val()},
        success: function(data,status) {
         //alert(data[0].county)
         $("#countyId").html("<option> Select One </option>");
         for (var i=0; i < data.length; i++){
         $("#countyId").append("<option>"+data[i].county+"</option>");
         }
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
        });//ajax
     }
     function checkUsername() {
        //alert("hello")
        $.ajax({
            type: "GET",
            url: "checkUserName.php",
            dataType: "json",
            data: { "username": $("#username").val()},
            success: function(data,status) {
                $("#available").html("");
                  $("#unavailable").html("");
               if (!data) {
                   
                  // alert("USERNAME AVAILABLE!");
                  $("#available").html("<strong>available</strong>");
               } else {
                   
                  // alert ("username already taken!");
                   $("#unavailable").html("<strong>unavailable </strong>");
               }
            
            }//,
            //complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            //}
            
            });//ajax
    }
      //event handlers
    
    $(document).ready(  function(){
        
        $("#zip").change( function(){ getCity(); } );
        $("#stateId").change(function(){getCounties(); });
        $("#username").change( function(){ checkUsername(); } );
        $("#result").change(function(){checkPassword();  });
        
    } ); //documentReady
</script>

</head>

<body id="dummybodyid">

   <h1 class="display-1"> Sign Up Form </h1>

    <form>
        <fieldset>
           <legend >Sign Up</legend>
           <div class="form-group">
            First Name:  <input type="text" class="form-control" required><br> 
            Last Name:   <input type="text" class="form-control"required><br> 
            Email:       <input type="text" class="form-control"required><br> 
            Phone Number:<input type="text" class="form-control"required><br>
            Zip Code:    <input type="text" id="zip" onchange="getCity()" maxlength="5" size="5" class="form-control"required><br>
            City: <span id="city" class="form-control"required></span> 
            <br>
            Latitude: <span id="lat" class="form-control"></span> 
            <br>
            Longitude:<span id="long" class="form-control col-xs"></span> 
            <br>
            <form class="form-inline">
            <div class="form-group">
            State: <select id="stateId" name="state" class="btn btn-default dropdown-toggle form-control" required>
                <option value="">Select One</option>
                <option value="ca"> California</option>
                <option value="ny"> New York</option>
                <option value="tx"> Texas</option>
                <option value="va"> Virginia</option>

            </select></br></br>
            Select a County: <select id="countyId"class="btn btn-default dropdown-toggle form-control" required></select><br>
            </div></form>
            Desired Username: <input type="text" id="username"class="form-control" required><div id="available"style="color:green;"></div><div id="unavailable" style="color:red;"></div>
            Password: <input type="password"class="form-control" id='fig' required><br>
            Type Password Again: <input type="password" class="form-control" id='fig2'required><br>
            <input type="submit" name='submit' class="btn btn-success btn-block" onclick="return checkPassword()" value="Sign up!">
            <div id=result></div>
            
            </div>
        </fieldset>
    </form>




</div></body></html>