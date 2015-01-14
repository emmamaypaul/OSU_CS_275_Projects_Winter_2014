<?php
ini_set('display_errors', 'On'); //error report

//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<div>
<?php
	if(!($stmt = $mysqli->prepare("SELECT lift.lftid AS 'lift', lift.name AS 'name'
							FROM lift 
							INNER JOIN lodge ON lodge.lid= lift.lid
							INNER JOIN resort ON resort.rid = lodge.rid
							WHERE resort.rid = 1"))){
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
	}
	if(!$stmt->execute()){	
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	}
	if(!$stmt->bind_result($lift, $name)){
		echo "Bind failed: (".$mysqli->errno.") ".$mysqli->error;
	}	
	while($stmt->fetch()){
		echo '<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/checkResults.php"
		method="POST"><input type="checkbox" name="lift[]" value=" '. $lift .'"> '. $name.'<br>';
	}
	$stmt->close();
?>
<input type="submit" value="Add Run"></form>
</div>