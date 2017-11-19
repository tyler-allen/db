<?php
    include("header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="move.php" method="GET">
        <input type="text" name="name" placeholder="ID To Move" />
	<p></p>
        <input type="text" name="location" placeholder="New Location" />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html> 

<?php
    $id = $_GET['name']; 
    $location = $_GET['location']; 
    $min_length = 1;
     
    if(strlen($id) >= $min_length){ // if query length is more or equal minimum length then
         
        $id = htmlspecialchars($id); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $id = mysqli_real_escape_string($sqldb, $id);
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
