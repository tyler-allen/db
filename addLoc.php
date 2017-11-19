<?php
    include("header.php");
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="addLoc.php" method="GET">
	<input type="text" name="name" placeholder="Storage Name" />
	<p></p>
	<input type="text" name="location" placeholder="Location/Room" />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html>

<?php
    $name = $_GET['name']; 
    $location = $_GET['location']; 
    // gets value sent over search form
     
    $min_length = 1;
    // you can set minimum length of the query if you want
     
    if(strlen($name) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($name); 
        $query = htmlspecialchars($location); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($sqldb, $name);
        $query = mysqli_real_escape_string($sqldb, $location);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($sqldb, "INSERT INTO locations (name, location) VALUES
            ( '" . $name . "', '" . $location . "' )") or die(mysqli_error($sqldb));
        echo "Added entry: " . $name . " At: " . $location;
         
   }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
