<?php
ini_set('display_errors', 'On'); //error report

//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","XXXXXXXXXXXXXXX","pauli-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<fieldset>
	<legend>Add a Run: </legend>
	<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addRunResults.php" method="POST">

<div>Name: <input type="text" name="runName"></div>
<div>Skill Level of Run: 
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
<div>Select if it is lit OR not lit (for night skiing): 
<select name="lit">
	<option value="1">Lit</option>
	<option value="0">Not Lit</option>
</select>
<div>Select all the lifts the new run connects to: <br>
<?php
	$resortID = $_POST['resortList'];

	if(!($stmt = $mysqli->prepare("SELECT lift.lftid AS 'lift', lift.name AS 'name'
							FROM lift 
							INNER JOIN lodge ON lodge.lid= lift.lid
							INNER JOIN resort ON resort.rid = lodge.rid
							WHERE resort.rid = $resortID"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($lift, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/addRunResults.php"
		method="POST"><input type="checkbox" name="liftList[]" value=" '. $lift .'"> '. $name.'<br>';
	}
	$stmt->close();
?>
<input type="submit" value="Add Run"></form>
</div>
</form>
</fieldset>

<br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/insertData.php" method="POST">
<div><input type="submit" value="Go Back"></div>
</form>
</body>
</html>
