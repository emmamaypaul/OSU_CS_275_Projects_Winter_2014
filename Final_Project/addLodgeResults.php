<?php

ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","XXXXXXXXXXXX","pauli-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
	
	
if(isset($_POST["lodgeName"]) && !empty($_POST["lodgeName"]) && isset($_POST["resortList"]) && !empty($_POST["resortList"]))
{	//if the variables for the table are set and not empty, then we will prepare, bind, execute, and close
	

	//make prepared statement using the mysqli objects prepare method 	
	//prepare will return false on an error and the error should be stored in the mysqli object 
	//step below returns statement object 
	if(!($tblInpt = $mysqli->prepare("INSERT INTO lodge(name, rid) VALUES(?,?)")))
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
		
		$lodgeName = $_POST['lodgeName'];
		$resortID = $_POST['resortList'];
		
	//bind user supplied data to variables, "sis" means string, integer, string, with their respective variables they are assigned to
	//we need to bind the user info to variables in case someone ever tried in inject harmful code, binding their text to a variable prevents hacking
	if(!($tblInpt->bind_param("si", $lodgeName, $resortID)))
		echo "Binding parameters failed: (".$mysqli->errno.") ".$msqli->error;

	//execute the statement, returns true on success or FALSE on failure, errors stored in the statement object 
	//executing the variables and prepared table, executes the insert into from prepare 
	if(!$tblInpt->execute())
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	
	//closing after execution because if you don't close it and have unfetched rows you will get erros trying to make a new prepared statement
	$tblInpt->close();
	
}

$addResults = sprintf("SELECT lodge.name AS Lodge, resort.name AS Resort
					FROM lodge 
					INNER JOIN resort ON resort.rid=lodge.rid");

if($result = $mysqli->query($addResults))
{
$table = "<table><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>
";
	$table=$table."<tr><td><h2>Lodge Name</h2></td><td><h2>Resort Located</h2></td></tr>";

	while($row = $result->fetch_assoc())
	{
		$table = $table."<tr><td>".$row['Lodge']."</td><td>".$row['Resort']."</td></tr>";

	}
	$table = $table."</table>";
	
	echo $table;
	$result->free();
}

$mysqli->close();

?>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php" method="POST">
<div><input type="submit" value="Go Back"></div>
</form>
