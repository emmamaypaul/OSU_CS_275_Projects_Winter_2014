<?php
ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above 

//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST['liftNames'])&& !empty($_POST["liftNames"]) && isset($_POST['skillList'])&& !empty($_POST["skillList"]))
{
	$skill = $_POST['skillList'];
	$lift = $_POST['liftNames'];
	
	$rQuery = ("SELECT runs.name AS 'Runs'
			FROM runs 
			INNER JOIN experience ON experience.eid = runs.eid
			INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
			INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
			INNER JOIN lodge ON lodge.lid = lift.lid
			INNER JOIN resort ON resort.rid = lodge.rid
			AND lift.lftid = '$lift'
			AND experience.eid = '$skill'
			GROUP BY runs.name");
	
}

//newest attempt using http://php.net/manual/en/mysqli-result.fetch-assoc.php

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");

if (mysqli_connect_errno())
{
	echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}


if($result = $mysqli->query($rQuery))
{
		$table = "<table><style>table , th, td
		{
			border-collapse:collapse;
			border: 1px solid black;
		}</style>";
		
		$table=$table."<tr><td><h3>Runs to Take</h3></td></tr>";

	while($row = $result->fetch_assoc())
	{
		$table = $table."<tr><td>".$row['Runs']."</tr></td>";

	}
	$table = $table."</table>";
	echo "<h2>Based on the lift and skill level you choose, these are the runs you should take: </h2>";
	echo $table;
	$result->free();
}

$mysqli->close();

?>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>
