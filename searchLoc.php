<?php include("header.php");?>
 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="searchLoc.php" method="GET">
	<input type="text" name="query" placeholder="Search..." />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html>

<?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    //$min_length = 1;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($sqldb, $query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($sqldb, "SELECT * FROM items
            WHERE `location` LIKE '".$query."'") or die(mysqli_error($sqldb));
             
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
	    //Header: Location being searched	
	    echo "<table class=\"table table2\"> <tr> <th>Name</th> <th>ID</th></tr>";

            while($results = mysqli_fetch_array($raw_results)){
                //Adds results to table
                echo "<tr> <td>".$results['name']."</td> <td>".$results['id']."</td></tr>";
            }
            //Closes table
            echo "</table>"; 
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
