<?php
    //Error reporting
    //ini_set('error_reporting', E_ALL);
    //ini_set('display_errors', 'On');  //On or Off

    //SQL Connection
    $sqldb = mysqli_connect("localhost", "pub", "qelc27c", "items") 
	or die("Error connecting to database: ".mysql_error());

    //Setup NavBar
    include("navBar.html");
    echo "<p></p>";
?>
