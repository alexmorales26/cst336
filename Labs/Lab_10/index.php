<?php
//print_r($_FILES);
function gall(){
echo"File Size :" . $_FILES['myFile']['size'] ."<br><br>";
if($_FILES['myFile']['size'] > 100000000){
       echo " <br> <h2> Image Too Big </h2>";
   // header('Location:index.php');
   
}
else{
    move_uploaded_file($_FILES["myFile"]["tmp_name"], "gallery/". $_FILES["myFile"]["name"] );
    
    $files = scandir("gallery/",1);
    for($i =0; $i < count($files)-2 ; $i++){
        echo "<img src='gallery/". $files[$i] . "' width='50' class='pics'>";
    }
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 10: Photo Gallery </title>
        <style>
        body{
            background-color:lightgray;
        }
            .pics:active
            {
            -webkit-transform: scale(4);
            -ms-transform: scale(4);
            transform: scale(4);
            width:40%;
            margin:auto;
            }
            h1{
                text-align:center;
                color:red;
            }
            .stuff{
                width:30%;
                margin:auto;
            }
        </style>
        <script>
            
        </script>
    </head>
    <body>
<h1>Photo Gallery </h1>
<div class="stuff">
<form method="POST" enctype="multipart/form-data">

    <input type="file" name="myFile"/>
    <input type='submit' value='Upload File!' name="submit"/><br><br>
     <?=gall()?>
</form>
</div>
    </body>
</html>