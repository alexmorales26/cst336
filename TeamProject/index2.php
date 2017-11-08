<?php
    // Index page
    session_start();
    //$_SESSION['Movie'];
    include 'dbCon.php';
    $conn = getDatabaseConnection();
    include 'inc/functions.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title> BLOCKBUSTER 2.0 | Homepage </title>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script>
        if ( $.browser.webkit ) {
            $(".my-group-button").css("height","+=1px");
        }
    </script>
  </head>
  <body>
    <h1><a href="index.php" id="titleMovie"> BLOCKBUSTER 2.0  </a></h1>
        
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <ul class="nav navbar-nav">
                        <li class="active"><a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Movie Database</a></li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="Popularity.php">Popular</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><form class="navbar-form" action="index.php">
                            <li><button type="submit" name="random" class="btn btn-link">Random</button></li>
                        </form></li>               
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">More
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <form class="navbar-form">
                                    <li><button type="submit" name="length" class="btn btn-link">Length</button></li>
                                    <li><button type="submit" name="newest" class="btn btn-link">Newest</button></li>
                                    <li><button type="submit" name="oldest" class="btn btn-link">Oldest</button></li>
                                    <li><button type="submit" name="a-z" class="btn btn-link">A-Z</button></li>
                                    <li><button type="submit" name="z-a" class="btn btn-link">Z-A</button></li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="input-group my-group">
                            <input type="text" name="movieSelect" class="form-control" placeholder="Search Movie">
                            <span class="input-group-btn" style="width:0px;"></span>
                            <select name="genre" class="selectpicker form-control" data-live-search="true">
                                <option value="" disabled selected>Genre</option>
                                <option value="Crime">Crime</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Action">Action</option>
                                <option value="Science Fiction">Science Fiction</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Drama">Drama</option>
                                <option value="Music">Music</option>
                                <option value="Psychological">Psychological</option>
                                <option value="Horror">Horror</option>
                                <option value="Romance">Romance</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Indie">Indie</option>
                            </select>
                            <span class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-default my-group-button ">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        

    <?php
      //$movies = displayMovies(); 
      // foreach($movies as $movies){
      //   echo $movies['movieId']. ' ' .$movies['movieName']. ' ' .$movies['movieGenre']; 
      //   echo "<br>"; 
      // }
    ?>
    <script src="js/javafunctions.js"></script>
  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Movie Name</th>
          <th>Genre</th>
          <th>Year</th>
          <th>Length</th>
          <th>Info</th>
        </tr>
      </thead>
      <tbody>
      <?=displayMovies2()?>
      </tbody>
      </table>
      
       <ul class="pager">
          <li><a href="index.php">Previous Page</a></li>
       </ul> 
  </div>
  </body>
</html>