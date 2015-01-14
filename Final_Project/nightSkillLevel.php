<?php
ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above 

//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST['skillList']))
{
	$skillLevel = $_POST['skillList'];
	$skillQuery = ("SELECT COUNT(DISTINCT runs.name) AS 'Run Count', 
				resort.name AS 'Resort Name'                            
				FROM runs
				INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
				INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
				INNER JOIN lodge ON lodge.lid = lift.lid
				INNER JOIN resort ON resort.rid = lodge.rid
				INNER JOIN experience ON experience.eid = runs.eid
				WHERE lit= 1 AND experience.eid = ' $skillLevel '
				GROUP BY resort.name");

}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");

if (mysqli_connect_errno())
{
	echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}


if($result = $mysqli->query($skillQuery))
{
$table = "<table><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>
";
	$table=$table."<tr><td>Number or runs</td><td>Resort Name</td></tr>";

	while($row = $result->fetch_assoc())
	{
		$table = $table."<tr><td>".$row['Run Count']."</td><td>".$row['Resort Name']."</td></tr>";

	}
	$table = $table."</table>";
	echo "<h2> Night Skiing Info: </h2>";
	echo $table;
	$result->free();
}

$mysqli->close();

?>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>
