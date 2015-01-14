$runName = $_POST['runName'];

	$query = "SELECT runs.name FROM runs WHERE name=?";

	if ($stmt = $mysqli->prepare($query))
	{
		
		$stmt->bind_param('s', $runName);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
	
		if ($numRows != 0)
		{
			echo "Run name already exists. Please choose another name.";
			$stmt->close(); //close statement 
			echo "<br><br><form action='http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php' method='POST'>
			<div><input type='submit' value='Go Back'></div></form>";
		}
		
		else
		{
		
		
		
		
		
		
		
		<?php

ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
		
if(isset($_POST["runName"]) && !empty($_POST["runName"]) && isset($_POST['skillList']) && !empty($_POST['skillList']) && isset($_POST['lit']) && !empty($_POST['lit']))
{	//if the variables for the table are set and not empty, then we will prepare, bind, execute, and close

	
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

			//reference: http://www.php.net/manual/en/mysqli-stmt.num-rows.php
			//reference: http://us.php.net/manual/en/mysqli-stmt.bind-param.php
			//reference: http://mattbango.com/notebook/code/prepared-statements-in-php-and-mysqli/

			
			
			echo "Run Added. <br><br><form action='http://web.engr.oregonstate.edu/~paule/CS%20275/.php' method='POST'>
			<div><input type='submit' value='Go Back'></div></form><br><br><form action='http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php' method='POST'>
			<div><input type='submit' value='Go Back'></div></form>"
			
			
			

			$runResults =("SELECT DISTINCT runs.name AS runz, runs.lit AS litz, experience.name AS skillz
					FROM runs
					INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
					INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
					INNER JOIN experience ON experience.eid = runs.eid
					WHERE runs.name = '$newRun' AND runs.lit='$lit' AND experience.name='$skillID'");
		
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
					$table2 = $table2."<tr><td>".$rowInfo2['runz']."</td><td>".$rowInfo2['liftz']."</td><td>".$rowInfo2['skillz']."</td></tr>";	
				}
					$table2 = $table2."</table>";
					echo $table2;
					$result3->free();
			
			}
		
		
		}
	
		
	}

}

?>	



<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php" method="POST">
<div><input type="submit" value="Go Back"></div>
</form>



<?php
/*
ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above 


//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST["liftName"]) && !empty($_POST["liftName"]) && isset($_POST["resortList"]) && !empty($_POST["resortList"]) && isset($_POST["lodgeList"]) && !empty($_POST["lodgeList"]))
{
	$resortId = $_POST["resortList"];
	$lodgeId = $_POST["lodgeList"];
	$liftName = $_POST["liftName"];
	
	$liftQuery = sprintf("SELECT lift.name AS 'Lift Name', resort.name AS 'Resort', lodge.name AS 'Lodge'
				FROM lift 
				INNER JOIN resort ON resort.rid = lift.rid
				INNER JOIN lodge ON lodge.lid = lift.lid
				WHERE lift.name = $liftName;");
}
	
//newest attempt using http://php.net/manual/en/mysqli-result.fetch-assoc.php

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");

if (mysqli_connect_errno())
{
	echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}


if($result = $mysqli->query($liftQuery))
{

<?php
ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
	else 
	{
		echo "Connection success. Table was successfully created.";
	}
	

if(isset($_POST["liftName"]) && !empty($_POST["liftName"]) && isset($_POST["resortList"]) && !empty($_POST["resortList"]) && isset($_POST["lodgeList"]) && !empty($_POST["lodgeList"]))
{	//if the variables for the table are set and not empty, then we will prepare, bind, execute, and close
	

	//make prepared statement using the mysqli objects prepare method 	
	//prepare will return false on an error and the error should be stored in the mysqli object 
	//step below returns statement object 
	if(!($tblInpt = $mysqli->prepare("INSERT INTO lift(rid, lid, name) VALUES(?,?,?)")))
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
		
		$resortId = $_POST["resortList"];
		$lodgeId = $_POST["lodgeList"];
		$liftName = $_POST["liftName"];
		
	//bind user supplied data to variables, "sis" means string, integer, string, with their respective variables they are assigned to
	//we need to bind the user info to variables in case someone ever tried in inject harmful code, binding their text to a variable prevents hacking
	if(!($tblInpt->bind_param("iis", $resortId, $lodgeId, $liftName)))
		echo "Binding parameters failed: (".$mysqli->errno.") ".$msqli->error;

	//execute the statement, returns true on success or FALSE on failure, errors stored in the statement object 
	//executing the variables and prepared table, executes the insert into from prepare 
	if(!$tblInpt->execute())
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	
	//closing after execution because if you don't close it and have unfetched rows you will get erros trying to make a new prepared statement
	$tblInpt->close();	
}
	
	
//reference: http://stackoverflow.com/questions/18299405/php-get-the-last-row-in-database-using-mysql
//reference: http://stackoverflow.com/questions/1765861/how-to-get-last-10-records-form-sql-table-in-asc-order
$data = $mysqli->query("SELECT lift.name AS 'Lift Name', resort.name AS 'Resort', lodge.name AS 'Lodge'
				FROM lift 
				INNER JOIN resort ON resort.rid = lift.rid
				INNER JOIN lodge ON lodge.lid = lift.lid
				WHERE lift.name = $liftName;");

if($result = $mysqli->query($data))
{
$table = "<table><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>
";
	$table=$table."<tr><td><h2>Lift Name</h2></td><td><h2>Resort Located</h2></td><td><h2>Lodge Connected To</h2></td></tr>";

	//$runCnt = $row['Run Count'];
	//$rstNm =  $row['Resort Name'];
	while($row = $result->fetch_assoc())
	{
		$table = $table."<tr><td>".$row['Lift Name']."</td><td>".$row['Resort']."</td><td>".$row['Lodge']."</td></tr>";

	}
	$table = $table."</table>";
	echo "Lift Successfully Added";
	echo $table;
	$result->free();
}

$mysqli->close();
*/