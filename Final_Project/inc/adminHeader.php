<!DOCTYPE html>
<html>
    <head>
        <title>Gamer Catalog</title>
                      
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <h1 id="MainTitle" style='text-align:center;'>Game Catalog</h1>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="admin.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link adder" href="addUser.php" id="add">Add User</a>
      </li>
      <li class="nav-item">
        <button class="dropdown-item reports btn-outline-success" type='button' id="report"> Number of Users Report</button>
      </li>
      <li class="nav-item">
        <button class="dropdown-item reports btn-outline-success" type='button' id="avg">Average price on Catalog Report</button>
      </li>
      <li class="nav-item">
        <button class="dropdown-item reports btn-outline-success" type='button' id="numG"> Most Expensive Item Report</button>
      </li>
      <li class="nav-item">
        <a class="nav-link del" href="#" id="delete">Delete Users</a>
      </li>
       <li class="nav-item">
        <form action="logOff.php">
            <button type="submit"class="btn btn-outline-danger btn-block" type="button" class="logff">Sign out</button>
        </form>
    </ul>
  </div>
</nav>
    </body>
</html>