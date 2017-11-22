<?php include("header.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Add Entry</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="add.php" method="POST">
	<input type="text" name="name" placeholder="Name" />
	<p></p>
	<input type="text" name="location" placeholder="Location" />
	<p></p>
        <input type="submit" name = "submit" value="Submit" />
	<p></p>
        <input type="submit" name = "submitLoc" value="Submit Location" />
	<p></p>
    </form>
</body>
</html>

<?php
    //Get name and location from address bar
    $name = $_POST['name']; 
    $location = $_POST['location']; 
     
    //Minimum name length
    $min_length = 1;

    if(strlen($name) >= $min_length){ // if query length is more or equal minimum length then
	$name = htmlspecialchars($name); 
	$location = htmlspecialchars($location); 
	// changes characters used in html to their equivalents, for example: < to &gt;
	 
	$name = mysqli_real_escape_string($sqldb, $name);
	$location = mysqli_real_escape_string($sqldb, $location);
	// makes sure nobody uses SQL injection
    }

    if(isset($_POST['submit'])){ 
	$raw_results = mysqli_query($sqldb, "INSERT INTO items (name, location) VALUES
	    ( '" . $name . "', '" . $location . "' )") or die(mysqli_error($sqldb));
	
	echo "<table> <tr> <th>Name</th> <th>Location</th></tr>";
        echo "<tr> <td>".$name."</td> <td>".$location."</td></tr>";
        echo "</table>"; 
    }
    elseif(isset($_POST['submitLoc'])){
	$raw_results = mysqli_query($sqldb, "INSERT INTO locations (name, location) VALUES
	    ( '" . $name . "', '" . $location . "' )") or die(mysqli_error($sqldb));
	
	echo "<table> <tr> <th>Name</th> <th>Location</th></tr>";
        echo "<tr> <td>".$name."</td> <td>".$location."</td></tr>";
        echo "</table>"; 
    }
?>
</body>
</html>
