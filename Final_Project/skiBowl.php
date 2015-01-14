<?php
	ini_set('display_errors', 'On'); //error report
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db"); //Connects to the database
	if($mysqli->connect_errno)
	{
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error; //reports error if can't connect to database
	} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> Ski Bowl Info Page - Final Project CS 275 </title>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="http://web.engr.oregonstate.edu/~paule/CS%20275/275_Final.css" />
</head>
<body>
	<div style="text-align:center;"><h2><label>Select a lift and your skill level to view what runs you should take: </label></h2></div>

<div>
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/skiBowlResults.php">
	<fieldset>
		<legend>Lift List: </legend>
			<select name="liftNames"> 
<?php
	//code to dynamically select all the lift names on Ski Bowl 
	if(!($stmt = $mysqli->prepare("SELECT lift.lftid AS 'lftid', lift.name AS 'name'
							FROM lift
							INNER JOIN lodge ON lodge.lid = lift.lid
							INNER JOIN resort ON resort.rid = lodge.rid
							WHERE resort.rid = 3")))
	{
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()) //select statement is executed 
	{	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($lftid, $name))
	{
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()) //selects all the lift names 
	{
		echo '<option value=" '. $lftid. ' "> ' . $name . '</option>\n'; //the lift id column (lftid) is the option value number and the name is shown in drop down menu 
	}

	$stmt->close();

?>
			</select>
	</fieldset>
		
	<fieldset>
		<legend>Skill Level: </legend>
			<select name="skillList">
<?php 

ini_set('display_errors', 'On'); //error report

	if(!($stmt = $mysqli->prepare("SELECT eid, name FROM experience"))) //selects skill level names 
	{
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($eid, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<option value=" '. $eid. ' "> ' . $name . '</option>\n';
	}
	$stmt->close();

	?>
				</select>
	</fieldset>
		<input type="submit" value="Submit">
</form>
</div>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>



