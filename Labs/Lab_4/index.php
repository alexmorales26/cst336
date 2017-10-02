<!DOCTYPE html>
<?php
    $backgroundImage = "img/sea.jpg";
    // APi call 
    if(isset($_GET['keyword'])){
        include 'api/pixabayAPI.php';
        
        $keyword=$_GET['keyword'];
        
        if(!empty($_GET['category']))
        {
            $keyword=$_GET['category'];
        }
        if(isset($_GET['layout']))
        {
              $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        }
        else{
        $imageURLs = getImageURLs($keyword);
        }
         $backgroundImage=$imageURLs[array_rand($imageURLs)];
    }
    
    function checkIfSelected($option)
    {
        if($option==$_GET['category'])
        {
            return "selected";
        }
    }
  
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         
        <style>
            @import url("css/styles.css");
            body{
                background-image:url('<?=$backgroundImage?>');
            }
        </style> 
        <title> Image Carousel</title>
    </head>
    <body>
    
    <br/> <br/>
      <form>
        <input type="text" name="keyword" placeholder ="keyword" value="<?=$_GET['keyword']?>">
        <div id="layoutDiv">
        <input type="radio" id="lhorizontal" name="layout" value="horizontal" <?=($_GET['layout']=='horizontal')?"checked":""?> ><label for="lhorizontal">Horizontal</label><br/>
        <input type="radio" id="lvertical" name="layout" value="vertical" <?=($_GET['layout']=='vertical')?"checked":""?>><label for="lvertical">Vertical</label><br/>
        </div>
        <br/>
        <select name="category" class="select">
            <option value="">Select One</option>
            <option <?=checkIfSelected('ocean')?>>sea</option>
            <option <?=checkIfSelected('Forest')?> >Forest</option>
            <option <?=checkIfSelected('Mountain')?>>Mountain</option>
        </select>
       <br/> <br/>
        <input type="submit" value="Search" />
    </form>
      <br/> <br/>
    <?php
    if(!isset($imageURLs)){ // form has not bee submitted
        echo "<h2> Type a key word to display a slideshow <br /> with random images from Pixabay.com </h2>";
    }
    else { // form has been submitted
        
         if(empty($_GET['category']) && empty($_GET['keyword']))
        {
            echo"<h2 style='color:red'>ERROR!You must type a keyword or select a category </h2>";
            return;
            exit;
        }
        
        
        
    ?>
    <!--<h1> im a regular</h1> -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- indicators -->
        <ol class="carousel-indicators">
            <?php
            for($i=0; $i < 5; $i++)
            {
            echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
            echo ($i==0)?"class='active'" : "";
            echo "></li>";
            }
            ?>
        </ol>
        <!-- wrapper of images --> 
        <div class="carousel-inner" role ="listbox">
        <?php
          for($i =0; $i < 5; $i++)
          {
            do{
                $randomIndex = rand(0, count($imageURLs));
            }
            while(!isset($imageURLs[$randomIndex])); // check if its in the array 
            
                echo '<div class="item ';
                echo ($i ==0)?"active":"";
                echo '">';
                echo '<img src="' . $imageURLs[$randomIndex] . '">';
                echo '</div>';
                unset($imageURLs[$randomIndex]); // delete from array 
            
           }
        ?>
        </div>
        <!-- controls -->
         <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
         </a>
         <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
          </a>
          </div>
           <?php
                }
           ?>
           <br>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>

</html>