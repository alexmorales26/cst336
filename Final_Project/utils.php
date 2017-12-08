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
    function gameC() {
          alert("hello");
       }
</script>
<div class="modal fade" id="InfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign-In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="dbAdmin.php">
  <div class="form-group">
    <label for="InputEmail1">Username</label>
    <input type="text" class="form-control" id="InputEmail1" name="InputEmail" aria-describedby="emailHelp" placeholder="Enter username" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your Information with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="InputPassword1" name="InputPassword" placeholder="Enter Password" required >
  </div>
  <div id="success" style="color:red;">
  </div>
    <button  type="submit" type="button" class="btn btn-primary" name="login" value="login" id="logger" style="margin-left:100px; width:50%;">Login</button>
</form>
      </div>
    </div>
  </div>
</div>