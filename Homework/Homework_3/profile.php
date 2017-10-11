<?php
 include 'api/pixabayAPI.php';
 // if any of the fields are empty print error message 
if(empty($_GET['fName'])||empty($_GET['lName'])||empty($_GET['age'])||empty($_GET['uName'])||empty($_GET['gender'])||empty($_GET['bio']))
{
     echo"<h2 style='color:red'>ERROR!You must fill in all fields before submitting!Please click back on your browser to fix errors </h2>";
            return;
            exit;
}

function Name()
{
    echo $_GET['fName'] ." ". $_GET['lName'];
}

function User()
{
    echo "@" . $_GET['uName'];
}

function age()
{
    echo $_GET['age'];
}
function gender()
{
    echo $_GET['gender'];
}
function bio()
{
    echo $_GET['bio'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>MEAE VITAE::Profile</title>
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
    <header class="HeadersProf">MEAE VITAE</header>
    <br/> <br/>
    <div id="innerBody">
        <?php
          $imageURLs = getImageURLs($_GET['keyword']);
          $backgroundImage=$imageURLs[array_rand($imageURLs)];
          if(empty($imageURLs))
          {
                echo "<img id='otter' src='img/otterhead.jpg' width='50%'></img>";
          }
          else{
            echo "<img id='otter' src='$backgroundImage' width='50%'></img>";
          }
        ?>
        <div class="user">
        <h3 >Username: <?=User()?> </h3>
        <br/> <br/> <br/>
        <h3>My name is <?=Name()?>. I'm <?=age()?> year(s) old <?=gender()?>.
        My favorite animal are <?=$_GET['keyword']?>(s) as you can see as my profile picture.
        Here's a little something you should know about me: <?=bio()?> </h3>
    </div>
    <img id="buddy" src="img/buddy_verified.png"></img>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>