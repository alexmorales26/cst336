<!DOCTYPE html>
<html>
    <head>
         <meta metacharset="utf-8"/>
         <?php
           include 'inc/functions.php';
         ?>
       <link href="css/styles.css" rel="stylesheet" type="text/css" />
       <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
        <title>PSN NAME GENERATOR </title>
    </head>
    <body id="body">
        <header id="title">
            Homework 2 
        </header>
         <div id="controller">
        <?php
        backgroundDisplay();
        ?>
    </div>
        <div id="image">
        <?php
            display();
        ?>
        </div>
    <div id="text">
    <?php
    $id=Generator();
    display_id($id);
    ?>
    </div>

    </body>
</html>