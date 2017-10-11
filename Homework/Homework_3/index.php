<?php
 function selected($opt)
    {
        if($opt==$_GET['age'])
        {
            return "selected";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>MEAE VITAE</title>
        <style>
            @import url("css/styles.css");
        body{
                background-image:url("img/LA.jpg");
                position:absolute;
                background-repeat: no-repeat !important;
                background-position: center;
                background-size:cover;
                background-attachment: fixed;
                max-width: 100%;
                overflow-x: hidden;
            }
        </style>
    </head>
    <body>
    <header class="Headers">MEAE VITAE</header>
    <br/> <br/>
    <div class="Cprof">
    <h2 id="titlo">Create profile </h2>
    </div>
    <div class="col-lg-10 col-lg-offset-4">
         <form  action = "index.php" method ="GET" class="forms" >
                <div class="input-group col-xs-4">
                  <span class="input-group-addon"  id="basic-addon1">UserName</span>
                  <input type="text" class="form-control" name="uName" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                <br/> <br/>
                 <div class="input-group col-xs-4">  
                  <span class="input-group-addon" id="basic-addon1">First Name</span>
                  <input type="text" class="form-control" name="fName" placeholder="First Name" aria-describedby="basic-addon1">
                </div>
                 <br/> <br/>
                 <div class="input-group col-xs-4">
                  <span class="input-group-addon"  id="basic-addon1">Last Name</span>
                  <input type="text" class="form-control"name="lName" placeholder="Last Name" aria-describedby="basic-addon1">
                </div>
                 <br/>
                 <h2 class="subheadings">Gender</h2>
                <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender" value="female">
                Female
              </label>
            </div>
            <div class="form-check enabled">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gender"value="male">
                Male
              </label>
            </div>
            <br/> <br/>
              <div class="form-group col-xs-4">
                <label for="exampleSelect1"class="subheadings">Age</label>
                <select class="form-control" name='age' id="exampleSelect1">
                    <option value="">Am I an Adult ?</option>
                  <option <?=selected('18')?>>18</option>
                  <option<?=selected('19')?>>19</option>
                  <option<?=selected('20')?>>20</option>
                  <option<?=selected('21')?>>21</option>
                  <option<?=selected('22')?>>22</option>
                  <option<?=selected('23+')?>>23+</option>
                </select>
              </div>
              <br/> <br/><br/> <br/> <br/> <br/>
              <div class="input-group col-xs-4">
                  <span class="input-group-addon" id="basic-addon1">Favorite Animal?</span>
                  <input type="text" class="form-control" name="keyword" placeholder="Animal" value="" aria-describedby="basic-addon1">
                </div>
              <h2 class="subheadings">Bio</h2>
              <textarea class="form-control" name="bio" rows="3"></textarea>
               <br/> <br/><br/> 
              <button type="submit" name="submitBtn"class="btn btn-primary btn-lg"formaction="profile.php" >Submit</button>
               <br/> <br/><br/> 
          </form>
 </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>