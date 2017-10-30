<?php

 function checkLogin() {
        if($_GET['login'] == "Error") {
            echo "<h2>Wrong Credentials!</h2>";
        }
    }


?>
<!DOCTYPE html>
<html>
    <head>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <title>Lab 6: Admin Login Page</title>
        <style>
        h1{
            text-align:center;
        }
        div{
            margin:auto;
              
               display: block;
                width: 20%;
        }
        </style>
    </head>
    <body>
        <h1 class="display-3">Admin Login</h1>
        <hr>
        <?=checkLogin()?>
        <form method="POST" action="loginProcess.php">
            <div>
            Username: <input type="text" name="username"class="form-control"/> <br/>
            
            Password: <input type="password" name="password"class="form-control"/> <br/>
            
        <br/>
            <input type="submit" name="login" value="Login"type="button" class="btn btn-outline-success btn-primary btn-lg btn-primary btn-lg btn-block"/>
                </div>
        </form>
        

    </body>
</html>