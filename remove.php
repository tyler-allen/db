<?php include("header.php");?>
 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="remove.php" method="GET">
	<input type="text" name="id" placeholder="ID To Remove" />
	<p></p>
        <input type="submit" value="Submit" />
	<p></p>
    </form>
</body>
</html>

<?php
    //Gets ID of entry to be removed
    $id = $_GET['id']; 

    //Minimum ID length
    $min_length = 1;
     
    if(strlen($id) >= $min_length){ // if query length is more or equal minimum length then
         
        $id = htmlspecialchars($id); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $id = mysqli_real_escape_string($sqldb, $id);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($sqldb, "SELECT * FROM items WHERE id='".$id."'") 
		or die(mysqli_error($sqldb));

	if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            //Table headers     
            echo "<table> <tr> <th>Name</th> <th>Location</th><th>ID</th></tr>";

            $results = mysqli_fetch_array($raw_results);
                //Adds results to table
                echo "<tr> <td>".$results['name']."</td> <td>"
                        .$results['location']."</td>" . "<td>".$results['id']."</td></tr>";
            
            //Closes table
            echo "</table>"; 
        }

	$raw_results2 = mysqli_query($sqldb, "DELETE FROM items WHERE id='".$id."'") 
		or die(mysqli_error($sqldb));
	
	echo "Item: ". $id . " Deleted";
	echo "<a href=\"add.php?name=" . $results['name'] 
		. "&location=" . $results['location'] 
		. "\" class=\"button\">Undo</a>";
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
