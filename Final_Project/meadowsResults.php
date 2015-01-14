<?php
ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above 

//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST['skillList']))
{
	$lift= $_POST['lifts'];
	$skillLevel = $_POST['skillLevel'];
	$runQuery =("SELECT runs.name AS 'Run'
				FROM runs
				INNER JOIN experience ON experience.eid = runs.eid
				INNER JOIN lift_to_runs on lift_to_runs.rid = runs.id
				INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
				INNER JOIN lodge ON lodge.lid = lift.lid
				INNER JOIN resort ON resort.rid = lodge.rid
				WHERE resort.rid = '1' AND lift.lftid =  ' 1 ' AND experience.eid = ' 1 '
				GROUP BY runs.name");
				
				

}
echo $runQuery;
echo $lift;

//newest attempt using http://php.net/manual/en/mysqli-result.fetch-assoc.php

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");

if (mysqli_connect_errno())
{
	echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}


if($result = $mysqli->query($runQuery))
{
$table = "<table><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>
";
	$table=$table."<tr><td>Runs to take</td></tr>";

	while($row = $result->fetch_assoc())
	{
		$table = $table."<tr><td>".$row['Run']."</td></tr>";

	}
	$table = $table."</table>";
	echo "<h2> Day Skiing Info: </h2>";
	echo $table;
	$result->free();
}

$mysqli->close();

//remember to escape values (function for it) 


?>


<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/meadows.php" method="POST">
<div><input type="submit" value="Go back"></div>
</form>