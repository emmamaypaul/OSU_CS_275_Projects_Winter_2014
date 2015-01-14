<?php
ini_set('display_errors', 'On'); //error report

//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> Home Page - CS 275 Project </title>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="http://web.engr.oregonstate.edu/~paule/CS%20275/275_Final.css" />
</head>
<div style="text-align:center;"><h1><font color="blue">Mt Hood Database</font></h1></div>
<body>
<fieldset>
<div style="text-align:center;"><h3><label>Please choose your personal ski or snowboarding skill level:</label></h3></div>
<div id="daySki">
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/skillLevel.php">
<legend>If you plan on Day Skiing: </legend>
<select name="skillList">
<?php
	if(!($stmt = $mysqli->prepare("SELECT eid, name FROM experience"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($rid, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<option value=" '. $rid. ' "> ' . $name . '</option>\n';
	}
	$stmt->close();
?>
				</select>
		
		<input type="submit" value="Submit">
	</form>
</div>

<div id="nightSki">
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/nightSkillLevel.php">
<legend>If you plan on Night Skiing: </legend>
<select name="skillList">
<?php
	if(!($stmt = $mysqli->prepare("SELECT eid, name FROM experience"))){
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
		
		<input type="submit" value="Submit">
	</form>
</div>
</fieldset>

<br>
<fieldset>
<div style="text-align:center;"><h3><label>Please choose the Lodge you'd like to Visit:</label></h3></div>
<div id="lodges">
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/lodge.php">
<legend>List of Lodges: </legend>
<select name="lodge">
<?php
	if(!($stmt = $mysqli->prepare("SELECT lid, name FROM lodge"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($lid, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<option value=" '. $lid. ' "> ' . $name . '</option>\n';
	}
	$stmt->close();
?>
				</select>
		
		<input type="submit" value="Submit">
	</form>
</div>
</fieldset>
<br>
<br>
<fieldset>
<div style="text-align:center;"><h3><label>General Resort Info:</label></h3></div>
<div>
<legend>Resort List: </legend>
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/resortInfo.php">
<select name="resortList">
<?php
	if(!($stmt = $mysqli->prepare("SELECT rid, name FROM resort"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($rid, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<option value=" '. $rid. ' "> ' . $name . '</option>\n';
	}
	$stmt->close();
?>
				</select>
		
		<input type="submit" value="See Resort Info">
	</form>
</div>
</fieldset>
<br>
<fieldset>
<div style="text-align:center;"><h3><label>Please choose a Resort for Specific Run Info: </label></h3></div>
<div>
<legend>Resort List: </legend>
<form method="POST" action="http://web.engr.oregonstate.edu/~paule/CS%20275/resortRunInfo.php">
<select name="resort">
<?php
	if(!($stmt = $mysqli->prepare("SELECT rid, name FROM resort"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($rid, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<option value=" '. $rid. ' "> ' . $name . '</option>\n';
	}
	$stmt->close();
?>
				</select>
		
		<input type="submit" value="See Resort Info">
	</form>
</div>
</fieldset>

<br>
<fieldset>
<div id="insertData">
<h3>If you'd like to add data to the Mt. Hood Database, please click button below:</h3>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php" method="POST">
<div><input type="submit" value="Add Data"></div>
</form>
</fieldset>

</body>
</html>