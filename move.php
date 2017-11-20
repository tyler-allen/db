<?php include("header.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="move.php" method="GET">
        <input type="text" name="id" placeholder="ID To Move" />
	<p></p>
        <input type="text" name="location" placeholder="New Location" />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html> 

<?php
    //Gets ID and new location
    $id = $_GET['id']; 
    $location = $_GET['location']; 

    //Minimum ID length
    $min_length = 1;
     
    if(strlen($id) >= $min_length){ // if query length is more or equal minimum length then
         
        $id = htmlspecialchars($id); 
        $location = htmlspecialchars($location); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $id = mysqli_real_escape_string($sqldb, $id);
        $location = mysqli_real_escape_string($sqldb, $location);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($sqldb, "UPDATE items SET location='".$location."' WHERE id= '".$id."'") 
		or die(mysqli_error($sqldb));
	
	echo "Item moved to: " . $location;
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
