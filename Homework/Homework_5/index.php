<!DOCTYPE html>
<html>
    <head>
        <title>WIKI-MART</title>
        <style>
            @import url("css/styles.css");
        </style>
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    </head>
    <body>
<header>
    <h1  id="TITLE" class="display-4">WIKI-MART Item Finder</h1>
    <br><br><br><br><br><br><br><hr>
</header>
<form method="GET">
    <div id="forms">
    <input type="text" id="item" placeholder="Search Inventory "/>
    <br><br>
    Category: <select id="category">
        <option value="default">select One</option>
        <option value="games">Video Games</option>
        <option values="tech">Electronics</option>
        <option values="blah">Everything else</option>
            </select>
            <br>
    <input class="btn-primary" type="button" value="Submit" id="submit"/>
    </div>
</form>
    <div id="game"></div>
    <div id="techno"></div>
    <div id="else"></div>
<script src="js/script.js"></script>
<img src="buddy_verified.png"></img>
    </body>
</html>