<?php include("header.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="add.php" method="GET">
	<input type="text" name="name" placeholder="Name" />
	<p></p>
	<input type="text" name="location" placeholder="Location" />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html>

<?php
    //Get name and location from address bar
    $name = $_GET['name']; 
    $location = $_GET['location']; 
     
    //Minimum name length
    $min_length = 1;
     
    if(strlen($name) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($name); 
        $query = htmlspecialchars($location); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($sqldb, $name);
        $query = mysqli_real_escape_string($sqldb, $location);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($sqldb, "INSERT INTO items (name, location) VALUES
            ( '" . $name . "', '" . $location . "' )") or die(mysqli_error($sqldb));
	
	echo "Added entry: " . $name . " At: " . $location;
         
   }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
