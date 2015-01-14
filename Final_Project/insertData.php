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
<body>
<fieldset>
<legend>Add a Resort: </legend>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addResortResults.php" method="POST">
<div>Name: <input type="text" name="resortName"></div>
<input type="submit" value="Add Resort">
</form>
</fieldset>
<br>
<fieldset>
<legend>Add a Skill Level: </legend>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertResults.php" method="POST">
<div>Name: <input type="text" name="skillName"></div>
<input type="submit" value="Add Skill Level">
</form>
</fieldset>
<br>
<fieldset>
<legend>Add a Lodge: </legend>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addLodgeResults.php" method="POST">
<div>Name: <input type="text" name="lodgeName"></div>
Resort Located: 
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
<input type="submit" value="Add Lodge">
</form>
</fieldset>
<br>
<fieldset>
<legend>Add a Lift: </legend>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addLiftResults.php" method="POST">
<div>Name: <input type="text" name="liftName"></div>
<div>Lodge Lift Connects to: 
<select name="lodgeList">
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
		
<input type="submit" value="Add Lift">
</form>
</fieldset>
<br>
<fieldset>
	<legend>Add a Run:</legend>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addRun.php" method="POST">
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
<input type="submit" value="Select Resort">
</form>
</fieldset>
<br>

<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>
</body>
</html>