<?php include("header.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Remove Entry</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <form action="remove.php" method="POST">
        <input type="text" name="id" placeholder="ID To Remove" />
	<p></p>
        <input type="submit" name="submit" value="Submit" />
	<p></p>
        <input type="submit" name="submitLoc" value="Submit Location" />
	<p></p>
    </form>
</body>
</html> 

<?php
    //Gets ID and new location
    $id = $_POST['id']; 

    //Minimum ID length
    $min_length = 1;
    
    if(strlen($id) >= $min_length){ // if query length is more or equal minimum length then
         
        $id = htmlspecialchars($id); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $id = mysqli_real_escape_string($sqldb, $id);
        // makes sure nobody uses SQL injection
    }

    if(isset($_POST['submit'])) {
        $raw_results = mysqli_query($sqldb, "SELECT * FROM items WHERE id='".$id."'") 
                or die(mysqli_error($sqldb));

        $raw_results2 = mysqli_query($sqldb, "DELETE FROM items WHERE id='".$id."'") 
                or die(mysqli_error($sqldb));
    
    }
    elseif(isset($_POST['submitLoc'])) {
        $raw_results = mysqli_query($sqldb, "SELECT * FROM locations WHERE id='".$id."'") 
                or die(mysqli_error($sqldb));

        $raw_results2 = mysqli_query($sqldb, "DELETE FROM locations WHERE id='".$id."'") 
                or die(mysqli_error($sqldb));

    }
    if(isset($_POST['submit']) || isset($_POST['submitLoc'])) {
	echo "<table> <tr> <th>Name</th> <th>Location</th><th>ID</th></tr>";
	$results = mysqli_fetch_array($raw_results);
	echo "<tr> <td>".$results['name']."</td> <td>".$results['location']."</td>" . "<td>".$results['id']."</td></tr>";
	echo "</table>"; 
    }
?>
</body>
</html>
