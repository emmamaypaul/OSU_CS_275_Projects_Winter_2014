<?php
ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above 

$lodgeID= $_POST['lodge'];

//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST['lodge']))
{
	$lodgeQuery = sprintf("SELECT resort.name AS 'Resort Name'
				FROM resort
				INNER JOIN lodge ON lodge.rid = resort.rid 
				WHERE lodge.lid = ' $lodgeID '");


}
	
//newest attempt using http://php.net/manual/en/mysqli-result.fetch-assoc.php

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","ShhOnXOEe6IVSHUB","pauli-db");

if (mysqli_connect_errno())
{
	echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}



if($result = $mysqli->query($lodgeQuery))
{
	while($stmt = $result->fetch_assoc())
	$info = $stmt['Resort Name'];
		
}
echo "The lodge you selected is located at  $info Resort";


$result->free();
$mysqli->close();

?>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>