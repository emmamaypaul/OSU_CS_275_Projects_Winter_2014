<?php

ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","XXXXXXXXXXXXXXX","pauli-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}

if(isset($_POST["runName"]) && !empty($_POST["runName"]) && isset($_POST['skillList']) && !empty($_POST['skillList']) && isset($_POST['lit']) && !empty($_POST['lit']))
{	//if the variables for the table are set and not empty, then we will prepare, bind, execute, and close

$query = "SELECT runs.name as FROM runs WHERE name=?";
if ($stmt = $mysqli->prepare($query))
{
		$runName = $_POST['runName'];
		$stmt->bind_param('s', $runName);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if ($numRows != 0)
			echo "Run name already exists. Please choose another name.";

		//$stmt->close(); //close statement 
		//close connection with $msqli->close()? don' tthink so 
		
	
		//echo "<br><br><form action='http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php' method='POST'>
//<div><input type='submit' value='Go Back'></div></form>";
		
	
?>	

<?php
		/*
if(!($tblInpt = $mysqli->prepare("INSERT INTO runs(name, lit, eid) VALUES (?, ?, ?)"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;}
		
			$newRun = $_POST['runName'];
			$lit = $_POST ['lit'];
			$skillID = $_POST['skillList'];

	//bind user supplied data to variables, "sis" means string, integer, string, with their respective variables they are assigned to
	//we need to bind the user info to variables in case someone ever tried in inject harmful code, binding their text to a variable prevents hacking
	if(!($tblInpt->bind_param("ssi", $newRun, $lit, $skillID)))
		echo "Binding parameters failed: (".$mysqli->errno.") ".$msqli->error;

	//execute the statement, returns true on success or FALSE on failure, errors stored in the statement object 
	//executing the variables and prepared table, executes the insert into from prepare 
	if(!$tblInpt->execute())
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	
	//closing after execution because if you don't close it and have unfetched rows you will get erros trying to make a new prepared statement
	$tblInpt->close();
}
//reference: http://www.php.net/manual/en/mysqli-stmt.num-rows.php
//reference: http://us.php.net/manual/en/mysqli-stmt.bind-param.php
//reference: http://mattbango.com/notebook/code/prepared-statements-in-php-and-mysqli/


$runResults =("SELECT DISTINCT runs.name AS runz, runs.lit AS litz, experience.name AS skillz
			FROM runs
			INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
			INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
			INNER JOIN experience ON experience.eid = runs.eid
			WHERE runs.name = '$newRun'");
		
echo $runResults;
	
	
	if($result3 = $mysqli->query($runResults))
	{
		$table2 = "<table><style>table , th, td
		{
			border-collapse:collapse;
			border: 1px solid black;
		}</style>";
		
	$table2=$table2."<tr><td><h2>Run Name</h2></td><td><h2>Lit? (1= Yes, 0=No)</h2></td><td><h2>Skill Level</h2></td></tr>";

	while($rowInfo2 = $result3->fetch_row()) //while there are rows to fetch 
	{	
		$table2 = $table2."<tr><td>".$rowInfo2['lifts']."</td><td>".$rowInfo2['lifts']."</td><td>".$rowInfo2['lifts']."</td></tr>";	
	}
		$table2 = $table2."</table>";
		echo $table2;
		$result3->free();
			
	}
	

/*
	
$selectRun = ("SELECT runs.id AS 'runID' FROM runs WHERE runs.name= '$newRun'");


if($result = $mysqli->query($selectRun))	
	
	
	while($row = $result->fetch_assoc())
	{
		$runID = $row['runID'];

	}
	
	if(!empty($_POST['liftList'])) 
	{
		foreach($_POST['liftList'] as $lift) 
		{
         
			if(!($stmt = $mysqli->prepare("INSERT INTO lift_to_runs(lftid,rid) VALUES (?,?)"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;}
			
			if(!($stmt->bind_param("ii",$lift,$runID))){
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;}
		
			if(!$stmt->execute()){
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;}
								
		}
		
		
	}
	
	$liftResults =("SELECT DISTINCT lift.name AS 'lifts'
						FROM runs
						INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
						INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
						WHERE runs.name = '$newRun'");
		

	
	
	if($result2 = $mysqli->query($liftResults))
	{
		$table = "<table><style>table , th, td
		{
			border-collapse:collapse;
			border: 1px solid black;
		}</style>";
		
	$table=$table."<tr><td><h2>Lifts Run Connects To</h2></td></tr>";

	while($rowInfo = $result2->fetch_assoc())
	{
		$table = $table."<tr><td>".$rowInfo['lifts']."</td></tr>";
		

	}
	$table = $table."</table>";
	echo $table;
	$result2->free();
	
	$mysqli->close();
			

?>

<?php

ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","XXXXXXXXXXXXXXX","pauli-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
	
	}
			
	$runResults =("SELECT DISTINCT runs.name AS runz, runs.lit AS litz, experience.name AS skillz
			FROM runs
			INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
			INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
			INNER JOIN experience ON experience.eid = runs.eid
			WHERE runs.name = '$newRun'");
		
echo $runResults;
	
	
	if($result3 = $mysqli->query($runResults))
	{
		$table2 = "<table><style>table , th, td
		{
			border-collapse:collapse;
			border: 1px solid black;
		}</style>";
		
	$table2=$table2."<tr><td><h2>Run Name</h2></td><td><h2>Lit? (1= Yes, 0=No)</h2></td><td><h2>Skill Level</h2></td></tr>";

	while($rowInfo2 = $result3->fetch_row()) //while there are rows to fetch 
	{	
		$table2 = $table2."<tr><td>".$rowInfo2['lifts']."</td><td>".$rowInfo2['lifts']."</td><td>".$rowInfo2['lifts']."</td></tr>";	
	}
		$table2 = $table2."</table>";
		echo $table2;
		$result3->free();
			
	}
	
	
	
	
	
	$mysqli->close();
			
*/
?>
	


<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php" method="POST">
<div><input type="submit" value="Go Back"></div>
</form>
