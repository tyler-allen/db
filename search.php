<?php include("header.php");?>
 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="search.php" method="POST">
	<input type="text" name="query" placeholder="Name" />
	<p></p>
        <input type="submit" name = "submit" value="Submit" />
	<p></p>
        <input type="submit" name = "submitLoc" value="Submit Location" />
        <p></p>
    </form>
</body>
</html>
   
<?php
    $query = $_POST['query']; 

    //Minimum name length
    $min_length = 1;
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
	
	$query = mysqli_real_escape_string($sqldb, $_POST['query']);
        // makes sure nobody uses SQL injection
    }
    if(isset($_POST['submit'])){
        $raw_results = mysqli_query($sqldb, "SELECT * FROM items
            WHERE `name` LIKE '%".$query."%'") or die(mysqli_error($sqldb));
    }     
    elseif(isset($_POST['submitLoc'])){
        $raw_results = mysqli_query($sqldb, "SELECT * FROM locations
            WHERE `name` LIKE '%".$query."%'") or die(mysqli_error($sqldb));
    }
    if(isset($_POST['submit']) || isset($_POST['submitLoc'])){
	if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
	    //Table headers	
	    echo "<table> <tr> <th>Name</th> <th>Location</th><th>ID</th></tr>";

	    while($results = mysqli_fetch_array($raw_results)){
		//Adds results to table
		echo "<tr> <td>".$results['name']."</td> <td>"
		.$results['location']."</td>" . "<td>".$results['id']."</td></tr>";
	    }
	    //Closes table
	    echo "</table>"; 
	}
	else{ // if there is no matching rows do following
	    echo "No results";
	}
    }
?>
</body>
</html>
